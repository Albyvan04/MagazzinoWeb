<style>
    html,
    body {
        text-align: center;
        font-size: 100%;
        width: 100%;
    }

    .testo:hover {
        border-style: double;
        height: 25px;
        width: 250px;
    }

    .testo {
        height: 20px;
        width: 200px;
        background-color: aliceblue;
    }

    .sfondo {
        background: url('sfondo.jpg');
        background-repeat: no-repeat;
        background-position: 0 0;
        -moz-background-size: cover;
        -webkit-background-size: cover;
        background-size: cover;
    }

    img {
        height: 250px;
        width: 200px;
    }
</style>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Registrazione</title>
</head>

<body class="sfondo">
    <h1 style="color: aliceblue;">Benvenuto nel form di registrazione</h1>

    <div class="card mb-3" style="max-width: 800px; margin:auto; margin-top:5%">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="account.jpg" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <form action="Registrazione.php" method="POST">
                    <br><label>Username:</label><br>
                    <input class="testo" type="text" name="username" id="username"><br>
                    <label>Password:</label><br>
                    <input class="testo" type="password" name="password" id="password"><br><br>
                    <p>Livello:<br>
                        <input type="radio" id="admin" name="livello" value="admin">
                        <label>Amministratore</label>
                        <input type="radio" id="user" name="livello" value="user" checked="true">
                        <label>Utente</label>
                    </p><br>
                    <label>Inserire la password amministratore:</label><br>
                    <input class="testo" type="password" name="pswadmin" id="pswadmin"><br><br><br>
                    <input type="submit" name="registrati" style="background-color:cadetblue;" class="btn btn-primary btn-lg" value="Registra"><br>
                    <?php

                    const ultraPass = "1234";

                    if (isset($_POST["registrati"])) {
                        if ($_POST["username"] == null || $_POST["password"] == null) {
                            echo ("Inserisci username e password!");
                            exit;
                        }

                        if ($_POST["pswadmin"] == null) {
                            echo ("Inserire la password Amministratore!");
                            exit;
                        }

                        $pswadmin = $_POST["pswadmin"];
                        if ($pswadmin != ultraPass) {
                            echo ("Password Admin errata!");
                        } else {
                            $username = $_POST["username"];
                            $password = $_POST["password"];
                            $priviledge = 1;

                            if ($_POST["livello"] == "admin") {
                                $priviledge = 0;
                            }

                            include 'ORM.inc.php';
                            include 'Account.inc.php';

                            $orm = new ORM("magazzino");
                            try {
                                $orm->OpenConn();
                                $result = $orm->CountUser($username);
                                if ($result != 0) {
                                    echo ("Utente già esistente!");
                                } else {
                                    $orm->CreateUser($username, $password, $priviledge);
                                    $result = $orm->SearchUser($username, $password)[0];
                                    $orm->CloseConn();
                                    $user = new Account($result[0], $result[1], $result[2], $result[3]);
                                    session_start();
                                    $_SESSION["id"] = $user->getId();
                                    $_SESSION["username"] = $username;
                                    $_SESSION["password"] = $password;
                                    setcookie("priviledge", $user->getPriviledge());
                                    header("location: main.php");
                                }
                            } catch (Exception $ex) {
                                echo ($ex);
                            }
                            $orm->CloseConn();
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>