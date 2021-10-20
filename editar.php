<?php

	/*
		Carregamento de todas classes 
		presentes no projeto.
	*/
	require __DIR__.'/vendor/autoload.php';

	define("title", "Editar Vaga", true);
	define("button", "Atualizar", true);

	Use \App\Entity\Vaga;

	if(!isset($_GET['id']) || !is_numeric($_GET['id'])):
		header("Location: index.php?status=error");
		exit;
	else:
		// objeto
		$obVaga = Vaga::getVaga($_GET['id']);
		
		// Validação da vaga
		if(!$obVaga instanceof Vaga){
			header("Location: index.php?status=error");
			exit;
		}

		// Validação do Formulário [POST]
		if(isset($_POST['cadastrar'])):
			$obVaga->setTitulo($_POST['titulo']);
			$obVaga->setDescricao($_POST['descricao']);
			$obVaga->setStatus($_POST['status']);
			$obVaga->atualizar();

			header('Location: index.php?status=successAtt');
			exit;
		endif;

	endif;

	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/formulario.php';
	include __DIR__.'/includes/footer.php';