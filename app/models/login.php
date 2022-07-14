<?php

namespace Model;

 
class Login{
    public static function VerifyClient($username){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=0 AND username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
    public static function VerifyAdmin($username){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE status=1 AND username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
}