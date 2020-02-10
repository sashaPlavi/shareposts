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
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_SESSION['user_id']);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            if (empty($data['title'])) {
                $data['title_err'] = 'Plese enter title';
            }
            if (empty($data['body'])) {
                $data['body_err'] = 'Plese enter post';
            }
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->addPost($data)) {
                    var_dump($data);
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('posts/add', $data);
            }
        } else {

            $data = [
                'title' => '',
                'body' => '',

            ];
            $this->view('posts/add', $data);
        }
    }
}
