<?php

class HomeController {
    public function index() {
        $title = "Inicio";
        require_once __DIR__ . '/../views/home.php';
    }
}
