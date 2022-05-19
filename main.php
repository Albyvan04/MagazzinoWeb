<?php 
    #setcookie("username", null);
    #setcookie("priviledge", null);
    $visibility = "hidden";
    #print_r($_COOKIE);
    if($_COOKIE["username"] != null && $_COOKIE["priviledge"] != null)
    {
        echo("Sono qui");
        $username = $_COOKIE["username"];
        $intro = "Benvenuto $username";
        if($_COOKIE["priviledge"] == 1) 
        {
            $visibility = "visible";
            echo("Visibile");
        }
    }
?>

<style>
    h2 {
        visibility: "<?php $visibility?>";
    }
</style>

<!DOCTYPE html>
<head>
    <title>Magazzino WEB</title>
</head>
<body>
    <h1>IL MIO MAGAZZINO</h1>
    <h2">$intro</h2>
    <a href="Registrazione.php">Registrati</a>
    <a href="Login.php">Login</a>
</body>