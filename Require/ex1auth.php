<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require "ex.header.php"; ?>
<?php require "ex1def.php"; ?>
<body>
    <fieldset class="form-group border col-sm-6 p-4" >
  <form action="ex1auth.php" method="post">
    <div class="form-group row">
      <label for="inputUser" class="col-sm-3 col-form-label">nom</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="inputUser" placeholder="courriel" name="inputUser" requiered>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-3 col-form-label">Mot de passe</label>
      <div class="col-sm-9">
        <input type="password" class="form-control" id="inputPassword3" placeholder="mot de passe" name="passw">
      </div>
    </div>
    
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Me connecter</button>
      </div>
    </div>
  </form>
  </fieldset> 

</div>
    
</body>

<?php require "ex.pied.php"; ?>
</html>