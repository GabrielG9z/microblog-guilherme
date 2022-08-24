<?php
use Microblog\ControleDeAcesso;
use Microblog\Noticia;
require "../vendor/autoload.php";
$sessao = new ControleDeAcesso;
$sessao -> verificaAcesso();
$noticia = new Noticia;
$noticia->setId($_GET['id']);
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$noticia->excluir();
header("location:noticias.php");
?>