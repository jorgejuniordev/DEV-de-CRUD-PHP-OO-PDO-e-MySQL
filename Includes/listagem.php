<main>
	<section class="pt-3">
		<a href="cadastro.php">
			<button class="btn btn-success">Nova Vaga</button>
		</a>
	</section>

	<?php 

		$msg = NULL;
		if(isset($_GET['status'])):
			switch ($_GET['status']):
				case 'success':
					$msg = 'success">Inserida com sucesso!';
					break;

				case 'successAtt':
					$msg = 'success">Atualizada com sucesso!';
					break;

				case 'successDel':
					$msg = 'success">Deletada com sucesso!';
					break;

				case 'error':
					$msg = 'danger">Vaga não encontrada!';
					break;
				
				default: break;
			endswitch;

			$msg = '<div class="alert mt-3 alert-'.$msg.'</div>';

			echo $msg;

		endif;
	?>


	<table class="table table-sm rounded text-center table-light text-dark mt-3">
		<thead class="text-capitalize">
			<tr>
				<th colspan="5" class="text-uppercase">
					Listagem de vagas cadastradas
				</th>
			</tr>
			<tr>
				<th>título</th>
				<th>descrição</th>
				<th>Status</th>
				<th>Data</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php 

				if(!empty($vagas)):
					foreach($vagas as $vaga): 

			?>
				<tr>
					<td><?=$vaga->titulo;?></td>
					<td><?=$vaga->descricao;?></td>
					<td><span class="badge text-capitalize text-<?=$vaga->status == 'ativo' ? 'success' : 'danger';?>"><?=$vaga->status;?></span></td>
					<td><?=date("d/m/Y à\s H:i:s", strtotime($vaga->data));?></td>
					<td>
						<a href="editar.php?id=<?=$vaga->id;?>">
							<button class="btn btn-sm btn-primary">
								Editar
							</button>
						</a>
						<a href="deletar.php?id=<?=$vaga->id;?>">
							<button class="btn btn-sm btn-danger">
								Deletar
							</button>
						</a>
					</td>
				</tr>
			<?php endforeach; else: ?>
				<tr>
					<td colspan="5">Não foram encontradas vagas no sistema.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</main>