<?php

namespace Model;

class Books
{
    public static function requestbook($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=? ");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $s = $db->prepare("INSERT INTO books(name,uname,quantity,date,month,year,status) VALUES (?,?,1,null,null,null,0)");
        $s->execute([$name, $uname]);
        return $result;
    }

    public static function requestbookupdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
        $s->execute([($quantity - 1), $name]);
    }

    public static function requestbookdelete($name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
        $s->execute([$name]);
    }

    public static function returnbook($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET status=-1 WHERE name=? AND uname=?");
        $stmt->execute([$name, $uname]);
        $stmt = $db->prepare("DELETE FROM books WHERE status=1 AND name=? AND uname=?");
        $stmt->execute([$name, $uname]);
    }

    public static function issuedbooks($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=1 AND uname=?");
        $stmt->execute([$uname]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public static function availablebooks()
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function requestedbooks($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=0 AND uname =?");
        $stmt->execute([$uname]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function rejectedrequests($uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status=2 AND uname =?");
        $stmt->execute([$uname]);
        $result = $stmt->fetchAll();
        $stmt = $db->prepare("DELETE FROM books WHERE status=2 AND uname =?");
        $stmt->execute([$uname]);
        return $result;
    }

    public static function addbook($name, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO  books VALUES(?,NULL,?,NULL,NULL,NULL,NULL)");
        $stmt->execute([$name, $quantity]);
    }

    public static function removebook($name, $quantity)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function removebookupdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name =?");
        $s->execute([$quantity, $name]);
    }

    public static function removebookdelete($name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("DELETE FROM books WHERE status IS NULL AND name=?");
        $s->execute([$name]);
    }

    public static function approved($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO books VALUES(?,?,1,?,?,?,1)");
        $stmt->execute([$name, $uname, date("d"), date("m"), date("Y")]);
        $stmt = $db->prepare("DELETE FROM books WHERE name=? AND uname=? AND status=0 ");
        $stmt->execute([$name, $uname]);
    }

    public static function disapproved($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function disapprovedupdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL AND name=?");
        $s->execute([$quantity, $name]);
    }

    public static function disapprovedinsert($name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
        $s->execute([$name]);
    }

    public static function disapprovedupdate2($uname, $name)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET status=2 WHERE uname=? AND name=? AND status=0");
        $stmt->execute([$uname, $name]);
    }

    public static function approvedreturn($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books where status IS NULL AND name=?");
        $stmt->execute([$name]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public static function approvedreturninsert($name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("INSERT INTO books VALUES(?,NULL,1,NULL,NULL,NULL,NULL)");
        $s->execute([$name]);
    }
    public static function approvedreturnupdate($quantity, $name)
    {
        $db = \DB::get_instance();
        $s = $db->prepare("UPDATE books SET quantity=? WHERE status IS NULL and name=?");
        $s->execute([$quantity, $name]);
    }

    public static function approvedreturndelete($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM books WHERE status=-1 AND name=? AND uname=?");
        $stmt->execute([$name, $uname]);
    }

    public static function disapprovedreturn($name, $uname)
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET status=1 WHERE uname=? AND name=? AND status=-1");
        $stmt->execute([$uname, $name]);
    }

    public static function unavailablebooks()
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
