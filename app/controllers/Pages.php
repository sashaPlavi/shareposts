<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    $data = [
      'title' => "Sasha's posts",
      'description' => 'Simple social network based on php framework '
    ];

    $this->view('pages/index', $data);
  }

  public function about()
  {
    $data = [
      'title' => 'About Us',
      'description' => 'Share your opinion with other friends ! '
    ];

    $this->view('pages/about', $data);
  }
}
