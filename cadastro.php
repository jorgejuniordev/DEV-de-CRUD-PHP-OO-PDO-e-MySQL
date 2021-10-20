<?php

	/*
		Carregamento de todas classes 
		presentes no projeto.
	*/
		require __DIR__.'/vendor/autoload.php';

		define("title", "Cadastrar Vaga", true);
		define("button", "Cadastrar", true);

		Use \App\Entity\Vaga;

		// Objeto nullo, criado para preencher form com dados nulls
		$obVaga = new Vaga;
		$obVaga->setTitulo(NULL);
		$obVaga->setDescricao(NULL);
		$obVaga->setStatus(NULL);

		// Validação do Formulário [POST]
		if(isset($_POST['cadastrar'])):
			$obVaga = new Vaga;
			$obVaga->setTitulo($_POST['titulo']);
			$obVaga->setDescricao($_POST['descricao']);
			$obVaga->setStatus($_POST['status']);
			$obVaga->cadastrar();

			header('Location: index.php?status=success');
			exit;
		endif;

		include __DIR__.'/includes/header.php';
		include __DIR__.'/includes/formulario.php';
		include __DIR__.'/includes/footer.php';