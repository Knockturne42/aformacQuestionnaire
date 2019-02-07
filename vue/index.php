<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>Document</title>
    </head>

    <body>
        
    </body>

</html>

    <div class="container">

        <h1 class="text-center">Se connecter </h1>

            <form method="POST" action="../controleur/login.php">

                <div class="form-group">

                    <label for="">Pseudo ou email</label>
                    <input type="text" name="userName" class="form-control" required />

                    <label for="">Mot de passe</label>
                    <input type="password" name="userPassword" class="form-control" required/><br>

                    <button type="submit" class="btn btn-primary">Se connecter</button><br>

                    <br><label for="">Retour <a href="index.php">Acceuil</a></label>
                   

            </form>