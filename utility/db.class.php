<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $pwd;
    private $dbobject;

    function __construct(){
        $conf=include("./config/db_access.php");
        $this->host=$conf->host;
        $this->db=$conf->db;
        $this->user=$conf->user;
        $this->pwd=$conf->pwd;
    }
        public function connect()
    {
        $this->dbobject = new mysqli($this->host, $this->user, $this->pwd, $this->db);
        if (mysqli_connect_errno() != 0) {
            echo "Datenbankverbindung nicht möglich";
        }

    }
    function __deconstruct(){
        $this->dbobject->close();
    }

    public function check_login($uname, $pw)
    {
        $pw=md5($pw);

        $sql='select * from users where (username=? and pwd=?)';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->bind_param('ss',$uname,$pw);
            $statement->execute();
            if($res=$statement->get_result())
            {
                //echo "Login erfolgreich";
                $row = $res->fetch_assoc();

                if($row['is_admin']==0)
                    $is_admin=0;
                else
                    $is_admin=1;

                $cookiePath="/";
                $cookieExpire=time()+36000;//Cookie 1 Stunde gültig
                
                session_start();                                    //Session wird gestartet
                $_SESSION['user']=$uname;
                $_SESSION['admin']=$is_admin;
                setcookie("user",$uname,$cookieExpire,$cookiePath); 
                setcookie("admin",$is_admin,$cookieExpire,$cookiePath); 
                setcookie("PHPSESSID",session_id(),$cookieExpire,$cookiePath);
                return true;
            }
            else
                return false;
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }

        
    }
    public function register_user($uname, $pw, $adr, $plz, $ort, $vname, $nname, $email)
    {
        $pw=md5($pw);
        $sql='insert into users (username,pwd,vorname,nachname,adresse,plz,ort,email) values (?,?,?,?,?,?,?,?)';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->bind_param('ssssssss',$uname,$pw, $adr, $plz, $ort, $vname, $nname, $email);
            $statement->execute();
            if($row=$statement->fetch())
            {
                //echo "Insert erfolgreich";
                return true;
            }
            else
                return false;
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }
    public function disconnect()
    {
        $this->dbobject->close();
    }
}

?>