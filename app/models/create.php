<?php

namespace Model;
session_start();

class Create{
    public static function createUser($uname,$pass){
        $db = \DB::get_instance();
        $status=0;
        $stmt = $db->prepare("INSERT INTO users (uname,pass,status) VALUES (?,?,?)");
        $stmt->execute([$uname, $pass, $status]);
    } 
    public static function createAdmin($uname,$pass){
        $db1 = \DB::get_instance();
        $status=1;
        $stmt = $db1->prepare("INSERT INTO users (uname,pass,status) VALUES (?,?,?)");
        $stmt->execute([$uname, $pass, $status]);
    } 
}