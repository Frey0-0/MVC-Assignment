<?php

namespace Controller;

session_start();

class RequestBook
{
    public function post()
    {
        \Controller\Utils::LoggedInUser();
        $name = $_POST["name"];
        $username = $_SESSION["username"];
        $result = \Model\Books::RequestBook($name, $username);
        if ($result["quantity"] > 1) {
            $quantity=$result["quantity"];
            \Model\Books::RequestBookUpdate($quantity, $username);
        }
        else{
            \Model\Books::RequestBookDelete($username);
        }
        header("Location:/client/dashboard");
    }
}
