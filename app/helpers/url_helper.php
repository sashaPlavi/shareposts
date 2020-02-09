<?php
//redirect

function redirect($page)
{
    //var_dump($page);
    header('location:' . URLROOT . '/' . $page);
}
