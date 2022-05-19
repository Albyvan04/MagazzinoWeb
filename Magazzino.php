<style>
    html, body {
        text-align: center;
        font-size: 100%;
        width: 100%;
        align-items: center;
} 
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
    .sfondo{
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
        <button type="button" class="btn btn-outline-success" name="aggiungi" style="margin-left: -40%;">Aggiungi</button>
        <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search" style="width: 400px;" name="txtCerca">
        <button class="btn btn-outline-primary" type="submit" name="cerca">Cerca</button>
        </form>
    </div>
    </nav>
    <table class="table table-sm">
        <?php
            include("ORM.inc.php");
            $orm = new ORM("magazzino");
            try
            {
                $orm->OpenConn();
                $elementi = $orm->SelectProducts();
                $orm->CloseConn();
            }
            catch(Exception $ex)
            {
                echo($ex);
            }

            $numero = ($elementi->num_rows)/2;
            for($i = 0; $i < $numero; $i+=2)
            {
                echo ("<TR>");
                for($j = 0; $j < 2; $j++)
                {
                echo("<td>
                <div class='card' style='width: 18rem; margin-left:7%;display: inline-block;'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$elementi[$i+$j]->getDescription()."</h5>
                        <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>Quantità: ".$elementi[$i]->getQuantity()."</li>
                            <li class='list-group-item'>Prezzo: ".$elementi[$i]->getPrice()."€</li>
                        </ul>
                        <button type="button" class="btn btn-success" name="modifica" style="margin-left: 10%;">Modifica</button>
                        <button type="button" class="btn btn-danger" name="elimina" style="width:50px; margin-left:10%;">X</button>
                    </div>
                </div>
                echo("</td>");
                echo ("</TR>");
        ?>
    </table>
</body>
