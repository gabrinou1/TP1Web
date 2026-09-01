<?php require "Require/ex.header.php"; ?>
<body>
    <form method = "post"  action ="index.php">
        <label for="artistName">Nom de l artiste : </label><br>
        <input type = "text" id="artistName" name="artistName"><br>
        <label for="ville">Ville</label>
        <select class="form-select" aria-label="Default select example">
  <option selected>Québec</option>
  <option value="1">Toronto</option>
  <option value="2">Gatineau</option>
  <option value="3">Montreal</option>
</select>
        <label for="artistPicture"> Photo de l artiste : </label> <br>
         <input type="file" id="artistPicture" name="artistPicture"><br><br>
        <input type="submit">
</form>


</body>
<?php require "Require/ex.pied.php"; ?>
</html>