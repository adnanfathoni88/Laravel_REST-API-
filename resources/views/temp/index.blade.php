<!DOCTYPE html>
<html>

<head>
    <title>Data Cuaca</title>
</head>

<body>
    <h1>Data Cuaca</h1>

    <table>
        <thead>
            <tr>
                <th>Kota</th>
                <th>Suhu</th>
                <th>Kelembaban</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weather as $w)
            <tr>
                <td>{{ $w->city }}</td>
                <td>{{ $w->temp }}</td>
                <td>{{ $w->humidity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>