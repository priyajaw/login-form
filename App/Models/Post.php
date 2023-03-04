<?php

namespace App\Models;

use PDO;
class Post extends \Core\Model
{
    public static function getAll($name, $email,$password,$gender,$file_name)
    {
        try {
           
            $db = static::getDB();
            session_start();

          $_SESSION['name']=$name;
            $stmt = $db->prepare('INSERT INTO login (name,email,password,gender,image)VALUES (:name,:email,:password,:gender,:image)');
            $results = $stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password,'gender'=>$gender,'image'=>$file_name]);
            // return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // public static function getForm($name,$email){
    //     try{
    //         $db=static::getDB();
    //         $result=0;

    //         $sql="insert into form (name,email) values (:name,:email)";
    //         $stmt=$db->prepare($sql);
    //         $dd = $stmt->execute(['name'=>$name,'email'=>$email]);

    //         if($dd == true){
    //             $result = 1;
    //         }
    //         return $result;
    //     }
    //     catch(PDOException $e){
    //         echo $e->getMessage();
    //     }
    // }
    public static function checkEmail($email,$name){
        try{
            $db=static::getdb();
               
            $sql="SELECT * FROM login WHERE email=:email and name=:name";
            $stmt=$db->prepare($sql);
            $stmt->execute([":email" => $email,":name"=>$name]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
          catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public static function info($email){
        try{
            $db=static::getdb();
            $sql="SELECT * FROM login WHERE email=:email";
            $stmt=$db->prepare($sql);
            $stmt->execute([":email" => $email]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;

        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
     
}
