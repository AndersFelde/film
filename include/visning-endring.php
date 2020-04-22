<?php 



$visning_id = $_POST["visning-endring"];
$aarstall = $_POST["aarstall"];
$uke = $_POST["uke"];
$film_id = $_POST["film_id"];


    if(($aarstall >= date("Y") && $aarstall <= (date("Y")+5))){
                
        if(($aarstall > date("Y")) || ($aarstall == date("Y") && $uke >= date("W"))) {
        
        $sql = "select * from visning 
                where 
                aarstall = $aarstall 
                and 
                uke = $uke
                where visning_id not in ('$visning_id')";
        
        $resultat = $kobling->query($sql);
        
        if(mysqli_num_rows($resultat) == 0) {
    
            $sql = "UPDATE visning 
                    SET
                    aarstall = $aarstall,
                    uke = $uke,
                    film_id = $film_id
                    where visning_id = '$visning_id'";
    
                if($kobling->query($sql)) {
        
                    $sql = "select tittel from film where film_id = $film_id";
    
                    $resultat = $kobling->query($sql);
    
                    $rad = $resultat->fetch_assoc();
    
                    $tittel = $rad["tittel"];
                        
                    $melding = "Oppdatert visning til $uke, $aarstall, $tittel";
    
                    $_SESSION["visning-endret"] = $melding;

                    header("Location: visning.php");
                    
                    echo "$sql";
                
    
                } else {
                    $error = (strtolower($kobling->error));
    
                        if(strpos($error, 'duplicate') !== false){
        
                            $melding = "Det er allerde lagt inn en film i uke $uke";
                            
                            $_SESSION["visning-endret"] = $melding;
    
                            header("Location: visning.php");
        
                        } else {
                            $melding = "$error";
                            
                            $_SESSION["visning-endret"] = $melding;
    
                            header("Location: visning.php");
                        }   
                }
            } else {
            
                $melding = "Det finnes allerde en visning i uke $uke i $aarstall";
            
                $_SESSION["visning-endret"] = $melding;
    
                header("Location: visning.php");
            }
            
        
        } else {
            
            $melding = "Du kan ikke legge inn en visning for en uke som allerde har vært";
            
            $_SESSION["visning-endret"] = $melding;
    
            header("Location: visning.php");
            
        }
     
        
    } else {
         
        $melding = "Året du har lagt inn er enten et år som har vært, eller mer enn 5 år frem i tid";
        
        $_SESSION["visning-endret"] = $melding;
    
        header("Location: visning.php");
    }



?>
