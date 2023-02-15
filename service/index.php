<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/database/bootstrap.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use React\EventLoop\Loop;
use RonAppleton\SseExample\Services\Watcher;

try {
    $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
} catch (Exception $e) {
    echo sprintf('An exception occurred connecting to RabbitMQ: %s', $e->getMessage()) . PHP_EOL;
    echo 'Stopping...' . PHP_EOL;
    exit(1);
}

$watcher = new Watcher;
$loop = Loop::get();

$topic = new \Ratchet\Wamp\Topic('orders');

$queues = [
    'orders' => 'onOrderMessage',
];

$webSock = new React\Socket\SocketServer('0.0.0.0:8888', [], $loop);
$webServer = new Ratchet\Server\IoServer(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Ratchet\Wamp\WampServer(
                $watcher
            )
        )
    ),
    $webSock
);


$channel = $connection->channel();

foreach ($queues as $queue => $method) {
    echo sprintf('Creating and attaching to queue: %s', $queue) . PHP_EOL;

    $channel->queue_declare($queue, false, false, false, false);
    $channel->basic_consume(
        $queue,
        '',
        false,
        true,
        false,
        false,
        static fn ($msg) => $watcher->$method($msg));
}



echo 'Starting server now on http://localhost:8888 Ctrl+C to quit.' . PHP_EOL;

try {
    $loop->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
