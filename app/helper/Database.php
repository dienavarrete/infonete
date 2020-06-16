<?php

require_once('excepciones/EntityNotFoundException.php');

class Database
{

    private static $database = "database";

    private static $instance;
    private $connexion;

    private function __construct($servername, $username, $password, $dbname)
    {
        $this->connexion = mysqli_connect($servername, $username, $password, $dbname)
        or die("Connection failed: " . mysqli_connect_error());
    }

    public function query($sql)
    {
        $result = mysqli_query($this->connexion, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    public function querySingleRow($sql)
    {
        $result = mysqli_query($this->connexion, $sql);

        if ($result->num_rows == 0) {
            throw new EntityNotFoundException("Entidad no encontrada", $sql);
        }

        return mysqli_fetch_assoc($result);

    }


    /**
     * @param str $sql SQL script a ejecutar
     * @return int Id generado para el script ejecutado
     */
    public function insertQuery($sql)
    {
        mysqli_query($this->connexion, $sql);
        return $this->connexion->insert_id;
    }

    public function __destruct()
    {
        mysqli_close($this->connexion);
    }

    public static function getInstance(Config $config)
    {

        if (!self::$instance instanceof self) {
            self::$instance = new Database(
                $config->get(self::$database, "servername"),
                $config->get(self::$database, "username"),
                $config->get(self::$database, "password"),
                $config->get(self::$database, "dbname")
            );
        }

        return self::$instance;
    }
}