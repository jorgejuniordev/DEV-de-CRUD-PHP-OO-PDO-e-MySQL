<?php

	/*
		Carregamento de todas classes 
		presentes no projeto.
	*/
		require __DIR__.'/vendor/autoload.php';

		use \App\Entity\Vaga;

		$vagas = Vaga::getVagas();

		include __DIR__.'/includes/header.php';
		include __DIR__.'/includes/listagem.php';
		include __DIR__.'/includes/footer.php';