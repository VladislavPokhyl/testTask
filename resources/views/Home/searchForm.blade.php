<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
   <script> src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.Laravel = {"csrfToken":"{{ csrf_token() }}"}
    </script>
</head>
<body>
<div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12">
        {!! Form::open(array('action'=>'HomeController@search','class'=>'form','method'=>'POST',"enctype"=>"multipart/form-data")) !!}
        {{ csrf_field() }}
        <ul class="nav nav-pills nav-justified">
            <li><div class="form-check-inline">
                    <select  class="custom-select" data-dependent="city" id="regions" name="regions" onchange="selectedChanged(this.value)">
                        <option value="-1">Выберите регион</option>
                        @for($i=0;$i<count($regions);$i++)
                            <option value="{{$i}}">{{$regions[$i]}}</option>
                        @endfor
                    </select>
                </div></li>
            <li ><div class="form-check-inline ">
                    <select  class="custom-select dynamic" name="city" id="cities" style="min-width :150px; max-width:150px; ">

                    </select>

                </div></li>
            <li> <div class='form-check-inline'>
                    <input type="text"  class="form-control" name="carBrand" placeholder="Марка">
                </div></li>
            <li>
                <div class='form-group'>

                    <input type="text"  class="form-control" name="carModel" placeholder="Модель">
                </div></li>
            <li style="width: 100px;"><div class='form-check-inline'>

                    <input step="0.1" type="number" name="carEngine" class="form-control" placeholder="Объем" >
                </div></li>
            <li> <div class='form-check-inline'>
                    <input type="number" name="milage"  class="form-control" placeholder="Километраж">
                </div></li>
            <li><div class='form-check-inline'>
                    <input type="number" name="ownersCount"  class="form-control" placeholder="Кол-во владельцев">
                </div></li>

        </ul>

        <div class='row'>
            <div class="col-md-4"></div>
            <button class="btn btn-success form-control col-md-4" type="submit" style="margin-bottom: 10px; margin-top:10px">Найти</button>
            <div class="col-md-4"></div>
        </div>
        {!! Form::close() !!}
    </div>

</div>
</body>
</html>




<script>
    function selectedChanged(value){
        let ao=null;
        let cities=document.getElementById('cities');
        cities.innerHTML="";
        if (value==-1) {
            cities.innerHTML="";

        }
        if (window.XMLHttpRequest) {
            ao=new XMLHttpRequest();
        }
        else
            ao=new ActiveXObject("Microsoft.XMLHTTP");

        ao.onreadystatechange=function(){
            if(ao.readyState==4&&ao.status==200){
                let resp=ao.responseText;
                cities.innerHTML=resp;

            }}
            if(value!=-1){
                ao.open("GET","/Home/cities/"+value,true);
                ao.send(null);
            }

    }
</script>


