<?php
    class Request
    {
        public $url;

        public function __construct()
        {
            echo"<pre>"; print_r($_SERVER); echo "</pre>"; exit;
            $this->url = $_SERVER["REQUEST_URI"];
        }
    }

?>
