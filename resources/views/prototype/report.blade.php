<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Отчет по экспериментам</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; color: #555; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .status-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }
        .status-success { background-color: #10B981; }
        .status-warning { background-color: #F59E0B; }
        .status-danger { background-color: #EF4444; }
        .status-info { background-color: #3B82F6; }
        .footer { margin-top: 30px; font-size: 12px; text-align: right; }
        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #3B82F6;
        }
        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-top: 10px;
        }
        .progress-bar {
            height: 20px;
            border-radius: 5px;
            background-color: #10B981;
            text-align: center;
            line-height: 20px;
            color: white;
        }
    </style>
</head>
<body>
@auth
<div class="header">
    <div class="title">Отчет по экспериментам</div>
    <div class="subtitle">Дата формирования: {{ $date }}</div>
</div>

<table class="table">
    @foreach($prototypes as $prototype)
        <tr>
            <th width="30%">Параметр</th>
            <th width="70%">Значение</th>
        </tr>
        <tr>
            <td>Номер эксперимента</td>
            <td>{{ $prototype->number_exp }}</td>
        </tr>
        <tr>
            <td>Модель детали</td>
            <td>{{ $prototype->model_detail }}</td>
        </tr>
        <tr>
            <td>Дата эксперимента</td>
            <td>{{ \Carbon\Carbon::parse($prototype->date_exp)->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td>Статус</td>
            <td>
                @if($prototype->status == 'success')
                    <span class="status-badge status-success">Успешно</span>
                @elseif($prototype->status == 'warning')
                    <span class="status-badge status-warning">Требует доработки</span>
                @elseif($prototype->status == 'danger')
                    <span class="status-badge status-danger">Провален</span>
                @elseif($prototype->status == 'info')
                    <span class="status-badge status-info">В процессе</span>
                @endif
            </td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $prototype->description }}</td>
        </tr>
        <tr><td colspan="2" style="height: 15px; background-color: #f8f9fa;"></td></tr>
    @endforeach
</table>

<div class="summary">
    <h3>Статистика выполнения экспериментов</h3>
    <p>Общее количество экспериментов: {{ $prototypes->count() }}</p>
    <p>Процент выполненных экспериментов: {{ $percentCompletedExp }}%</p>

    <div class="progress-container">
        <div class="progress-bar" style="width: {{ $percentCompletedExp }}%">
            {{ $percentCompletedExp }}%
        </div>
    </div>
</div>
@endauth
</body>
</html>
