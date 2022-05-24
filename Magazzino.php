<?php
include "ORM.inc.php";
include "Product.inc.php";

session_start();
if (!isset($_SESSION["username"])) {
    header("location: Login.php");
}

switch ($_COOKIE["priviledge"]) {
    case 0:
        $visibility = "visible";
        break;
    case 1:
        $visibility = "hidden";
        break;
}

function ViewProdotti($prodotti, $numElementi)
{
    //visualizzazione prodotti
    if ($numElementi == 0) {
        echo ("<label>Non ci sono prodotti in magazzino con questi filtri</label>");
    } else {
        for ($i = 0; $i < $numElementi; $i += 3) {
            echo ("<TR>");
            for ($j = 0; $j < 3 && $j < $numElementi - $i; $j++) {
                $index = $i + $j;
                echo ("<td>
                <div class='card' style='width: 18rem; margin-left:10%; display: inline-block; margin-top:5%;'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $prodotti[$index]->getDescription() . "</h5>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>Quantità: " . $prodotti[$index]->getQuantity() . "</li>
                            <li class='list-group-item'>Prezzo: " . $prodotti[$index]->getPrice() . "€</li>
                        </ul><br>
                        <form action='Magazzino.php' method='POST'>
                        <button type='submit' class='btn btn-success' name='modifica$index' style='margin-left: 15%;' id='privilegi'>Modifica</button>
                        <button type='submit' class='btn btn-danger' name='elimina$index' style='width:50px; margin-left:10%;' id='privilegi'>X</button>
                        </form>
                    </div>
                </div></td>");
            }
            echo ("</TR>");
        }
    }
}
?>

<style>
    html,
    body {
        text-align: center;
        font-size: 100%;
        width: 100%;
        align-items: center;
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

    #privilegi {
        visibility: <?php echo ($visibility); ?>;
    }

    label {
        color: antiquewhite;
        font-size: xx-large;
    }

    img {
        height: 40px;
        width: 80px;
    }

    #Magazzino {
        background-color: transparent;
        border: none;
        color: antiquewhite;
        font-size: xx-large;
    }
</style>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Magazzino</title>
</head>

<body class="sfondo">
    <nav class="navbar sticky-top bg-ligh" style="background-color: darkgray;">
        <div class="container-fluid">
            <form method="POST" action="Magazzino.php">
                <a href="main.php" class="navbar-brand"><img src="logo.jpg"></a>
                <button type="submit" class="btn btn-outline-success" name="aggiungi" id="privilegi">Aggiungi</button>
                <?php
                if (isset($_POST["aggiungi"])) {
                    setcookie("modalita", "INSERISCI");
                    header("location: Articolo.php");
                }
                ?>
            </form>
            <form method="POST" action="Magazzino.php">
                <button type="submit" id="Magazzino" name="magazzino">MAGAZZINO</button>
                <?php
                if (isset($_POST["magazzino"])) {
                    setcookie("searched", "", time() - 3600);
                    setcookie("minPrice", "", time() - 3600);
                    setcookie("maxPrice", "", time() - 3600);
                    header("location: Magazzino.php");
                }
                ?>
            </form>
            <form class="d-flex" role="search" method="POST" action="Magazzino.php">
                <div>
                    <div class="input-group">
                        <input class="form-control me-2" style="margin-right: 0px !important;" type="search" placeholder="Cerca" aria-label="Search" style="width: 400px;" name="txtCerca">
                        <button type="submit" name="cerca" class="btn btn-primary">Ricerca</button>
                    </div><br>
                    <div class="input-group">
                        <input class="form-control me-2" style="margin-right: 0px !important;" type="search" placeholder="Prezzo min. (€)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46 || event.charCode == 0" min="0.0" max="999999" maxlength="6" aria-label="Search" style="width: 150px;" name="txtPrezzoMin">
                        <input class="form-control me-2" style="margin-right: 0px !important;" type="search" placeholder="Prezzo max. (€)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46 || event.charCode == 0" min="0.0" max="999999" maxlength="6" aria-label="Search" style="width: 150px;" name="txtPrezzoMax">
                    </div>
                </div>
            </form>
        </div>

    </nav>
    <table class="table table-sm" style="border:transparent; margin:auto; margin-top:2%">
        <?php

        $minPrice = 0.00;
        $maxPrice = 999999;
        $searched = "";

        if (isset($_COOKIE["searched"]) && $_COOKIE["searched"] != null) {
            $searched = $_COOKIE["searched"];
        }
        if ((isset($_POST["txtCerca"]) && $_POST["txtCerca"] != null)) {
            $searched = $_POST["txtCerca"];
            setcookie("searched", $searched);
        }

        if (isset($_COOKIE["minPrice"]) && $_COOKIE["minPrice"] != null) {
            $minPrice = $_COOKIE["minPrice"];
        }
        if (isset($_POST["txtPrezzoMin"]) && $_POST["txtPrezzoMin"] != null) {
            $minPrice = $_POST["txtPrezzoMin"];
            setcookie("minPrice", $minPrice);
        }

        if (isset($_COOKIE["maxPrice"]) && $_COOKIE["maxPrice"] != null) {
            $maxPrice = $_COOKIE["maxPrice"];
        }
        if (isset($_POST["txtPrezzoMax"]) && $_POST["txtPrezzoMax"] != null) {
            $maxPrice = $_POST["txtPrezzoMax"];
            setcookie("maxPrice", $maxPrice);
        }

        $orm = new ORM("magazzino");
        try {
            $orm->OpenConn();
            $elementi = $orm->SearchProduct($searched, $minPrice, $maxPrice);
            $orm->CloseConn();
        } catch (Exception $ex) {
            echo ($ex);
        }

        $numElementi = count($elementi);

        $prodotti = [];
        for ($i = 0; $i < $numElementi; $i++) {
            array_push($prodotti, new Product($elementi[$i][0], $elementi[$i][1], $elementi[$i][2], $elementi[$i][3]));
        }

        //intercettazione modifica articolo
        for ($i = 0; $i < $numElementi; $i++) {
            if (isset($_POST["modifica$i"])) {
                setcookie("id", $prodotti[$i]->getId());
                setcookie("descrizione", $prodotti[$i]->getDescription());
                setcookie("quantita", $prodotti[$i]->getQuantity());
                setcookie("prezzo", $prodotti[$i]->getPrice());
                setcookie("modalita", "MODIFICA");
                header("location: Articolo.php");
            }
        }

        //intercettazione elimina articolo
        for ($i = 0; $i < $numElementi; $i++) {
            if (isset($_POST["elimina$i"])) {
                $orm = new ORM("magazzino");
                try {
                    $orm->OpenConn();
                    $orm->DeleteProduct($prodotti[$i]);
                    $orm->CloseConn();
                    header("location: Magazzino.php");
                } catch (Exception $ex) {
                    echo ($ex);
                }
            }
        }

        ViewProdotti($prodotti, $numElementi);

        //print_r($_POST);

        ?>
    </table>
</body>

</html>

<?php
ob_end_flush();
?>