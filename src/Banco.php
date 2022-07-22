<?php
namespace Microblog;
use PDO, Exception;

abstract class Banco {
    /* Proppriedades ou atributos de acesso ao servidor de banco de dados*/
    private static string  $servidor = "localhost";
    private static string  $usuario = "root";
    private static string  $senha = "";
    private static string  $banco = "microblog_guilherme";
    /* private static \PDO $conexao;  Não precisa do use PDO*/
    private static PDO $conexao;

    /* Método de conexão ao banco */

    public static function conecta():PDO 
    {
        try{
            self::$conexao = new PDO(
                "mysql:host=".self::$servidor."; 
                dbname=".self::$banco."; 
                charset=utf8",
                self::$usuario, /* self:: da acesso recursos statics dentro da classe */
                self::$senha
            );
            self::$conexao ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
        }catch(Exception $erro){
            die("Deu ruim: ".$erro->getMessage());
        }
        return self::$conexao;
    }
}