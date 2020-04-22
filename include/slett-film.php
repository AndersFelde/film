<?php

$tittel = $_POST["slett-film"];

$sql = "select * from film where tittel = '$tittel'";

$resultat = $kobling->query($sql);

$rad = $resultat->fetch_assoc();

$beskrivelse = $rad["beskrivelse"];
$bilde_navn = $rad["bilde_navn"];
$film_id = $rad["film_id"];

$sql1 = "DELETE from visning where film_id = $film_id;";

$sql2 = "DELETE from film where tittel = '$tittel'";

echo "<h1>LOADING...</h1>";


if(($kobling->query($sql1)) && ($kobling->query($sql2)) && (unlink("bilder/$bilde_navn"))) {
    
        header("Location: filmer.php");
    } else {
        
        $error = $kobling->error;
    
        echo "$error<br>";
        echo "Det kan ha skjedd en feil med å slette bilde";
    
    }
    

?>
