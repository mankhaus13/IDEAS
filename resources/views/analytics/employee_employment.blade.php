<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Занятость сотрудников</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div style="width: 100%; min-height: 500px; height: 90vh;">
    <canvas id="countEmployment"></canvas>
</div>
</body>

<script>
    const ctx = document.getElementById('countEmployment');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_keys($employmentCount)),
            datasets: [{
                label: 'Кол-во занятых рабочих',
                data: @json(array_values($employmentCount)),
                backgroundColor: [
                    '#2196F3',
                ],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: 5 },
            scales: {
                x: { ticks: { font: { size: 10 } } },
                y: { ticks: { font: { size: 10 } } }
            }
        }
    });
</script>
</html>
