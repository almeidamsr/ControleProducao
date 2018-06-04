<html>

<?php
 require('conexao.php');

$conn = new mysqli($servername, $username, $password, $dbname);

?>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'Quantidade de Produtos', 'Custo Total'],
          ['2017', 1000, 400],
          ['2017', 1170, 460],
          ['2017', 660, 1120],
          ['2017', 1030, 540]
        ]);

        var options = {
          chart: {
            title: 'ordem de produtos',
            subtitle: '',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  <body>

	<h1> Grafico</h1>
	<div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>