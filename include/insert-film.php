<?php
$tittel = $_POST[ "tittel" ];
$beskrivelse = $_POST[ "beskrivelse" ];

$sql = "insert into film 
        (tittel, beskrivelse, bilde_navn) 
        VALUES 
        ('$tittel', '$beskrivelse', '$bilde_name_new')";

if ( $kobling->query( $sql ) ) {

    move_uploaded_file( $bilde_tmp_name, $bilde_dest );

    $melding = "$tittel har blitt lagt til som film<br>";

    $_SESSION[ "film" ] = $melding;

    header( "Location: legg-til.php" );

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
?>