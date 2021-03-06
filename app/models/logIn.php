<?php

namespace Model;


class LogIn
{
    public static function verifyClient($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username,password FROM users WHERE status=? AND username=?");
        $query->execute([\Enum\UserRole::user,$username]);
        $result = $query->fetch();
        return $result;
    }
    public static function verifyAdmin($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username,password FROM users WHERE status=? AND username=?");
        $query->execute([\Enum\UserRole::admin,$username]);
        $result = $query->fetch();
        return $result;
    }
}
