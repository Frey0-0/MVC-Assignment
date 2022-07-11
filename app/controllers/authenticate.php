<?php

namespace Controller;
session_start();
class Authenticate {
    public function get() {
        echo \View\Loader::make()->render("templates/authenticate.twig");
    }
}