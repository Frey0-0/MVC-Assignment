<?php

namespace Model;


class Users
{
    public static function CreateUser($username, $password)
    {
        $db = \DB::get_instance();
        $status = 0;
        $stmt = $db->prepare("INSERT INTO users (username,password,status) VALUES (?,?,?)");
        $stmt->execute([$username, $password, $status]);
    }

    public static function CheckAdminReq($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    public static function AdminReq()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public static function ApprovedAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function ApprovedAdminInsert($username, $password)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO users VALUES(?,?,1)");
        $stmt->execute([$username, $password]);
    }
    public static function ApprovedAdminDelete($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
    }
    public static function DisapprovedAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM adminreq WHERE username=?");
        $stmt->execute([$username]);
    }
    public static function CheckUser($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function CheckAdmin($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function CreateAdminReq($username, $hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO adminreq VALUES(?,?)");
        $stmt->execute([$username, $hash]);
    }
}
