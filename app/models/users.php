<?php

namespace Model;


class Users
{
    public static function createUser($username, $password)
    {
        $db = \DB::get_instance();
        $status = 0;
        $query= $db->prepare("INSERT INTO users (username,password,status) VALUES (?,?,?)");
        $query->execute([$username, $password, $status]);
    }

    public static function checkAdminReq($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username FROM adminreq WHERE username =?");
        $query->execute([$username]);
        $result =  $query ->fetch();
        return $result;
    }

    public static function adminReq()
    {
        $db = \DB::get_instance();
        $query= $db->prepare("SELECT username FROM adminreq");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public static function approvedAdmin($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username,password FROM adminreq WHERE username=?");
        $query->execute([$username]);
        $result = $query->fetchAll();
        return $result;
    }

    public static function approvedAdminInsert($username, $password)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO users VALUES(?,?,1)");
        $stmt->execute([$username, $password]);
    }
    public static function approvedAdminDelete($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $query->execute([$username]);
    }
    public static function disapprovedAdmin($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $query->execute([$username]);
    }
    public static function checkUser($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT username FROM users WHERE status=0 AND username =?");
        $query->execute([$username]);
        $result =  $query ->fetch();
        return $result;
    }
    public static function checkAdmin($username)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("SELECT username FROM users WHERE status=1 AND username =?");
        $query ->execute([$username]);
        $result =  $query ->fetch();
        return $result;
    }
    public static function createAdminReq($username, $hash)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO adminreq VALUES(?,?)");
        $query ->execute([$username, $hash]);
    }
}
