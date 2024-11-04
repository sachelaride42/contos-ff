<?php
namespace Src\Controllers;

class ContosController {
    public function createForm(){
        require_once __DIR__ . '/../views/criar_conto.php';
    }

    public function myContos(){
        require_once __DIR__ . '/../views/meus_contos.php';
    }

    public function allContos() {
        require_once __DIR__ . '/../views/todos_contos.php';
    }

    public function index() {
        //listar todos os contos (API)
    }

    public function show($id) {
        //visualizar conto com o id (API)
    }

    public function store(){
        //criar novo conto (API)
    }

    public function update($id) {
        //atualizar conto com o id (API)
    }

    public function destroy($id) {
        //Deletar conto com id (API)
    }
}