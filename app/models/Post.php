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
    public function getPost_by_id($id)
    {
        $this->db->query('SELECT * FROM sharepost.sh_posts WHERE id =:id ');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function updatePost($data)
    {
        //var_dump($data);

        $this->db->query('UPDATE sharepost.sh_posts SET title=:title, body=:body WHERE id= :id ');
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM sharepost.sh_posts   WHERE id= :id ');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            false;
        }
    }
}
