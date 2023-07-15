<!DOCTYPE html>
<html>

<head>
    <title>Data Cuaca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    <style>
        .suhu {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .icon {
            font-size: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Data Cuaca</h1>
        <div>
            <form action="/city" method="POST">
                @csrf
                <label for="city">Kota</label>
                <div class="d-flex">
                    <input class="form-control" type="text" name="city" id="city">
                    <button class="btn btn-primary mx-2" type="submit">Cari</button>
                </div>
            </form>
        </div>
        @foreach ($weather as $w)
        <div class="suhu">
            <div class="text-center ">
                <i class="icon {{ $icon }}"></i>
                <h1>{{ $w->city }}</h1>
                <h4>{{ $w->temperature }} °C</h4>
            </div>
        </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>