<?php


class Posts extends Controller
{
    public function __construct()
    {
        if (!is_loggedin()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('post');
        $this->userModel = $this->model('user');
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

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_SESSION['user_id']);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
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
                if ($this->postModel->updatePost($data)) {
                    //var_dump($data);
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('posts/edit', $data);
            }
        } else {
            $post = $this->postModel->getPost_by_id($id);
            //check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,

            ];
            $this->view('posts/edit', $data);
        }
    }
    public function show($id)
    {
        $post = $this->postModel->getPost_by_id($id);
        $user = $this->userModel->getUser_by_id($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $post = $this->postModel->getPost_by_id($id);
            //check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Post removed');
                redirect('posts');
            } else {
                die('somethin went wrong');
            }
        } else {
            redirect('posts');
        };
    }
}
