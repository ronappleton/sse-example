<?php

declare(strict_types=1);

namespace RonAppleton\SseExample\Services;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;
use Ratchet\WebSocket\WsServerInterface;

class Watcher implements WampServerInterface, WsServerInterface
{
    public function __construct(
        private array $subscribedTopics = [],
        private readonly \SplObjectStorage $clients = new \SplObjectStorage())
    {
    }

    function onSubscribe(ConnectionInterface $conn, mixed $topic)
    {
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    function onUnSubscribe(ConnectionInterface $conn, mixed $topic)
    {
        // TODO: Implement onUnSubscribe() method.
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    /**
     * @throws \JsonException
     */
    public function onOrderMessage(string $msg)
    {
        $data = json_decode($msg, true, 512, JSON_THROW_ON_ERROR);

        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($data['category'], $this->subscribedTopics)) {
            return;
        }

        $topic = $this->subscribedTopics[$data['category']];

        // re-send the data to all the clients subscribed to that category
        $topic->broadcast($data);
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        trigger_error("An error has occurred: {$e->getMessage()}\n", E_USER_WARNING);

        $conn->close();
    }

    function getSubProtocols(): array
    {
        return ['ocpp1.6'];
    }
}
