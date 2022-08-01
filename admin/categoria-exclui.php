<?php

use Microblog\Categoria;
use Microblog\ControleDeAcesso;
require "../vendor/autoload.php";
$sessao = new ControleDeAcesso;
$sessao->verificaAcessoAdmin();
$sessao -> verificaAcesso();
$categoria = new Categoria;
$categoria->setId($_GET['id']);
$categoria->excluirCategoria();
header("location:categorias.php");