<?php


namespace App\Server;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;

class Chat implements MessageComponentInterface
{
    private $clients;
    private $users=[];

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: Hello', $conn->resourceId";
        echo "\n";
    }

    public function onClose(ConnectionInterface $closedConnection)
    {
        $this->clients->detach($closedConnection);
        /*unset($this->clients[$closedConnection->resourceId]);*/
        foreach ($this->users as $key=>$value){
            if($value === $closedConnection){
                echo 'User withe key ('.$key.') is disconnected';
                echo "\n";
                unset($this->users[$key]);
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->send('An error has occurred: '.$e->getMessage());
        $conn->close();
    }


    public function onMessage(ConnectionInterface $conn, $message)
    {
        $messageData = json_decode($message,true);
        $recipient = $messageData['recipient'];
        $msg = $messageData['message'];
        if($recipient === 0 ){
            $this->users[$messageData['userId'][0]]=$conn;
            /*echo 'Message connexion from '.$recipient.' in the thread '.$thread.'|';*/
            foreach ($this->users as $key=>$value){
                if($value === $conn){
                    $id = $key;
                }
            }
            echo 'Message connexion user id save at users ['.$id.'] |';
            echo "\n";
            return false;
        }
        echo 'Message sent to user '.$recipient.' msg is  '.$msg.'|';
        echo "\n";
        if(isset($messageData['type'])){
            if($messageData['type']==='seen'){
                $messages = $messageData['messages'];
                $recipient = $messageData['recipient'];
                $thread = $messageData['thread'];
                if($messages){
                    if(isset($this->users[$recipient])){
                        $this->users[$recipient]->send(json_encode([
                            'message' => $messages,
                            'thread' => $thread,
                            'type'=> 'seen',
                            'recipient'=>$recipient
                        ]));
                        echo 'kokooooooooooo';
                        echo "\n";
                    }
                }
                /*if(!empty($messages)){
                    foreach ($messages as $mess){
                        if(isset($this->users[$recipient])){
                            $this->users[$recipient]->send(json_encode([
                                'message' => $mess,
                                'thread' => $thread,
                                'type'=> 'seen',
                                'recipient'=>$recipient
                            ]));
                            echo 'kokooooooooooo';
                            echo "\n";
                        }
                    }
                }*/
            }
          return false;
        }
        return $this->msgToUser($msg,$recipient,$messageData['thread']);
    }


    public function msgToUser($msg, $id, $thread) {
        if(isset($this->users[$id])){

            $this->users[$id]->send(json_encode([
                'message' => $msg,
                'thread' => $thread,
            ]));
            echo 'message to user is sent';
            echo "\n";
        }
        return false;

    }

}