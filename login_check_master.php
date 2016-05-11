<?php

 session_start();

if(!isset($_SESSION["USERID"]) || $_SESSION["TYPE"]!=="店長"){
  header("Location:logout.php");
  exit;
}

?>
