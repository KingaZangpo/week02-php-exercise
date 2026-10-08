<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

function count_pending(array $requests): int
{
    $total = 0;

    for ($i = 0; $i < count($requests); $i++) {
        $status = $requests[$i]['status'] ?? '';

        if (
            $status === 'Submitted' ||
            $status === 'Under review'
        ) {
            $total++;
        }
    }

    return $total;
}

$pendingCount = count_pending($requests);

// Summary results to fit the styled card layout
$summaryResults = [
    "Total Pending Requests (Submitted or Under Review): " . $pendingCount
];

// Individual request breakdown for the secondary section
$requestStatuses = [];
foreach ($requests as $request) {
    $label = $request['name'] ?? ('Request #' . ($request['id'] ?? 'Item'));
    $status = $request['status'] ?? 'Unknown';
    $requestStatuses[] = $label . " — Status: " . $status;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Week 2 - Pending Requests</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            text-align: center;
            background-color: #3D8D7A;
            color: #FFFACD;
            text-shadow: 1px 1px 2px #000;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 750px;
            margin: auto;
            padding: 30px;
            background-color: #2F6F62;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        h1 {
            margin-bottom: 30px;
            font-size: 32px;
        }

        h2 {
            margin-top: 30px;
        }

        .result {
            background-color: #3D8D7A;
            border: 2px solid #FFFACD;
            border-radius: 12px;
            padding: 18px;
            margin: 15px 0;
        }

        .role-result {
            background-color: #245B50;
            border: 2px solid #FFFACD;
            border-radius: 12px;
            padding: 15px;
            margin: 10px 0;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Request Statistics</h1>

    <h2>Pending Summary</h2>

    <?php
    foreach ($summaryResults as $result) {
        echo '<div class="result">';
        echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        echo '</div>';
    }
    ?>

    <h2>All Requests Breakdown</h2>

    <?php
    foreach ($requestStatuses as $statusText) {
        echo '<div class="role-result">';
        echo htmlspecialchars($statusText, ENT_QUOTES, 'UTF-8');
        echo '</div>';
    }
    ?>
</div>

</body>

</html>