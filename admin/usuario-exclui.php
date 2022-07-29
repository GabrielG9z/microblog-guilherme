<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
require_once "../vendor/autoload.php";
$verifica = new ControleDeAcesso;

$verifica->verificaAcessoAdmin();

$sessao = new ControleDeAcesso;
$sessao -> verificaAcesso();
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->excluir();
header("location:usuarios.php");