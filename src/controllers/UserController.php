<?php

namespace App\controllers;

use App\core\AbstractController;
use App\repo\UserRepo;
use App\helpers\InputHelper;


class UserController extends AbstractController
{
    public function show_login()
    {
        $this->view('view_login', []);
    }

    public function login()
    {
        $inp = new InputHelper();
        $post_data = $inp->get_all_inputs();
        $usermail = $post_data['email'];
        $password = $post_data['password'];

        $db_user = UserRepo::get_user_by_email($this->db, $usermail);

        if($db_user !== false)
        {
            if(password_verify($password, $db_user->u_password))
            {
                $_SESSION['login'] = $db_user;
                session_regenerate_id(true);
                
                header('Location: home');
            }
            else
            {
                $data['feedback'] = 'Wrong password';
                $this->view('view_login', $data);
            }
        }
        else
        {
            $data['feedback'] = 'User not registered';
            $this->view('view_login', $data);
        }

    }

    public function signup()
    {
        $inp = new InputHelper();
        $post_data = $inp->get_all_inputs();
        if(isset($post_data['email']))
        {
            $usermail = $post_data['email'];
            $password = $post_data['password'];
            $username = $post_data['name'];

            if($usermail != '' && $password != '' && $username != '')
            {
                UserRepo::create_user($this->db, $usermail, password_hash($password, PASSWORD_DEFAULT), $username);
                header('Location: signup-start');
            }
            else
            {
                $this->view('view_signup', []);
            }

        }
        else
        {
            $this->view('view_signup', []);
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
        header('Location: home');
    }

    public function check_login()
    {
        if(isset($_SESSION['login']))
        {
            return $_SESSION['login'];
        }
        else
        {
            return ['u_mail' => 'nope'];
        }
    }
}