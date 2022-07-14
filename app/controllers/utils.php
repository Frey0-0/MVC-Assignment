<?php

namespace Controller;

session_start();

class Utils
{
    public static function LoggedInUser()
    {
        if (!((isset($_SESSION["loggedin"])) && $_SESSION['status'] === 0)){
            header("Location: /");
        }
    }

    public static function LoggedInAdmin()
    {
        if (!((isset($_SESSION["loggedin"])) && $_SESSION['status'] === 1)) {
            header("Location: /");
        }
    }
}
