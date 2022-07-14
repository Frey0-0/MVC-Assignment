<?php

namespace Model;


class Users
{
    public static function createuser($uname, $pass)
    {
        $db = \DB::get_instance();
        $status = 0;
        $stmt = $db->prepare("INSERT INTO users (uname,pass,status) VALUES (?,?,?)");
        $stmt->execute([$uname, $pass, $status]);
    }
    public static function checkadminreq($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE uname =?");
        $stmt->execute([$uname]);
        $result = $stmt->fetch();
        if (!empty($result))
            return false;
        else
            return true;
    }
    public static function adminreq()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public static function approvedadmin($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM adminreq WHERE uname=?");
        $stmt->execute([$uname]);
        $result = $stmt->fetchAll();
        $stmt = $db->prepare("INSERT INTO users VALUES(?,?,1)");
        $stmt->execute([$uname, $result[0]["pass"]]);
        $stmt = $db->prepare("DELETE FROM adminreq WHERE uname=?");
        $stmt->execute([$uname]);
    }
    public static function disapprovedadmin($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM adminreq WHERE uname=?");
        $stmt->execute([$uname]);
    }
    public static function checkuser($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND uname =?");
        $stmt->execute([$uname]);
        $result = $stmt->fetch();
        if ( !empty($result)) {
            return false;
        } else {
            return true;
        }
    }
    public static function checkadmin($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND uname =?");
        $stmt->execute([$uname]);
        $result = $stmt->fetch();
        if (!empty($result))
            return false;
        else
            return true;
    }
    public static function createadminreq($uname,$hash)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO adminreq VALUES(?,?)");
        $stmt->execute([$uname,$hash]);
    }
}
