<!DOCTYPE html>
	<html>
		<head>
			<title>Page Title</title>
		</head>
		<style>
			#datos {
			  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			#datos td, #datos th {
			  border: 1px solid #ddd;
			  padding: 8px;
			}

			#datos tr:nth-child(even){background-color: #f2f2f2;}

			#datos tr:hover {background-color: #ddd;}

			#datos th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #33B2FF;
			  color: white;
			}
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
				  <li><form class="" name="summonerForm" action="Invocador.php" method="POST">
				<p>Summoner Name: <input type="text" name="username" placeholder="username"/><input class="buttons button1" type="submit" name="submit" value="submit"/>
			</form><br /></p></li>
				</ul>
			</div>
			
			<table id="datos">
				<tr>
					<th>Division</th>
					<th>Nombre</th>
					<th>Puntos</th>
					<th>Ganadas</th>
					<th>Perdidas</th>
				</tr>
				<?php
				#La key de la api que se necesita actualizar todos los dias para que funcione
				$api_key = "RGAPI-98dd23ed-bb04-4770-bba1-1ae196002564";
				#La url proporcionada en la pagina
				$api_ranking = "https://euw1.api.riotgames.com/lol/league-exp/v4/entries/RANKED_SOLO_5x5/CHALLENGER/I?page=1&api_key=" . $api_key;
				#Extraer los datos de la api
				$ranking_data = file_get_contents($api_ranking);
				#Pasar los datos extraidos a json
				$json_ranking = json_decode($ranking_data, TRUE);
				#Foreach para ir por todos los datos que hay en el array
				foreach($json_ranking as $id => $data){
					#echo tr para hacer la tabla en html
					echo "<tr>";
					#otro foreach porque despues de la principal seguido hay otro array
					foreach($data as $id2 => $data2){
						#switch para sacar los datos por el id
						switch($id2){
							case 'tier':
								echo "<td>";
								echo $data2;
								echo "</td>";
								break;
							case 'summonerName':
								echo "<td>";
								echo $data2;
								echo "</td>";
								break;
							case 'leaguePoints':
								echo "<td>";
								echo $data2;
								echo "</td>";
								break;
							case 'wins':
								echo "<td>";
								echo $data2;
								echo "</td>";
								break;
							case 'losses':
								echo "<td>";
								echo $data2;
								echo "</td>";
								break;
						}
					}
					echo "</tr>";
				}

?>
			</table>
		</body>
</html>
