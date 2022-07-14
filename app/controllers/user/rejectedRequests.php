<?php

namespace Controller;

session_start();

class RejectedRequests
{
    public function get()
    {
        \Controller\Utils::loggedInUser();

        $username = $_SESSION["username"];
        $result = \Model\Books::rejectedRequests($username);
        \Model\Books::rejectedRequestsDelete($username);
        echo \View\Loader::make()->render("templates/clientRejectedRequests.twig", array(
            "rejectedrequests" => $result,
            "username" => $username,
        ));
    }
}
