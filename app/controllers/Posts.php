<?php


class Posts extends Controller
{
    public function __construct()
    {
        if (!is_loggedin()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }
}
