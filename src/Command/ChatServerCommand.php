<?php


namespace App\Command;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use App\Server\Chat;
use Ratchet\Http\OriginCheck;
use React\EventLoop\Factory;
use React\Socket\Server;
use React\ZMQ\Context;
use ZMQ;

/*require getcwd(). '/vendor/autoload.php';*/
class ChatServerCommand  extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:chat-server')
            ->setDescription('Start chat server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       /* $server = IoServer::factory(
            new HttpServer(new WsServer(new Chat())),
            8080,
            '127.0.0.1'
        );
        $server->run();*/
        $chatApp = new Chat;
        $checkedApp = new OriginCheck(new WsServer($chatApp), array('localhost'));
        $checkedApp->allowedOrigins[] = '127.0.0.1';
        $loop = Factory::create();

        $socket = new Server('tcp://0.0.0.0:8080', $loop);
        $server = new IoServer(new HttpServer($checkedApp), $socket, $loop);

        $context = new Context($loop);
        $responder = $context->getSocket(ZMQ::SOCKET_PULL);
        $responder->bind('tcp://127.0.0.1:5555');
        $responder->on('message', array($chatApp, 'handleZmqMessage'));

        $server->run();
    }
}