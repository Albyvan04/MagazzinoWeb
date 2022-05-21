<?php
$viewModale = "none";
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

    .modal {
        display: <?php echo ($viewModale); ?>;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
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
            <a class="navbar-brand"><img src="logo.jpg" style="height: 40px; width:80px;"></a>
            <form method="POST" action="Magazzino.php">
                <button type="submit" class="btn btn-outline-success" name="aggiungi" style="margin-left: -40%;">Aggiungi</button>

                <?php

                if (isset($_POST["aggiungi"])) {
                    setcookie("modalita", "INSERISCI");
                    header("location: Articolo.php");
                }
                ?>
            </form>

            <form class="d-flex" role="search" method="POST" action="Magazzino.php">
                <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search" style="width: 400px;" name="txtCerca">
                <button class="btn btn-outline-primary" type="submit" name="cerca">Cerca</button>

                <?php
                if (isset($_POST["cerca"])) {
                    ######
                }
                ?>
            </form>
        </div>

        <div id="modale" class="modal">
            <div class="modal-content">
                <span onclick="chiudi">&times;</span>
                <p>Selezione</p>
            </div>

        </div>

    </nav>
    <table class="table table-sm">
        <?php

        include "ORM.inc.php";
        include "Product.inc.php";
        $orm = new ORM("magazzino");
        try {
            $orm->OpenConn();
            $elementi = $orm->SelectProducts();
            $orm->CloseConn();
        } catch (Exception $ex) {
            echo ($ex);
        }

        $prodotti = [];
        for ($i = 0; $i < count($elementi); $i++) {
            array_push($prodotti, new Product($elementi[$i][0], $elementi[$i][1], $elementi[$i][2], $elementi[$i][3]));
        }

        //intercettazione modifica articolo
        for ($i = 0; $i < count($prodotti); $i++) {
            if (isset($_POST["modifica$i"])) {
                setcookie("descrizione", $prodotti[$i]->getDescription());
                setcookie("quantita", $prodotti[$i]->getQuantity());
                setcookie("prezzo", $prodotti[$i]->getPrice());
                setcookie("modalita", "MODIFICA");
                header("location: Articolo.php");
            }
        }

        //intercettazione elimina articolo
        for ($i = 0; $i < count($prodotti); $i++) {
            if (isset($_POST["elimina$i"])) {
                $viewModale = "block";
            }
        }

        //visualizzazione prodotti
        if (count($prodotti) == 0) {
            echo ("Non ci sono prodotti in magazzino");
        } else {
            for ($i = 0; $i < count($prodotti); $i += 3) {
                echo ("<TR>");
                for ($j = 0; $j < 3 && $j < count($prodotti) - $i; $j++) {
                    $index = $i + $j;
                    echo ("<td>
                    <div class='card' style='width: 18rem; margin-left:7%; display: inline-block;'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . $prodotti[$index]->getDescription() . "</h5>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'>Quantità: " . $prodotti[$index]->getQuantity() . "</li>
                                <li class='list-group-item'>Prezzo: " . $prodotti[$index]->getPrice() . "€</li>
                            </ul>
                            <form action='Magazzino.php' method='POST'>
                            <button type='submit' class='btn btn-success' name='modifica$index' style='margin-left: 10%;'>Modifica</button>
                            <button type='submit' class='btn btn-danger' name='elimina$index' style='width:50px; margin-left:10%;'>X</button>
                            </form>
                        </div>
                    </div></td>");
                }
                echo ("</TR>");
            }
        }

        ?>

    </table>
</body>

</html>