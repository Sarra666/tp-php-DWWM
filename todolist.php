<?php
include_once("dbConnexion.php");
session_start();

if ($_SESSION["autoriser"] != "oui") {
   header("Location:loging.php"); 
  
}
var_dump($_SESSION);


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre espace personnel</title>
    <link rel=stylesheet href="main.css">
</head>
<body id="accueil" >
    <header>
        <h1>Todolist & Playlist</h1>
        <nav>      
<?php
            if ($_SESSION["autoriser"] != "oui") {
?>              <a href="loging.php">Ma Todolist</a>
<?php       }
            else{
?>            <a href="session.php">Ma Todolist</a>
<?php 
            }
?>
            <a href="index.php"><img src="images/mosaique_sf2.png"></a>
            <a href="playlist.php">Ma playlist</a>
        </nav>
    </header>
    <main id='main' >
    

        <section>
<?php

            $sql = 'SELECT * FROM todolist WHERE id_user = \''.$_SESSION['id'].'\' ;';
            if (isset($pdo)) {
                $db_statement = $pdo->prepare($sql);
            }
            $db_statement = $pdo->query($sql);
            ini_set('display_errors','Off');
            $todolist = $db_statement->fetchAll(PDO::FETCH_ASSOC);
    
            
            foreach ($todolist as $valeur) {                                                                                 
                  
                    foreach($valeur as $cle => $val){ 
                        switch($cle){
                            case 'id_numero':
                                echo 'Titre '.$val.' : ';
                            break;
                            case 'titre':
                                echo $val.'<br>';
                            break;
                            case 'description':
                                echo 'Description : '. $val.'<br>';
                            break;
                        }
                        echo '<br>';
                    }             
                    
                
            
            }
            var_dump($todolist);
            ini_set('display_errors','On');
         /* while($row = $db_statement->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
              <td><?php echo htmlspecialchars($row['pseudo']); ?></td>
              <td><?php echo htmlspecialchars($row['passwd']); ?></td>
              
        
            </tr>
            <?php endwhile; */
?>      
        
        </section>
        <a href="deconnexion.php">Se déconnecter</a>
    </main>
    <footer></footer>
    
</body>
</html>
<?php

