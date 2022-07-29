 <?php

 	require "../../app_lista_tarefas/tarefa_model.php";
 	require "../../app_lista_tarefas/tarefa_service.php";
 	require "../../app_lista_tarefas/conexao.php";

 	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;



 	if ($acao == 'inserir'){
		 	$tarefa = new Tarefa();
		 	$tarefa->__set('tarefa', $_POST['tarefa']);

		 	$conexao = new Conexao();

		 	$tarefaService= new tarefaService($conexao, $tarefa);
		 	$tarefaService->inserir();

		 	header('Location: nova_tarefa.php?estado=sim');
	 	
 	}  elseif ($acao == 'recuperar') {	
	 		$tarefa = new Tarefa();
	 		$conexao = new Conexao();

	 		$tarefaService = new TarefaService($conexao, $tarefa);
	 		$tarefas = $tarefaService->recuperar();
 	
 	} elseif ($acao == 'atualizar') {
 		
	 		$tarefa = new Tarefa();
	 		$tarefa->__set('id', $_POST['id']);
	 		$tarefa->__set('tarefa', $_POST['tarefa']);
	 		
	 		$conexao = new Conexao();
	 		$tarefaService = new TarefaService($conexao, $tarefa);
	 		
	 		if ($tarefaService->atualizar()) {
		 		header('Location: todas_tarefas.php');
	 		}
 	} elseif ($acao == 'remover') {	
	 		$tarefa = new Tarefa();
	 		$tarefa->__set('id', $_GET['id']);

	 		$conexao = new Conexao();

	 		$tarefaService = new TarefaService($conexao, $tarefa);
	 		$tarefaService->remover();
	 		header('Location: todas_tarefas.php');
 	
 	} elseif ($acao == 'marcarRealizada') {	
	 		$tarefa = new Tarefa();
	 		$tarefa->__set('id', $_GET['id']);
	 		$tarefa->__set('id_status', 2);

	 		$conexao = new Conexao();

	 		$tarefaService = new TarefaService($conexao, $tarefa);
	 		$tarefaService->marcarRealizada();
	 		header('Location: todas_tarefas.php');
 	
 	} elseif ($acao == 'recuperarTarefasPendentes') {	
	 		$tarefa = new Tarefa();
	 		$tarefa->__set('id_status', 1);

	 		$conexao = new Conexao();

	 		$tarefaService = new TarefaService($conexao, $tarefa);
	 		$tarefas = $tarefaService->recuperarTarefasPendentes();
 	
 	}
    
    

 	



 ?>

