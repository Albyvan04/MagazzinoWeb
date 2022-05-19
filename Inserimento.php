<style>
    html, body {
        text-align: center;
        font-size: 100%;
        width: 100%;
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
    <title>Inserimento</title>
</head>
<body class="sfondo">
    <h1 style="color: aliceblue;">Form di inserimento prodotti</h1>    
    
    <div class="card mb-3" style="max-width: 800px;margin-top: 10%; margin-left: 30%; margin-right:30%; margin-bottom:10%">
        <div class="row g-0" style="align-items: center;">
          <div class="col-md-4">
            <img src="account.jpg" class="img-fluid rounded-start" style="height: 250px; width: 200px;">
          </div>
          <div class="col-md-8">
            <form>
                <br><br><label>Descrizione:</label><br>
                <input type="text" style="max-width: 400px; margin-left: 10%; margin-right:10%;" class="form-control" placeholder="Descrizione"  aria-describedby="addon-wrapping" name="descrizione"><br>
                <label>Prezzo:</label><br>
                <div class="input-group mb-3" style="margin-left: 10%; margin-right:10%;">
                    <span class="input-group-text" style=" max-width: 50px;" name="prezzo">€</span>
                    <input type="text" style="max-width: 370px;" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div><br>
                <div>
                    <label style="margin-left: -50%;">Quantità:</label><br>
                    <input type="number" name="quantità" value="5" min="0">
                    <input type="submit" style="background-color:cadetblue; margin-left: 10%;" class="btn btn-primary btn-lg" value="Inserisci" name="Inserisci">
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>