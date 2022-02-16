<?php
require_once 'bdd.php';
include('header.php');


// on commence par verifier si les input existe
if(isset($_POST['login']) && isset($_POST['password']))
{
    // ensuite on stock dans des html specialchars pour eviter les fails xss
    $email = htmlspecialchars($_POST['email']);
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    // ensuite on check si l'utilisateur exist en BDD 

    $check = $bdd->prepare('SELECT login, password, email FROM utilisateurs WHERE login = ?');
    $check->execute(array($login));
    $data = $check->fetch();
    $row = $check->rowCount();

    if($row == 1)
    {
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $password = hash('sha256', $password);

                if($data['password'] === $password)
                {
                    $_SESSION['login'] = $data['login'];
                    $_SESSION['id'] = $tableau['id'];
                    $_SESSION['login'] = $tableau['login'];
                    $_SESSION['password'] = $tableau['password'];


                }else header('location:index.php?login_err=password');
            }else header('location:index.php?login_err=email');
    }else header('location:index.php?login_err=already');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body>
    <div class="login_form">
        <form action="connexion.php" method="post">
        <h2 class="text_center">Connexion</h2>
        <div class="form_groupe">
            <input type="login" name="login" class="form_control" placeholder="Login" required="required" autocomplete="off">
        </div>
        <div class="form_groupe">
            <input type="password" name="password" class="form_control" placeholder="Mot de passe" required="required" autocomplete="off">
        </div>
        <div class="form_group">
            <button type="submit" class="">Connexion</button>
        </div>
    </form>
    <p class="text_center"><a href="inscription.php">Inscription</a></p>
    </div>
</body>
</html>