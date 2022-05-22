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

    img{
        height: 250px;
        width: 200px;
    }
</style>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Inserimento</title>
</head>

<body class="sfondo">
    <h1 style="color: aliceblue;">Form di inserimento prodotti</h1>

    <div class="card mb-3" style="max-width: 800; margin:auto; margin-top: 5%;">
        <div class="row g-0" style="align-items: center;">
            <div class="col-md-4">
                <img src="account.jpg" class="img-fluid rounded-start">
            </div>
            <div class="col-md-8" >
                <form method="POST" action="Inserimento.php">
                    <br><br><label>Descrizione:</label><br>
                    <input type="text" class="form-control" placeholder="Descrizione" aria-describedby="addon-wrapping" name="descrizione" maxlength="20" style="width:250px; margin:auto;"><br>
                    <label>Prezzo:</label><br>
                    <div class="input-group mb-3" style="margin: auto;">
                        <span class="input-group-text" style="margin-left: auto;">€</span>
                        <input type="text" name="prezzo" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 0" min="0,0" max="9999,00" maxlength="6" value="0,00"  style="max-width:220; margin-top:auto; margin-right:auto; margin-bottom:auto">
                    </div><br>
                    <div>
                        <label>Quantità:</label><br>
                        <input type="number" name="quantita" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0" min="0" value="1"><br><br>
                        <input type="submit" style="background-color:cadetblue;" class="btn btn-primary btn-lg" value="Inserisci" name="inserisci"><br>

                        <?php
                        if (isset($_POST["inserisci"])) {
                            if ($_POST["descrizione"] != null) {
                                if ($_POST["quantita"] != null) {
                                    if ($_POST["prezzo"] != null) {

                                        include "ORM.inc.php";
                                        include "Product.inc.php";
                                        $descrizione = $_POST["descrizione"];
                                        $quantita = $_POST["quantita"];
                                        $prezzo = $_POST["prezzo"];
                                        $prodotto = new Product(-1, $descrizione, $quantita, $prezzo);
                                        $orm = new ORM("magazzino");
                                        try {
                                            $orm->OpenConn();
                                            $elementi = $orm->CreateProduct($prodotto->getDescription(), $prodotto->getQuantity(), $prodotto->getPrice());
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