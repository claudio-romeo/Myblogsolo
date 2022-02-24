<?php

require_once 'bdd.php';

// si on est bien connecté 
if (isset($_SESSION['id'])) {
    // Si l'utilisateur est connecté et qu'il a bien un id dans la bdd alors
    $requete = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");

    $requete->execute(array($_SESSION['id']));

    $user = $requete->fetch();

    if (isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $user['login']) 
    {
        // on sécurise nos variable 
        $newlog = htmlspecialchars(($_POST['newlogin']));

        $insert_log = $bdd->prepare("UPDATE utilisateurs SET login = ? Where id = ?");

        $insert_log->execute(array($newlog, $_SESSION['id']));

        header("location: edition.php?id=" . $_SESSION['id']);
            
        
           
    }

    if (isset($_POST['newmail']) && !empty($_POST['newmail']) && $_POST['newmail'] != $user['email']) 
    {
        // on sécurise nos variable 
       
        $newmail = htmlspecialchars($_POST['newmail']);

        $insert_mail = $bdd->prepare("UPDATE utilisateurs SET email = ? Where id = ?");

        $insert_mail->execute(array($newmail, $_SESSION['id']));

        header("location: edition.php?id=" . $_SESSION['id']);
            
    }

    if (isset($_POST['password']) && !empty($_POST['password'] != $user['password'])) 
    {
        // on sécurise nos variable 
        $password = htmlspecialchars($_POST['password']);

        $insert_pass = $bdd->prepare("SELECT utilisateurs SET password = ? Where id = ?");

        $insert_pass->execute(array($password, $_SESSION['id']));

        if (password_verify($password,$user['password'])) 
        {
           $_SESSION['login'] = $user['login'];

           $_SESSION['id'] = $user['id'];

           $_SESSION['password'] = $user['password'];

           $_SESSION['email'] = $user['email'];

           $_SESSION['id_droits'] = $user['id_droits'];

           header("location: edition.php?id=" . $_SESSION['id']);
        }

        else  $erreur = 'Vôtre login ou mot de pass est éronné !';

    }

    if (isset($_POST['pass1']) && isset($_POST['pass2'])) 
    {
        // on sécurise nos variable 
       
        $newpass1 = htmlspecialchars($_POST['pass1']);

        $newpass2 = htmlspecialchars($_POST['pass2']);

        if($newpass1 == $newpass2)
        {
            $insert_pass1 = $bdd->prepare("UPDATE utilisateurs SET password = ? Where id = ?");

            $insert_pass1->execute(array($newpass1, $_SESSION['id']));

         header("location: edition.php?id=" . $_SESSION['id']);
        }
        
        else  $erreur = 'Vos mot de passe ne correspondent pas !';
         
            
    }

?>

    <!DOCTYPE html>
    <html lang="Fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <?php
        // include("link.php"); 
        ?>

        <title>Profil</title>
    </head>

    <body>

        <?php include("header.php"); ?>

        <main class="text_profil">

            <h2>Profil de <?php echo $_SESSION['login'];?></h2>
            

          
            <form action="" method="POST" class="profil_tab">
                <table>

                    <input type="text" name="newlogin" placeholder="Modifier votre login" value="<?php echo $user['login']; ?>" /><br>
                    <input type="password" name="password" placeholder="Password" required /><br>
                    <input type="email" name="newmail" placeholder="Nouveau Email" value="<?php echo  $user['email']; ?>" /><br>
                    <input type="password" name="pass1" placeholder="Nouveau Password" /><br>
                    <input type="password" name="pass2" placeholder="verifier votre password" /><br>
                    <input type="submit" name="soumis" value=" Mettre vos informations a jour">

                    <?php
                    if (isset($erreur)) {
                        echo '<p style="color:red"> ' . $erreur . '</p>';
                    }

                    ?>
                </table>
            </form>

            <footer> <?php
                        include("footer.php"); ?></footer>


        </main>

    </body>

    </html>
<?php
} else {
    // si l'utilisateur n'est pas connecté alors on redirect vers la page de connexion .
    header('location: connexion.php');
}
?>