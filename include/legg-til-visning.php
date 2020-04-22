<?php 

if(isset($_POST["uke_aar"])){
    
    
    $uke_aarstall = $_POST["uke_aar"];
        
    $bindestrek = strpos($uke_aarstall, 'W');
    
    $aarstall = substr($uke_aarstall, 0, 4);
    
    $uke = substr($uke_aarstall, $bindestrek + 1, 2);
        
    $film_id = $_POST["film_id"];
    
    if(($aarstall >= date("Y") && $aarstall <= (date("Y")+5))){
                
        if(($aarstall > date("Y")) || ($aarstall == date("Y") && $uke >= date("W"))) {
        
        $sql = "select * from visning 
                where 
                aarstall = $aarstall 
                and 
                uke = $uke";
        
        $resultat = $kobling->query($sql);
        
        if(mysqli_num_rows($resultat) == 0) {
    
            $sql = "insert into visning (uke, aarstall, film_id) 
            VALUES
            ('$uke', '$aarstall', '$film_id')";
    
                if($kobling->query($sql)) {
        
                    $sql = "select tittel from film where film_id = $film_id";
    
                    $resultat = $kobling->query($sql);
    
                    $rad = $resultat->fetch_assoc();
    
                    $tittel = $rad["tittel"];
                        
                    $melding = "En visning i uke $uke, har blitt lagt til for filmen $tittel";
    
                    $_SESSION["visning"] = $melding;
    
                    header("Location: legg-til.php");
                
    
                } else {
                    $error = (strtolower($kobling->error));
    
                        if(strpos($error, 'duplicate') !== false){
        
                            $melding = "Det er allerde lagt inn en film i uke $uke";
                            
                            $_SESSION["visning"] = $melding;
    
                            header("Location: legg-til.php");
        
                        } else {
                            $melding = "$error";
                            
                            $_SESSION["visning"] = $melding;
    
                            header("Location: legg-til.php");
                        }   
                }
            } else {
            
                $melding = "Det finnes allerde en film i uke $uke i $aarstall";
            
                $_SESSION["visning"] = $melding;
    
                header("Location: legg-til.php");
            }
            
        
        } else {
            
            $melding = "Du kan ikke legge inn en visning for en uke som allerde har vært";
            
            $_SESSION["visning"] = $melding;
    
            header("Location: legg-til.php");
            
        }
     
        
    } else {
         
        $melding = "Året du har lagt inn er enten et år som har vært, eller mer enn 5 år frem i tid";
        
        $_SESSION["visning"] = $melding;
    
        header("Location: legg-til.php");
    }
    
    
    
    
}  else {
    
    //hvis det er visning og film
    
    $uke = $_SESSION["uke"];
    
    $aarstall = $_SESSION["aarstall"];
    
    $tittel = $_POST["tittel"];
    
    $sql = "select film_id from film where tittel = '$tittel'";
    
    $resultat = $kobling->query($sql);
    
    $rad = $resultat->fetch_assoc();
    
    $film_id = $rad["film_id"];
    
    
            $sql = "insert into visning (uke, aarstall, film_id) 
            VALUES
            ('$uke', '$aarstall', '$film_id')";
    
                if($kobling->query($sql)) {
        
                    $sql = "select tittel from film where film_id = $film_id";
    
                    $resultat = $kobling->query($sql);
    
                    $rad = $resultat->fetch_assoc();
    
                    $tittel = $rad["tittel"];
            
                    $melding = "En visning i uke $uke, har blitt lagt til for filmen $tittel";
    
                    $_SESSION["visning"] = $melding;
    
                    header("Location: legg-til.php"); 
                
    
                } else {
                    $error = (strtolower($kobling->error));
    
                        if(strpos($error, 'duplicate') !== false){
        
                            $melding = "Det er allerde lagt inn en film i uke $uke";
                            
                            $_SESSION["visning"] = $melding;
    
                            header("Location: legg-til.php");
        
                        } else {
                            echo "$error";
                        }   
                }
}



?>