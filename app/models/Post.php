<?php

class Post
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts()
    {
        //join
        $this->db->query('SELECT *,
        sharepost.sh_posts.id as postId,
        sharepost.share_users.id as userId,
        sharepost.sh_posts.created_at as postCreated,
        sharepost.share_users.created_at as userCreated
        
         FROM sharepost.sh_posts
         INNER JOIN sharepost.share_users
         on sharepost.sh_posts.user_id = sharepost.share_users.id
         ORDER BY sharepost.sh_posts.created_at DESC');

        $result = $this->db->resultSet();
        return $result;
    }
    public function addPost($data)
    {

        $this->db->query('INSERT INTO sharepost.sh_posts (title, user_id, body) VALUES(:title,:user_id, :body)');
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }
}
