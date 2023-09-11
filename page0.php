<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "dadosort") or die("Erro no banco!");
$banco = mysqli_query($link,"SELECT * from perguntas;") or die("Erro na query: ".mysqli_error($link));
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAGE 0</title>
</head>
<body>
	<?php
	/* <script type="text/javascript">alert("Item correto! (<?php echo($x." => $key"); ?>)"); </script>*/
	if (@$_POST["resposta"]) {
		$x = @$_POST["itensM"];
		$y = $_SESSION["verboIId"];
		if ($x || $x == 10) {
			$aux = 0;
			while ($row = mysqli_fetch_assoc($banco)) {
				$corretas[$row["id_verbo"]] = $row[2];
				$aux++;
			}
			$pass = false;
			if($x != 10){
				foreach ($corretas as $key => $value) {
					if ($x == $value) {
						$pass = true;
					}
				}
			}else{
				$pass1 = false;
				foreach ($corretas as $key => $value) {
					for ($o = 0; $o <= 4; $o++){
						if ($_SESSION["verbosEscolhidos1"][$o] != $value){
							if (!$pass1) {
								$pass = true;
							}
						}else{
							$pass = false;
							$pass1 = true;								
						}
					}
				}
			}
		}else{?>
			<script type="text/javascript">
				alert("Responda a questão!");
				window.location.href = 'index.php';
			</script>;
			<?php 
		}
		if ($pass == true) {
			if ($x == 10) {
				echo "<script type='text/javascript'>
				alert('Resposta correta! (".$corretas[$y].")');
				window.location.href='index.php';
				</script>";
			}else{
				echo "<script type='text/javascript'>
				alert('Resposta correta!');
				window.location.href='index.php';
				</script>";
			}
		}else{
			/**/
			echo "<script type='text/javascript'>
			alert('Resposta incorreta!');
			window.location.href='index.php';
			</script>";
		}
	}
	?>
</body>
</html>
