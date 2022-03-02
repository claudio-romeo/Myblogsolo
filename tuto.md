on verifie si le login a envoyer est egal a celui de la session 

si il est egal a celui de la session ca veut dire que l'utilisateur ne la pas modifier 

    donc a ce moment la on va recuperer les information depuis la base de données avec le login de la session

    verifier si le mdp actuel correspond a celui de la BD , a ce moment la 

    si il a mit un nouveau mot de pass on verifie que le nouveau mdp et sa confirmation correspondent 

        si il correspondent alors on envoi tout en BD 

    si il ne met pas de nouveau mdp on met seulement le mail et le login en update.

si l'utilisateur modifie son login 

    on verifie qu'il n'est pas en base donnée 
    si il n'y est pas 
        verifier si le mdp actuel correspond a celui de la BD , a ce moment la 

            si il a mit un nouveau mot de pass on verifie que le nouveau mdp et sa confirmation correspondent 

                si il correspondent alors on envoi tout en BD 

            si il ne met pas de nouveau mdp on met seulement le mail et le login en update.






                   // on sécurise nos variable 

        // $insert_pass = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");

        // $insert_pass->execute(array($_SESSION['id']));

        // $data = $insert_pass->fetch();

        // $row = $insert_pass->rowCount();

        // if ($row == 1)
        // {
        //     if (password_verify($password, $data['password'])) 
        //     {
        //         $_SESSION['login'] = $data['login'];

        //         $_SESSION['id'] = $data['id'];

        //         $_SESSION['password'] = $data['password'];

        //         $_SESSION['email'] = $data['email'];

        //         $_SESSION['id_droits'] = $data['id_droits'];

        //         header("location: edition.php?id=" . $_SESSION['id']);
        //     } 
        // }