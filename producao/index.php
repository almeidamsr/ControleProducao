<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> </title>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="_css/meuestiloprod.css">
	
</head>
<body>

<div id="header">
<h1>TECNOLOGIA DA PROGRAMAÇÃO V</h1>
</div>

<div id="nav">
<a href="index.php">Inicio</a><br>
<a href="index.php?id=produto">Ordem de Produção</a><br>
<a href="index.php?id=relatorio">Relatorio</a><br>
</div>

<?php
	@$id = $_GET["id"];
	$pages["produto"]="./_pages/produto.php";
	$pages["relatorio"]="./_pages/relatorio.php";
	$pages["grafico"]="./_pages/grafico.php";
?>

<div id="section">

<?php
	if(is_null($id)){
		@include $pages["produto"]="./_pages/produto.php";
	}
	@include $pages[$id];
?>

</div>

<div id="footer">

</div>

</body>
</html>