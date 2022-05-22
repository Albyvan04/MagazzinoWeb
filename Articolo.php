<?php
switch ($_COOKIE["modalita"]) {
    case "INSERISCI":
        $titolo = "Inserimento prodotto";
        $nomeForm = "Inserimento nuovo prodotto";
        $descrizione = "";
        $quantita = 0;
        $prezzo = 0.00;
        $nomeBtn = "Inserisci";
        break;

    case "MODIFICA":
        $titolo = "Modifica prodotto";
        $nomeForm = "Modifica prodotto: " . $_COOKIE["descrizione"];
        $descrizione = $_COOKIE["descrizione"];
        $quantita = $_COOKIE["quantita"];
        $prezzo = $_COOKIE["prezzo"];
        $nomeBtn = "Modifica";
        break;
}
?>

<style>
    html,
    body {
        text-align: center;
        font-size: 100%;
        width: 100%;
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
    <title><?php echo ($titolo); ?></title>
</head>

<body class="sfondo">
    <h1 style="color: aliceblue;"><?php echo ($nomeForm); ?></h1>

    <div class="card mb-3" style="max-width: 800; margin:auto; margin-top: 5%;">
        <div class="row g-0" style="align-items: center;">
            <div class="col-md-4">
                <img src="account.jpg" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8">
                <form method="POST" action="Articolo.php">
                    <br><br><label>Descrizione:</label><br>
                    <input type="text" class="form-control" placeholder="Descrizione" aria-describedby="addon-wrapping" name="descrizione" maxlength="20" style="width:250px; margin:auto;" value=<?php echo ($descrizione); ?>><br>
                    <label>Prezzo:</label><br>
                    <div class="input-group mb-3" style="margin: auto;">
                        <span class="input-group-text" style="margin-left: auto;">€</span>
                        <input type="text" name="prezzo" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46 || event.charCode == 0" min="0.0" max="9999.00" maxlength="6" value="<?php echo ($prezzo); ?>" style="max-width:220; margin-top:auto; margin-right:auto; margin-bottom:auto">
                    </div><br>
                    <div>
                        <label style="margin-left: -40%;">Quantità:</label><br>
                        <input type="number" name="quantita" value="<?php echo ($quantita); ?>" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0" min="0" value="1"><br><br>
                        <input type="submit" style="background-color:cadetblue" class="btn btn-primary btn-lg" value="<?php echo ($nomeBtn); ?>" name="<?php echo ($nomeBtn); ?>"><br>

                        <?php
                        if (isset($_POST["Inserisci"]) || isset($_POST["Modifica"])) {
                            if ($_POST["descrizione"] != null) {
                                if ($_POST["quantita"] != null) {
                                    if ($_POST["prezzo"] != null) {

                                        $modalita = $_COOKIE["modalita"];

                                        include "ORM.inc.php";
                                        include "Product.inc.php";
                                        $descrizione = $_POST["descrizione"];
                                        $quantita = $_POST["quantita"];
                                        $prezzo = $_POST["prezzo"];
                                        $id = $_COOKIE["id"];

                                        if ($modalita == "INSERISCI") {
                                            $prodotto = new Product(-1, $descrizione, $quantita, $prezzo);
                                        } else if ($modalita == "MODIFICA") {
                                            $prodotto = new Product($id, $descrizione, $quantita, $prezzo);
                                        }

                                        $orm = new ORM("magazzino");
                                        try {
                                            $orm->OpenConn();
                                            if ($modalita == "INSERISCI") {
                                                $elementi = $orm->CreateProduct($prodotto);
                                            } else if ($modalita == "MODIFICA") {
                                                $orm->UpdateProduct($prodotto);
                                                echo ("<script>alert('Modifica avvenuta con successo!')</script>");
                                            }
                                            $orm->CloseConn();
                                            header("location: Magazzino.php");
                                        } catch (Exception $ex) {
                                            echo ($ex);
                                        }
                                    } else {
                                        echo ("Inserire il prezzo!");
                                    }
                                } else {
                                    echo ("Inserire la quantitá!");
                                }
                            } else {
                                echo ("Inserire la descrizione!");
                            }
                        }
                        ?>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>