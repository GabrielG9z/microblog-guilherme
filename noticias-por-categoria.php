<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";
$noticia = new Noticia;
$noticia->setCategoriaId($_GET['id']);
$buscaNoticia = $noticia->listarPorCategoria();

?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2 class=" ">Notícias sobre <span class="badge bg-primary">categoria</span> </h2>
        
        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                    <?php foreach($buscaNoticia as $noticia){?>
                    <a href="noticia.php?categoria=<?=$noticia['nome']?>" class="list-group-item list-group-item-action">
                        <h3 class="fs-6"><?=$noticia['titulo']?></h3>
                        <p><time><?=Utilitarios::data($noticia['data'])?></time> - <?=$noticia['autor']?></p>
                        <p><?=$noticia['resumo']?></p>
                    </a>
                    <?php } ?>
                    
                </div>
            </div>
        </div>


    </article>
    

</div> 

<?php include_once "inc/todas.php";?>        
        
          

<?php 
require_once "inc/rodape.php";
?>

