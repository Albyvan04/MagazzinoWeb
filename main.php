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

    html,body {
        text-align: center;
        font-size: 100%;
        width: 100%;
        align-items: center;
    }

    .sfondo {
        background: url('sfondo.jpg');
        background-repeat: no-repeat;
        background-position: 0 0;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        background-size: cover;
        color:antiquewhite;
        font-size:xx-large;
    }

    a{
        color:antiquewhite;
        font-size:xx-large;
    }
</style>

<!DOCTYPE html>

<head>
    <title>Magazzino WEB</title>
</head>

<body class="sfondo">
    <h1>IL MIO MAGAZZINO</h1>
    <label><?php echo ($intro); ?></label><br><br><br>
    <a href="Registrazione.php">Registrati</a><br>
    <a href="Login.php">Login</a><br>
    <a href="Magazzino.php">Magazzino</a>
</body>