<form action="#" class="form" method="post" enctype="multipart/form-data">
    <label>Hva er tittelen på filmen?</label>
    <input required type="text" name="tittel"></input>
    <br>
    <label>Gi en kort beskrivelse på filmen</label>
    <textarea maxlength="200" required name="beskrivelse" cols="20" rows="4"></textarea>
    <br>
    <label>Legg ved et bilde</label>
    <input type="file" required name="bilde"></input>
    <br>
    <button name="legg-til-film-visning" type="submit">Legg til film</button>
</form>
