<?php

/**
 * Database
 * A connection to the database
 */
class Database {

    /**
     * Get the database connection
     * @return PDO object Connection to the database server
     */

    public function getConn() {
        $db_host = "";
        $db_name = "";
        $db_user = "";
        $db_pass = "";


        $dsn = 'mysql:host=' . $db_host . '; dbname=' . $db_name . ';charset=utf8mb4';

        try {
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            exit;
        }
    }
}
