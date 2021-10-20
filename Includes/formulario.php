<main>
	<section class="pt-3">
		<a href="index.php">
			<button class="btn btn-secondary">Voltar</button>
		</a>
	</section>

	<h2 class="mt-3"><?=title;?></h2>

	<form method="post" class="mb-4">
		<div class="form-group">
			<label for="titulo">Título</label>
			<input type="text" id="titulo" name="titulo" class="form-control" placeholder="Título da vaga..." value="<?=$obVaga->getTitulo();?>">
		</div>
		<div class="form-group">
			<label for="descricao">Descrição</label>
			<textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control" placeholder="Descrição da vaga..."><?=$obVaga->getDescricao();?></textarea>
		</div>
		<div class="form-group">
			<label for="status">Status</label>
			<select name="status" id="status" class="form-control">
				<option value="ativo" <?=$obVaga->getStatus() == 'ativo' ? 'selected' : NULL;?>>Ativo</option>
				<option value="desativado" <?=$obVaga->getStatus() == 'desativado' ? 'selected' : NULL;?>>Desativado</option>
			</select>
		</div>
		<div class="form-group mt-3">
			<button type="submit" name="cadastrar" class="btn btn-success">
				<?=button;?>
			</button>
		</div>
	</form>
</main>