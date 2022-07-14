<?php

namespace Model;


class Users
{
    public static function createUser($username, $password)
    {
        $db = \DB::get_instance();
        $status = 0;
        $stmt = $db->prepare("INSERT INTO users (username,password,status) VALUES (?,?,?)");
        $stmt->execute([$username, $password, $status]);
    }

    public static function checkAdminReq($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    public static function adminReq()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public static function approvedAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
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
        $stmt = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
    }
    public static function disapprovedAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
    }
    public static function checkUser($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function checkAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function createAdminReq($username, $hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO adminreq VALUES(?,?)");
        $stmt->execute([$username, $hash]);
    }
}
