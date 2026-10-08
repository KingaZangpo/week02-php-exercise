<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$rules = [
    'Submitted' => [
        'Under review'
    ],
    'Under review' => [
        'Approved',
        'Rejected'
    ],
    'Rejected' => [
        'Submitted'
    ],
    'Approved' => []
];

function can_move(string $from, string $to): bool
{
    global $rules;
    $allowedStatuses = $rules[$from] ?? [];
    return in_array($to, $allowedStatuses, true);
}

$moves = [
    [
        'from' => 'Submitted',
        'to' => 'Under review'
    ],
    [
        'from' => 'Submitted',
        'to' => 'Approved'
    ],
    [
        'from' => 'Under review',
        'to' => 'Rejected'
    ],
    [
        'from' => 'Approved',
        'to' => 'Submitted'
    ],
    [
        'from' => 'Rejected',
        'to' => 'Submitted'
    ],
    [
        'from' => 'Closed',
        'to' => 'Submitted'
    ]
];

$moveResults = [];

foreach ($moves as $move) {
    $allowed = can_move(
        $move['from'],
        $move['to']
    );
    $result = $allowed ? 'Allowed' : 'Blocked';
    $moveResults[] =
        $move['from'] .
        " → " .
        $move['to'] .
        ": " .
        $result;
}

// Extension: role-based moves
function can_move_as(
    string $role,
    string $from,
    string $to
): bool {

    $roleRules = [

        'officer' => [
            'Under review'
        ],

        'approver' => [
            'Approved',
            'Rejected'
        ],

        'requester' => [
            'Submitted'
        ]
    ];

    $allowedTargets = $roleRules[$role] ?? [];
    if (!can_move($from, $to)) {
        return false;
    }
    return in_array(
        $to,
        $allowedTargets,
        true
    );
}

$roleResults = [
    can_move_as(
        'officer',
        'Under review',
        'Approved'
    ),

    can_move_as(
        'approver',
        'Under review',
        'Approved'
    ),

    can_move_as(
        'requester',
        'Rejected',
        'Submitted'
    )
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Week 2 - Exercise 5</title>
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

    <h1>Week 2 - Exercise 5</h1>
    <h2>Status Changes</h2>

    <?php
    foreach ($moveResults as $result) {
        echo '<div class="result">';
        echo $result;
        echo '</div>';
    }
    ?>

    <h2>Role-Based Moves</h2>

    <?php
    foreach ($roleResults as $result) {
        echo '<div class="role-result">';
        var_dump($result);
        echo '</div>';
    }
    ?>
</div>

</body>
</html>