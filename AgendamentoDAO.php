<?php
include "../dataBase/DataBase.php";
include "../crud/Agendamento.php";

class AgendamentoDAO{
    private $conn;

    public function __construct(){
        $this->conn = DataBase::getInstance();
    }

    public function inserirAgendamento(Agendamento $agendamento){
        $sqlAgendamento = "INSERT INTO agendamentos (data_registro_agendamento, data_agendamento, hora_agendamento, status, titulo, cor) VALUES
        (:data_registro_agendamento, :data_agendamento, :hora_agendamento, :status, :titulo, :cor)";
        $stmt = $this->conn->getConexao()->prepare($sqlAgendamento);
        $stmt->bindValue(":data_registro_agendamento",$agendamento->getDataRegistroAgendamento(), PDO::PARAM_STR);
        $stmt->bindValue(":data_agendamento", $agendamento->getDataAgendamento(), PDO::PARAM_STR);
        $stmt->bindValue(":hora_agendamento", $agendamento->getHoraAgendamento(), PDO::PARAM_STR);
        $stmt->bindValue(":status", "agendado",PDO::PARAM_STR);
        $stmt->bindValue(":titulo",$agendamento->getTitulo(), PDO::PARAM_STR);
        $stmt->bindValue(":cor",$agendamento->getCor(),PDO::PARAM_STR);

        $stmt->execute();

        $stmt->closeCursor();
    }

    public function excluirAgendamentoPorId($id){
        $sqlExcluirPorID = "DELETE FROM agendamentos where id= :id";
        $stmt = $this->conn->getConexao()->prepare($sqlExcluirPorID);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function editarAgendamento(Agendamento $agendamento){
        $sqlAgendamento = "UPDATE agendamentos SET 
            data_agendamento = :data_agendamento, 
            hora_agendamento = :hora_agendamento, 
            status = :status, 
            titulo = :titulo, 
            cor = :cor 
            WHERE id = :id";  
    
        $stmt = $this->conn->getConexao()->prepare($sqlAgendamento);
        $stmt->bindValue(":data_agendamento", $agendamento->getDataAgendamento(), PDO::PARAM_STR);
        $stmt->bindValue(":hora_agendamento", $agendamento->getHoraAgendamento(), PDO::PARAM_STR);
        $stmt->bindValue(":status", $agendamento->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(":titulo", $agendamento->getTitulo(), PDO::PARAM_STR);
        $stmt->bindValue(":cor", $agendamento->getCor(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $agendamento->getId(), PDO::PARAM_INT);  

        $stmt->execute();

        $stmt->closeCursor();
    }
    
    public function carregaPorIdAgendamento($id){
        $agendamento = [];
        $sqlCarregaPorIdAgendamentoJson = "SELECT * FROM agendamentos where id= :id";
        $stmt = $this->conn->getConexao()->prepare($sqlCarregaPorIdAgendamentoJson);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $data_inicio = date("Y-m-d", strtotime($row['data_agendamento']));
            $hora_inicio = date("H:i", strtotime($row['hora_agendamento']));
            $dataRegistroAgendamento = date("Y-m-d", strtotime($row['data_registro_agendamento'])); 
        
            $agendamento[] = [
                "id" => $row['id'],
                "data_registro_agendamento" => $dataRegistroAgendamento,
                "data_agendamento" => $data_inicio,
                "hora_agendamento" => $hora_inicio,
                "status" => $row['status'],
                "titulo" => $row['titulo'],
                "cor" => $row['cor'] 
            ];
        }
        $stmt->closeCursor();
        return $agendamento;
    }

    public function listarAgendamentos(){
        $agendamentos = [];
        $sqlListarAgendamentos = "SELECT * FROM agendamentos WHERE status='agendado'";
        $stmt = $this->conn->getConexao()->prepare($sqlListarAgendamentos);

        $stmt->execute();

        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $data_inicio = date("Y-m-d", strtotime($row['data_agendamento']));
            $hora_inicio = date("H:i", strtotime($row['hora_agendamento']));
            $dataRegistroAgendamento = date("Y-m-d", strtotime($row['data_registro_agendamento'])); 
            $agendamentos[] = [
                "id" => $row['id'],
                "data_registro_agendamento" => $dataRegistroAgendamento,
                "start" => $data_inicio,
                "startTime" => $hora_inicio,
                "status" => $row['status'],
                "title" => $row['titulo'],
                "color" => $row['cor'] 
            ];
        }

        $stmt->closeCursor();

        return $agendamentos;
    }

}