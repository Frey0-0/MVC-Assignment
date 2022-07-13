<?php

namespace Controller;
session_start();

class RemoveBook {
    public function post(){
        $name=$_POST["name"];
        $quantity =$_POST["quantity"];
        \Model\Books::removebook($name,$quantity);
        header("Location:/admin/dashboard");
    }
}