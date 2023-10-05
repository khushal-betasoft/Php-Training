<?php

class DB
{
    private $con;

    public function __construct()
    {
        try {
            $this->con = new mysqli('localhost', 'root', '', 'userDB');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //For checking the Existence of the User.................
    public function verifyUser($table,$conditions){
        $sql="select * from $table ";
        if(count($conditions)){
            $sql.="where ";
            foreach($conditions as $element=>$value){
                if(gettype($value)=='string'){
                    $sql.="$element='$$value'";
                }
                else{
                    $sql.="$element=$value";
                }
            }
        }
        $result=$this->con->query($sql);
        return $result->num_rows;
    }

    /**
     * @description 
     * @return 
     */
    public function query($table, $fields = [], $conditions = [])
    {
        $sql = "SELECT ";
        if (count($fields)) {
            $sql .= implode(',', $fields);
        } else {
            $sql .= " * ";
        }
        $sql .= " FROM $table";

        if (count($conditions)) {
            $sql .= " WHERE ";
            $i = 0;
            foreach ($conditions as $key => $value) {
                $i++;
                $sql .= $key . " = '" . $value . "'";

                if ($i != count($conditions)) {
                    $sql .= ", ";
                }
            }
            
        }

        $result  = $this->con->query($sql);
        if($result){
            if ($result->num_rows) {
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } 
            else {
                return [];
            }
        }
        else {

            die($this->con->error);
        }
    }
//For Deletion.......................................................
    public function deleteQuery($table, $conditions){
        $sql = " DELETE FROM $table ";
        if (count($conditions)) {
            $sql .= " WHERE ";
            $i = 0;
            foreach ($conditions as $key => $value) {
                $i++;
                $sql .= $key . " = '" . $value . "'";

                if ($i != count($conditions)) {
                    $sql.="and";
                }
            }
            
        }
        $result= $this->con->query($sql);
           
        if($result){
            return ['status' => true,"message" => "Data has been updated successfully"];
        }
        else{
            return ['status' => false, "message" => $this->con->error ];
        }
       
    }
//For Updation................................................................
    public function updateQuery($table,$data,$conditions){

            $sql="update $table set ";
            $count=0;
            foreach($data as $field=>$value){
                $count++;
                if(gettype($value)=="string")
                $sql.=$field."="."'$value' ";
                else
                $sql.=$field."=".$value;
                
                if(count($data)!=$count)
                $sql.=",";

            }
            $sql.=" where ";
            $count=0;
            foreach($conditions as $element=>$value){
                $count++;
                if(gettype($value)=="string")
                $sql.=$element."="."'$value' ";
                else
                $sql.=$element."=".$value;
                
                if(count($conditions)!=$count)
                $sql.="and";
            }

            $result=$this->con->query($sql);
            if($result){
                return ['status' => true, "message" => "Data has been updated successfully" ];
            }
            else{
                return ['status' => false, "message" => $this->con->error ];
            }
           
    }
}
