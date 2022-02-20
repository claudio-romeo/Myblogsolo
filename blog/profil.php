<?php
require_once 'bdd.php';

// si on est bien connecté 
if (isset($_SESSION['login']))
{
 // on met le login dans une variable 
  $log_enter = $_SESSION['login'];

  if(isset($_SESSION['email']))
  {
    $newmail = $_SESSION['email'];
  }

}
  else 
    {
        header('location: index.php');
    }
    

if(isset($_POST['soumis']))
//si le formulaire est soumis alors on verifie qu'il y a une demande de changement  
{
  if($_POST['password'] == $_POST['pass2'])
  {
    $newlog = htmlspecialchars(($_POST['newlogin']));
    $newpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $newmail = htmlspecialchars($_POST['email']);

    $request = $bdd->prepare("SELECT COUNT (*) FROM `utilisateurs` WHERE login= '$newlog'");
    $request->execute(array($newlog));
    $result = $request->fetch();
    $count = $request->rowCount();
    var_dump($request);
    var_dump($count);
    var_dump($_SESSION);
    if($count == 1 && $_POST['newlogin'] !=$log_enter)
    {
      echo $erreur = 'login non disponible !';
    } 
    // Si il apres soumission du formulaire il y a une demande de modification alors -->
    else {        
      $req_insert = $bdd->prepare("UPDATE `utilisateurs` SET `login`=\'$newlog\',`password`=\'$newpass\',`email`=\'$newmail\',`id_droits`=\'1\' WHERE $log_enter;");
      $req_insert->execute(array($newlog,$newpass,$newmail));
      $result_insert = $req_insert->fetch();

      $_SESSION['login']=$newlog ;
      $_SESSION['password']=$newpass;
      $_SESSION['email']=$newmail;
      var_dump($_SESSION);

      // echo "UPDATE `utilisateurs` SET `login`= '$newlog',`password`= '$newpass', `email`= '$newmail'  where login = '$login_entree'";

      header('location: profil.php?id='.$_SESSION['id']);
    }
  }
  
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
    <P>
      <?php echo 'Bonjour et bienvenue ' . $_SESSION['login'] . ' si vous désirez changer vos informations
      </br> ' . $_SESSION['email'] . '';
      
      ?>
      <br>
      <br>

    </P>

    <h2>Profil de <?php

                  echo $_SESSION['login']; ?></h2>

    <form action="" method="POST" class="profil_tab">
      <table>

        <input type="text" name="newlogin" placeholder="Modifier votre login" value="<?php echo $log_enter; ?>" /><br>


        <input type="password" name="password" placeholder="Nouveau Password" /><br>
        <input type="password" name="pass2" placeholder="verifier votre password" /><br>
        <input type="email" name="email" placeholder="Nouveau Email" /><br>
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