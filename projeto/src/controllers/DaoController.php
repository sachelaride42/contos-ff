<?php
namespace Src\controllers;
use Src\models\Dao;

class DaoController{
    private $dao;
    public function __construct(){
        $this->dao = new Dao();
    }
    public function loginUser($user){
        return $this->dao->loginUser($user);
    }
    public function registerUser($user){
        return $this->dao->registerUser($user);
    }

    public function createConto($conto){
        return $this->dao->createConto($conto);
    }

    public function updateConto($conto){
        return $this->dao->updateConto($conto);
    }

    public function destroyConto($conto){
        return $this->dao->destroyConto($conto);
    }

    public function indexContos(){
        return $this->dao->indexContos();
    }

    public function indexMyContos($id){
        return $this->dao->indexMyContos($id);
    }

    public function showConto($id){
        return $this->dao->showConto($id);
    }

    public function showUser($id){
        return $this->dao->showUser($id);
    }



}