<?php

namespace Controller;

session_start();

class RemoveBook
{
    public function post()
    {
        \Controller\Utils::loggedInAdmin();

        $name = $_POST["name"];
        $quantity = $_POST["quantity"];
        $result=\Model\Books::removeBook($name, $quantity);
        if (($result[0]["quantity"]) > $quantity) {
            \Model\Books::removeBookUpdate($result[0]["quantity"] - $quantity, $name);
        }
        else{
            \Model\Books::removeBookDelete($name);
        }
        header("Location:/admin/dashboard");
    }
}
