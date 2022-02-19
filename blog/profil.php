<?php
require_once 'bdd.php';




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
    // include("link.php"); ?>

   <title>Profil</title>
 </head>

 <body>

   <?php include("header.php"); ?>

   <main class="text_profil">
     <P>
       <?php echo 'Bonjour et bienvenue ' . $_SESSION['login']. ' si vous désirez changer vos informations <a href="edition.php">Mon profil</a>';
        ?>
        <br>
        <br>
      
     </P>



   </main>
  
 </body>
 <footer> <?php
            include("footer.php"); ?></footer>
 </html>