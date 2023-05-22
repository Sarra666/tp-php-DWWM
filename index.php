<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil php</title>
    <link rel=stylesheet href="main.css">
</head>
<body id="accueil">
    <?php 
        //include_once 'Db.php' ;
        include_once 'dbConnexion.php';
       

        /* Requête pour récupérer UN SEUL résultat selon l'identifiant
        $id = 1;
        $query = 'SELECT * FROM articles WHERE identifiant='.$id ;
        $arr = $pdo-> query($query)->fetch();
        var_dump($arr);
        echo 'Article : '. $arr['libelle'].' au prix de '. $arr[2] . '€/kg<br>';*/

        // Requête pour récupérer PLUSIEURS résultats selon le prix
        
       /* $query = 'SELECT * FROM todolist ;' ;
        $arrAll = $pdo->query($query)->fetchAll();
        //var_dump($arrAll);
        foreach($arrAll as $article){
            echo 'Titre : ' . $article[2]. '<br>Description :'. $article[3]. '<br>Date : '.$article[5].'<br><br>';
        }*/

        /*//version foreach
        foreach($arrAll as $article){
            echo 'Article : ' . $article['libelle']. ' au prix de'. $article[2]. '€/kg.<br>';
        }
        echo '<br>';

        //version for
        for($i=0; $i<count($arrAll); $i++){
            echo 'Artcle : '. $arrAll[$i][1]. ' au prix de '. $arrAll[$i][2].'€/kg.<br>';
        }

        //Exemple pour INSERT
        // INSERT INTO nomTABLE (col1, col2, colN) VALUES (val1, val2, valN)
        $id = 9;
        $libelle = 'Artichauts';
        $prix = 7.20;
        $query = 'INSERT INTO articles  (identifiant, libelle, prix) VALUES ('. $id .', \''. $libelle .'\','. $prix .');';
        //Cette fois on ne fait pas fetch() mais exec() + met compteur d'ajout de ligne
        $rowCount = $pdo -> exec($query);

        echo 'Nombre de lignes insérées : ' . $rowCount . '.<br>';

        //Exemple pour une mise à jour UPDATE - on s'est trompé de prix
        $libelle = 'Artichauts';
        // UPDATE nomTable SET nomCol = XXX WHERE libelle = monArticle;
        $query ='UPDATE articles SET prix = prix/3 WHERE libelle = \''. $libelle . '\';';
        //$query = '';
        $rowCount = $pdo -> exec($query);
        echo 'Nombre de lignes modifiées : ' . $rowCount . '.<br>';
        //Exemple pour DELETE
        // requete -> DELETE FROM nomTable WHERE prix > XXX;
        $prixMax = 2;
        $query = ' DELETE FROM articles WHERE prix > ' . $prixMax . ';';
        $rowCount = $pdo -> exec($query);
        echo 'Nombre de lignes supprimées : '. $rowCount . '.<br>';

        //Cette condition est toujours remplie
        $req = "SELECT count(*) FROM articles WHERE identifiant='' OR '1' = '1' ; 
                DROP TABLE articles ;
                -- and mdp=''"; 
                //marche pas (déjà sarra n'a pas les droits de DROP TABLE)


        $id = 1;
        $query = 'SELECT * FROM articles WHERE identifiant= ?;' ;
        $prep = $pdo -> prepare($query);
        // Associer des valeurs dans les "trous" le bindParam lie en tant que référence contrairemnt au bindValue
        $prep -> bindParam(1, $id);
        // Maintenant, je peux exécuter ma requête
        $prep -> execute();

        $arr = $prep -> fetch();
        var_dump($arr);
        echo 'Article : '. $arr[1].' au prix de '. $arr[2] . '€/kg<br>';

        
        /*Nous ferons maintenant des requêtes paramétrées nommées 
        (ou non nommées pour ceux qui préfèrent)
        paramétrées = sécurisées
        non paramétrées = pas de diplôme !!!*/

       /* $prixMax = 1.32;
        $query = 'SELECT * FROM articles WHERE prix < :prixMax;';
        $prep = $pdo -> prepare($query);
        $prep->bindParam(':prixMax', $prixMax);
        $prep -> execute();
        $arrAll = $prep->fetchAll();

        var_dump($arrAll);

        foreach($arrAll as $article){
            echo 'Article : ' . $article[1]. ' au prix de'. $article[2]. '€/kg.<br>';
        }

    ?>*/

        ?>
    <header>
        <h1>Todolist & Playlist</h1>
        <nav>
            <a href="loging.php">Ma Todolist</a>
            <a href="index.php"><img src="images/mosaique_sf2.png"></a>
            <a href="playlist.php">Ma playlist</a>
        </nav>
    </header>
    <main>
    
        <h2>Bienvenu(e)<br>sur<br>la Todolist</h2>
        <section id="principal">
            <a href="register.php">Créez un compte</a>
        </section>
    </main>
    <footer></footer>
</body>
</html>