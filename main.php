<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: Login.php");
}
if ($_SESSION["username"] != null && $_COOKIE["priviledge"] != null) {
    $username = $_SESSION["username"];
    $intro = "Benvenuto $username";
}

if (isset($_POST["logout"])) {
    session_destroy();
    header("location: Login.php");
}
?>

<style>
    html,
    body {
        text-align: center;
        font-size: 100%;
    }

    .sfondo {
        background: url('sfondo.jpg');
        background-repeat: no-repeat;
        background-position: 0 0;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        background-size: cover;
        color: antiquewhite;
        font-size: xx-large;
    }

    a,
    input {
        color: antiquewhite;
        font-size: xx-large;
        text-decoration: underline;
        background-color: transparent;
        border: none;
        font-family: serif;
    }
</style>

<!DOCTYPE html>

<head>
    <title>Magazzino WEB</title>
</head>

<body class="sfondo">
    <h1>IL MIO MAGAZZINO</h1>
    <label><?php echo ($intro); ?></label><br><br><br>
    <form method="POST" action="main.php">
        <a href="Registrazione.php">Nuova registrazione</a><br>
        <input type="submit" name="logout" value="Logout"><br>
        <a href="Magazzino.php">Magazzino</a>
    </form>
</body>