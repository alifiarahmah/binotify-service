<?php

class User_model
{

    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT 
            `user_id`, email, username, isAdmin 
            FROM $this->table");
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT `user_id`, email, username, isAdmin FROM $this->table WHERE `user_id`=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getUserByEmail($email)
    {
        $this->db->query("SELECT `user_id`, email, username, isAdmin FROM $this->table WHERE email=:email");
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function getUserByEmailPassword($email, $password)
    {
        $this->db->query("SELECT `user_id`, email, username, isAdmin FROM $this->table WHERE email=:email AND password=:password");
        $this->db->bind('email', $email);
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT `user_id`, email, username, isAdmin FROM $this->table WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserByUsernamePassword($username, $password)
    {
        $this->db->query("SELECT `user_id`, email, username, isAdmin FROM $this->table WHERE username=:username AND password=:password");
        $this->db->bind('username', $username);
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    public function validateUser()
    {
        include_once __DIR__ . '/../config/config.php';
        $username = $_POST['username'];
        $password = hash('sha256', $_POST['password']);
        if ($username === '' || $password === '') {
            $_SESSION['error'] = 'Silakan isi terlebih dahulu.';
            header('Location: ' . BASE_URL . '/login');
        } else {
            $email_exists = $this->getUserByEmail($username);
            $username_exists = $this->getUserByUsername($username);
            if (!$email_exists && !$username_exists) {
                $_SESSION['error'] = 'Username tidak ada. Silakan daftar terlebih dahulu.';
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
            $email_valid = $this->getUserByEmailPassword($username, $password);
            $username_valid = $this->getUserByUsernamePassword($username, $password);
            if (!$email_valid && !$username_valid) {
                $_SESSION['error'] = 'Password salah';
                header('Location: ' . BASE_URL . '/login');
                exit;
            } else {
                if ($email_valid) {
                    $_SESSION['user_id'] = $email_valid['user_id'];
                    $_SESSION['email'] = $email_valid['email'];
                    $_SESSION['username'] = $email_valid['username'];
                    $_SESSION['isAdmin'] = $email_valid['isAdmin'];
                    if ($email_valid['isAdmin']) {
                        header('Location: ' . BASE_URL . '/admin');
                        exit;
                    } else {
                        header('Location: ' . BASE_URL . '/');
                        exit;
                    }
                } else {
                    $_SESSION['user_id'] = $username_valid['user_id'];
                    $_SESSION['email'] = $username_valid['email'];
                    $_SESSION['username'] = $username_valid['username'];
                    $_SESSION['isAdmin'] = $username_valid['isAdmin'];
                    if ($username_valid['isAdmin']) {
                        header('Location: ' . BASE_URL . '/admin');
                        exit;
                    } else {
                        header('Location: ' . BASE_URL . '/');
                        exit;
                    }
                }
            }
        }
    }

    public function validateRegister()
    {
        include_once __DIR__ . '/../config/config.php';
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];
        if ($username === '' || $password === '' || $confirm === '' || $email === '') {
            $_SESSION['error'] = 'Silakan isi terlebih dahulu.';
            header('Location: ' . BASE_URL . '/register');
        } elseif ($password !== $confirm) {
            $_SESSION['error'] = 'Password tidak cocok. Silakan ulangi lagi.';
            header('Location: ' . BASE_URL . '/register');
        } else {
            $email_exists = $this->getUserByEmail($email);
            $username_exists = $this->getUserByUsername($username);
            if ($email_exists) {
                $_SESSION['error'] = 'Email sudah terdaftar sebelumnya.';
                header('Location: ' . BASE_URL . '/register');
                exit;
            } elseif ($username_exists) {
                $_SESSION['error'] = 'Username sudah terdaftar sebelumnya.';
                header('Location: ' . BASE_URL . '/register');
                exit;
            } else {
                $data = [];
                $data['email'] = $email;
                $data['username'] = $username;
                $data['password'] = hash('sha256', $password);

                $this->addUser($data);
                $_SESSION['success'] = 'Berhasil mendaftar. Silakan login.';
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    public function addUser($data)
    {
        $query = "INSERT INTO $this->table (email, password, username)
										VALUES
									(:email, :password, :username)";

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('username', $data['username']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateUser($data)
    {
        $query = "UPDATE $this->table SET
										email = :email,
										password = :password,
                                        username = :username
									WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
