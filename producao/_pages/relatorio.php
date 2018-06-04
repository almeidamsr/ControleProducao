<h1> Relatorio </h1>

<hr>
<?php
	require('conexao.php');
	
	// verificando se os inputs estão vazios
	if(($_POST["inputProduto"]!="")){
		@$nomeProd = $_POST["inputProduto"];
	}
	$test = 12;
	
		$sql = "SELECT codProd,nome,mat_prima1,mat_prima2,mat_prima3,quantidadePedido,matPorDia,custoTotDia,dataAtual,dataInicial,dataEntrega
				FROM producao;";
		$result = $conn->query($sql);
	
		$sql2 = "SELECT sum(quantidadePedido) as quantidade, sum(custoTotDia) as custo
				FROM producao;";
		$result2 = $conn->query($sql);
		
		while($row2 = $result->fetch_assoc()) {
			$quantidade = $row2["quantidade"];
			$custo =  $row2["custo"];
		}
		
		if ($result->num_rows > 0) {
		// for each pra imprimir a tabela
			echo "<table class='table' border='1'>".
				 "<thead>".
				 "<tr>".
				 "<td>Codigo</td>".
				 "<td>Nome</td>".
				 "<td>materia prima 1</td>".
				 "<td>materia prima 2</td>".
				 "<td>materia prima 3</td>".
				 "<td>mat. Prod. Por Dia</td>".
				 "<td>custo Total Dia</td>".
				 "<td>Quantidade Pedida</td>".
			     "<td>Data do Pedido</td>".
				 "<td>Data de Entrega</td>".
				 "</tr>".
				 "</thead>";
			echo "<tbody>";			
				//imprime os dados do banco na tabela				
				while($row = $result->fetch_assoc()) {
					//guarda o codigo para ser usado na query do grafico
					$codigoProd = $row["codProd"];
					echo "<tr>".
						 "<td>". $row["codProd"]. "</td>".
						 "<td>". $row["nome"]. "</td>".
						 "<td>". $row["mat_prima1"]. "</td>".
						 "<td>". $row["mat_prima2"]. "</td>".
						 "<td>". $row["mat_prima3"]. "</td>".
						 "<td>". $row["matPorDia"]. "</td>".
						 "<td>". $row["custoTotDia"]. "</td>".
						 "<td>". $row["quantidadePedido"]. "</td>".
						 "<td>". $row["dataInicial"]. "</td>".
						 "<td>". $row["dataEntrega"]. "</td>".
						 "</tr>";
				}
				echo "</tbody></table>";
		} else {
			// echo "0 resultados";
		}
	
		$conn->close();
?>
<hr>
<form action="index.php?id=grafico&codProd=<?=$test?>" method="post">
	<input type="submit" value="Gerar Grafico">
</form>
<hr>