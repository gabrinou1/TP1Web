<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php require "Require/ex.header.php"; ?>

<body>
    <?php
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
    }


    ?>

    <?php if (isset($user)): ?>
        <h2><?= htmlspecialchars($user->name) ?></h2>
    <?php endif; ?>



</body>
<?php require "Require/ex.pied.php"; ?>

</html>