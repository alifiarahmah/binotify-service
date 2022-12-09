<?php

class Logout extends Controller
{
    function __construct()
    {
        $this->userModel = $this->model('User_model');
        session_start();
    }

    public function index()
    {
        $this->model('User_model')->logout();
    }
}