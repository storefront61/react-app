

<?php
session_start();
include('connection.php');

//get the id of the note sent through Ajax
$id = $_POST['id'];
var_dump($id);
//get the content of the note
$note = $_POST['note'];
var_dump($note);//get the time
$time = time();
var_dump($time);
var_dump($link);
//run a query to update the note
//if values are numbers don't use quotes. strings use letters use single quotes '';
$sql = "UPDATE notes SET note='$note', rtime=$time WHERE id=$id";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error'; 
    echo " error 1 " . mysqli_error($link);  
    echo " error 2 " . mysqli_error($sql);  
}
?>