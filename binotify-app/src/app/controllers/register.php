<?php

class Register extends Controller
{
    function __construct()
    {
        $this->userModel = $this->model('User_model');
        session_start();
        include_once __DIR__.'/../config/config.php';
    }

    public function index()
    {
        if (isset($_SESSION['username']))
        {
            if ($_SESSION['isAdmin'] == true) {
                header('Location: ' . BASE_URL . '/admin');
            } else {
                header('Location: ' . BASE_URL . '/user');
            }
        }
        
        else
        {
            $data['title'] = 'Listen to all songs';
            $this->view('templates/header', $data);
            $this->view('templates/navbar');
            $this->view('register/index');
            $this->view('templates/footer');
        }
    }
    public function validate()
    {
        $this->userModel->validateRegister();
    }
}
