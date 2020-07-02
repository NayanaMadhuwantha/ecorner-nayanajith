<?php


session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: a_signin.php"); // Redirecting To Home Page
}
?>