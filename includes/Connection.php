<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 12/03/2017
 * Site: http://www.diogomarcos.com
 */
class Connection {
    private static $instance;

    const DB_HOST = 'localhost';
    const DB_NAME = 'test-register';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return object PDO connection
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USER, self::DB_PASSWORD);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                echo 'There was an error making the connection'.$exception->getMessage();
                exit();
            }
        }
        return self::$instance;
    }
}
