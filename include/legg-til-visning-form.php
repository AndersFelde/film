<?php 
if(isset($_SESSION["visning"])) {
    
    $melding = $_SESSION["visning"];
    
    echo "<span class='melding'>$melding</span>";
    
    session_unset();
}

?>
<div class="mid">
<h1>Legg til en visning</h1>
<form class="form" method="post">
    <label>Hvilken film skal sees?</label><br>
    <select name="film_id">
        
        <option value="film">Legg til film</option>

        <?php 
            $sql = "select film_id, tittel from film";
            $resultat = $kobling->query($sql);
        
            while($rad = $resultat->fetch_assoc()){
                $tittel = $rad["tittel"];
                $film_id = $rad["film_id"];

                echo "<option value='$film_id'>";
                    echo "$tittel";
                echo "</option>";
            }
        ?>

        
    </select><br>
    
    <label>Når skal du se filmen? (Uke, år)</label><br>
    <input type="week" maxlength="3" name="uke_aar"><br>
    
    
    <button name="legg-til-visning" type="submit">Legg til visning</button>

</form>
</div>