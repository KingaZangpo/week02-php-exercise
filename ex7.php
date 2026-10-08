<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$duplicateMessages = [];
$invalidMessages = [];

// Group requests by CID to check for duplicates
$cidGroups = [];

foreach ($requests as $r) {
    $cid = $r['cid'] ?? '';
    $cidGroups[$cid] ??= [];
    $cidGroups[$cid][] = $r['id'] ?? 'Unknown';
}

foreach ($cidGroups as $cid => $ids) {
    if (count($ids) > 1) {
        $duplicateMessages[] = "Duplicate CID $cid: requests " . implode(', ', $ids);
    }
}

if (empty($duplicateMessages)) {
    $duplicateMessages[] = "No duplicate CIDs found.";
}

// Check for invalid CIDs
foreach ($requests as $r) {
    $cid = $r['cid'] ?? '';
    if (!is_valid_cid($cid)) {
        $invalidMessages[] = "Invalid CID in request " . ($r['id'] ?? 'Unknown') . ": " . $cid;
    }
}

if (empty($invalidMessages)) {
    $invalidMessages[] = "All CIDs are valid.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Week 2 - CID Validation</title>
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

    <h1>CID Validation Checks</h1>

    <h2>Duplicate CID Status</h2>

    <?php
    foreach ($duplicateMessages as $message) {
        echo '<div class="result">';
        echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        echo '</div>';
    }
    ?>

    <h2>CID Validity Status</h2>

    <?php
    foreach ($invalidMessages as $message) {
        echo '<div class="role-result">';
        echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        echo '</div>';
    }
    ?>
</div>

</body>

</html>