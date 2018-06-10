<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $pwd;
    private $dbobject;

    function __construct(){
        $this->host='localhost';
        $this->db='autoshopdb';
        $this->user='auto_admin';
        $this->pwd='admin_pw';        
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
                $statement->close();
                return true;
            }
            else
            {
                $statement->close();
                return false;
            }
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
                $statement->close();
                return true;
            }
            else
            {
                $statement->close();
                return false;
            }
        }       
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }
    public function get_Kat()
    {
        $sql='select kategorie from kategorien';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->execute();
            $statement->bind_result($kat);
            while($statement->fetch())
            {
                echo '<option value="'.$kat.'">'.$kat.'</option>';
            }
            $statement->close();
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }

    public function getLastProdId()
    {
        $sql='select max(id) from produkte';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->execute();
            $statement->bind_result($kat);
            if($statement->fetch())
            {
                return $kat;
            }
            $statement->close();
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }

    public function insertProduct($name,$besch,$preis,$kat,$bewert,$filepath)
    {
        $sql='select id from kategorien where kategorie = "'.$kat.'"';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->execute();
            $statement->bind_result($katId);
            if($statement->fetch())
            {
                log_to_console($katId);
                $kat=$katId;
            }
            $statement->close();
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }

        $sql='insert into produkte (name,bewertung,beschreibung,preis,fotolink,fk_kategorie) values (?,?,?,?,?,?)';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->bind_param('ssssss',$name,$bewert, $besch, $preis, $filepath, $kat);
            $statement->execute();
            if($row=$statement->fetch())
            {
                //echo "Insert erfolgreich";
                $statement->close();
                return true;
            }
            else
            {
                $statement->close();
                return false;
            }
        }       
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }

    public function addKat($kat)
    {
        $sql='select id from kategorien where kategorie = "'.$kat.'"';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->execute();
            $statement->bind_result($katId);
            if($statement->fetch())
            {
                echo '<script type="text/javascript">alert("Kategorie bereits vorhanden!");</script>';
                $statement->close();
                return false;
            }
            else
            {
                $statement->close();
                $sql='insert into kategorien (kategorie) values (?)';
                if($statement=$this->dbobject->prepare($sql))
                {
                    $statement->bind_param('s',$kat);
                    $statement->execute();
                    if($row=$statement->fetch())
                    {
                        //echo "Insert erfolgreich";
                        $statement->close();
                        return true;
                    }
                    else
                    {
                        $statement->close();
                        return false;
                    }
                }       
                else
                {
                    $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
                    echo $error;
                }
            }
            $statement->close();
        }
        else
                {
                    $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
                    echo $error;
                }
    }

    public function getProductEdit()
    {
        $sql='select produkte.id,name,bewertung,beschreibung,preis,fotolink,kategorie from produkte left join kategorien on fk_kategorie=kategorien.id';
        if($statement=$this->dbobject->prepare($sql))
        {
            $i=1;
            $statement->execute();
            $statement->bind_result($id,$name,$bewert,$besch,$preis,$foto,$kat);
            while($statement->fetch())
            {
                echo '<tr><form id="'.$i.'" class="edit_prod_form" enctype="multipart/form-data" method="POST" action="?edit=1">';
                    echo '<input type=hidden name="id" value="'.$id.'" form="'.$i.'">';    
                    echo '<td><img class="ProdPic" src="'.$foto.'"><input name="prod_file" onchange="ValidateSize(this)" type="file" id="fi" form="'.$i.'"></td>';
                    echo '<td><input class="reg_form_input" name="prod_name" id="prod_name" type="text" value="'.$name.'" required form="'.$i.'"></td>';
                    echo '<td><textarea class="reg_form_input" name="prod_beschreibung" id="prod_beschreibung" required form="'.$i.'">'.$besch.'</textarea></td>';
                    echo '<td><input class="reg_form_input" name="prod_preis" id="prod_preis" type="number" step="0.01" min="0" value="'.$preis.'" required form="'.$i.'"></td>';
                    echo '<td><select name="prod_kat" required form="'.$i.'">';
                    echo '<option value="'.$kat.'">'.$kat.'</option>';
                    echo '</select></td>';
                    echo '<td><textarea class="reg_form_input" name="prod_bewertung" id="prod_bewertung" form="'.$i.'">'.$bewert.'</textarea></td>';
                    echo '<td><input type="submit" value="Aktualisieren" form="'.$i.'"></td>';
                echo '</form></tr>';

                $i++;

                // echo '<tr><td><img class="ProdPic" src="'.$foto.'"></td><td>'.$name.'</td><td>'.$besch.'</td><td>'.$bewert.'</td><td>'.$preis.'</td>';
                // echo '<td><form action="?edit=1" method="POST">';
                // echo '<input class="editButton" type="submit" value="Bearbeiten">';
                // echo '<input type=hidden name="id" value="'.$id.'">';
                // echo '<input type=hidden name="name" value="'.$name.'">';
                // echo '<input type=hidden name="bewert" value="'.$bewert.'">';
                // echo '<input type=hidden name="besch" value="'.$besch.'">';
                // echo '<input type=hidden name="preis" value="'.$preis.'">';
                // echo '<input type=hidden name="foto" value="'.$foto.'">';
                // echo '<input type=hidden name="fk_kat" value="'.$fk_kat.'">';
                // echo '</form></td></tr>';
            }
            $statement->close();
        }
        else
        {
            $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
            echo $error;
        }
    }

    public function editProduct($id,$name,$bewert,$besch,$preis,$foto,$kat)
    {
        //echo '<script type="text/javascript">alert("'.$kat.'");</script>';
        $sql='select id from kategorien where kategorie = "'.$kat.'"';
        if($statement=$this->dbobject->prepare($sql))
        {
            $statement->execute();
            $statement->bind_result($katId);
            if($statement->fetch())
            {
                $statement->close();
            }
        }

        //echo '<script type="text/javascript">alert(fk_Kat:"'.$katId.'");</script>';

        if($foto=="")
        {
            $sql='UPDATE produkte SET name=?, bewertung=?, beschreibung=?, preis=?, fk_kategorie=? where id=?';
            //echo '<script type="text/javascript">alert("kein Foto");</script>';
            if($statement=$this->dbobject->prepare($sql))
            {
                $statement->bind_param('sssdii',$name,$bewert,$besch,$preis,$katId,$id);
                $status=$statement->execute();
                if($status===false)
                {
                    //echo '<script type="text/javascript">alert("YesNt");</script>';
                    $statement->close();
                    return false;
                }
                else
                {
                    //echo '<script type="text/javascript">alert("OK");</script>';
                    $statement->close();
                    return true;
                }
            }       
            else
            {
                //echo '<script type="text/javascript">alert("Damn");</script>';
                $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
                echo $error;
                return false;
            }
        } 
        else
        {
            echo '<script type="text/javascript">alert("Foto");</script>';
            $sql='UPDATE produkte SET name=?, bewertung=?, beschreibung=?, preis=?, fotolink=?, fk_kategorie=? where id=?';
            if($statement=$this->dbobject->prepare($sql))
            {
                $statement->bind_param('sssdsii',$name,$bewert, $besch, $preis, $foto, $katId,$id);
                $status=$statement->execute();
                if($status===false)
                {
                    //echo '<script type="text/javascript">alert("YesNt");</script>';
                    $statement->close();
                    return false;
                }
                else
                {
                    //echo '<script type="text/javascript">alert("OK");</script>';
                    $statement->close();
                    return true;
                }
            }       
            else
            {
                $error = $this->dbobject->errno . ' ' . $this->dbobject->error;
                echo $error;
                return false;
            }
        }            
    }

    public function getallProducts($filter = FALSE)
    {
        if($filter !== FALSE)
        {
            $result = $this->dbobject->query(
                'select produkte.id as id,name as name,bewertung as bewert,beschreibung as besch,preis as preis,fotolink as link,kategorie as kategorie from produkte left join kategorien on fk_kategorie=kategorien.id where fk_kategorie=kategorien.id and name like "%'.$filter.'%"');
        }else
        {
            $result = $this->dbobject->query(
                'select produkte.id as id,name as name,bewertung as bewert,beschreibung as besch,preis as preis,fotolink as link,kategorie as kategorie from produkte left join kategorien on fk_kategorie=kategorien.id where fk_kategorie = kategorien.id');
        }

        while($row = $result->fetch_assoc())
        {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getKatProd()
    {
        $result = $this->dbobject->query(
            'SELECT kategorie as kategorie from kategorien');
        while($row = $result->fetch_assoc())
        {
            $rows[] = $row;
        }
        return $rows;
    }


    public function addProductWarenkorb()
    {
        
    }

    public function deleteProductWarenkorb()
    {

    }

    public function disconnect()
    {
        $this->dbobject->close();
    }
}

?>