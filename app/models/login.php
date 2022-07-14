<?php

namespace Model;

 
class LogIn{
    public static function verifyClient($username){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function verifyAdmin($username){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
}