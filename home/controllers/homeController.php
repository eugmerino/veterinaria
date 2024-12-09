<?php

class HomeController {
    public function home() {
        $title = "Inicio";
        require_once __DIR__ . '/../views/home.php';
    }

    public function acercade() {
        
        require_once __DIR__ . '/../views/acercade.php';
    }
  
}
