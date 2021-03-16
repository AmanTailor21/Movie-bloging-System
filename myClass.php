<?php

class myClass
{
    private $con;

    function __construct()
    {
        $this->con = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    }

    function insert($n, $e, $p)
    {
        $query = "insert into register(name,email,password) values(:V1,:V2,:V3)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $n);
        $register->bindParam(":V2", $e);
        $register->bindParam(":V3", $p);
        $f = $register->execute();
        return $f;
    }

    function login($a, $b)
    {
        $q = "select * from register where email=:V3 and password=:V4";
        $login = $this->con->prepare($q);
        $login->bindParam(':V3', $a);
        $login->bindParam(':V4', $b);
        $f = $login->execute();
        $val = $login->fetch();
        if (!empty($_REQUEST["rememberme"])) {
            setcookie("email", $a, time() + (86400 * 30), "/");
            setcookie("password", $b, time() + (86400 * 30), "/");
        } else {

        }
        return $val;

    }

    function addblog($n, $t, $c, $i)
    {

        $query = "insert into addblog(m_name,m_title,m_contain,m_img,user_id,user_name) values(:V1,:V2,:V3,:V4,:V5,:V6)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $n);
        $register->bindParam(":V2", $t);
        $register->bindParam(":V3", $c);
        $register->bindParam(":V4", $i);
        $register->bindParam(":V5", $_SESSION['id']);
        $register->bindParam(":V6", $_SESSION['name']);
        $f = $register->execute();
        return $f;
    }

    function show()
    {
        $query = "select * from addblog LIMIT 8";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function loadmore($id)
    {
        $query= $qry = "select * from addblog LIMIT 8 OFFSET $id";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function count()
    {
        $query="select COUNT(m_id) from addblog";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }

    function showmovie($id)
    {
        $query = "select * from addblog where m_id='$id'";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }

    function showmyblog($id)
    {
        $query = "select * from addblog where user_id='$id'";
        $book = $this->con->prepare($query);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }

    function fetch($i)
    {
        $query = "select * from addblog where m_id=:V1";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $i);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }

    function update($i, $n, $t, $c, $x)
    {
        $query = "update addblog set m_name=:V1,m_title=:V2,m_contain=:V3,m_img=:V4 where m_id=:V5";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $n);
        $book->bindParam(":V2", $t);
        $book->bindParam(":V3", $c);
        $book->bindParam(":V4", $x);
        $book->bindParam(":V5", $i);
        $f = $book->execute();
        return $f;

    }

    function delete($d)
    {
        $query = "delete from addblog where m_id=$d";
        $book = $this->con->prepare($query);
        $c = $book->execute();
        return $c;
    }

    function email($f)
    {
        $result = "SELECT * FROM register where email=:V1";
        $book = $this->con->prepare($result);
        $book->bindParam(":V1", $f);
        $book->execute();
        $row = $book->fetchAll();
        return $row;
    }

    function comment($c, $n, $m)
    {
        $query = "insert into comment(c_replay,id,m_id) values(:V1,:V2,:V3)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $c);
        $register->bindParam(":V2", $n);
        $register->bindParam(":V3", $m);
        $comment = $register->execute();
        return $comment;
    }
    function reply_comment($reply, $m_id,$c_id,$user_id)
    {
        $query = "insert into reply_comment(reply,movie_id,comment_id,user_id) values(:V1,:V2,:V3,:V4)";
        $register = $this->con->prepare($query);
        $register->bindParam(":V1", $reply);
        $register->bindParam(":V2", $m_id);
        $register->bindParam(":V3", $c_id);
        $register->bindParam(":V4", $user_id);
        $comment = $register->execute();
        return $comment;
    }


    function getcomment($i)
    {
        $query = "select * from comment where m_id=:V1";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $i);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }
    function getcomment_reply($i)
    {
        $query = "select * from reply_comment where comment_id=:V1";
        $book = $this->con->prepare($query);
        $book->bindParam(":V1", $i);
        $book->execute();
        $all = $book->fetchAll();
        return $all;
    }

    function insertlike($a, $b, $c)
    {
        $qry = "insert into like_counte (user_id,m_id,total_like) values (:V1,:V2,:V3)";
        $stmt = $this->con->prepare($qry);
        $stmt->bindParam(':V1', $a);
        $stmt->bindParam(':V2', $b);
        $stmt->bindParam(':V3', $c);
        try {
            $r = $stmt->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

        return $r;

    }

    function fetchlike($a)
    {
        $qry = "select * from like_counte where m_id=:a";
        $stmt = $this->con->prepare($qry);
        $stmt->bindparam(':a', $a);
        try {
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $stmt->execute();
            $f = $stmt->fetchall();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $f;
    }

    function deletelike($a, $b)
    {
        $qry = "delete from like_counte where user_id=:a and m_id=:b";
        $stmt = $this->con->prepare($qry);
        $stmt->bindparam(':a', $a);
        $stmt->bindparam(':b', $b);
        $r = $stmt->execute();
        return $r;
    }

    function likecounter($a)
    {
        $qry = "select sum(total_like) from like_counte where m_id=:V1";
        $stmt = $this->con->prepare($qry);
        $stmt->bindparam(':V1', $a);
        $stmt->execute();
        $all = $stmt->fetch();
        return $all;
    }
    function glike($a,$b)
    {
        $getData = "select * from like_counte where user_id=:uid and m_id=:mid";
        $stmt = $this->con->prepare($getData);
        $stmt->bindParam(":uid", $a);
        $stmt->bindParam(":mid", $b);
        $stmt->execute();
        $all = $stmt->rowCount();
        return $all;
    }

}

