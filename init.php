<?php
require_once("vendor/autoload.php");
require_once('app/cores/Websocket.php');

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Speaker\cores\ChatWebSocket\Chat;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);
try {
    $server->run();
} catch (Exception $e) {
    echo 'Error has occurred';
    exit();
}
?>