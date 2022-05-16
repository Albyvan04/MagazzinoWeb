<style>
    html, body {
        text-align: center;
        font-size: 100%;
        width: 100%;
        background-color: aquamarine;} 
    .testo:hover{
        border-style: double;
        height: 25px;
        width: 250px;
    }
    .testo{
        height: 20px;
        width: 200px;
        background-color: aliceblue;
    }
    .card {
        border-style: solid;
	    padding: 50px 0;
        height: auto;
        width: auto;
	    text-align: center;
	    -webkit-perspective: 800px;
	    -moz-perspective: 800px;
	    -o-perspective: 800px;
	    -ms-perspective: 800px;
	    perspective: 800px;
    }
</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body class="card">
    <h1>Benvenuto nel form di registrazione</h1>    
    
    <form action="Registrazione.php" method="POST">
        <label>Username:</label><br>
        <input class="testo" type="text" name="username" id="username"><br>
        <label>Password:</label><br>
        <input class="testo" type="password" name="password" id="password"><br>
        <p>Livello:</p>
        <input type="radio" id="admin" name="livello" value="admin">
        <label>Amministratore</label>
        <input type="radio" id="user" name="livello" value="user" checked>
        <label>Utente</label><br><br><br>
        <label>Inserire la password amministratore:</label><br>
        <input class="testo" type="password" name="pswadmin" id="pswadmin"><br><br><br>
        <input type="submit" value="Registra" name="registrati">
        <?php

        const ultraPass = "1234";

        if(!isset($_POST["username"]) || !isset($_POST["password"]))
        {
            echo("Inserisci username e password!");
        }

        if(!isset($_POST["pswadmin"]))
        {
            echo("Inserire la password Amministratore!");
        }

        if(isset($_POST["registrati"]))
        {
            
            $pswadmin = $_POST["pswadmin"];
            if($pswadmin != ultraPass)
            {
                echo("Password Admin errata!");
            }
            else
            {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $priviledge = 1;

                if($_POST["livello"] == "admin")
                {
                    $priviledge = 0;
                }

                include 'ORM.inc.php';
                $orm = new ORM("login_5f");
                try
                {
                    $orm->OpenConn();
                    if(count($orm->SearchUser($username, $password)) != 0)
                    {
                        echo("Utente già esistente!");
                    }
                    else
                    {
                        $orm->CreateUser($username, $password, $priviledge);
                        $orm->CloseConn();
                        $_COOKIE["username"] = $username;
                        $_COOKIE["priviledge"] = $priviledge;
                        header("location: main.php");
                    }
                }
                catch(Exception $ex)
                {
                    echo($ex);
                }
                $orm->CloseConn();
            }
        }
        ?>
    </form>
</body>
</html>