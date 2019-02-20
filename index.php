<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<div class="container">

    <h1 class="text-center">Se connecter en tant qu'utilisateur</h1>

        <form method="POST" action="controleur/loginUser.php">

            <div class="form-group">

                <label for="">Nom</label>
                <input type="text" name="userName" class="form-control" required />

                <button type="submit" class="btn btn-primary">Se connecter</button><br>
            </div>
        </form>
        

<div class="container">

    <h1 class="text-center">Se connecter en tant qu'Admin </h1>

        <form method="POST" action="controleur/loginAdmin.php">

            <div class="form-group">

                <label for="">Nom</label>
                <input type="text" name="userName" class="form-control" required />

                <label for="">Mot de passe</label>
                <input type="password" name="userPassword" class="form-control" required/><br>

                <button type="submit" class="btn btn-primary">Se connecter</button><br>

        </form>
<!-- <a href="vue/creationQuestionnaire.php">Creation de questionnaire</a> -->
