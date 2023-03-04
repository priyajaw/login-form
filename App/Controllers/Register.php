<?php

namespace App\Controllers;

use App\Models\Post;
use \Core\View;

class Register extends \Core\Login

{
    public function signupAction()
    {
        $err = array();
        $success = 0;
        if (isset($_POST['submitbtn'])) {
            if (empty(trim($_POST['name']))) {
                $err[] = "enter name";
            } else {
                $name = trim($_POST['name']);
            }
            if (empty(trim($_POST['email']))) {
                $err[] = "enter email";
            } else if ($count = POST::info(trim($_POST['email']))) {
                $err[] = " email alerady present";
            } else {
                $email = trim($_POST['email']);

            }
            if (empty($_POST['password'])) {
                $err[] = "enter password";
            } else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            }
            if (empty($_POST['gender'])) {
                $err[] = "enter gender";

            } else {
                $gender = $_POST['gender'];
            }
            if (isset($_FILES["image"])) {
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];

                $des = 'image/' . $file_name;
                move_uploaded_file($file_tmp, $des);

            }

            if (empty($err)) {
                Post::getAll($name, $email, $password, $gender, $file_name);
                header("Location: http://login/register/signin");

            }

        }

        View::renderTemplate('Form/signup.html', ['err' => $err]);

    }

    public function signinAction()
    {

        // session_start();
        $err = array();
        $ans = 0;
        if (isset($_POST['submitbtn'])) {

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($name)) {
                $err[] = "enter name";
            }
            if (empty($email)) {
                $err[] = "enter email";
            }
            if (empty($err)) {
                $count = POST::checkEmail($email, $name);
                //    var_dump($count);
                if (!$count) {
                    $err[] = "name email combination unmatched";
                } else {
                    if (password_verify($password, $count['password'])) {
                        //    $_SESSION['name']=$count['name'];
                        $_SESSION['email'] = $count['email'];
                        //    $_SESSION['gender']=$count['gender'];
                        //    $_SESSION['image']=$;

                        $ans = 1;
                        header("Location: http://login/home/dashboard");

                    } else {
                        $err[] = "password is wrong";
                    }

                }

            }
        }
        View::renderTemplate('Form/signin.html', ['ans' => $ans, 'err' => $err]);
    }

}
