<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title> CSV IMPORT! | Básico</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=" " />
	<meta name="author" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="index, folow" />
	<!--Icone-->
	<link rel="icon" type="image/x-icon" href="img/logo.ico">
	<!-- CSS Personaliado -->
	<link rel="stylesheet" href="css/style.css">
	<!-- CSS do Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!--Font Awesome === ICONES MANEIROS-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!--Google Fonts-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
</head>
<body class="">
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<?php
//-----includes------
			require_once 'functions/functions.php';
			carregaIncludes("functions/", array("config", "conexao", "database"));
//-----/includes-----
	//gravar dados e checar
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				if(isset($_POST['importar']) || !empty($_POST['importar'])){

					$arquivo = $_FILES["file"]["tmp_name"];
					$nome = $_FILES["file"]["name"];

					$ext = explode(".", $nome);
					$extesao = $ext[1];
					if(!isset($arquivo) || empty($arquivo)){
						flash("mensagem", "Por favor, insira um arquivo CSV!", "danger");
						header("Location: index.php");
					} else {
					//processe
						if($extesao !== "csv"){
							flash("mensagem", "Extensão Inválida!", "danger");
							header("Location: index.php");
						} else {

							?>
							<div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
								<?php


								$csv = file($arquivo);
								foreach ($csv as $row => $line) {
									$th[] = explode(";", utf8_encode($line));
									$td[] = explode(" ", utf8_encode($line));
									$row++;
									$column = str_getcsv(utf8_encode($line), ';');
									
									if($row == 1){

										?>
										<thead>

											<tr>
										
										<?php

										foreach($th as $value){
											$cols = count($value);
											for ($i=0; $i < $cols; $i++) { 
												# code...
											?>
												<th class="lead th col-1" style="font-size: 12px"><?= $value[$i] ?></th>
											<?php

											}

											
												
											
										
										}
										?>
										</tr>
										</thead>


										<?php
									
										
									}
									if($row > 1){
									?>
										<tbody>
										
										<tr>
											<?php

										
											for ($i=0; $i < count($column); $i++) { 
												# code...
											?>
											<td class="lead th col-1" style="font-size: 12px"><?=$column[$i]?><td>
											<?php

											}
										
										?>	
										</tr>
									</body>
									<?php
									}	
									/*
									if ($row > 1) {
										echo 'Está na linha: '.utf8_encode($row).' e na Coluna: '.utf8_encode( $column[13]). "<br />\n";
									}
									*/
								}
								?>
								</table>
							</div>
								<?php
							}
						}
					}
				}


				?>
				<!--Bootstrap-->
				<!-- Primeiro o jQuery, depois o Popper.js, e depois o Bootstrap JS -->
				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<!--/Bootstrap-->
			</body>
			</html>


