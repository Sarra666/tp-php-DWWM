<?php

include_once("dbConnexion.php");

/**
 * Création de constante des erreurs possibles
 */

const ERROR_REQUIRED = 'Veuillez renseigner ce champ';
const ERROR_PASSWORD_NUMBER_OF_CHARACTERS = 'le mot de passe ne répond pas au nombre de caractère demandé';
//const MYSQLI_CODE_DUPLICATE_KEY = "ce pseudo est déjà attribué";

/**
 * Initialisation d'un tableau contenant les erreurs possibles lors des saisies
 */

$errors = [
    'pseudo' => '',
    'passwd' => '',
//    'doublon'=> ''
];
$message = '';

/**
 * Traitemet des données si la methode est bien POST
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'pseudo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'passwd' => FILTER_SANITIZE_FULL_SPECIAL_CHARS

    ]);
    /**
     * Initialisation des variables qui vont recevoir les datas des champs de formulaire
     */
    $pseudo = $_POST['pseudo'] ?? '';
    $passwd = $_POST['passwd'] ?? '';


    /**
     * Remplissage du tableau concernant les erreurs possibles
     */
    if (!$pseudo) {
        $errors['pseudo'] = ERROR_REQUIRED;
    }

    if (!$passwd) {
        $errors['passwd'] = ERROR_REQUIRED;
    } /*le mb_strlen() compte le nomre de caractères dans le mdp
    elseif (mb_strlen($passwd) < 10) {      
        $errors['passwd'] = ERROR_PASSWORD_NUMBER_OF_CHARACTERS;
    }*/
    /**
     * Execution de la requête INSERT INTO
     */
    if (($passwd) && ($pseudo)) {
        /**
         * On vérifie si le login existe dans la table
         */
        $sql = 'SELECT pseudo FROM users 
                WHERE pseudo = :pseudo ';
        if (isset($pdo)) {
            $db_statement = $pdo->prepare($sql);
        }
        $db_statement->execute(
            array(
                ':pseudo' => $pseudo
            )
        );

        /**
         * L'execution nous retourne une valeur, si <=0 alors on traite la requête
         */
        $nb = $db_statement->rowCount();
        if ($nb <= 0) {
            /**
             * On insert notre utilisateur
             */
            $rqt = 'INSERT INTO users VALUES (DEFAUlT,:pseudo,:passwd)';
            $db_statement = $pdo->prepare($rqt);
            $db_statement->execute(
                array(
                    ':pseudo' => $pseudo,
                    ':passwd' => password_hash($passwd, PASSWORD_DEFAULT)
                )
            );
            $message = "<span class='message'>Votre compte a bien été créé ! </span>";
            ?> <!--<script>alert('compte créé!');</script>--> <?php
            header("Location: loging.php");
            
        } else {
            $message = "<span class='message'>Le login existe déja ! </span>";
           // $errors['doublon'] =  MYSQLI_CODE_DUPLICATE_KEY ;
            
        }
    } else {
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loguez-vous</title>
    <link rel=stylesheet href="main.css">
</head>
<body id="accueil">
    <header>
        <h1>Todolist & Playlist</h1>
        <nav>
    
<?php
            ini_set('display_errors','Off');
            if ($_SESSION["autoriser"] != "oui") {
?>              <a href="loging.php">Ma Todolist</a>
<?php       
            }
            else{
?>              <a href="session.php">Ma Todolist</a>
<?php 
            }
            ini_set('display_errors','On');
?>
            <a href="index.php"><img src="images/mosaique_sf2.png"></a>
            <a href="playlist.php">Ma playlist</a>
        </nav>
    </header>
    <main>
    
        <h2>Créez un compte</h2>
        <section>
            <form action="" method="POST">
                <label for="idPseudo">Pseudo: </label>
                <input type="text" name="pseudo" id="pseudo"><br>

                <label for="idMotDePasse">Mot de passe : </label>
                <input type="password" name="passwd" id="passwd" required
                title="8 caractères minimum avec majuscule, minuscule et chiffre"><br>

        <!--  <input type="password" name="passwd" id="passwd" required
                title="8 caractères minimum avec majuscule, minuscule et chiffre"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br> -->
        
                <input type="submit" name="ok" value="Valider">
            </form>
           
        </section>
    </main>
    <footer></footer>
</body>
</html>