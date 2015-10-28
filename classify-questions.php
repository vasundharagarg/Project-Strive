<?php
//CODE TO PROVIDE AN INTERFACE TO THE TEACHER TO CLASSIFY QUESTIONS IN THE QUESTION PAPER ALREADY UPLOADED IN THE index.php file
session_start();

$filename = $_SESSION['filename'];
$quant_topic = $_SESSION['quant_topic'];
$reasoning_topic = $_SESSION['reasoning_topic'];
$verbal_topic = $_SESSION['verbal_topic'];

echo $filename;
echo $quant_topic;
echo $reasoning_topic;
echo $verbal_topic;


?>
