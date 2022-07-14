<?php

namespace Controller;

session_start();

class RequestBook
{
    public function post()
    {
        \Controller\Utils::loggedInUser();

        $name = $_POST["name"];
        $username = $_SESSION["username"];
        $result = \Model\Books::requestBook($name, $username);

        if ($result["quantity"] > 1) {
            $quantity = $result["quantity"];
            \Model\Books::requestBookUpdate($quantity, $username);
        } 
        else {
            \Model\Books::requestBookDelete($username);
        }
        
        \Model\Books::requestBookInsert($name, $username);

        header("Location:/client/dashboard");
    }
}
