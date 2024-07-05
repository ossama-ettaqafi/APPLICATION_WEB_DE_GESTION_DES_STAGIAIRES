<!DOCTYPE html>
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        margin-top: 50px;
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    th, td {
        padding: 4px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    .header {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo img {
        height: 55px;
        width: auto;
        margin-right: 10px; /* Add margin for spacing */
    }

    .export-info {
        font-size: 14px;
        position: absolute;
        top: 26px;
        right: 10px;
    }

</style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/suninternship.png'))) }}" alt="Logo">
        </div>
        <div class="export-info">
            Page : {{ $pageNumber }} / {{ $totalPages }} | Exporté en: {{ now()->format('Y-m-d H:i:s') }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Âge</th>
                <th>CIN</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>École</th>
                <th>Secteur</th>
                <th>Date de début</th>
                <th>Date de fin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $intern)
                <tr>
                    <td>{{ $intern->id }}</td>
                    <td>{{ $intern->firstName }}</td>
                    <td>{{ $intern->lastName }}</td>
                    <td>{{ $intern->age }}</td>
                    <td>{{ $intern->cin }}</td>
                    <td>{{ $intern->phone }}</td>
                    <td>{{ $intern->address }}</td>
                    <td>{{ $intern->school }}</td>
                    <td>{{ $intern->sector }}</td>
                    <td>{{ $intern->startDate }}</td>
                    <td>{{ $intern->endDate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
