<main>
	<section class="pt-3">
		<a href="index.php">
			<button class="btn btn-secondary">Voltar</button>
		</a>
	</section>

	<h2 class="mt-3">Excluir Vaga</h2>

	<form method="post" class="mb-4">
		<div class="form-group">
			<p>Você deseja realmente excluir a vaga <strong><?=$obVaga->titulo;?></strong>?</p>
		</div>
		<div class="form-group mt-3">
			<a href="index.php">
				<button type="button" class="btn btn-secondary">Cancelar</button>
			</a>
			<button type="submit" name="deletar" class="btn btn-danger">Deletar</button>
		</div>
	</form>
</main>