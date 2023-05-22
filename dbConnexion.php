<?php
    
   /* try{
        // Chaîne de connexion à la BDD
        $dsn = 'mysql:host=localhost;dbname=tp_php';
        // Options de connexions : encodage utf8
        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
        // Création d'une instance de connexion à la BDD
        // et ouverture de celle-ci
        $pdo = new PDO($dsn , 'sarra' , 'jesc9caJ6yEl*9L',$options);

        //Choix de la méthode d'information en cas d'erreur
        // - levé d'exception on importe ATTR_ERRMODE de son parent PDO
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'Connexion effectuée avec le driver ' . $pdo ->getAttribute(PDO::ATTR_DRIVER_NAME).'<br>';
    }
    catch(PDOException){
        $msg = 'Impossible de se connecter à la base de données';
        die($msg);
    }
    /*catch(PDOException $e){
        $msg = 'ERREUR PDO dans '. $e-> getfile() . ' :<br>'. $e -> getLine() . ' : <br>'. $e -getMessage();
        die($msg);
    }*/

    // 3. Créer la connexion à la BDD, puis créer la BDD
/**
 * Création d'une instance PDO pour se connecter à la BDD stagiaires
 */

$dsn = "mysql:host=localhost;dbname=tp_php;charset=utf8";
$user = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (PDOException $e){
    echo "Impossible d'accéder à la base de données.</br>";
}