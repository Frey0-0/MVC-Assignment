<?php

namespace Model;

class Books
{
    public static function requestBook($name, $username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=? ");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $query = $db->prepare("INSERT INTO books(name,username,quantity,date,month,year,status) VALUES (?,?,1,null,null,null,0)");
        $query->execute([$name, $username]);
        return $result;
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
        $stmt = $db->prepare("UPDATE books SET status=-1 WHERE name=? AND username=?");
        $stmt->execute([$name, $username]);
        $stmt = $db->prepare("DELETE FROM books WHERE status=1 AND name=? AND username=?");
        $stmt->execute([$name, $username]);
    }

    public static function issuedBooks($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=1 AND username=?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public static function availableBooks()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function requestedBooks($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=0 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function rejectedRequests($username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=2 AND username =?");
        $stmt->execute([$username]);
        $result = $stmt->fetchAll();
        $stmt = $db->prepare("DELETE FROM books WHERE status=2 AND username =?");
        $stmt->execute([$username]);
        return $result;
    }

    public static function addBook($name, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO  books VALUES(?,NULL,?,NULL,NULL,NULL,NULL)");
        $stmt->execute([$name, $quantity]);
    }

    public static function removeBook($name, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function removeBookUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query= $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name =?");
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
        $stmt = $db->prepare("INSERT INTO books VALUES(?,?,1,?,?,?,1)");
        $stmt->execute([$name, $username, date("d"), date("m"), date("Y")]);
        $stmt = $db->prepare("DELETE FROM books WHERE name=? AND username=? AND status=0 ");
        $stmt->execute([$name, $username]);
    }

    public static function disapproved($name, $username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function disapprovedUpdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $query= $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
        $query->execute([$quantity, $name]);
    }

    public static function disapprovedInsert($name)
    {
        $db = \DB::get_instance();
        $query= $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
        $query->execute([$name]);
    }

    public static function disapprovedUpdate2($username, $name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET status=2 WHERE username=? AND name=? AND status=0");
        $stmt->execute([$username, $name]);
    }

    public static function approvedReturn($name, $username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books where status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function approvedReturnInsert($name)
    {
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
        $query->execute([$name]);
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
        $stmt = $db->prepare("DELETE FROM books WHERE status=-1 AND name=? AND username=?");
        $stmt->execute([$name, $username]);
    }

    public static function disapprovedReturn($name, $username)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET status=1 WHERE username=? AND name=? AND status=-1");
        $stmt->execute([$username, $name]);
    }

    public static function unavailableBooks()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function checkout()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=0");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function checkin()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=-1");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
