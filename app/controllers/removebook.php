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
        $result=\Model\Books::removebook($name, $quantity);
        if (($result[0]["quantity"]) > $quantity) {
            \Model\Books::removebookupdate($result[0]["quantity"] - $quantity, $name);
        }
        else{
            \Model\Books::removebookdelete($name);
        }
        header("Location:/admin/dashboard");
    }
}
