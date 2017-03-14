<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

use Model\Configuration;
use PDO;
use PDOException;

include_once "AbstractDao.php";

class ConfigurationDao extends AbstractDao
{
    private $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'configuration';
    }

    /**
     * @return array
     */
    public function readFirst()
    {
        $sql = "SELECT * FROM {$this->table_name} ORDER BY id LIMIT 1";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute();

            $get_row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $get_row;
        } catch (PDOException $exception) {
            echo 'There was an error returning configuration information: '.$exception->getMessage();
        }
    }

    /**
     * @param $object Configuration
     *
     * @return boolean
     */
    public function update($object)
    {
        var_dump($object);
        $sql = "UPDATE {$this->table_name} 
                SET website_name=:website_name, 
                version=:version, 
                state_id=:state_id
                WHERE id=:id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $object->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":website_name", $object->getWebsiteName(), PDO::PARAM_STR);
            $stmt->bindValue(":version", $object->getVersion(), PDO::PARAM_STR);
            $stmt->bindValue(":state_id", $object->getStateId(), PDO::PARAM_STR);

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
            echo 'There was an error updating client information: '.$exception->getMessage();
        }
    }
}