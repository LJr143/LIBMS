<?php

require_once 'C:\wamp64\www\LIBMS\LIBMS\db_config\config.php';

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
        $result = $this->database->executeQuery($sql);

        $user_penalty = array();

        while ($row = $result->fetch_assoc()) {
            $user_penalty[] = $row;
        }

        return $user_penalty;
    }
}


