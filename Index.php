<?php 
session_start();
$link = mysqli_connect("localhost", "root", "", "dadosort") or die("Erro no banco!");
$banco = mysqli_query($link,"SELECT * from perguntas;") or die("Erro na query: ".mysqli_error($link));
$verbo = array("Nadar", "Correr","Andar","Pular","Ler","Ouvir");
$itens = array("a", "b","c","d","e","f");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<title>Back-End</title>
	<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
</head>
<body>
	<header>
		<form method="POST" action=".">
			<input type="submit" name="rodar" value="Jogar Dado">
		</form>
		<?php
		echo("Dado");
		/*while ($row = mysqli_fetch_assoc($query)) {*/
			if (@$_POST["rodar"]) {
				$aux = (array_rand($verbo)+1);
				while ($row = mysqli_fetch_assoc($banco)) {
					if ($row["id_verbo"] == $aux) {
						$v = $verbo[$aux-1];
						for ($i = 1; $i <= 6; $i++) { 
							$verbosEscolhidos[$i-1] = $row[$i];
						}
						echo "<h1>".$aux." - ".$verbo[$aux-1]."</h1>";
					}
				}
				$_SESSION["verbosEscolhidos"] = $verbosEscolhidos;
				$_SESSION["verboInfinitivo"] = $v;
				$_SESSION["verboIId"] = $aux;
				?>
				<form method="POST" action="page0.php">
					<?php
					echo "<h2><em>Qual a conjugação do verbo '$v' na 2º pessoa do singular no tempo presente?</em></h2>";

					shuffle($verbosEscolhidos);
					$_SESSION["verbosEscolhidos1"] = $verbosEscolhidos;
					foreach ($itens as $key => $value) {
						if ($value == "f") {
							echo "<input type='radio' name='itensM' value='10'>&nbsp;".$value.") Nenhum dos itens anteriores<br>";
						}else{
							echo "<input type='radio' name='itensM' value='".$verbosEscolhidos[$key]."'>&nbsp;".$value.") ".$verbosEscolhidos[$key]."<br>";
						}
					}
					?>
					<p><input type="submit" name="resposta" value="Responder"></p>
				</form>
				<?php 
			}
			?>
		</header>
	</body>
	</html>
