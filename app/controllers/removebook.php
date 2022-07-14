<?php

namespace Controller;

session_start();

class RemoveBook
{
    public function post()
    {
        \Controller\Utils::LoggedInAdmin();

        $name = $_POST["name"];
        $quantity = $_POST["quantity"];
        \Model\Books::removebook($name, $quantity);
        header("Location:/admin/dashboard");
    }
}
