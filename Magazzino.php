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
                    header("location: Inserimento.php");
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

        if (count($prodotti) == 0) {
            echo ("Non ci sono prodotti in magazzino");
        } else {
            $numero = count($prodotti) / 3;
            for ($i = 0; $i < $numero; $i += 3) {
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
                            <button type='button' class='btn btn-success' name='modifica$index' style='margin-left: 10%;'>Modifica</button>
                            <button type='button' class='btn btn-danger' name='elimina$index' style='width:50px; margin-left:10%;'>X</button>
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