<?php

$file = $_FILES[ "bilde" ];

if ( empty( $file[ "name" ] ) == false ) {



    $bilde_name = $file[ "name" ];
    $bilde_tmp_name = $file[ "tmp_name" ];
    $bilde_size = $file[ "size" ];
    $bilde_error = $file[ "error" ];

    $bilde_ext = explode( '.', $bilde_name );

    $bilde_type = strtolower( end( $bilde_ext ) );

    $allowed = array( 'jpg', 'jpeg', 'png' );

    if ( $bilde_error === 0 ) {

        if ( in_array( $bilde_type, $allowed ) ) {

            if ( $bilde_size < 2000000 ) {

                $bilde_name_new = uniqid( '', true ) . "." . $bilde_type;

                $bilde_dest = 'bilder/' . $bilde_name_new;

                $film_endring_arr = explode( ',', $_POST[ "film-endring" ] );

                $film_id = $film_endring_arr[ "0" ];
                $tittel = $_POST[ "tittel" ];
                $beskrivelse = $_POST[ "beskrivelse" ];
                $old_bilde = $film_endring_arr[ "1" ];

                $sql = "UPDATE film 
                    SET
                    beskrivelse = '$beskrivelse',
                    tittel = '$tittel',
                    bilde_navn = '$bilde_name_new'
                    where film_id = '$film_id'";

                if ( ( ( $kobling->query( $sql ) ) && ( unlink( "bilder/$old_bilde" ) ) ) ) {

                    move_uploaded_file( $bilde_tmp_name, $bilde_dest );

                    $melding = "$tittel har oppdatert beskrivelse og bilde<br>";

                    $_SESSION[ "film-endret" ] = $melding;

                    echo "$melding";

                    echo "$sql";

                    header( "Location: filmer.php" );



                } else {
                    $error = ( strtolower( $kobling->error ) );

                    if ( strpos( $error, 'duplicate' ) !== false ) {

                        $melding = "Filmen '$tittel' finnes allerede<br>";

                        $_SESSION[ "film-endret" ] = $melding;

                        echo "$melding";

                        header( "Location: filmer.php" );

                    } elseif ( strpos( $error, 'long' ) !== false ) {

                        $melding = "Beskrivelsen er for lang<br>";

                        $_SESSION[ "film-endret" ] = $melding;

                        echo "$melding";

                        header( "Location: filmer.php" );


                    } else {
                        $melding = "$error";

                        $_SESSION[ "film-endret" ] = $melding;

                        echo "$melding";

                        header( "Location: filmer.php" );
                    }
                }
            } else {
                //size
                $melding = "ikke så store bilder da plz";

                $_SESSION[ "film-endret" ] = $melding;

                echo "$melding";

                header( "Location: filmer.php" );
            }





        } else {
            //filtype
            $melding = "Filtypen du har valgt er ikke lov, SLUTT";

            $_SESSION[ "film-endret" ] = $melding;

            echo "$melding";

            header( "Location: filmer.php" );
        }



    } else {
        //eror
        $melding = "Det er en error med bilde du har lastet opp";

        $_SESSION[ "film-endret" ] = $melding;

        echo "$melding";
        header( "Location: filmer.php" );
    }

} else {

    $film_endring_arr = explode( ',', $_POST[ "film-endring" ] );

    $film_id = $film_endring_arr[ "0" ];
    $old_bilde = $film_endring_arr[ "1" ];
    $tittel = $_POST[ "tittel" ];
    $beskrivelse = $_POST[ "beskrivelse" ];

    $sql = "UPDATE film 
            SET
            beskrivelse = '$beskrivelse',
            tittel = '$tittel'
            where film_id = '$film_id'";

    if ( $kobling->query( $sql ) ) {

        $melding = "$tittel har oppdatert beskrivelse<br>";

        $_SESSION[ "film-endret" ] = $melding;

        echo "$melding";

        echo "$sql";

        header( "Location: filmer.php" );

    } else {

        $error = ( strtolower( $kobling->error ) );

        if ( strpos( $error, 'duplicate' ) !== false ) {

            $melding = "Filmen '$tittel' finnes allerede<br>";

            $_SESSION[ "film-endret" ] = $melding;

            echo "$melding";

            header( "Location: filmer.php" );

        } elseif ( strpos( $error, 'data' ) !== false ) {

            $melding = "Beskrivelsen er for lang<br>";

            $_SESSION[ "film-endret" ] = $melding;

            echo "$melding";

            header( "Location: filmer.php" );


        } else {
            $melding = "$error";

            $_SESSION[ "film-endret" ] = $melding;

            echo "$melding";

            header( "Location: filmer.php" );
        }
    }
}


?>