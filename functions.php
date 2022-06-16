<?php
require_once ('config.php');

function db_connect($user,$pass){

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=timetracking', $user, $pass);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return $dbh;
}
function get_tasks_list(){
    $dbh = db_connect(user,pass);
    $stmt = $dbh->prepare("SELECT * FROM tasks");

    $stmt->execute();

    return $rows = $stmt->fetchAll();
}
function edit_task($tasks_id, $name, $duration, $date ){
    $dbh = db_connect(user,pass);

    try {
        $stmt = $dbh->prepare("UPDATE tasks SET  name = '" . $name . "', duration = '" . $duration . "', date = '" . $date . "' WHERE tasks_id =" . $tasks_id);
        $stmt->execute();
        return "1";
    }catch (Exception $e){
        return $e->getMessage();
    }


}
function add_task($name, $duration, $date ){
    $dbh = db_connect(user,pass);

    try {
        $stmt = $dbh->prepare("INSERT INTO tasks (name, duration, date) VALUES (:Name, :Duration, :Date)");

        $stmt->bindParam(':Name', $name);
        $stmt->bindParam(':Duration', $duration);
        $stmt->bindParam(':Date', $date);

        $stmt->execute();
        return "1";
    }catch (Exception $e){
        return $e->getMessage();
    }


}
function delete_task( $tasks_id ){
    $dbh = db_connect(user,pass);

    try {
        $stmt = $dbh->prepare("DELETE FROM tasks WHERE Id= ".$tasks_id);
        $stmt->execute();
        return "1";
    }catch (Exception $e){
        return $e->getMessage();
    }
}