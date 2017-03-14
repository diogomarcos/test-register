<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 13/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

use Connection;
use Exception;
use PDO;
use PDOException;

abstract class AbstractDao
{
    /** @var $instance_connection PDO */
    private $instance_connection;

    public function __construct()
    {
        $this->instance_connection = Connection::getInstance();
    }

    public function create($object, $object_id = null) {}
    public function read($id) {}
    public function update($object) {}
    public function delete($id) {}

    /**
     * @param $table_name string
     *
     * @return int
     * @throws Exception
     */
    public function getNewId($table_name)
    {
        $sql = "SELECT MAX(id) AS id FROM {$table_name}";

        try {
            $stmt = $this->instance_connection->prepare($sql);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $get_row = $stmt->fetch(PDO::FETCH_OBJ);
                    $new_id = (int)$get_row->id + 1;
                    return $new_id;
                } else {
                    throw new Exception('There was an error returning next id');
                }
            } else {
                throw new Exception('There was an error returning next id');
            }
        } catch (PDOException $exception) {
            echo 'There was an error returning next id: '.$exception->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getInstanceConnection(): PDO
    {
        return $this->instance_connection;
    }
}
