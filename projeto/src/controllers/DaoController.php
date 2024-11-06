<?php

use Src\models\Dao;

class DaoController{
    private $dao;
    public function __construct(){
        $this->dao = new Dao();
    }
    public function registerUser($user){
        return $this->dao->registerUser($user);
    }


}