<?php


namespace App\Server;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;


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
        /*echo "New connection: Hello', $conn->resourceId";
        echo "\n";*/
    }

    public function onClose(ConnectionInterface $closedConnection)
    {
        $this->clients->detach($closedConnection);
        /*unset($this->clients[$closedConnection->resourceId]);*/
        foreach ($this->users as $key=>$value){
            if($value === $closedConnection){
                /*echo 'User withe key ('.$key.') is disconnected';
                echo "\n";*/
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
            if($messageData['message']==='open'){
                $this->users[$messageData['userId']]=$conn;
                /*echo 'Message connexion from '.$recipient.' in the thread '.$thread.'|';*/
                foreach ($this->users as $key=>$value){
                    if($value === $conn){
                        $id = $key;
                    }
                }
                /*echo 'Message connexion user id save at users ['.$id.'] |';
                echo "\n";*/
                return false;
            }
            if ($messageData['message']=== 'close'){
                $this->clients->detach($conn);
                unset($this->users[$messageData['userId']]);

                /*echo 'Message disconnexion user id save at users ['.$messageData['userId'].'] |';
                echo "\n";*/
                return false;
            }
        }

        /*echo 'Message sent to user '.$recipient.' msg is  '.$msg.'|';
        echo "\n";*/
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
                        /*echo 'kokooooooooooo';
                        echo "\n";*/
                    }
                }
            }
          return false;
        }
        return $this->msgToUser($msg,$recipient,$messageData['thread']);
    }


    public function msgToUser($msg, $id, $thread): bool
    {
        if(isset($this->users[$id])){

            $this->users[$id]->send(json_encode([
                'message' => $msg,
                'thread' => $thread,
            ]));
            /*echo 'message to user is sent';
            echo "\n";*/
        }
        return false;

    }

    /** Trimmed for clarity
     * @param $message
     * @return bool
     */
    public function handleZmqMessage($message)
    {
        /*echo 'handle Zmq Message';
        echo "\n";*/
        $messageData = json_decode($message, true);
        $id = $messageData['recipient'];
        if (/*$this->users[$id]*/ array_key_exists($id,$this->users)){
           /* echo 'notification to user is sent';
            echo "\n";*/
            return $this->users[$id]->send($message);
        }
        /*echo 'notification NOT sent';
        echo "\n";*/
        return false;
    }

}