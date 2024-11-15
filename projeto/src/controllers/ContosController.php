<?php
namespace Src\controllers;
use Src\controllers;
use Src\models\Conto;

class ContosController {
    public function createForm(){
        require_once __DIR__ . '/../views/criar_conto.php';
    }

    public function myContos(){
        require_once __DIR__ . '/../views/meus_contos.php';
    }

    public function atualizarConto($id) {
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['conto_id'] = $id;
        require_once __DIR__ . '/../views/atualizar_conto.php';
    }

    public function index() {
        header('Content-Type: application/json');
        $daoController = new DaoController();
        $contos = $daoController->indexContos();
        if($contos){
            echo json_encode([
                'status' => 'sucesso',
                'message' => $contos
            ]);
        }else if($contos == "Erro ao listar os contos"){
            echo json_encode([
                'status' => 'erro',
                'message' => 'Erro ao listar os contos!'
            ]);
        }
        else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Não há contos'
            ]);
        }

    }

    public function myContosIndex($id) {
        header('Content-Type: application/json');
        $daoController = new DaoController();
        $contos = $daoController->indexMyContos($id);
        if($contos){
            echo json_encode([
                'status' => 'sucesso',
                'message' => $contos
            ]);
        }else if($contos == "Erro ao listar os contos"){
            echo json_encode([
                'status' => 'erro',
                'message' => 'Erro ao listar os contos!'
            ]);
        }
        else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Não há contos'
            ]);
        }

    }

    public function show($id) {
        header('Content-Type: application/json');
        $daoController = new DaoController();
        $conto = $daoController->showConto($id);
        if($conto){
            echo json_encode([
                'status' => 'sucesso',
                'message' => $conto
            ]);
        }else if($conto == "Erro buscar conto") {
            echo json_encode([
                'status' => 'erro',
                'message' => 'Erro ao buscar conto'
            ]);
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Conto não existente'
            ]);
        }
    }

    public function create(){
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $usuario_id = $data['usuario_id'] ? $data['usuario_id'] : null;
        $titulo = $data['titulo'] ? $data['titulo'] : null;
        $data_publicacao = $data['data_publicacao'] ? $data['data_publicacao'] : null;
        $texto = $data['texto'] ? $data['texto'] : null;

        $conto = new Conto(null,$usuario_id, $titulo, $data_publicacao, $texto);
        if($conto->validarConto()){
            $daoController = new DaoController();
            if($daoController->createConto($conto)){
                echo json_encode([
                    'status' => 'sucesso',
                    'message' => 'Conto criado com sucesso!'
                ]);
            }else{
                echo json_encode([
                    'status' => 'erro',
                    'message' => 'Erro ao criar conto!'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Dados incompletos'
            ]);
        }
    }

    public function update($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        $usuario_id = $data['usuario_id'] ? $data['usuario_id'] : null;
        $titulo = $data['titulo'] ? $data['titulo'] : null;
        $data_publicacao = $data['data_publicacao'] ? $data['data_publicacao'] : null;
        $texto = $data['texto'] ? $data['texto'] : null;

        $conto = new Conto($id, $usuario_id, $titulo, $data_publicacao, $texto);

        if($conto->validarConto()){
            $daoController = new DaoController();
            if($daoController->updateConto($conto)){
                echo json_encode([
                    'status' => 'sucesso',
                    'message' => 'Conto atualizado com sucesso!'
                ]);
            }else{
                echo json_encode([
                    'status' => 'erro',
                    'message' => 'Erro ao atualizar conto!'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Dados incompletos'
            ]);
        }


    }

    public function destroy($id) {
        header('Content-Type: application/json');
        /*$data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ? $data['id'] : null;*/

        $daoController = new DaoController();
        if($daoController->destroyConto($id)){
            echo json_encode([
                'status' => 'sucesso',
                'message' => 'Conto removido com sucesso!'
            ]);
        }else{
            echo json_encode([
                'status' => 'erro',
                'message' => 'Erro ao remover conto!'
            ]);
        }
    }
}