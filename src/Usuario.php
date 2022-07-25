<?php
namespace Microblog;
use PDO, Exception;

final class Usuario{
    private int $id;
    private string $nome;
    private String $email;
    private string $senha;
    private  string $tipo;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }

    public function listar():array{
        $sql = "SELECT id, nome, email, tipo FROM usuarios ORDER BY nome";

        try{
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $erro){
            die("Erro:". $erro->getMessage());
        }
        return $resultado;
    }
    public fuction inserir():void{
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo)
        VALUES(:nome, :email, :senha, :tipo)"
    }
    try{
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $consulta->bindParam(":email", $this->email, PDO::PARAM_STR);
        $consulta->bindParam(":senha", $this->senha, PDO::PARAM_STR);
        $consulta->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
        $consulta->execute();

    }catch(Exception $erro){
        die("Erro:". $erro->getMessage());
    }

}



/* try{

}catch(Exception $erro){
    die("Erro:". $erro->getMessage());
} */