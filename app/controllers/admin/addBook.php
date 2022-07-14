<?php

namespace Controller;
session_start();

class AddBook {
    public function post(){
        \Controller\Utils::loggedInAdmin();

        $name=$_POST["name"];
        $quantity =$_POST["quantity"];
        \Model\Books::AddBook($name,$quantity);
        header("Location:/admin/dashboard");
    }
}