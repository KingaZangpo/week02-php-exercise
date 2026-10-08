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
    <title>Week 2 - Exercise 1</title>

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
            padding: 20px;
            margin: 15px 0;
        }

        .result-title {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .answer {
            font-size: 20px;
        }
    </style>
</head>

<body>

<body>

<?php

// Snippet A
$x = 0;
$label = $x ?: 'none';
$size = $x ?? 'none';

// Snippet B
$total = 0;

for ($i = 1; $i <= 10; $i++) {
    if ($i % 3 === 0) {
        continue;
    }
    if ($i > 7) {
        break;
    }
    $total += $i;
}

// Snippet C
$m = [
    'b' => 2,
    'a' => 1,
    'c' => 3
];

$out = '';

foreach ($m as $k => $v) {
    $up = $v > 1;
    $out .= $up ? strtoupper($k) : $k;
}

// Snippet D
$n = strlen(trim(' Paro '));

?>


<div class="container">
    <h1>Week 2 - Exercise 1</h1>
    <div class="result">
        <?php
        echo "Snippet A: $label | $size";
        ?>
    </div>
    <div class="result">
        <?php
        echo "Snippet B: $total";
        ?>
    </div>
    <div class="result">
        <?php
        echo "Snippet C: $out";
        ?>
    </div>
    <div class="result">
        <?php
        echo "Snippet D: " . $n . substr('Paro', -2);
        ?>
    </div>
</div>

</body>
</html>