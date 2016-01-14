<?php

$time_start = microtime(true);

function read_it ($file) {
	if (is_readable($file)) {
		$fichier = fopen($file, "r");
		if (FALSE === $fichier) {
			return(-1);
		}
		else {
			$contents = fread($fichier, filesize($file));
			fclose($fichier);
			return($contents);
		}
	}
	else {
		echo "Erreur lors de l'ouverture du fichier $file\n";
		return(-1);
	}
}
if (isset($argv[1]) && isset($argv[2]) && !isset($argv[3])) {
	$file1 = read_it($argv[1]);
	$file2 = read_it($argv[2]);
	if ($file1 != -1 && $file2 != -1)
	{
		preg_match_all("/[a-zA-Z][\S]+/", $file1, $tab1);
		preg_match_all("/[a-zA-Z][\S]+/", $file2, $tab2);

		$tab2re = array_flip($tab2[0]);
		$resu = array();
		$a = 0;
		for ($i = 0; isset($tab1[0][$i]); $i++) {
			if (isset($tab2re[$tab1[0][$i]])) {
				echo $tab1[0][$i]."\n";
				$a++;
			}
		}

		echo $a." mots trouvés\n";
		$time_end = microtime(true);
		$time = $time_end - $time_start;

		echo "Recherche terminee en $time sec\n";
	}
}
else {
	echo "Usage : php nox.php message dico\n";
}
?>
