<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ads;
use App\adImages;
use App\Tools;
use App\Providers\workWithRegions2;
use Illuminate\Support\Facades\Input;
use DB;
use App\Quotation;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $ads = Ads::with(['image'])->orderByDesc("created_at")->paginate(10);
        $regions= workWithRegions2::getAllRegions();
        if ($request->ajax()) {
            return view('home.cars', ['ads'=>$ads,'regions'=>$regions]);
        }
        return view('home.index', ['ads'=>$ads,'regions'=>$regions]);
    }
    public function search(Request $request){
        $query=$this->build($request);
        $ads= $query->get();

        $regions=workWithRegions2::getAllRegions();

        return view("home.search",['ads'=>$ads,'regions'=>$regions]);
    }
    private function build(Request $request){
        $query = DB::table('ads');
        if(!empty($request->regions)&&$request->regions>=0)
            $query->where('region',workWithRegions2::getRegionByIndex($request->regions));
        if(!empty($request->city))
            $query->where('city',$request->city);
        if (!empty($request->carBrand))
            $query->where('carBrand',$request->carBrand);
        if (!empty($request->carModel))
            $query->where('carModel',$request->carModel);
        if (!empty($request->carEngine)){
            $num=number_format($request->carEngine,1);
            $query->where('carEngine','like',$num);
        }
        if (!empty($request->ownersCount))
            $query->where('ownersCount',$request->ownersCount);
        if (!empty($request->milage))
            $query->where('milage',$request->milage);
       // echo dd($query);
        return $query;
    }
    public function cities($id){
        $index =(int)$id;
        $cities=null;
        $cities=workWithRegions2::getCitiesByRegionIndex($index);
        foreach ($cities as $city){
            echo "<option value='".$city."'>".$city."</option>";
        }
    }
    public function create(Request $request)
    {

        if (!Auth::check())
            return redirect('login')->with('message',"asdasd");
        else{
            $user = Auth::user();
            $id = Auth::id();
            $ads=Ads::All()->where("userId",$id)->count();

      if($ads>=3)
                return redirect()->action('HomeController@index')->withErrors(['cannot add more the 3 ads from 1 acc', 'cannot add more the 3 ads from 1 acc']);




            $ad = new Ads;
            $ad->carModel = $request->carModel;
            $ad->userId = $id;
            $ad->carBrand = $request->carBrand;
            $ad->carEngine = $request->carEngine;
            $ad->region = workWithRegions2::getRegionByIndex($request->regions);
            $ad->city = $request->city;
            $ad->ownersCount = $request->ownersCount;
            $ad->milage = $request->milage;
            !$ad->save();

            if($request->hasFile('pic')){
                $image = new adImages;
                $f=$request->file('pic');
                $ext=$f->getClientOriginalExtension();
                $filename= rand().'.'.$ext;
                $f->move("storage/uploads/ads",$filename);
                $image->adId=$ad->id;
                $image->name=$filename;
                $image->save();
            }

         return   redirect()->action("HomeController@index");

    }
}
}
