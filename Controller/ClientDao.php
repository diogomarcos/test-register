<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 13/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

use Model\Client;
use PDO;
use PDOException;

include_once "AbstractDao.php";

class ClientDao extends AbstractDao
{
    private $table_name;

    const RECORDS_PER_PAGE = 5;

    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'client';
    }

    /**
     * @param $object Client
     * @param $object_id int|null
     *
     * @return boolean
     */
    public function create($object, $object_id = null)
    {
        $id = $this->getNewId($this->table_name);
        $sql = "INSERT INTO {$this->table_name} (id, name, cpf, general_registration, date_of_birth, created_at)
                VALUES (:id, :name, :cpf, :general_registration, :date_of_birth, :created_at)";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $object->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":general_registration", $object->getGeneralRegistration(), PDO::PARAM_STR);
            $stmt->bindValue(":date_of_birth", $object->getDateOfBirth(), PDO::PARAM_STR);
            $stmt->bindValue(":created_at", $object->getCreatedAt(), PDO::PARAM_STR);

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
            echo 'There was an error saving the client information: '.$exception->getMessage();
        }
    }

    /**
     * @param $id int
     *
     * @return array
     */
    public function read($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id=:id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $get_row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $get_row;
        } catch (PDOException $exception) {
            echo 'An error occurred while returning the information the client: '.$exception->getMessage();
        }
    }

    /**
     * @param $object Client
     *
     * @return boolean
     */
    public function update($object)
    {
        var_dump($object);
        $sql = "UPDATE {$this->table_name} 
                SET name=:name, 
                cpf=:cpf, 
                general_registration=:general_registration, 
                date_of_birth=:date_of_birth, 
                created_at=:created_at
                WHERE id=:id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $object->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $object->getCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":general_registration", $object->getGeneralRegistration(), PDO::PARAM_STR);
            $stmt->bindValue(":date_of_birth", $object->getDateOfBirth(), PDO::PARAM_STR);
            $stmt->bindValue(":created_at", $object->getCreatedAt(), PDO::PARAM_STR);

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

    /**
     * @param $id int
     *
     * @return boolean
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id=:id";

        try {
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

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
     * @return array
     */
    public function findAll()
    {
        $current_page = 0;

        if (isset($_GET['page'])) {
            $current_page = ($_GET['page']-1)*self::RECORDS_PER_PAGE;
        }

        $sql = "SELECT * FROM {$this->table_name} LIMIT {$current_page},".self::RECORDS_PER_PAGE;

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

    /**
     * @return string
     */
    public function pagination()
    {
        $html_pagination = "";
        $sql = "SELECT * FROM {$this->table_name}";

        try {
            $self = $_SERVER['PHP_SELF'];

            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute();

            $total_records = $stmt->rowCount();
            if ($total_records > 0) {
                $html_pagination.="<ul class='pagination'>";

                $total_pages = ceil($total_records/self::RECORDS_PER_PAGE);
                $current_page=1;
                if (isset($_GET['page'])) {
                    $current_page = $_GET['page'];
                }

                if ($current_page!=1) {
                    $previous_page = $current_page-1;
                    $html_pagination.="<li><a href='{$self}?page=1'>Primeiro</a></li>";
                    $html_pagination.="<li><a href='{$self}?page={$previous_page}'>Anterior</a></li>";
                }

                for ($i=1; $i <= $total_pages; $i++) {
                    if ($i==$current_page) {
                        $html_pagination.="<li><a href='{$self}?page={$i}' style='color: red;'>{$i}</a></li>";
                    } else {
                        $html_pagination.="<li><a href='{$self}?page={$i}'>{$i}</a></li>";
                    }
                }

                if ($current_page!=$total_pages) {
                    $next_page = $current_page + 1;
                    $html_pagination.="<li><a href='{$self}?page={$next_page}'>Próximo</a></li>";
                    $html_pagination.="<li><a href='{$self}?page={$total_pages}'>Último</a></li>";
                }

                $html_pagination.="</ul>";

                return $html_pagination;
            }
        } catch (PDOException $exception) {
            echo 'Error generating pagination: '.$exception->getMessage();
        }
    }
}
