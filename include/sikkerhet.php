<?php
$bad = ";<>?'" . '"';
$bad_regexp = "~[" . preg_quote($bad) . "]~";

echo "$bad<br>";

print_r($_POST);
echo "<br>";
print_r($_SESSION);
echo "<br>";

$post = implode( $_POST );
$session = implode( $_SESSION );

echo "$post(post)<br>";

echo "$session aa(session)<br>";

if ( ( preg_match( $bad_regexp, "$post" ) ) || ( preg_match( $bad_regexp, "$session" ) ) ) {
    echo "<h1>SLUTT MED DET DER</h1>";
} else {}
?>