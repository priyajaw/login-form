<?php

namespace App\Controllers;

use App\Models\Post;
use \Core\View;

class Home extends \Core\Controller

{
    public function dashboard()
    {
        session_start();

        $email = $_SESSION['email'];
        $data = Post::info($email);
        View::renderTemplate('Form/dashboard.html', ['data' => $data]);

    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: http://login/register/signup");

    }
}
