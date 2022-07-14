<?php

namespace Controller;

session_start();

class RequestBook
{
    public function post()
    {
        \Controller\Utils::LoggedInUser();
        $name = $_POST["name"];
        $uname = $_SESSION["uname"];
        $result = \Model\Books::requestbook($name, $uname);
        if ($result["quantity"] > 1) {
            $quantity=$result["quantity"];
            \Model\Books::requestbookupdate($quantity, $uname);
        }
        else{
            \Model\Books::requestbookdelete($uname);
        }
        header("Location:/client/dashboard");
    }
}
