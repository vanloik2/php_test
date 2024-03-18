<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
@php
@endphp

<body>
    <div class="">
        <table class="table table table-white table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Restaurant</th>
                    <th scope="col">Meal</th>
                    <th scope="col">No Of People</th>
                    <th scope="col">Dish - quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['restaurant'] }}</td>
                        <td>{{ $item['meal'] }}</td>
                        <td>{{ $item['amount_people'] }}</td>
                        <td>
                            @foreach ($item['dish_quantity'] as $key => $val)
                                {{ $key }} - {{ $val }} </br>
                            @endForeach
                        </td>
                    </tr>
                @endForeach
            </tbody>
        </table>
    </div>
</body>

</html>
