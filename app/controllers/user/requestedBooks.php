<?php

namespace Controller;

session_start();

class RequestedBooks
{
    public function get()
    {
        \Controller\Utils::LoggedInUser();

        $username = $_SESSION["username"];
        echo \View\Loader::make()->render("templates/clientRequestedBooks.twig", array(
            "requestedbooks" => \Model\Books::requestedBooks($username),
            "username" => $username,
        ));
    }
}
