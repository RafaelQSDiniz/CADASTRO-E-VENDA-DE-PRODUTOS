<?php
// define a venda
    $venda = isset($_GET['venda']) ? $_GET['venda'] : $venda;
// conecta ao DB
    $dsn = 'mysql:host=localhost;dbname=sistema';
    $user = 'root';
    $senha = ''; 
    $conexao = new PDO ($dsn,$user, $senha);
// pega os itens do form e remove itens zerados
    $selecionados2 = ($_POST); //pega os itens do form
    $selecionados = ($_POST);
    $selecionados0 = ($_POST);
    /*
        echo'<pre> itens selecionados';
        print_r($selecionados0);
        echo'</pre>';
    */
    foreach ($selecionados2 as $indice => $selecionados2) {    //remove itens zerados
        if (($key = array_search(0, $selecionados)) !== false) {
            unset($selecionados[$key]);
        }
    }
    /*
        echo'<pre> itens selecionados';
        print_r($selecionados);
        echo'</pre>';
    */
// pega o indice do array e transforma em conteudo do outro array
    $idselecionados = array_keys($selecionados);   // pega o indice do array e transforma em conteudo do outro array
    $idselecionados2 = $idselecionados;

    $idselecionados00 = array_keys($selecionados0);   // pega o indice do array e transforma em conteudo do outro array
    $idselecionados0 = $idselecionados00;
    /*
        echo'<pre>id selecionados';
        print_r($idselecionados0);
        echo'</pre>';
    */
// cria lista puxando os dados do DB usando os itens selecionados com referencia
    $contador=1;
    foreach ($idselecionados as $indice => $idselecionados) { //puxa os dados do DB usando os itens selecionados com referencia
            $query = "SELECT NOME, VALOR, ID, QUANTIDADE  FROM produtos WHERE ID = '{$idselecionados}' ";
            $stmt = $conexao->query($query);
            $lista[$contador] = $stmt->fetchALL(PDO::FETCH_ASSOC);
            $contador= $contador+1; //conta +1 para o indice 
    }
// cria lista de quantidades 
    $contador=1;
    foreach ($selecionados as $indice => $selecionados) { //pega as quantidades
            $quantidades[$contador] = $selecionados;
            $contador= $contador+1; //conta +1 para o indice       
    }
    $quantidades2 = $quantidades;
    $quantidades3 = $quantidades;
    /*
    echo'<pre> quantidades';
    print_r($quantidades);
    echo'</pre>';
    */   
// formata lista add: quantidade, total do item e calcula valor total da lista
    $soma = 0;
    $contador=1;
        foreach ($quantidades as $indice => $quantidades) { 
            $lista[$contador][0]['quantidade']= $quantidades; //adiciona as quantidades na lista
            $total= $lista[$contador][0]['quantidade'] * $lista[$contador][0]['VALOR']; // calcula quantidade x valor do item
            $lista[$contador][0]['total']= $total; //adiciona o total do  item
            $soma = $lista[$contador][0]['total'] + $soma; //soma o total de todos os itens
            $contador= $contador+1; //conta +1 para o indice da lista 
        
        }
    /*
    echo'<pre> lista';
    print_r($lista);
    echo'</pre>';
    echo($soma);
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sua lista</title>
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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
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
			<div >
				<div class="col">		
						<div class="row">
                            <?php if ($venda == 'confirmada') {
                                
                                    $contador=1;
                                    foreach ($quantidades2 as $indice => $quantidades2) { 
                                        $novaquantidade= $lista[$contador][0]['QUANTIDADE'] - $lista[$contador][0]['quantidade'];
                                        $query = "
                                                UPDATE produtos 
                                                SET   quantidade ='{$novaquantidade}'
                                                WHERE  id = '{$lista[$contador][0]['ID']}' ";
                                        $conexao->exec($query);
                                                                            
                                        $contador= $contador+1; //conta +1 para o indice da lista 
                                    }  
                                                
                            ?>
                                <h1>Nota Fiscal</h1>
                            <?php }else{ ?>
							    <h1>Seus itens</h1>
                            <?php };?>	

								

							<?php
                                //crie uma variável para receber o código da tabela
                                $tabela = '<table class="bordered striped centered tabela">';//abre table
                                $tabela .='<thead>';//abre cabeçalho
                                $tabela .= '<tr>';//abre uma linha
                                $tabela .= '<th>Produto</th>'; // colunas do cabeçalho
                                $tabela .= '<th>Preço</th>';
                                $tabela .= '<th>Quantidade</th>';
                                $tabela .= '<th>Total</th>';
                                $tabela .= '</tr>';//fecha linha
                                $tabela .='</thead>'; //fecha cabeçalho
                                $tabela .='<tbody>';//abre corpo da tabela
                            
                                $contador=1;
                                foreach ($quantidades3 as $indice => $quantidades3) {      //começo do loop
                                    $lista[$contador][0]['VALOR'] = number_format($lista[$contador][0]['VALOR'],2, ',', ' ');
                                    $lista[$contador][0]['total'] = number_format($lista[$contador][0]['total'],2, ',', ' '); //formata o valor para R$0,00 
                                    $tabela .= '<tr>'; // abre uma linha
                                    $tabela .= '<td>'.$lista[$contador][0]['NOME'].'</td>'; 
                                    $tabela .= '<td>R$'.$lista[$contador][0]['VALOR'].'</td>'; 
                                    $tabela .= '<td>'.$lista[$contador][0]['quantidade'].'</td>';
                                    $tabela .= '<td>R$'.$lista[$contador][0]['total'].'</td>'; 
                                    $tabela .= '</tr>'; // fecha linha
                                    $contador= $contador+1; //conta +1 para o indice da lista
                                    /*loop fim*/
                                }
                                $tabela .= '<tr>'; // abre uma linha
                                $tabela .= '<td></td>';
                                
                                $tabela .= '<td></td>';
                                
                                $tabela .= '<td>Total:</td>';
                                $soma= number_format($soma,2, ',', ' ');
                                $tabela .= '<td>R$'.$soma.'</td>';
                                $tabela .= '</tr>'; // fecha linha
                                $tabela .='</tbody>'; //fecha corpo
                                $tabela .= '</table>';//fecha tabela
                                echo $tabela; // imprime
							?>
                            <?php if ($venda == 'confirmada') {?>
                                    <div class="d-inline-flex w-100">                                        
                                        <button class="login100-form-btn" onclick="window.print()">			                
								            Imprimir venda
						                </button>
                                        <button class="login100-form-btn">
							                <a class="login100-form-btn" href="index.html">
								            Menu principal
							                </a>
						                </button>
                                   </div> 
                            <?php }else{ ?>
                                    <div class="row">
                                    
                                        <form method="post" action="calculo.php?venda=confirmada">
                                            <?php  
                                                $contador=0;
                                                foreach ($selecionados0 as $indice2 => $selecionados0) { //começo do loop ?>

                                                        <input type="hidden" name="<?=$idselecionados0[$contador]?>" value="<?=$selecionados0?>" >	

                                            <?php 
                                                    $contador = $contador+1;
                                                    } // fim do loop
                                            ?>

                                            <div class="container-login100-form-btn">          
                                                    <button class="login100-form-btn">
                                                        Confirmar venda
                                                    </button>
                                            </div>
                                        </form>
                                    </div>
                            <?php };?>
                        </div>

				</div>	
			</div>
		</div>
	</div>
      

	


</body>
</html>