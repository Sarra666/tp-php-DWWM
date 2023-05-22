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
            header('Location: register.php');
            exit();
            
        } else {
            //$message = "<span class='message'>Le login existe déja ! </span>";
            // $errors['doublon'] =  MYSQLI_CODE_DUPLICATE_KEY ;
           
            /*$sql = 'SELECT * FROM users 
            WHERE (pseudo = \''. $pseudo.'\' AND  '.password_verify( $passwd , "$2y$10\$dXGy8KvpHRyJkgEy0aKNwe179qRMQbyRytR2mhPhhvLxghGHgPhkK" ) .' = 1 );';*/
           
          
            //echo(password_verify($_POST['passwd'], '$2y$10$dXGy8KvpHRyJkgEy0aKNwe179qRMQbyRytR2mhPhhvLxghGHgPhkK)' ));
            //$db_statement = $pdo->query($sql);
            /*  $sql ="SELECT passwd FROM users WHERE id = 1 ;";
            $db_statement = $pdo->query($sql);*/
            
            $sql = 'SELECT * FROM users WHERE (pseudo = \''. $pseudo.'\')';
            $db_statement = $pdo->query($sql);
            session_start();
            $_SESSION = $db_statement->fetch(PDO::FETCH_ASSOC); // crée un tableau associatif $_SESSION['id'] $_SESSION['pseudo'] $_SESSION['passwd']
            var_dump($_SESSION);
            $_SESSION["autoriser"] = "non";
        
            if( password_verify( $passwd , $_SESSION['passwd']) == 1)  {
        
                $_SESSION["autoriser"] = "oui";
          
                header('Location:session.php');
        
            }
            else{
                echo('pseudo ou mot de passe incorrect !');
            }
          /* $sql = 'SELECT passwd FROM users WHERE '.password_verify( $passwd , "$2y$10\$dXGy8KvpHRyJkgEy0aKNwe179qRMQbyRytR2mhPhhvLxghGHgPhkK" ) .' = 1 );';/* ?>
            <tr>
            <td><?php echo htmlspecialchars($id); ?></td>
              <td><?php echo htmlspecialchars($row['pseudo']); ?></td>
              <td><?php echo htmlspecialchars($row['passwd']); ?></td>
              
        
            </tr>
            <?php */
          
         //  $sql = 'SELECT passwd FROM users WHERE (pseudo = \''. $pseudo.'\');';
          /* if (password_verify('pommes', '$2y$10$dXGy8KvpHRyJkgEy0aKNwe179qRMQbyRytR2mhPhhvLxghGHgPhkK' ) == 1){
            echo(0);
           }
           else{
            echo(1);
           }*/
        
           /*while($row = $db_statement->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['pseudo']); ?></td>
              <td><?php echo htmlspecialchars($row['passwd']); ?></td>
              
        
            </tr>
            <?php endwhile; */
        
            
           
        }
        
    
    } else {
        
        $message = "<span class='message'>Veuillez renseigner tous les champs! </span>";
       
    }
}

/* session_start();
@$login = $_POST["login"];
@$pass = $_POST["pass"];
@$valider = $_POST["valider"];
$bonLogin = "user";
$bonPass = "1234";
$erreur = "";
 {
    if ($login == $bonLogin && $pass == $bonPass) {
        $_SESSION["autoriser"] = "oui";
        echo($_SESSION["autoriser"]);
       // header("location:session.php");
    } else
        $erreur = "Mauvais login ou mot de passe!";
} */
?> 



<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/login.css" />
    <style>

    </style>
</head>

<body onLoad="document.fo.login.focus()">
<h1>Authentification</h1>
<div class="erreur">
    <?php
    
    // echo $erreur 
    ?></div>
<form name="fo" method="post" action="">
    <input type="text" name="login" placeholder="Login" /><br />
    <input type="password" name="pass" placeholder="Mot de passe" /><br />
    <input type="submit" name="valider" value="S'authentifier" />
</form>
</body>

</html> -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loguez-vous</title>
    <link rel=stylesheet href="main.css">
</head>
<body id="accueil" >
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
    <main >
    
        <h2>Loguez vous</h2>
        <section>
            <form action="#" method="POST">
                <label for="idPseudo">Pseudo: </label>
                <input type="text" name="pseudo" id="pseudo"><br>

                <label for="idMotDePasse">Mot de passe : </label>
                <input type="password" name="passwd" id="passwd" required><br>
                <!--<input type="password" name="passwd" id="passwd" required
                title="8 caractères minimum avec majuscule, minuscule et chiffre"
                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"><br>-->
        
                <input type="submit"  name="ok" value="Valider" onsubmit="effacer()">
            </form>
            <p>Pas encore de compte ?</p>
            <a href="register.php">Inscrivez-vous !</a>
        </section>
    </main>
    <footer></footer>
    <script src='main.js'></script>
</body>
</html>


