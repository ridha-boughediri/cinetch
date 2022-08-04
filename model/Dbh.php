<?php

/**
 * Database connection object. Dbh stands for database handler.
 */
class Dbh
{
    /**
     * PDO connection object used to connect to the database server before performing queries.
     *
     * @return void
     */
    protected function connect()
    {
        
        try {

            $username = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost; dbname=cinetech', $username, $password);
            return $dbh;
            
        } catch (PDOException $e) {
            print "Error! :" . $e->getMessage() . "<br/>";
            die();
        }

    }
    
    /**
     * Used to filter the data from eache $_POST value before returning it to the database.
     *
     * @param string $data
     * @return string
     */
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
