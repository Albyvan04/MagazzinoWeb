<?php
#setcookie("username", null);
#setcookie("priviledge", null);
$visibility = "hidden";
#print_r($_COOKIE);
if ($_COOKIE["username"] != null && $_COOKIE["priviledge"] != null) {
    $username = $_COOKIE["username"];
    $intro = "Benvenuto $username";
    if ($_COOKIE["priviledge"] == 0) {
        $visibility = "visible";
    }
}
?>

<style>
    label {
        visibility: <?php echo ($visibility); ?>;
    }
</style>

<!DOCTYPE html>

<head>
    <title>Magazzino WEB</title>
</head>

<body>
    <h1>IL MIO MAGAZZINO</h1>
    <label><?php echo ($intro); ?></label><br>
    <a href="Registrazione.php">Registrati</a>
    <a href="Login.php">Login</a>
</body>