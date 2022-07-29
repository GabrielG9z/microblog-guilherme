<?php

use Microblog\ControleDeAcesso;
require "../vendor/autoload.php";

$verifica = new ControleDeAcesso;
$verifica->verificaAcessoAdmin();

$sessao = new ControleDeAcesso;
$sessao -> verificaAcesso();