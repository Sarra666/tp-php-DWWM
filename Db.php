<?php

namespace App\Core;

//use PDO;
//use PDOException;

class Db extends PDO
{
    // On stock l'instance de la connexion en BDD
    private static ?Db $instance = null;

    // On stock dans des constantes les informations de connexion en BDD
    private const DBHOST = 'mvc_debut_exo-db-1';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'demo_mvc_2023';

    public function __construct()
    {
        // DSN de connexion en BDD
        $dsn = 'mysql:dbname=' .  self::DBNAME . ';host=' . self::DBHOST;

        // On appelle le constructeur de la classe PDO
        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Récupère ou créée une instance de Db (INSTANCE UNIQUE)
     *
     * @return self
     */
    public static function getInstance(): self
    {
        // On vérifie que la propriété instance est null
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}