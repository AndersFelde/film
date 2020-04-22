<?php

$film_id = $_POST[ "endre-film" ];

$sql = "select * from film where film_id = $film_id";

$resultat = $kobling->query( $sql );

$rad = $resultat->fetch_assoc();

$tittel = $rad[ "tittel" ];
$beskrivelse = $rad[ "beskrivelse" ];
$bilde_navn = $rad[ "bilde_navn" ];

echo "<table class='filmer'>";

echo "<tr>";

echo "<td>
                    <form action='#' class='film-endring' method='POST' enctype='multipart/form-data'>
                        <div>
                        <h1>
                        <input class='film-edit-input' required name='tittel' value='$tittel'>
                        </h1>
                        <textarea class='film-edit-textarea' required name='beskrivelse'>$beskrivelse</textarea>
                        <br>
                        *Det er ikke nødvendig å velge et nytt bilde
                        <br>
                        <input type='file' accept='.png, .jpg, .jpeg' name='bilde'>
                        </div>
                        <div>
                            <img class='film-edit-img' src=bilder/" . "$bilde_navn>
                        </div>
                        <div class='trash-film'>
                            <button type='submit' value='$tittel' name='slett-film' class='material-icons filmer-button delete-button'>delete</button>
                            <button type='submit' value='$film_id,$bilde_navn' name='film-endring' class='material-icons filmer-button check-button'>check</button>
                        </div>
                    </form>
                </td>";
echo "</tr>";

echo "</table>";

echo "<table class='filmer'>";

$sql = "select * from film
                where tittel not in ('$tittel')
                order by tittel";

$resultat = $kobling->query( $sql );

$addbutton = 0;

while ( $rad = $resultat->fetch_assoc() ) {

    $tittel = $rad[ "tittel" ];
    $beskrivelse = $rad[ "beskrivelse" ];
    $bilde_navn = $rad[ "bilde_navn" ];
    $film_id = $rad[ "film_id" ];

    echo "<tr>";
    echo "<td>              
                            <div class='film-info'>
                            <div class='tittel-beskrivelse'>
                            <h1>$tittel</h1>$beskrivelse
                            </div>
                            <div class='se-visning'>
                            <form action='visning.php#$tittel' method='POST'>
                            <button name='visninger-for-film' value='$film_id' class='filmer-button-visning'>Se visninger</button>
                            </form>
                            </div>
                            </div>
                            </td>";
    echo "<td><img src=bilder/" . "$bilde_navn></td>";
    echo "<td class='trash-film'>
                            <form action='#' method='POST'>
                            <button type='submit' value='$tittel' name='slett-film' class='material-icons filmer-button delete-button'>delete</button>   
                            <button type='submit' value='$film_id' name='endre-film' class='material-icons filmer-button edit-button'>edit</button>
                            </form>
                        </td>";
    echo "</tr>";

    $addbutton++;

    if ( $addbutton == ( mysqli_num_rows( $resultat ) ) ) {

        echo "</table>";

        echo "<form action='legg-til.php' method='POST'>
                        <button type='submit' name='film' class='material-icons filmer-button add-button'>add</button>
                    </form>";

    }

}


echo "</table>";
?>