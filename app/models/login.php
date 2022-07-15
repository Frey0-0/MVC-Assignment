<?php

namespace Model;


class LogIn
{
    public static function verifyClient($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username,password FROM users WHERE status=0 AND username=?");
        $query->execute([$username]);
        $result = $query->fetch();
        return $result;
    }
    public static function verifyAdmin($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username,password FROM users WHERE status=1 AND username=?");
        $query->execute([$username]);
        $result = $query->fetch();
        return $result;
    }
}
