<?php 
$file = $_FILES["bilde"];

$bilde_name = $file["name"];
$bilde_tmp_name = $file["tmp_name"];
$bilde_size = $file["size"];
$bilde_error = $file["error"];

$bilde_ext = explode('.', $bilde_name);

$bilde_type = strtolower(end($bilde_ext));

$allowed = array('jpg', 'jpeg', 'png');

if($bilde_error === 0) {
    
    if(in_array($bilde_type, $allowed)) {
    
        if ($bilde_size < 200000000) {
            
            $bilde_name_new = uniqid('', true).".".$bilde_type;
            
            $bilde_dest = 'bilder/'.$bilde_name_new;
            
            include 'insert-film.php';
            

        
            } else {
            //size
                $melding = "ikke så store bilder da plz";
            
                $_SESSION["film"] = $melding;
    
                header("Location: legg-til.php");
            }
    
    } else {
        //filtype
        $melding = "Filtypen du har valgt er ikke lov, SLUTT";
        
        $_SESSION["film"] = $melding;
    
        header("Location: legg-til.php");
    }

} else {
    //eror
    $melding = "Den er en error med bilde du har lastet opp";
    
    $_SESSION["film"] = $melding;
    
    header("Location: legg-til.php");
}

?>