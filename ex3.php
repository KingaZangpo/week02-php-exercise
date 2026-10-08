<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2 - Exercise 3</title>

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
            max-width: 700px;
            margin: auto;
            padding: 30px;
            background-color: #2F6F62;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        h1 {
            margin-bottom: 30px;
        }

        .result {
            background-color: #3D8D7A;
            border: 2px solid #FFFACD;
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
        }
    </style>
</head>

<body>

<div class="container">
    
    <h1>Week 2 - Exercise 3</h1>
    <?php
    foreach ($requests as $r) {
        $reference = make_reference(
            $r['id'],
            $r['dzongkhag'],
            $r['submitted']
        );

        echo '<div class="result">';
        echo $reference;
        echo '</div>';
    }
    ?>

</div>

</body>
</html>