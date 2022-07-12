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
    public static function showadminreq(){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM admin_eq");
        $stmt->execute();
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function approvedadmin($uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM admin_req WHERE uname=?");
        $stmt->execute([$uname]);
        $result=$stmt->fetchAll();
        $stmt= $db->prepare("INSERT INTO user VALUES(?,?,1");
        $stmt->execute([$uname,$result[0]->pass]);
        $stmt= $db->prepare("DELETE FROM adminreq WHERE uname=?");
        $stmt->execute([$uname]);
    }
    public static function disapprovedadmin($uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("DELETE FROM adminreq WHERE uname=?");
        $stmt->execute([$uname]);
    }
}