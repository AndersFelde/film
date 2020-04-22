<?php
if ( isset( $_SESSION[ "film" ] ) ) {

    $melding = $_SESSION[ "film" ];

    echo "<span class='melding'>$melding</span>";

    session_unset();

}
?>
<div class="mid">
    <h1>Legg til en film</h1>
    <form class="form" action="#" class="insert-form" method="post" enctype="multipart/form-data">

        <label>Hva er tittelen på filmen?</label><br>
        <input required type="text" name="tittel"><br>

        <label>Gi en kort beskrivelse på filmen</label><br>
        <textarea maxlength="300" required name="beskrivelse" cols="20" rows="4"></textarea><br>

        <label>Legg ved et bilde</label><br>
        <input type="file" accept=".png, .jpg, .jpeg" required name="bilde"><br>

        <button name="legg-til-film" type="submit">Legg til film</button>

    </form>
</div>