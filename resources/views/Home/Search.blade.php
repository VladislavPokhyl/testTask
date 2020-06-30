@include("layouts.app")


<div class="container">
<div class="row">
    @if(count($ads)>0)
        <table class="table">
            <thead>
            <tr>
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
                    <td>{{$ad->carBrand}}</td>
                    <td>{{$ad->carModel}}</td>
                    <td>{{$ad->milage  }}</td>
                    <td>{{$ad->carEngine }}</td>
                    <td>{{$ad->ownersCount }}</td>

                    <td>{{$ad->region}} {{$ad->city}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <p>Данные не найдены</p>
    @endif
</div>
</div>
