<?php

class Admin extends Controller {
    function __construct() {
        session_start();
        if (!isset($_SESSION['username']) || $_SESSION['isAdmin'] == false) {
            $_SESSION['error'] = 'You must be logged in as admin to access this page';
            header('Location: ' . BASE_URL . '/login');
        }
    }

    public function index() 
    {
        $this->view('templates/layout', [
            'mode' => 'admin',
        ]);
    }

    public function users()
    {
        $this->view('templates/layout', [
            'mode' => 'users',
        ]);
    }

    public function fetch($data = [])
    {
        if ($data['mode'] == 'users') {
            $data = $this->model('User_model')->getAllUsers($data);
            $this->view('admin/users', $data);
        } else {
            $this->view('admin/index');
        }

    }
}