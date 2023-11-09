<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Staff {

    protected $database;
    public function __construct($database){
        $this->database = $database->getDb();
}

public function addStaff($staffData){

$staffData = ['FirstName','LastName','MiddleInitial','StaffID','EmailAddress','PhoneNumber','TeleNumber','Address', 'Role','OfficeAddress','UserName','Password'];

//query
    $query = 'INSERT INTO tb_admin VALUES($staffData)';


}
}