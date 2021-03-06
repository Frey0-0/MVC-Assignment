<?php

namespace Model;

class Books
{
    public static function requestBook($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT quantity FROM books WHERE status IS NULL AND name=? ");
        $query->execute([$name]);
        $result =  $query->fetch();
        return $result;
    }

    public static function requestBookInsert($name,$username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO books(name,username,quantity,date,month,year,status) VALUES (?,?,1,null,null,null,?)");
        $query->execute([$name, $username,\Enum\BookStatus::request]);
    }

    public static function requestBookUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
        $query->execute([($quantity - 1), $name]);
    }

    public static function requestBookDelete($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
        $query->execute([$name]);
    }

    public static function returnBook($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET status=? WHERE name=? AND username=?");
        $query->execute([\Enum\BookStatus::return,$name, $username]);
    }
    
    public static function issuedBooks($username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name FROM books WHERE status=? AND username=?");
        $query ->execute([\Enum\BookStatus::issued,$username]);
        $result =  $query ->fetchAll();
        return $result;
    }

    public static function availableBooks()
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,quantity FROM books WHERE status IS NULL");
        $query ->execute();
        $result =  $query ->fetchAll();
        return $result;
    }

    public static function requestedBooks($username)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("SELECT name FROM books WHERE status=? AND username =?");
        $query ->execute([\Enum\BookStatus::request,$username]);
        $result =  $query ->fetchAll();
        return $result;
    }

    public static function rejectedRequests($username)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("SELECT name FROM books WHERE status=? AND username =?");
        $query ->execute([\Enum\BookStatus::rejected,$username]);
        $result =  $query ->fetchAll();
        return $result;
    }
    public static function rejectedRequestsDelete($username)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("DELETE FROM books WHERE status=? AND username =?");
        $query ->execute([\Enum\BookStatus::rejected,$username]);
    }

    public static function addBook($name, $quantity)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("INSERT INTO  books VALUES(?,NULL,?,NULL,NULL,NULL,?)");
        $query ->execute([$name, $quantity,\Enum\BookStatus::available]);
    }

    public static function removeBook($name, $quantity)
    {
        $db = \DB::get_instance();
        $query  = $db->prepare("SELECT name,quantity FROM books WHERE status IS NULL AND name=?");
        $query ->execute([$name]);
        $result =  $query ->fetchAll();
        return $result;
    }

    public static function removeBookUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name =?");
        $query->execute([$quantity, $name]);
    }

    public static function removeBookDelete($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
        $query->execute([$name]);
    }

    public static function approved($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO books VALUES(?,?,1,?,?,?,?)");
        $query->execute([$name, $username, date("d"), date("m"), date("Y"),\Enum\BookStatus::issued]);
    }

    public static function approvedDelete($name,$username){
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM books WHERE name=? AND username=? AND status=? ");
        $query->execute([$name, $username,\Enum\BookStatus::request]);
    }

    public static function disapproved($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,quantity FROM books WHERE status IS NULL AND name=?");
        $query->execute([$name]);
        $result = $query->fetchAll();
        return $result;
    }

    public static function disapprovedUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
        $query->execute([$quantity, $name]);
    }

    public static function disapprovedInsert($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,?)");
        $query->execute([$name,\Enum\BookStatus::available]);
    }

    public static function disapprovedUpdate2($username, $name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET status=? WHERE username=? AND name=? AND status=0");
        $query->execute([\Enum\BookStatus::rejected,$username, $name]);
    }

    public static function approvedReturn($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,quantity FROM books where status IS NULL AND name=?");
        $query->execute([$name]);
        $result = $query->fetchAll();
        return $result;
    }

    public static function approvedReturnInsert($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,?)");
        $query->execute([$name,\Enum\BookStatus::available]);
    }
    public static function approvedReturnUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL and name=?");
        $query->execute([$quantity, $name]);
    }

    public static function approvedReturnDelete($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM books WHERE status=-1 AND name=? AND username=?");
        $query->execute([$name, $username]);
    }

    public static function disapprovedReturn($name, $username)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE books SET status=? WHERE username=? AND name=? AND status=?");
        $query->execute([\Enum\BookStatus::issued,$username, $name,\Enum\BookStatus::return]);
    }

    public static function unavailableBooks()
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,username FROM books WHERE status=?");
        $query->execute([\Enum\BookStatus::issued]);
        $result = $query->fetchAll();
        return $result;
    }

    public static function checkout()
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,username FROM books WHERE status=?");
        $query->execute([\Enum\BookStatus::request]);
        $result = $query->fetchAll();
        return $result;
    }

    public static function checkin()
    {
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT name,username,date,month,year FROM books WHERE status=?");
        $query->execute([\Enum\BookStatus::return]);
        $result = $query->fetchAll();
        return $result;
    }
}
