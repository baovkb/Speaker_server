<?php
namespace Speaker\cores\ChatWebSocket;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/*
    json msg format 
    {
        "action": ["join", "get", "next", ...]
        "data": {
            audio: []
            curAudioid: number,
            isPlaying: bool,
            isRepeat: bool,
            isShuffle: bool,
            timer: time
        }
        "sender": ["server", "app", "speaker"]
    }

    */


class Chat implements MessageComponentInterface {
    public static $isPlaying;
    public static $isRepeat;
    public static $isShuffle;
    public static $curAudioId;
    public static $audio = [];
    public static $timer = 0;

    protected $apps;
    protected $speaker;
    
    public function __construct() {
        $this->apps = new \SplObjectStorage;
        $this->speaker = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        echo "New guest has connected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $raw_msg = $msg;
        $msg = json_decode($msg, true);
        
        if (!is_array($msg)) {
            return;
        }

        $action = array_key_exists('action', $msg) ? $msg['action'] : null;
        $data = array_key_exists('data', $msg) ? $msg['data'] : [];
        $sender = array_key_exists('sender', $msg) ? $msg['sender'] : null; 

        //get action
        if (isset($action) && $action == "get") {
            if (isset($sender) && $sender == "app" && $this->apps->contains($from)) {
                echo "App request 'get'\n";
                //send all data
                $payload = self::payload();
                self::sendData($from, $payload);
                return;
            }
        }

        //join action
        if (isset($action) && $action == "join") {
            if (isset($sender) && $sender == "app") {
                $this->apps->attach($from);
                echo "New app has joined\n";

                $payload = self::payload("update");
                self::sendData($from, $payload);
                return;
            } else if (isset($sender) && $sender == "speaker") {
                $this->speaker->attach($from);
                echo "Speaker has joined\n";
            } else {
                return;
            }
        }     
        
        if (isset($sender) && $sender == "speaker" && $this->speaker->contains($from)) {
            echo "Speaker sent an update: ";
            var_dump($raw_msg);
            echo "\n";

            self::$audio = $data['audio'];
            self::$curAudioId = $data['curAudioId'];
            self::$isPlaying = $data['isPlaying'];
            self::$isShuffle = $data['isShuffle'];
            self::$isRepeat = $data['isRepeat'];
            self::$timer = $data['timer'];

            $payload = self::payload("update");
            foreach ($this->apps as $app) {
                self::sendData($app, $payload);
            }
                
        } else if (isset($sender) && $sender == "app" && $this->apps->contains($from)) {
            echo "App sent a request: ";
            var_dump($raw_msg);
            echo "\n";

            if (strpos($action, "timer") !== false) {
                $payload = self::payload($action, ["time_stamp" => time()]);
            } else {
                $payload = self::payload($action, []);
            }

            foreach ($this->speaker as $sp) {
                self::sendData($sp, $payload);
            }
            
        } else 
            return;
    }

    public function onClose(ConnectionInterface $conn) {
        if ($this->apps->contains($conn)) {
            $this->apps->detach($conn);
            echo "App has disconnected\n";
        } else if ($this->speaker->contains($conn)){
            $this->speaker->detach($conn);
            echo "Speaker has disconnected\n";
        } else {
            echo "Guest has disconnected\n";
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    static function payload($action="get", $data='all') {
        if (!is_array($data) && $data == 'all') {
            $data = [
                "isPlaying" => self::$isPlaying,
                "isRepeat" => self::$isRepeat,
                "isShuffle" => self::$isShuffle,
                "curAudioId" => self::$curAudioId,
                "audio" => self::$audio,
                "timer" => self::$timer,
            ];
        }
        $payload = [
            "action" => $action,
            "data" => $data,
            "sender" => "server",
        ];

        return json_encode($payload);
    }

    static function sendData($conn, $payload) {
        $conn->send($payload);
    }
}

?>