    </div>
</main>

<footer class="footer mt-auto py-3 bg-dark border-top">
    <div class="container text-center text-white">
        Microblog é um site fictício desenvolvido para fins didáticos | Senac Penha &copy; 2022
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<?php 
switch($pagina){
    case 'usuarios.php':
    case 'noticias.php':
    case 'categorias.php':
?>
<script src="js/confirm.js"></script>
<?php
    break;

    case 'noticia-insere.php':
    case 'noticia-atualiza.php':
?>
<script src="js/contador.js"></script>
<?php
    break;
}
?>
</body>
</html>
<?php ob_end_flush();?>