<?php

/**
 * Fichier de la classe utilitaire PDOTools.
 * 
 * @author      Rodolphe Terry <rodolphe.terry@afpa.fr>
 * @version     v.1.0 (01/03/2021)
 * @copyright   Copyright (c) 2021, Terry
 */


/**
 * Classe utilitaire PDO
 *
 * Encapsule la connexion à la base de données MySQL
 * 
 * @see https://www.php.net/manual/fr/book.pdo.php
 */
class PDOTools
{
    /**
     * Nom du serveur MySQL ou adresse IP
     *
     * @var string
     */
    private const HOST = 'localhost';

    /**
     * Nom de la base de données MySQL
     *
     * @var string
     */
    private const DB = 'courses';

    /**
     * Utilisateur de connexion à la base de données MySQL
     *
     * @var string
     */
    private const USER = 'userBasic';

    /**
     * Mot de passe de connexion à la base de données MySQL
     *
     * @var string
     */
    private const PWD = 'ginger';

    /**
     * Connexion unique PDO
     *
     * @var PDO
     */
    static private $connection;

    /**
     * Execute une requête préparée SQL
     *
     * @param string $prepared_sql Motif de la requête préparée avec paramètres anonymes
     *  Exemple "SELECT * FROM ma_table WHERE id = ? AND nom = ?"
     * @param array $paramters_array Tableau de valeurs correspondantes aux paramètres
     *  Exemple
     * [
     *  13,
     *  'Toto'
     * ]
     * @param bool $select_query True si la requête est de type SELECT, false sinon
     *
     * @return array|null Tableau associatif de colonnes du jeu de résultats
     *  Exemple
     * [
     *  [
     *   'id' => 13,
     *   'nom'=> 'Toto',
     *   'taille' => 56
     *  ],
     *  [
     *   'id' => 9,
     *  'nom'=> 'Titi',
     *  'taille' => 52
     *  ]
     * ]
     */
    static public function query($prepared_sql, $parameters_array, $select_query)
    {
        $result_set = null;

        // On récupère la connexion
        $conn = self::getConnection();

        try {
            // Preparation de la requête SQL
            $pdo_statement = $conn->prepare($prepared_sql);

            // Liage aux paramètres
            for ($i = 0; $i < count($parameters_array); $i++) {

                // Attention la numérotation des paramètres commence à 1 contrairement l'index du tableau qui commence à 0
                $pdo_statement->bindParam($i + 1, $parameters_array[$i]);
            }

            // Execution de la requête
            $pdo_statement->execute();

            // Vérification de l'existence de lignes dans le jeu de résultat dans l'unique cas d'une requête SELECT
            // ! https://stackoverflow.com/questions/55483165/fix-sqlstatehy000-general-error-when-using-fetch-after-insert?noredirect=1&lq=1
            if ($select_query && $pdo_statement->rowCount() > 0) {

                // Récupération et renvoi du jeu de résultats sous la forme d'un tableau associatif
                // ! Risque de dépassement des ressources en cas d'un "énorme" jeu de résultats
                $result_set = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {

            echo "Erreur général !: " . $e->getMessage() . " " . $e->getLine();
            die();
        }
        return $result_set;
    }

    /**
     * Récupère la connexion à MySQL
     *
     * Gère l'unicité de la connexion
     *
     * @return PDO Connexion MySQL
     */
    static private function getConnection()
    {

        // Vérification d'une connexion existant
        if (is_null(self::$connection)) {

            // On doit la crée
            try {

                // Création et stockage de la connexion
                self::$connection = new PDO(
                    'mysql:host=' . self::HOST . ';dbname=' . self::DB,
                    self::USER,
                    self::PWD,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
                );

                // Activation des exceptions PDO (mode silencieux par défaut)
                // https://www.php.net/manual/fr/pdo.error-handling.php
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {

                echo "Erreur de connexion à la base de données : " . $e->getMessage();

                // On force l'absence de connexion
                self::$connection = null;

                // Pas connexion, on s'arrête
                die();
            }
        }

        // On renvoie la connexion
        return self::$connection;
    }
}
