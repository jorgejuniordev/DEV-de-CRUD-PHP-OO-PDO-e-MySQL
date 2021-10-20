<?php

	/*
		Carregamento de todas classes 
		presentes no projeto.
	*/
	require __DIR__.'/vendor/autoload.php';

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
		if(isset($_POST['deletar'])):
			$obVaga->excluir();
			header('Location: index.php?status=successDel');
			exit;
		endif;

	endif;

	include __DIR__.'/includes/header.php';
	include __DIR__.'/includes/confirmar_exclusao.php';
	include __DIR__.'/includes/footer.php';