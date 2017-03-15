<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 13/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

use Model\Phone;
use PDO;
use PDOException;

include_once "AbstractDao.php";

// Classe com operações crud para Telefone
class PhoneDao extends AbstractDao
{
    private $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'phone';
    }

    /**
     * @param $object Phone
     * @param $object_id int|null
     *
     * @return boolean
     */
    public function create($object, $object_id = null)
    {
        $id = $this->getNewId($this->table_name);
        $sql = "INSERT INTO {$this->table_name} (id, client_id, number)
                VALUES (:id, :client_id, :number)";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":client_id", $object->getClientId(), PDO::PARAM_INT);
            $stmt->bindValue(":number", $object->getNumber(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $object->setId($id);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo 'There was an error saving the customer\'s phone information: '.$exception->getMessage();
        }
    }

    /**
     * @param $client_id int
     *
     * @return boolean
     */
    public function delete($client_id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE client_id=:client_id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":client_id", $client_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo 'There was an error deleting a client: '.$exception->getMessage();
        }
    }

    /**
     * @param $client_id int
     *
     * @return array
     */
    public function findAll($client_id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE client_id=:client_id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":client_id", $client_id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $get_data = $stmt->fetchAll();

                return $get_data;
            }
            return array();
        } catch (PDOException $exception) {
            echo 'There was an error fetching all registry phones: '.$exception->getMessage();
        }
    }
}
