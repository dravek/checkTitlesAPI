<?php

namespace App;

use PDO;

/**
 * Database Class to manage and store results in a SQlite3 database
 * 
 */

class Database{

    static protected $db;

    /**
     * Initialize Sqlite database
     * 
     */
    public static function init(){
        self::$db = new PDO("sqlite:./database/marfeelizable.sqlite");
    }


    /**
     * Store function
     * @param url url of the website
     * @param title title from website
     * @param status status of the request (OK or TIMEOUT)
     * @param marfeelizable if website is marfeelizable (YES or NO)
     */
    public static function store($url,$title,$status,$marfeelizable)
    {
        // We check if URL already exists in database
        $sql = "SELECT url FROM urls WHERE url = :url";
        $stmt = self::$db->prepare($sql);
        $stmt->execute(array(':url'=>$url));

        $result = $stmt->fetchAll();

        if (count($result) == 0) {

            // Does not exists in Database. We store it
            $insert = "INSERT INTO urls (id, url, title, status, marfeelizable) VALUES (null, :url, :title, :status, :marfeelizable)";
            $stmt = self::$db->prepare($insert);

            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':marfeelizable', $marfeelizable);

            $stmt->execute();
        }
    }
}