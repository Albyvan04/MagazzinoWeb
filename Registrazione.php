<style>
    html, body {
        text-align: center;
        font-size: 100%;
        width: 100%;
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
    <title>Registrazione</title>
</head>
<body class="sfondo">
    <h1 style="color: aliceblue;">Benvenuto nel form di registrazione</h1>    
    
    <div class="card mb-3" style="max-width: 600px; margin-top: 100px; margin-left: 375px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="account.jpg" class="img-fluid rounded-start" style="height: 250px; width: 200px;">
          </div>
          <div class="col-md-8">
            <form>
                <label>Username:</label><br>
                <input class="testo" type="text" name="username" id="username"><br>
                <label>Password:</label><br>
                <input class="testo" type="password" name="password" id="password"><br>
                <p>Livello:</p>
                <input type="radio" id="admin" name="livello" value="admin">
                <label>Amministratore</label>
                <input type="radio" id="user" name="livello" value="user" checked="True">
                <label>Utente</label><br><br><br>
                <label>Inserire la password amministratore:</label><br>
                <input class="testo" type="password" name="pswadmin" id="pswadmin"><br><br><br>
                <input type="submit" style="background-color:cadetblue;" class="btn btn-primary btn-lg" value="Registra">
            </form>
          </div>
        </div>
    </div>
</body>
</html>