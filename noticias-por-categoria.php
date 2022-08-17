<?php


use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

$noticia->setCategoriaId($_GET['id']);
$dados = $noticia->listarPorCategoria();



?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
       <?php if(count($dados) > 0){?> 
        <h2 class=" ">Notícias sobre <span class="badge bg-primary"><?=$dados[0]['nome']?></span> </h2>
        <?php }else { ?>
            <h2 class="alert alert-warning text-center">Não tem notícias desta categoria!</h2>
            <?php  }?>
        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                    <?php foreach($dados as $dado){?>
                    <a href="noticia.php?id=<?=$dado['nid']?>" class="list-group-item list-group-item-action">
                        <h3 class="fs-6"><?=$dado['titulo']?></h3>
                        <p><time><?=Utilitarios::data($dado['data'])?></time> - <?=$dado['autor']?></p>
                        <p><?=$dado['resumo']?></p>
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

