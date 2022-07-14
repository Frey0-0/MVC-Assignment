<?php

namespace Controller;
session_start();

class LogOut
{
    public function get()
    {
        session_destroy();
        header("Location:/");
    }
}
