<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
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
