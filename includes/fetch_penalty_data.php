<?php

require_once 'C:\wamp64\www\LIBMS\db_config\config.php';

class penaltyData
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAllPenalty(): array
    {
        $sql = "SELECT * FROM vw_user_penalty";
        $stmt = $this->database->executeQuery($sql);

        //Fetch all penalty records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}


