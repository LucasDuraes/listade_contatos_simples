<?php

class acesso{
    private $pdo;
    public function __construct($dbname, $host, $user, $senha){
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        } catch (PDOException $th) {
            echo "Erro com Banco de Dados: ". $th->getMensagem();
        } catch (Exception $th) {
            echo "Erro: ". $th->getMensagem();
        }
    }

    public function exibir_dados(){
        $retorno = array();
        $cmd = $this->pdo->query("SELECT * FROM `pessoas` ORDER BY `nome`;");
        $retorno = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $retorno;
    }

    public function cadastrar_cliente($nome, $telefone, $email, $descricao){
        //testar se o email já esta cadastrado e retorna.
        $cmd = $this->pdo->prepare("SELECT `id` FROM `pessoas` WHERE `email`=:e;");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if ($cmd->rowCount()>0) {
            return false;
        }else {//cadastrar pessoa e retorna.
            $cmd = $this->pdo->prepare("INSERT INTO `pessoas`(nome, telefone, email, descricao) VALUES (:n, :t, :e, :d);");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":d", $descricao);
            $cmd->execute();
            return true;
        }
    }

}

?>