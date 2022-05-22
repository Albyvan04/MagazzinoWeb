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

    <div class="card mb-3" style="max-width: 1000px;margin-top: 6%; margin-left: 30%; margin-right:30%; margin-bottom:10%">
        <div class="row g-0" style="align-items: center;">
            <div class="col-md-4">
                <img src="account.jpg" class="img-fluid rounded-start" style="height: 250px; width: 200px;">
            </div>
            <div class="col-md-8">
                <form method="POST" action="Articolo.php">
                    <br><br><label style="margin-left: 20%">Descrizione:</label><br>
                    <input type="text" style="max-width: 250px; margin-left: 20%; margin-right:10%;" class="form-control" placeholder="Descrizione" aria-describedby="addon-wrapping" name="descrizione" maxlength="20"><br>
                    <label style="margin-left: 20%">Prezzo:</label><br>
                    <div class="input-group mb-3" style="margin-left: 20%; margin-right:10%;">
                        <span class="input-group-text" style=" max-width: 50px;">€</span>
                        <input type="text" style="max-width: 220px;" name="prezzo" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 0" min="0,0" max="9999,00" maxlength="6" value="0,00">
                    </div><br>
                    <div>
                        <label style="margin-left: -40%;">Quantità:</label><br>
                        <input type="number" name="quantita" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0" min="0" value="1"><br><br>
                        <input type="submit" style="background-color:cadetblue; margin-left: 10%;" class="btn btn-primary btn-lg" value="Inserisci" name="inserisci"><br>

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