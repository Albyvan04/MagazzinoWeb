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
    <title>Login</title>
</head>

<body class="sfondo">
    <h1 style="color: aliceblue;">Benvenuto nel form di login</h1>

    <div class="card mb-3" style="max-width: 600px; margin:auto; margin-top:10%;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="account.jpg" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <form method="POST" action="Login.php">
                    <br><label>Username:</label><br>
                    <input class="testo" type="text" name="username" id="username"><br><br>
                    <label>Password:</label><br>
                    <input class="testo" type="password" name="password" id="password"><br><br><br><br>
                    <input type="submit" style="background-color:cadetblue;" class="btn btn-primary btn-lg" name="loggati" value="Accedi"><br>
                    <br><a href="Registrazione.php">Non hai ancora creato il tuo account? Clicca qui</a><br>
                    <?php
                    if (isset($_POST["loggati"])) {

                        if ($_POST["username"] == null || $_POST["password"] == null) {
                            echo ("Inserisci username e password!");
                            exit;
                        }

                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        include 'ORM.inc.php';
                        include 'Account.inc.php';
                        $orm = new ORM("magazzino");
                        try {
                            $orm->OpenConn();
                            $result = $orm->SearchUser($username, $password);
                            if (count($result) == 0) {
                                echo ("Username e/o password errati!");
                            } else {
                                $user = new Account($result[0][0], $result[0][1], $result[0][2], $result[0][3]);
                                session_start();
                                $_SESSION["id"] = $user->getId();
                                $_SESSION["username"] = $username;
                                $_SESSION["password"] = $password;
                                //$_SESSION["priviledge"] = $user->getPriviledge();
                                //setcookie("id", $user->getId());
                                //setcookie("username", $user->getUsername());
                                //setcookie("password", $user->getPassword());
                                setcookie("priviledge", $user->getPriviledge());
                                header("location: main.php");
                            }
                        } catch (Exception $ex) {
                            echo ($ex);
                        }
                        $orm->CloseConn();
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>