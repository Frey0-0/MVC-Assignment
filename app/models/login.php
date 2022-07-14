<?php

namespace Model;

 
class Login{
    public static function verifyClient($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND uname=?");
        $stmt->execute([$uname]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function verifyAdmin($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND uname=?");
        $stmt->execute([$uname]);
        $result = $stmt->fetch();
        return $result;
    }
}