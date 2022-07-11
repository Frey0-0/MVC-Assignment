<?php

namespace Controller;
session_start();
class Authorize {
    public function get() {
        echo \View\Loader::make()->render("templates/authorize.twig");
    }
}