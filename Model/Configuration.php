<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 14/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Model;

class Configuration
{
    private $id;
    private $website_name;
    private $version;
    private $state_id;

    public function __construct($website_name, $version, $state_id)
    {
        $this->website_name = $website_name;
        $this->version = $version;
        $this->state_id = $state_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getWebsiteName()
    {
        return $this->website_name;
    }

    /**
     * @param mixed $website_name
     */
    public function setWebsiteName($website_name)
    {
        $this->website_name = $website_name;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getStateId()
    {
        return $this->state_id;
    }

    /**
     * @param mixed $state_id
     */
    public function setStateId($state_id)
    {
        $this->state_id = $state_id;
    }
}
