<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    } elseif ($days <= 7) {
        return 'On time';
    } elseif ($days <= 14) {
        return 'Follow up';
    } else {
        return 'Overdue';
    }
}

$today = '2026-10-07';

$overdue = 0;
$followUp = 0;
$onTime = 0;

$results = [];


foreach ($requests as $r) {

    if (
        $r['status'] === 'Submitted' ||
        $r['status'] === 'Under review'
    ) {

        $days = intdiv(
            strtotime($today) - strtotime($r['submitted']),
            86400
        );

        $name = full_Name(
            $r['first'],
            $r['last']
        );

        $band = wait_band($days);

        $results[] = "#" . $r['id'] . " " . $name .
            " — " . $days . " days — " . $band;

        if ($band === 'Overdue') {
            $overdue++;
        } elseif ($band === 'Follow up') {
            $followUp++;
        } elseif ($band === 'On time') {
            $onTime++;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2 - Exercise 4</title>
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

        .result {
            background-color: #3D8D7A;
            border: 2px solid #FFFACD;
            border-radius: 12px;
            padding: 18px;
            margin: 15px 0;
        }

        .summary {
            margin-top: 25px;
            padding: 20px;
            background-color: #245B50;
            border-radius: 12px;
            border: 2px solid #FFFACD;
        }
    </style>
</head>

<body>

<div class="container">
    <h1>Week 2 - Exercise 4</h1>
    <?php
    foreach ($results as $result) {
        echo '<div class="result">';
        echo $result;
        echo '</div>';
    }
    ?>

    <div class="summary">
        <?php
        echo "$overdue overdue · ";
        echo "$followUp follow up · ";
        echo "$onTime on time";
        ?>
    </div>
</div>

</body>

</html>