<?php

/*******************************************************************************************
 *	Esse arquivo contém as principais funções desse sistema. Além das funções, também há a *
 *	inicialização das sessões															   *
 *******************************************************************************************/

//--------------------------Iniciando sessão--------------------------------
	//verificando status da sessão (se ela já foi iniciada e talz)
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_cache_expire(1440); //tempo de duração da sessão em minutos
		session_start();
	}
//--------------------------/Iniciando sessão-------------------------------

//Funções Genéricas do Sistema --- Podem ser utilizadas em outros sistemas

	#função pra carregar includes
	function carregaIncludes($pasta, $includes){
		if(is_array($includes)){
			if(!empty($includes)){
				foreach ($includes as $value) {
					include_once "$pasta/$value.php";
				}
			}
		}
	}

	#Função que monta a estrutura das flash mensagens
	function flash($key, $mensagem, $tipo = "danger"){
		if(!isset($_SESSION['flash'][$key])){
			$_SESSION['flash'][$key] = '<div class="alert alert-'.$tipo.' text-center">'.$mensagem.'</div>';
		}
	}
	#Função pra exibir as flash mensagens
	function getFlash($key){
		if(isset($_SESSION['flash'][$key])){
			$mensagem = $_SESSION['flash'][$key];
			unset($_SESSION['flash'][$key]);
			if(isset($mensagem)){
				return $mensagem;
			} else {
				return '';
			}
		}
	}

	#Função pra contar registros
	function countRows($table){
		$link = dbConnect();
		$result = dbCount($table);
			if($result){
				return $result;
			} else {
				return "Erro ao contar registros.";
			}
		DBClose($link);
	}


//Funções Relacionadas ao Modulo de Login
	
	#novo usuario
	function readCSV($filename){
		$rows = Array();
			foreach (file($filename, FILE_IGNORE_NEW_LINES) as $line) {
				$rows[] = str_getcsv($line);
			}
		return $rows;
	}

	function morte($path){
		$headler = fopen($path, 'r');
		$data = Array();

			if ($headler !== FALSE) {
				while ($dados = fgetcsv($headler, 17, ";") !==FALSE) {
					$data[] = utf8_encode($dados);
				}
			}
		return $data;
	}

?>
