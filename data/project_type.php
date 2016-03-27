<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-12
 * Time: 오후 12:27
 */

/*
class project_type {

    private $projTypes;

    public $db;
    public $rows;

    public function __construct($key) {
        require("../class/db.php");

        $this->db = new db();
        $this->db->connect();
        $sql = "SELECT * FROM project_type_tb WHERE projKey='$key'";
        $this->rows = $this->db->select($sql);

        $this->projTypes = array();
        $this->getProjectType();
    }

    public function getProjectType() {
        foreach ($this->rows as $row) {
            array_push($this->projTypes, $row['proj_type']);
        }
    }

    public function getProjTypes()
    {
        return $this->projTypes;
    }

}
*/

class project_type {

    private $projKey;
    private $projType;

    public function __construct ($projKey, $projType){
        $this->projKey = $projKey;
        $this->projType = $projType;
    }

    /**
     * @return mixed
     */
    public function getProjKey()
    {
        return $this->projKey;
    }

    /**
     * @return mixed
     */
    public function getProjType()
    {
        return $this->projType;
    }

    /**
     * @param mixed $projType
     */
    public function setProjType($projType)
    {
        $this->projType = $projType;
    }



}