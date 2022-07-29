<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;

require_once "../inc/cabecalho-admin.php";

$usuario = new Usuario;
$listardeUsuarios = $usuario->listar();
$verifica = new ControleDeAcesso;
$verifica->verificaAcessoAdmin();



?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Usuários <span class="badge bg-dark"><?= count($listardeUsuarios)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="usuario-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir novo usuário</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Tipo</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
<?php foreach($listardeUsuarios as $usuarios){?>					
					<tr>
						<td><?=$usuarios['nome']?></td>
						<td> <?=$usuarios['email']?></td>
						<td> <?=$usuarios['tipo']?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="usuario-atualiza.php?id=<?=$usuarios['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="usuario-exclui.php?id=<?=$usuarios['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
					<?php } ?>

				</tbody>                
			</table>
	</div>
		
	</article>
</div>

<script src="../admin/js/confirm.js"></script>
<?php 
require_once "../inc/rodape-admin.php";
?>

