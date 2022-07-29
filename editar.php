<?php
    $id = isset($_GET['id']) ? $_GET['id'] : $id;

    $dsn = 'mysql:host=localhost;dbname=sistema';
    $user = 'root';
    $senha = ''; 
    $conexao = new PDO ($dsn,$user, $senha);
    
    $query = "SELECT * FROM produtos WHERE ID = '{$id}' ";
    $stmt = $conexao->query($query);
    $lista = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
    $nome_antigo=        ($lista[0]['nome']);
    $preco_antigo=       ($lista[0]['valor']);
    $codigo_antigo=      ($lista[0]['codigo']);
	$quantidade_antiga=  ($lista[0]['quantidade']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Novo produto</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

<script>
			function confirma( ) {
				alert("Edição salva com sucesso!")
       			location.href = "controlador.php?acao=atualizar&id=<?=$id?>"; 
			}	
	</script>

<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="controlador.php?acao=atualizar&id=<?=$id?>" >
					<span class="login100-form-title">
						Editar Produto
					</span>
						
					<div class="wrap-input100 validate-input" >
						<input class="input100" required="" type="text" class="form-control" name="nome" value="<?= $nome_antigo?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" required="" type="text" class="form-control" name="preco" value="<?= $preco_antigo?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-money" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" required="" type="text" class="form-control" name="quantidade" value="<?= $quantidade_antiga?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-inbox" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" required="" type="text" class="form-control" name="codigo" value="<?= $codigo_antigo?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-barcode" aria-hidden="true"></i>
						</span>
					</div>



					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" onclick="confirma()">
							Salvar
						</button>
					</div>


					<div class="text-center p-t-136">
						<a class="txt2" href="index.html">
							Menu principal
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>