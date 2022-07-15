<?php

namespace Controller;

session_start();

class Utils
{
    public static function loggedInUser()
    {
        if (!((isset($_SESSION["loggedin"])) && $_SESSION['status'] === 0)) {
            header("Location: /");
        }
    }

    public static function loggedInAdmin()
    {
        if (!((isset($_SESSION["loggedin"])) && $_SESSION['status'] === 1)) {
            header("Location: /");
        }
    }
}
