<?php
$user="root";
$pass="";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tusmo', $user, $pass);
    try{
        $stmt = $dbh->prepare("select * from user");
        $stmt->execute();
    }
    catch(PDOException $e){
        $stmt = $dbh->prepare("CREATE table user (
            id int not null auto_increment,
            pseudo varchar(255) not null,
            email varchar(255) not null,
            password varchar(255) not null,
            level int not null,
            primary key (id)
        )");
        $stmt->execute();
    }

    try{
        $stmt = $dbh->prepare("select * from admin");
        $stmt->execute();
    }
    catch(PDOException $e){
        $stmt = $dbh->prepare("create table admin(
            id int not null auto_increment,
            pseudo varchar(255) not null,
            email varchar(255) not null,
            password varchar(255) not null,
            primary key (id)
        )");
        $stmt->execute();
    }

    try{
        $stmt = $dbh->prepare("select * from word");
        $stmt->execute();
    }
    catch(PDOException $e){
            $stmt = $dbh->prepare("create table word (
                id int not null auto_increment,
                word varchar(255) not null,
                difficulte int not null,
                primary key (id)
            )");
            $stmt->execute();
    }
    
} catch (PDOException $e) {
    try{
        $dbh = new PDO('mysql:host=localhost', $user, $pass);
        $stmt = $dbh->prepare("CREATE DATABASE tusmo");
        $stmt->execute();
        $dbh = new PDO('mysql:host=localhost;dbname=tusmo', $user, $pass);
        $stmt = $dbh->prepare("CREATE table user (
            id int not null auto_increment,
            pseudo varchar(255) not null,
            email varchar(255) not null,
            password varchar(255) not null,
            level int not null,
            primary key (id)
        )");
        $stmt->execute();
        $stmt = $dbh->prepare("create table admin(
            id int not null auto_increment,
            pseudo varchar(255) not null,
            email varchar(255) not null,
            password varchar(255) not null,
            primary key (id)
        )");
        $stmt->execute();
        $stmt = $dbh->prepare("create table word (
            id int not null auto_increment,
            word varchar(255) not null,
            difficulte int not null,
            primary key (id)
        )");
        $stmt->execute();
    }
    catch(PDOException $e){
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>
