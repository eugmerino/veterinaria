<?php

class HomeController {
    public function home() {
        $title = "Inicio";
        require_once __DIR__ . '/../views/home.php';
    }
}
