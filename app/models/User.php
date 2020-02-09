<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
    public function register($data)
    {
        $this->db->query('INSERT INTO sharepost.share_users (name, email, password) VALUES(:name, :email, :password)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }

    public function find_user_by_email($email)

    {
        // var_dump($email);
        //FIX sharepost.SHARE_USERS
        $this->db->query('SELECT * FROM sharepost.share_users WHERE email= :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        //var_dump($this->db->rowCount());

        if ($this->db->rowCount() > 0) {

            return true;
        } else {
            return false;
        }
    }
}
