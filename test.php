<?php
if(isset($_POST['submit'])){
    $values = $_POST['select'];
}
?>
<html>
<body>
<form action="" method="post">

    <select multiple name="select[]">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="opel">Opel</option>
        <option value="audi">Audi</option>
    </select>
    <input type="submit" name="submit">

</form>
</body>
</html>