<?php

declare(strict_types=1);

function full_Name(string $first_name, string $last_name): string
{
    return ucwords(
        strtolower(
            trim($first_name . ' ' . trim($last_name))
        )
    );
}

function is_valid_cid(string $cid): bool
{
    $cid = trim($cid);

    return strlen($cid) === 11 && ctype_digit($cid);
}

function count_by_status(array $requests, string $status): array
{
    $count = 0;

    foreach ($requests as $r) {
        if ($r['status'] === $status) {
            $count++;
        }
    }

    return [
        $status => $count
    ];
}

function make_reference(
    int $id,
    string $dzongkhag,
    string $submitted
): string {
    $dzongkhag = trim($dzongkhag);
    $shortName = strtoupper(substr($dzongkhag, 0, 3));
    $year = substr($submitted, 0, 4);
    $formattedId = sprintf('%04d', $id);

    // IDs longer than four digits are kept intact rather than truncated.
    return $shortName . '-' . $year . '-' . $formattedId;
}
