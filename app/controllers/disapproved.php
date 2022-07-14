<?php

namespace Controller;

session_start();

class Disapproved
{
    public function post()
    {
        \Controller\Utils::LoggedInAdmin();

        $name = $_POST["name"];
        $uname = $_POST["uname"];
        $result = \Model\Books::disapproved($name, $uname);
        if (isset($result[0])) {
            \Model\Books::disapprovedupdate($result[0]["quantity"] + 1, $name);
        } else {
            \Model\Books::disapprovedinsert($name);
        }
        \Model\Books::disapprovedupdate2($uname, $name);
        header("Location:/admin/checkin_out");
    }
}
