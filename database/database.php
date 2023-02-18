<?php

namespace database;

use PDO;
use PDOException;

class database
{
    private $database;
    private $conenction;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    private $dbhost = DB_HOST;
    private $dbusername = DB_USERNAME;
    private $dbname = DB_NAME;
    private $dbpassword = DB_PASSWORD;

    function __construct()
    {
        try {
            $this->conenction = new PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname, $this->dbusername, $this->dbpassword, $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function select($sql, $value = null)
    {
        $stmt = $this->conenction->prepare($sql);
        if ($value == null) {
            $stmt->execute();
        } else {
            $stmt->execute($value);
        }
        $result = $stmt;
        return $result;
    }
    public function insert($table_name, $filds, $values)
    {



        try {
            $stmt = $this->conenction->prepare("INSERT INTO " . $table_name . "(" . implode(', ', $filds) . " , created_at) VALUES ( :" . implode(', :', $filds) . " , now() );");
            $stmt->execute(array_combine($filds, $values));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function update($tableName, $id, $fields, $values)
    {

        $sql = "UPDATE " . $tableName . " SET";
        foreach (array_combine($fields, $values) as $field => $value) {
            if ($value) {
                $sql .= " `" . $field . "` = ? ,";
            } else {
                $sql .= " `" . $field . "` = NULL ,";
            }
        }

        $sql .= " updated_at = now()";
        $sql .= " WHERE id = ?";
        try {
            $stmt = $this->conenction->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function delete($tablename, $id)
    {
        try {

            $sql = "DELETE FROM " . $tablename . " WHERE id = ?";
            $stmt = $this->conenction->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
