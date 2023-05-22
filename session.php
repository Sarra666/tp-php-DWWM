<?php
//include_once("dbConnexion.php");
include_once("loging.php");
session_start();
if ($_SESSION["autoriser"] != "oui") {
   header("Location:login.php"); 
  
}
if (date("H") < 18){
    $bienvenue = "Bonjour et bienvenue dans votre espace personnel";
}
else{
    $bienvenue = "Bonsoir et bienvenue dans votre espace personnel";}
?>

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
    
            
            <a href="loging.php">Ma Todolist</a>
            <a href="index.php"><img src="images/mosaique_sf2.png"></a>
            <a href="playlist.php">Ma playlist</a>
        </nav>
    </header>
    <main id='main' >
    
        <h2><?= $bienvenue,' ',  $_SESSION['pseudo'];?></h2>
        <section>
         
        </section>
    </main>
    <footer></footer>
    <script src='main.js'></script>
</body>
</html>