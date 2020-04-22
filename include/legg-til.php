<?php

session_start();


if ( ( isset( $_POST[ "visning" ] ) ) || ( isset( $_SESSION[ "visning" ] ) ) ) {
    //legge til en visning skjema

    include 'legg-til-visning-form.php';


} elseif ( ( isset( $_POST[ "film" ] ) ) || ( isset( $_SESSION[ "film" ] ) ) ) {
    //legge til en film skjema

    include 'legg-til-film-form.php';

} elseif ( isset( $_POST[ "legg-til-film" ] ) ) {
    //har lagt til en film i skjema

    include 'lagre-bilde.php';

} elseif ( isset( $_POST[ "legg-til-visning" ] ) ) {
    //har lagt til en visning i skjema

    $film = $_POST[ "film_id" ];

    if ( $film == 'film' ) {
        //sjekker om "ny film" er valgt

        include 'legg-til-film-visning.php';

    } else {
        //en film er valgt

        include 'legg-til-visning.php';
    }

} elseif ( isset( $_POST[ "legg-til-film-visning" ] ) ) {
    //når man har valgt film og visning


    include 'lagre-bilde.php';

    include 'legg-til-visning.php';


} else {
    //når man trykker på legg til og skal velge legg til film eller visning

    include 'valg-form.php';
}



?>