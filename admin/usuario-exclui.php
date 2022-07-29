<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
require_once "../vendor/autoload.php";


$sessao = new ControleDeAcesso;
$sessao->verificaAcessoAdmin();
$sessao -> verificaAcesso();
$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->excluir();
header("location:usuarios.php");