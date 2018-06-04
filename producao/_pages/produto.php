<h1> Ordem de Produção </h1>

<form action="index.php?id=produto" method="post">
	<span id="tituloProduto">Produto</span>
	<div id="divProduto" style="margin:10px;">  
		<input id="inputProduto" name="inputProduto" type="text" value="maxsteel" ></input> 
	</div>
	<span id="tituloQuantidade">Quantidade</span>
	<div id="divQuantidade" style="margin:10px;"> 
		<input id="inputQuantidade" name="inputQuantidade" type="text"></input>
	</div>
	<span id="tituloDtInicial">Data Inicial</span>
	<div id="divDtInicial" style="margin:10px;">  
		<input id="inputDtInicial" name="inputDtInicial" type="text" value="2017-06-26" ></input> 
	</div>
	<input type="submit" value="Incluir">
</form>
<hr>

<?php

	require('conexao.php');
	
	// verificando se os inputs estão vazios
	if(($_POST["inputProduto"]!="") and ($_POST["inputQuantidade"]!="") and ($_POST["inputDtInicial"]!="")){
		@$nomeProd = $_POST["inputProduto"];
		@$quantidadePedido = $_POST["inputQuantidade"];
		@$dataInicial = $_POST["inputDtInicial"];
	
		//$partes = explode("/", $dataInicial);
        //$dia = $partes[0];
        //$mes = $partes[1];
        //$ano = $partes[2];
	
		$sql = "SELECT codProd,nome,mat_prima1,mat_prima2,mat_prima3,quantidadePedido,quantMatTotal,matPorDia,custoTotDia,dataAtual,dataInicial,dataEntrega
		FROM producao where nome = '$nomeProd';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// for each pra imprimir a tabela
			echo "<table class='table' border='1'>".
				 "<thead>".
				 "<tr>".
				 "<td>Nome</td>".
				 "<td>materia prima 1</td>".
				 "<td>materia prima 2</td>".
				 "<td>materia prima 3</td>".
				 "<td>mat. Prod. Por Dia</td>".
				 "<td>custo Total Dia</td>".
				 "<td>Quantidade Pedida</td>".
				 "<td>Custo Total da Ordem</td>".
			     "<td>Data do Pedido</td>".
				 "<td>Data de Entrega</td>".
				 "</tr>".
				 "</thead>";
			echo "<tbody>";
					//imprime os dados do banco na tabela
					while($row = $result->fetch_assoc()) {
					
					$codigoProd = $row["codProd"];
					$nome = $row["nome"];
					$custoDia = $row["custoTotDia"];
					
					//--------------------------------------------------
										
					$materiasPrimasPorDia  = $row["matPorDia"];
					$materiasPrimasTotal = $row["quantMatTotal"];
					
					$produtoPorDia = $materiasPrimasPorDia / $materiasPrimasTotal;
					
					if($quantidadePedido > $produtoPorDia){
						$quantidadeDiasProducao = $quantidadePedido / $produtoPorDia;
					}
					
					$sql2 = "SELECT date_add('$dataInicial', interval $quantidadeDiasProducao day) as dataFinal;";
					$result2 = $conn->query($sql2);
					
					while($final = $result2->fetch_assoc()) { 
						$dataFinal = $final["dataFinal"];
					}
					
					//verificando dias uteis
					// $dia_inicial  = date('w', strtotime('$dataInicial')); //traz o numero do dia da semana 1,2,3,4,5,6 ou 7 
					// $dia_final  = date('w', strtotime('$dataInicial')); // " "
					
			        // $partes = explode("-", $dataInicial);
                    // $diaI = $partes[1];
                    // $mesI = $partes[2];
                    // $anoI = $partes[0];
					
					// $partesF = explode("-", $dataFinal);
                    // $diaF = $partesF[1];
                    // $mesF = $partesF[2];
                    // $anoF = $partesF[0];
					
 				    // $dataInicial = "$anoI"."-"."$mesI"."-"."$diaI";
					// $cont = 0;
					
					// while($diaI != $diaF){
						// $diaSemana = date("w", dataToTimestamp('$dataInicial'));
						
						// if($diaSemana==0 || $diaSemana==6){
							// // //se SABADO OU DOMINGO, SOMA 01
							 // $diaF = $diaF + 1;
						// }	
						// $diaI++;
						// $cont++;
					  // }
					  
					   // $dataFinal = "$anoF"."-"."$mesF"."-"."$diaF";				

					$valorTotalDaOrdem = $quantidadeDiasProducao * $custoDia;
					//--------------------------------------------------
					
					echo "<tr>".
						 "<td>". $row["nome"]. "</td>".
						 "<td>". $row["mat_prima1"]. "</td>".
						 "<td>". $row["mat_prima2"]. "</td>".
						 "<td>". $row["mat_prima3"]. "</td>".
						 "<td>". $row["matPorDia"]. "</td>".
						 "<td>". $row["custoTotDia"]. "</td>".
						 "<td>". $quantidadePedido . "</td>".
						 "<td>". $valorTotalDaOrdem ."</td>".
						 "<td>". $dataInicial . "</td>".
						 "<td>". $dataFinal . "</td>".
						 "</tr>";
						 
						 //--------------------------------------------------
						 		$sql3 = "INSERT INTO pedidoProducao (nome, quantidadePedido, dataInicial,dataEntrega)
								VALUES ('$nome', $quantidadePedido,'$dataInicial','$dataFinal')";
								
								if ($conn->query($sql3) === TRUE) {
                                
							    echo "sucesso";
                               } else {
                                   echo "Error: " . $sql3 . "<br>" . $conn->error;
                               }
				}
				echo "</tbody></table>";
		} else {
			// echo "0 resultados";
		}
	
	}
		$conn->close();
?>
	