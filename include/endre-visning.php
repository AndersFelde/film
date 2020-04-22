<?php

$uke_aarstall = $_POST[ "endre-visning" ];

$uke_aarstall_arr = explode( ',', $uke_aarstall );

$uke = $uke_aarstall_arr[ "1" ];
$aarstall = $uke_aarstall_arr[ "0" ];
$tittel = $uke_aarstall_arr[ "2" ];
$visning_id = $uke_aarstall_arr[ "3" ];
$film_id = $uke_aarstall_arr[ "4" ];

echo "<table class='visning-tabell'>";

echo "<thead><tr>";
echo "<th>År</th>";
echo "<th>Uke</th>";
echo "<th>Film</th>";
echo "</tr></thead>";


echo "<tbody><tr>";
echo "<form action='#' method='POST'>";
echo "<td id='visning-tall'><input type='number' name='aarstall' autofocus class='edit-visning-input' value='$aarstall'></td>";
echo "<td id='visning-tall'><input type='number' name='uke' tabindex='0' class='edit-visning-input check-button' value='$uke'></td>";
echo "<td>";
echo "<select id='edit-visning-film' name='film_id'>
        
                    <option value='$film_id'>$tittel</option>";


$sql = "select film_id, tittel from film
                            where tittel not in ('$tittel')";

$resultat = $kobling->query( $sql );

while ( $rad = $resultat->fetch_assoc() ) {
    $tittel = $rad[ "tittel" ];
    $film_id = $rad[ "film_id" ];

    echo "<option value='$film_id'>";
    echo "$tittel";
    echo "</option>";
}



echo "</select>";
echo "</td>";
echo "<td class='trash-visning'>
                        <button type='submit' value='$aarstall,$uke' name='slett-visning' class='visninger-button material-icons delete-button'>delete</button>
                        <button type='submit' value='$visning_id' name='visning-endring' class='visninger-button material-icons check-button'>check</button>
                        </form>
                    </td>";
echo "</td>";
echo "</tr></tbody>";

echo "$visning_id";

$sql = "SELECT aarstall, uke, tittel, visning_id, visning.film_id
                    from visning
                    join film on visning.film_id=film.film_id
                    where visning_id not in ('$visning_id')
                    order by 
                    aarstall, uke
                    ";

echo "$sql";

$resultat = $kobling->query( $sql );

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
                                <form action='visning.php' method='POST'>
                                <button type='submit' value='$aarstall,$uke' name='slett-visning' class='visninger-button material-icons delete-button'>delete</button>
                                <button type='submit' value='$aarstall,$uke,$tittel,$visning_id,$film_id' name='endre-visning' class='visninger-button material-icons edit-button'>edit</button>
                        </form>
                                </form>
                            </td>";
    echo "</td>";
    echo "</tr></tbody>";

    $addbutton++;

    if ( $addbutton == ( mysqli_num_rows( $resultat ) ) ) {

        echo "</table>";

        echo "<form action='legg-til.php' method='POST'>
                        <button type='submit' name='visning' class='material-icons filmer-button add-button'>add</button>
                    </form>";

    }
}
echo "</table>";
?>