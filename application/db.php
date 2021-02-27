<?php
/**
 * Класс конфигурации базы данных
 */
class DB
{

    const USER  = "torex";
    const PASS  = "K7a1R8y4";
    const HOST  = "localhost";
    const DB    = "torex_db";

    public static function connToDB() {
        $user   = self::USER;
        $pass   = self::PASS;
        $host   = self::HOST;
        $db     = self::DB;
        $conn   = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        $conn->exec("SET NAMES 'utf8'");
        return $conn;
    }

}
