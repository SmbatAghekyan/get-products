<?php
echo"<pre>"; print_r(11); echo "</pre>"; exit;

class Database
{
    private static $bdd = null;

    private function __construct() {
    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=localhost;dbname=task_program", 'root', '');
        }
        return self::$bdd;
    }
}
?>
