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
    <title>Login</title>
</head>
<body class="sfondo">
    <h1 style="color: aliceblue;">Benvenuto nel form di login</h1>    
    
    <div class="card mb-3" style="max-width: 600px; margin-top: 10%; margin-left: 30%; margin-right:30%; margin-bottom:10%">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="account.jpg" class="img-fluid rounded-start" style="height: 250px; width: 200px;">
          </div>
          <div class="col-md-8">
            <form>
                <br><label>Username:</label><br>
                <input class="testo" type="text" name="username" id="username"><br>
                <label>Password:</label><br>
                <input class="testo" type="password" name="password" id="password"><br><br><br><br>
                <input type="submit" style="background-color:cadetblue;" class="btn btn-primary btn-lg" value="Accedi">
            </form>
          </div>
        </div>
    </div>
</body>
</html>