<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

$noticia = new Noticia;
$noticia->setId($_GET['id']);
$umaNoticia = $noticia->listarUmaNoticia();


?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2><?=$umaNoticia['titulo']?></h2>
        <p class="font-weight-light">
            <time><?=Utilitarios::data($umaNoticia['data'])?></time> - <span><?=$umaNoticia['autor']??"<i>Equipe Microblog</i>" ?></span>
        </p>
        <img src="imagem/<?=$umaNoticia['imagem']?>" alt="" class="float-start pe-2 img-fluid">
        <p><?=Utilitarios::formataTexto($umaNoticia['texto'])?></p>
    </article>
    

</div>        
        
          
<?php include_once "inc/todas.php";?> 

<?php 
require_once "inc/rodape.php";
?>

