<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

use PDOException;

class StateDao extends AbstractDao
{
    private $table_name;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'state';
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table_name}";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $get_data = $stmt->fetchAll();

                return $get_data;
            }
            return array();
        } catch (PDOException $exception) {
            echo 'There was an error fetching all records: '.$exception->getMessage();
        }
    }
}
