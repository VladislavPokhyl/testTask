{{--@extends("layouts.app")--}}

@include("Home.searchForm")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{--@include("Home.searchForm")--}}
<style>
    .tableimage{
        width: 125px;
        height: 75px;
    }
    td{height: 75px;width: 125px;
        text-align: center;
        vertical-align:center;}
</style>
<div class="container">
    @if($errors->any())
        <h4 ><span style="color:red">{{$errors->first()}}</span></h4>
    @endif
<div class="row">

    @if(count($ads)>0)
        <table class="table">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Марка</th>
                <th>Модель</th>
                <th>Километраж</th>
                <th>Объем двигателя</th>
                <th>Кол-во хозяинов</th>
                <th>Расположение</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td>
                        @if(count($ad->image)>0)
                        @foreach($ad->image as $a)
                           <img class="tableimage" src="{{asset("storage/uploads/ads/".$a->name)}}" alt="qweqwe">
                            @endforeach
                                @else <p>foto ne naideno</p>
                            @endif
                    </td>
                    <td>{{$ad->carBrand}}</td>
                    <td>{{$ad->carModel}}</td>
                    <td>{{$ad->milage  }}</td>
                    <td>{{$ad->carEngine }}</td>
                    <td>{{$ad->ownersCount }}</td>

                     <td>{{$ad->region}} г.{{$ad->city}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <p>Данные не найдены</p>
    @endif

</div>
    <div> {!! $ads->links()!!} </div>

</div>



