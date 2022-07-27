<?php
namespace Microblog;

final class ControleDeAcesso{

    public function __constuct()
    {
        /* Verificando se NÃO EXISTE uma sessão em funcionamento */

        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function verificaAcesso():void{
        /* se não existir a variavel de sessão relacionada ao id do usuário logado */
        if(!isset($_SESSION['id'])){
            /* Significa que o usuario não esta logado por tanto apague qualquer resquício de sessão e force o usuario a ir para login.php */
            session_destroy();
            header("location:../login.php?acesso_proibido");
            exit;
        }
    }
    public function login(int $id, string $nome, string $tipo):void{
        /* Criar variaveis de sessão com os dados */
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
    }

}