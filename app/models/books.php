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
        if($result->quantity >1){
            $s=$db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
            $s->execute([($result->quantity -1 ),$name]);
        }
        else{
            $s=$db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
            $s->execute([$name]);
        }
    }
}