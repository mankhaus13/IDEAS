<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отчет по ресурсам</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th, td {
            padding: 8px 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .count-section {
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<h1 style="text-align:center;">Отчет по ресурсам</h1>

<div class="count-section">
    <strong>Количество использованных ресурсов по сотрудникам:</strong>
    <ul>
        @foreach($countResourcesUser as $userName => $resourcesCount)
            <li>{{ $userName }}: {{ $resourcesCount }} ресурса(ов)</li>
        @endforeach
    </ul>
</div>

<table>
    <thead>
    <tr>
        <th>№ отчета</th>
        <th>Сотрудник</th>
        <th>Ресурс</th>
        <th>Дата</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    @foreach($resources as $resource)
        <tr>
            <td>{{ $resource->number_report }}</td>
            <td>{{ $resource->user->name }}</td>
            <td>{{ $resource->resource_name }}</td>
            <td>{{ \Carbon\Carbon::parse($resource->date_report)->format('d.m.Y') }}</td>
            <td>{{ $resource->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
