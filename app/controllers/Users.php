<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('user');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //proces form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' =>  '',
                'email_err' => '',
                'password_err' =>  '',
                'confirm_password_err' => ''
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                //check db
                //var_dump($this->userModel->find_user_by_email($data['email']));
                if ($this->userModel->find_user_by_email($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at lest 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = "Passwords do not match";
                }
            }

            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //register user 
                // var_dump($this->userModel->register($data));
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registerd and can log in');
                    redirect('users/login');
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('users/register', $data);
                // print_r($data);
            }
        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',


            ];
            $this->view('users/register', $data);
        }
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //proces form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' =>  '',
            ];
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            if ($this->userModel->find_user_by_email($data['email'])) {
            } else {
                $data['email_err'] = 'No user found';
            }


            if (empty($data['email_err']) && empty($data['password_err'])) {
                //set loged in user
                $loggedinUser = $this->userModel->login($data['email'], $data['password']);
                var_dump($data);
                var_dump($loggedinUser);
                if ($loggedinUser) {
                    //create session
                    $this->create_login_sesion($loggedinUser);
                } else {
                    $data['password_err'] = ' Password incorect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            //init data
            $data = [

                'email' => '',
                'password' => '',


                'email_err' => '',
                'password_err' => '',


            ];
            $this->view('users/login', $data);
        }
    }
    public function create_login_sesion($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_mail'] = $user->mail;
        $_SESSION['user_name'] = $user->name;
        redirect('pages/index');
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_mail']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    public function is_loggedin()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
