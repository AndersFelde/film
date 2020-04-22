<?php 

    $uke_aarstall = $_POST["uke_aar"];
        
    $bindestrek = strpos($uke_aarstall, 'W');
    
    $aarstall = substr($uke_aarstall, 0, 4);
    
    $uke = substr($uke_aarstall, $bindestrek + 1, 2);

    if(($aarstall >= date("Y") && $aarstall <= (date("Y")+5))){
                
        if(($aarstall > date("Y")) || ($aarstall == date("Y") && $uke >= date("W"))) {
        
        $sql = "select * from visning 
                where 
                aarstall = $aarstall 
                and 
                uke = $uke";
        
        $resultat = $kobling->query($sql);
        
        if(mysqli_num_rows($resultat) == 0) {
        
            $_SESSION["aarstall"] = $aarstall;

            $_SESSION["uke"] = $uke;
            
            include("film-visning-form.php");

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
?>




