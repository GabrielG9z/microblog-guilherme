<?php 
use Microblog\Noticia;
use Microblog\Utilitarios;

$noticia= new Noticia;
$todasAsNoticias = $noticia->listarTodos();

?>
<hr class="my-5 w-50 mx-auto">
        
  <div class="row my-1">
      <div class="col-12 px-md-1">
          <h2 class="fs-6 text-center text-muted">Todas as notícias <?= count($todasAsNoticias)?></h2>
          <div class="list-group">
              <?php foreach($todasAsNoticias as $noticia){?>
              <a href="noticia.php?id=<?=$noticia['id']?>" class="list-group-item list-group-item-action">
                   <h3 class="fs-6"><time><?=Utilitarios::data($noticia['data'])?></time> - <?=$noticia['titulo']?></h3>
                  <p><?=$noticia['resumo']?></p>
              </a>
          
              <?php }?>              
           </div>
          </div>
  </div>