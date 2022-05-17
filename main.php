<?php 
    setcookie("username", null, time()+3600);
    setcookie("priviledge", null, time()+3600);
    $visibility = "hidden";

    if($_COOKIE["username"] != "" && $_COOKIE["priviledge"] != "")
    {
        $username = $_COOKIE["username"];
        $intro = "Benvenuto $username";
        if($priviledge == 0) 
        {
            $visibility = "visible";
        }
    }
?>

<style>
    h2 {
        visibility: <?php $visibility ?>;
    }
</style>

<!DOCTYPE html>
<head>
    <title>Magazzino WEB</title>
</head>
<body>
    <h1>IL MIO MAGAZZINO</h1>
    <h2 value=<?php $intro?>></h2>
    <a href="Registrazione.php">Registrati</a>
    <a href="Login.php">Login</a>
</body>