<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['username'];
		
	$api_key = "RGAPI-98dd23ed-bb04-4770-bba1-1ae196002564";
							
	$api_url_summoner = "https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/" . $username . "?api_key=" . $api_key;
	$summoner_data = file_get_contents($api_url_summoner);
	$json_summoner = json_decode($summoner_data, TRUE);

		

	$summoner_lvl = $json_summoner['summonerLevel'];
	$summoner_accountId = $json_summoner['accountId'];

	$api_url_match = "https://euw1.api.riotgames.com/lol/match/v4/matchlists/by-account/" . $summoner_accountId . "?api_key=" . $api_key;
	$match_data = file_get_contents($api_url_match);
	$json_match = json_decode($match_data, TRUE);
	$match_array = $json_match['matches'];

	$gameId_array = array();
	$champion = array();
	$spell1 = array();
	$spell2 = array();
	$kills = array();
	$deaths = array();
	$assits = array();
	$partid = array();

	for($x = 0; $x <= count($match_array); $x++){
		foreach($match_array as $id1=>$match){
			foreach($match as $id=>$data){
				if($id == "gameId"){
					array_push($gameId_array, $data);
				}
			}
		}
	}	
	for($x = 0; $x <= 3; $x++){
			$api_url_match_info = "https://euw1.api.riotgames.com/lol/match/v4/matches/" . $gameId_array[$x] . "?api_key=" . $api_key;
			$match_info_data = file_get_contents($api_url_match_info);
			$json_match_info = json_decode($match_info_data, TRUE);
			foreach ($json_match_info as $id => $data) {
				if($id == "participantIdentities"){
					$num = 0;
					foreach($data as $idpart => $datapart){
						$num++;
						foreach($datapart as $idplayer => $dataplayer){
							if($idplayer == "player"){
								foreach ($dataplayer as $idplayer2 => $dataplayer2) {
									if($dataplayer2 == $username){
										$partid[] = $num;	
									}
								}
							}
						}
					}
				}
			}
	}
	$idbueno = "";
	for($x = 0; $x <= 3; $x++){
		$api_url_match_info = "https://euw1.api.riotgames.com/lol/match/v4/matches/" . $gameId_array[$x] . "?api_key=" . $api_key;
		$match_info_data = file_get_contents($api_url_match_info);
		$json_match_info = json_decode($match_info_data, TRUE);
		foreach ($json_match_info as $id => $data) {	
			if($id == "participants"){
					foreach ($data as $id3 => $datapartid2) {
						foreach ($datapartid2 as $id4 => $datapartid3){
								if($id4 == "participantId"){
										if($datapartid3 == $partid[$x]){
											$idbueno = $datapartid3;
										}
								}
								if($idbueno != ''){
									switch ($id4) {
										case 'championId':
											$champion[] = $datapartid3;
											break;
										case 'spell1Id':
											$spell1[] = $datapartid3;
											break;
										case 'spell2Id':
											$spell2[] = $datapartid3;
											break;
										}
									if($id4 == "stats"){
										foreach($datapartid3 as $id5 => $datapartid4){
											switch($id5){
												case 'kills':
													$kills[] = $datapartid4;
													break;
												case 'deaths':
													$deaths[] = $datapartid4;
													break;
												case 'assists':
													$assists[] = $datapartid4;
													break;
											}
										}
									}	
								}
						}
					}
				$idbueno = '';
			}
		}
	}
}
?>
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
			<h1><?php echo $username;?></h1>
			<h4>Level: <?php echo $summoner_lvl;?></h4>
			<table id="datos">
				<tr>
					<th>Campeon</th>
					<th>Hechizo 1</th>
					<th>Hechizo 2</th>
					<th>Asesinatos</th>
					<th>Muertes</th>
					<th>Asistencias</th>
				</tr>
				<?php
					for($x = 0; $x < count($partid); $x++){
						echo "<tr>";
						echo "<td>" . $champion[$x] . "</td>";
						echo "<td>" . $spell1[$x] . "</td>";
						echo "<td>" . $spell2[$x] . "</td>";
						echo "<td>" . $kills[$x] . "</td>";
						echo "<td>" . $deaths[$x] . "</td>";
						echo "<td>" . $assists[$x] . "</td>";
						echo "</tr>";
					}
				?>
			</table>
		</body>
</html>