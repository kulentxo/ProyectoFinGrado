<!DOCTYPE html>
	<html>
		<head>
			<title>Page Title</title>
		</head>
		<style>
			.button {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				background-color: #33B2FF;
				padding: 15px;
				padding-bottom: : 15%;
				margin-left: 30%;
				text-decoration: none;
			}
			.buttons{
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				padding: 15px;
				text-decoration: none;
			}
			.button1 {
				background-color: #33B2FF;
				color: black;
				border: 2px solid #33B2FF;
			}
			.button1:hover {
				background-color: #3390FF;
				color: black;
				border: 2px solid #3390FF;
			}
			li{
				display: inline;
			}
			#links {
				padding: 5px;
				background-color: #33B2FF;
			} 
			p{
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			}
		</style>
		<body>
			<div id="links">
				<ul style="">
				  <li ><a class="button button1" href="RankingChall.php" target="_blank">Ranking</a></li>
				  <li ><a class="buttons button1" href="Campeones.php" target="_blank">Campeones</a></li>
				  <li ><a class="buttons button1" href="Estadisticas.php" target="_blank">Estadisticas</a></li>
				  <li ><a class="buttons button1" href="index.php" target="_blank">Inicio</a></li>
				</ul>
			</div>
			<form class="" name="summonerForm" action="Invocador.php" method="POST">
				<p>Summoner Name: <input type="text" name="username" placeholder="username"/><input class="buttons button1" type="submit" name="submit" value="submit"/>
			</form><br /></p>
			
		</body>
</html>