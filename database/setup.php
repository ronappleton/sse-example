<?php

declare(strict_types=1);

$db = new SQLite3('database.sqlite');

if (!$db) {
    echo $db->lastErrorMsg();
    die;
}

$tables['orders'] = <<<EOF
    CREATE TABLE IF NOT EXISTS orders
    (
        id INT PRIMARY KEY NOT NULL,
        name TEXT NOT NULL,
        editing_at INT DEFAULT 0 NOT NULL,
        created_at TEXT NOT NULL,
        updated_at TEXT NULL
    );
EOF;

foreach ($tables as $table => $sql) {
    $result = $db->exec($sql);
    if (!$result) {
        echo $db->lastErrorMsg();
        die;
    }
    echo sprintf('Table %s successfully created.', $table) . PHP_EOL;
}

$seedPath = dirname(__DIR__) . '/database/seeds/';

$ordersSeed = json_decode(file_get_contents($seedPath . 'orders.json'));

foreach ($ordersSeed as $order) {
    $insert = sprintf(
        'INSERT INTO orders (`id`, `name`, `editing_at`, `created_at`) VALUES (%d, "%s", "%s", "%s")',
        $order->id,
        $order->name,
        $order->editing_at,
        $order->created_at,
    );

    echo $insert . PHP_EOL;

    $db->exec($insert);
}

$db->close();


