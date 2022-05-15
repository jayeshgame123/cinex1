<?php

class Account{
    private $pdo;
    private $errorArray=[];

    public function __construct(){
        $this->pdo=Database::instance();
    }

    public function register($fn,$ln,$em,$pwd){
        if(empty($errorArray)){
            return $this->insertUserDetails($fn,$ln,$em,$pwd);

        }else{
            return true;
        }

    }

    public function insertUserDetails($fn,$ln,$em,$pwd){
        $pass_hash=password_hash($pwd,PASSWORD_BCRYPT);
        $stmt=$this->pdo->prepare("INSERT INTO users (firstName,lastName,email,password) VALUES (:fn,:ln,:em,:pwd)");
        $stmt->bindParam(":fn",$fn,PDO::PARAM_STR);
        $stmt->bindParam(":ln",$ln,PDO::PARAM_STR);
        $stmt->bindParam(":em",$em,PDO::PARAM_STR);
        $stmt->bindParam(":pwd",$pass_hash,PDO::PARAM_STR);

        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

   /* public function validateEmail($em){
        $stmt=$this->pdo->prepare("SELECT * FROM 'users' WHERE email=:email");
        $stmt->bindParam(":email",$em,PDO::PARAM_STR);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count > 0){
            return array_push($this->errorArray,Constant::$emailInUse);
        }

        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            return array_push($this->errorArray,Constant::$emailInvalid);
        }

        if(empty($this->errorArray)){
            return $em;
        }else{
            return false;
        }
    }

    public function getErrorMessage($error){
        if(in_array($error,$this->errorArray)){
            return " <div class='inputError'>$error</div>";
        }
    }*/
}