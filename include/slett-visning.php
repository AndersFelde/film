<?php

$uke_aarstall = $_POST["slett-visning"];

$uke_aarstall_arr = explode(',', $uke_aarstall);

$uke = $uke_aarstall_arr["1"];

$aarstall = $uke_aarstall_arr["0"];



$sql1 = "DELETE from visning where 
        uke = $uke
        and aarstall = $aarstall";

echo "<h1>LOADING...</h1>";

if(($kobling->query($sql1))){
        header("Location: visning.php");

    } else {
    $error = $kobling->error;
    
    echo "$error";
}

?>
