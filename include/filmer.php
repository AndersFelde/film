<?php
session_start();

if ( isset( $_POST[ "slett-film" ] ) ) {

    include 'slett-film.php';

} elseif ( isset( $_POST[ "endre-film" ] ) ) {

    include 'endre-film.php';

} elseif ( isset( $_POST[ "film-endring" ] ) ) {

    include 'film-endring.php';

} else {

    if ( isset( $_SESSION[ "film-endret" ] ) ) {
        $melding = $_SESSION[ "film-endret" ];

        echo "<span class='melding'>$melding</span>";

        session_unset();
    }

    $sql = "select * from film
        order by tittel";

    $resultat = $kobling->query( $sql );

    echo "<table class='filmer'>";


    if ( isset( $_POST[ "tittel" ] ) ) {


        $_tittel = $_POST[ "tittel" ];
        
        $addbutton = 0;

        while ( $rad = $resultat->fetch_assoc() ) {

            $tittel = $rad[ "tittel" ];
            $beskrivelse = $rad[ "beskrivelse" ];
            $bilde_navn = $rad[ "bilde_navn" ];
            $film_id = $rad[ "film_id" ];

            if ( $tittel == $_tittel ) {

                echo "<tr id='$tittel' class ='film-uthev'>";
                echo "<td><h1>$tittel</h1>$beskrivelse
                        <br>
                        <form action='visning.php#$tittel' method='POST'>
                        <button name='visninger-for-film' value='$film_id' class='filmer-button-visning'>Se visninger</button>
                        </form>
                        </td>";
                echo "<td><img src=bilder/" . "$bilde_navn></td>";
                echo "<td class='trash'>
                        <form action='#' method='POST'>
                        <button type='submit' value='$tittel' name='slett-film' class='material-icons filmer-button delete-button '>delete</button>   
                        <button type='submit' value='$film_id' name='endre-film' class='material-icons filmer-button edit-button'>edit</button>
                        </form>
                    </td>";
                echo "</tr>";
            } else {

                echo "<tr>";
                echo "<td><h1>$tittel</h1>$beskrivelse
                        <br>
                        <form action='visning.php#$tittel' method='POST'>
                        <button name='visninger-for-film' value='$film_id' class='filmer-button-visning'>Se visninger</button>
                        </form>
                        </td>";
                echo "<td><img src=bilder/" . "$bilde_navn></td>";
                echo "<td class='trash-film'>
                        <form action='#' method='POST'>
                        <button type='submit' value='$tittel' name='slett-film' class='material-icons filmer-button delete-button '>delete</button>   
                        <button type='submit' value='$film_id' name='endre-film' class='material-icons filmer-button edit-button'>edit</button>
                        </form>
                    </td>";
                echo "</tr>";

            }
            
            $addbutton++;

            if ( $addbutton == ( mysqli_num_rows( $resultat ) ) ) {

                echo "</table>";

                echo "<form action='legg-til.php' method='POST'>
                        <button type='submit' name='film' class='material-icons filmer-button add-button'>add</button>
                    </form>";

            }
        }


    } else {

        $addbutton = 0;
        
        

        while ( $rad = $resultat->fetch_assoc() ) {

            $tittel = $rad[ "tittel" ];
            $beskrivelse = $rad[ "beskrivelse" ];
            $bilde_navn = $rad[ "bilde_navn" ];
            $film_id = $rad[ "film_id" ];
            
            

            echo "<tr>";
        
            echo "<td>  <div class='film-info'>
                            <div class='tittel-beskrivelse'>
                            <h1>$tittel</h1>
                            <p>$beskrivelse</p>
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
                        <button type='submit' value='$tittel' name='slett-film' class='delete-button material-icons filmer-button '>delete</button>   
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
    }


}

?>