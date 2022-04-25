<?php
class DB {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "storage";
 
    public function __construct() {
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }

    public function check_credentials($email = '', $password = '') {
        $sql = $this->db->query("SELECT id, fullname, status FROM users WHERE email = '$email' AND password = '". md5($password) ."'");
 
        if($sql->num_rows) {
 
            $result = $sql->fetch_assoc();
 
            if ('1' == $result['status']) {
                return array('status' => 'success', 'id' => $result['id'], 'fullname' => $result['fullname']);
            }
 
            return array('status' => 'error', 'message' => 'Your account is not activated yet.');
        }
         
        return array('status' => 'error', 'message' => 'Email or password is invalid.');
    }
 
    public function insert_user($arr_data = array()) {
        $keys = array_keys($arr_data);
        $values = array_values($arr_data);
 
        $db_values = '';
        $i = 0;
        foreach($values as $v) {
            $pre = ($i > 0)?', ':'';
            $db_values .= $pre. "'". $this->db->real_escape_string($v)."'";
            $i++;
        }
 
        $this->db->query("INSERT INTO users (".implode(",", $keys).") VALUES (".$db_values.")");
    }
 
    public function email_exists($email = '') {
        $sql = $this->db->query("SELECT id FROM users WHERE email = '$email'");
 
        if($sql->num_rows) {
            return true;
        }
 
        return false;
    }
}