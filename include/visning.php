<?php
session_start();

if ( isset( $_POST[ "slett-visning" ] ) ) {

    include 'slett-visning.php';

} elseif ( isset( $_POST[ "endre-visning" ] ) ) {

    include 'endre-visning.php';

} elseif ( isset( $_POST[ "visning-endring" ] ) ) {

    include 'visning-endring.php';

} elseif ( ( isset( $_POST[ "visninger-for-film" ] ) ) ) {
    
    $film_id_ = $_POST[ "visninger-for-film" ];
    
    $sql = "select film_id from visning where film_id = $film_id_";
    
    $resultat = $kobling->query($sql);
    
    if(mysqli_num_rows($resultat) == 0){
        
        echo "<span class='melding'>Det finnes ingen visninger for denne filmen</span>";
    
        session_unset();
    }

    $sql = "SELECT aarstall, uke, tittel, visning_id, visning.film_id
            from visning
            join film on visning.film_id=film.film_id
            order by 
            aarstall, uke
            ";

    $resultat = $kobling->query( $sql );

    echo "<table class='visning-tabell'>";

    echo "<thead><tr>";
    echo "<th>År</th>";
    echo "<th>Uke</th>";
    echo "<th>Film</th>";
    echo "</tr></thead>";
    
    $addbutton = 0;

    while ( $rad = $resultat->fetch_assoc() ) {

        $aarstall = $rad[ "aarstall" ];
        $uke = $rad[ "uke" ];
        $tittel = $rad[ "tittel" ];
        $visning_id = $rad[ "visning_id" ];
        $film_id = $rad[ "film_id" ];

        if ( $film_id_ == $film_id ) {

            echo "<tbody><tr class='film-uthev' id='$tittel'>";
            echo "<td id='visning-tall'>$aarstall</td>";
            echo "<td id='visning-tall'>$uke</td>";
            echo "<td>";
            echo "<form class='form' action='filmer.php#$tittel' method='POST'>";
            echo "<button value='$tittel' name='tittel'>$tittel</button>";
            echo "</form>";
            echo "<td class='trash-visning'>
                        <form action='#' method='POST'>
                        <button type='submit' value='$aarstall,$uke' name='slett-visning' class=' delete-button visninger-button material-icons'>delete</button>
                        <button type='submit' value='$aarstall,$uke,$tittel,$visning_id,$film_id' name='endre-visning' class='visninger-button material-icons edit-button'>edit</button>
                        </form>
                    </td>";
            echo "</td>";
            echo "</tr></tbody>";
        

        } else {

            echo "<tbody><tr>";
            echo "<td id='visning-tall'>$aarstall</td>";
            echo "<td id='visning-tall'>$uke</td>";
            echo "<td>";
            echo "<form class='form' action='filmer.php#$tittel' method='POST'>";
            echo "<button value='$tittel' name='tittel'>$tittel</button>";
            echo "</form>";
            echo "<td class='trash-visning'>
                        <form action='#' method='POST'>
                        <button type='submit' value='$aarstall,$uke' name='slett-visning' class=' delete-button visninger-button material-icons'>delete</button>
                        <button type='submit' value='$aarstall,$uke,$tittel,$visning_id,$film_id' name='endre-visning' class='visninger-button material-icons edit-button'>edit</button>
                        </form>
                    </td>";
            echo "</td>";
            echo "</tr></tbody>";
        }
        
        $addbutton++;
        
        if($addbutton == (mysqli_num_rows($resultat))){
            
            echo "</table>";

                echo "<form action='legg-til.php' method='POST'>
                        <button type='submit' name='visning' class='material-icons filmer-button add-button'>add</button>
                    </form>";
            
        }
    }
    echo "</table>";



} else {

    if ( isset( $_SESSION[ "visning-endret" ] ) ) {
        $melding = $_SESSION[ "visning-endret" ];

        echo "<span class='melding'>$melding</span>";

        session_unset();
    }


    $sql = "SELECT aarstall, uke, tittel, visning_id, visning.film_id
            from visning
            join film on visning.film_id=film.film_id
            order by 
            aarstall, uke
            ";

    $resultat = $kobling->query( $sql );

    echo "<table class='visning-tabell'>";

    echo "<thead><tr>";
    echo "<th>År</th>";
    echo "<th>Uke</th>";
    echo "<th>Film</th>";
    echo "</tr></thead>";
    
    $addbutton = 0;

    while ( $rad = $resultat->fetch_assoc() ) {
        $aarstall = $rad[ "aarstall" ];
        $uke = $rad[ "uke" ];
        $tittel = $rad[ "tittel" ];
        $visning_id = $rad[ "visning_id" ];
        $film_id = $rad[ "film_id" ];
        

        echo "<tbody><tr>";
        echo "<td id='visning-tall'>$aarstall</td>";
        echo "<td id='visning-tall'>$uke</td>";
        echo "<td>";
        echo "<form class='form' action='filmer.php#$tittel' method='POST'>";
        echo "<button value='$tittel' name='tittel'>$tittel</button>";
        echo "</form>";
        echo "<td class='trash-visning'>
                        <form action='#' method='POST'>
                        <button type='submit' value='$aarstall,$uke' name='slett-visning' class='visninger-button material-icons delete-button'>delete</button>
                        <button type='submit' value='$aarstall,$uke,$tittel,$visning_id,$film_id' name='endre-visning' class='visninger-button material-icons edit-button'>edit</button>
                        </form>
                    </td>";
        echo "</td>";
        echo "</tr>
                </tbody>";
        
        $addbutton++;
        
        if($addbutton == (mysqli_num_rows($resultat))){
            
            echo "</table>";
            
            

                echo "<form action='legg-til.php' method='POST'>
                        <button type='submit' name='visning' class='material-icons filmer-button add-button'>add</button>
                    </form>";
            
        }
        
    }
}
?>