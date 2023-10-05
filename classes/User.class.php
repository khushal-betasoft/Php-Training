<?php

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getRecord()
    {
        return $this->db->query('users', ['name', 'password']);
    }
    public function deleteRecord()
    {
        if($this->db->verifyUser('users',['name'=>'Khushal']))
        return $this->db->deleteQuery('users',['name'=>'Khushal']);
        else
        echo "User not Found!";
    }
    public function updateRecord($data = []){
        if($this->db->verifyUser('users',['name'=>'Ravi']))
        return $this->db->updateQuery('users', ['name' => 'Ram'], ['name'=>'Ravi']);
        else
        echo "User not Found!";
    }
}
