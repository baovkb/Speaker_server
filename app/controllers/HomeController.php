<?php
namespace Speaker\controllers;
use Speaker\cores\Controller;

class HomeController extends Controller{
    function index() {
        $this->render('main', 'home/index.php');
    }
}
?>