<?php

class HomeController {
    public function home() {
        $title = "Inicio";
        require __DIR__ . '/../views/home.php';
    }
}
