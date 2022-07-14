<?php

namespace Model;
session_start();

class Books{
    public static function requestbook($name,$uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=? ");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $s=$db->prepare("INSERT INTO books(name,uname,quantity,date,month,year,status) VALUES (?,?,1,null,null,null,0)");
        $s->execute([$name,$uname]);
        if($result["quantity"] >1){
            $s=$db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
            $s->execute([($result["quantity"]  -1 ),$name]);
        }
        else{
            $s=$db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
            $s->execute([$name]);
        }
    }

    public static function returnbook($name,$uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("UPDATE books SET status=-1 WHERE name=? AND uname=?");
        $stmt->execute([$name,$uname]);
        $stmt=$db->prepare("DELETE FROM books WHERE status=1 AND name=? AND uname=?");
        $stmt->execute([$name,$uname]);
    }
    public static function issuedbooks($uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=1 AND uname=?");
        $stmt->execute([$uname]);
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function availablebooks(){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status IS NULL");
        $stmt->execute();
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function requestedbooks($uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=0 AND uname =?");
        $stmt->execute([$uname]);
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function rejectedrequests($uname){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=2 AND uname =?");
        $stmt->execute([$uname]);
        $result=$stmt->fetchAll();
        $stmt= $db->prepare("DELETE FROM books WHERE status=2 AND uname =?");
        $stmt->execute([$uname]);
        return $result;
    }
    public static function addbook($name,$quantity){
        $db = \DB::get_instance();
        $stmt= $db->prepare("INSERT INTO  books VALUES(?,NULL,?,NULL,NULL,NULL,NULL)");
        $stmt->execute([$name,$quantity]);
    }
    public static function removebook($name,$quantity){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result=$stmt->fetchAll();
        if(($result[0]["quantity"])>$quantity){
            $s=$db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name =?");
            $s->execute([($result[0]["quantity"]-$quantity),$name]);
        }
        else{
            $s=$db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
            $s->execute([$name]);
        }
    }
    public static function approved($name,$uname){
        $db = \DB::get_instance();
        $stmt=$db->prepare("INSERT INTO books VALUES(?,?,1,?,?,?,1)");
        $stmt->execute([$name,$uname,date("d"),date("m"),date("Y")]);
        $stmt=$db->prepare("DELETE FROM books WHERE name=? AND uname=? AND status=0 ");
        $stmt->execute([$name,$uname]);
    }
    public static function disapproved($name,$uname){
        $db = \DB::get_instance();
        $stmt=$db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result=$stmt->fetchAll();
        if(isset($result[0])){
            $s=$db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
            $s->execute([($result[0]["quantity"]+1),$name]);   
        }
        else{
            $s=$db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
            $s->execute([$name]);
        }
        $stmt=$db->prepare("UPDATE books SET status=2 WHERE uname=? AND name=? AND status=0");
        $stmt->execute([$uname,$name]);
    }
    public static function approvedreturn($name,$uname){
        $db = \DB::get_instance();
        $stmt=$db->prepare("SELECT * FROM books where status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result=$stmt->fetchAll();
        if(!isset($result[0])){
            $s=$db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
            $s->execute([$name]);
        }
        else{
            $s=$db->prepare("UPDATE books SET quantity=? WHERE status IS NULL and name=?");
            $s->execute([($result[0]["quantity"]+1),$name]);
        }
        $stmt=$db->prepare("DELETE FROM books WHERE status=-1 AND name=? AND uname=?");
        $stmt->execute([$name,$uname]);
    }
    public static function disapprovedreturn($name,$uname){
        $db = \DB::get_instance();
        $stmt=$db->prepare("UPDATE books SET status=1 WHERE uname=? AND name=? AND status=-1");
        $stmt->execute([$uname,$name]);
    }
    public static function unavailablebooks(){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=1");
        $stmt->execute();
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function checkout(){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=0");
        $stmt->execute();
        $result=$stmt->fetchAll();
        return $result;
    }
    public static function checkin(){
        $db = \DB::get_instance();
        $stmt= $db->prepare("SELECT * FROM books WHERE status=-1");
        $stmt->execute();
        $result=$stmt->fetchAll();
        return $result;
    }
}