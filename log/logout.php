<?php

// Commment for Starting Session
session_start();

// Commment for destroying the sessions
if(session_destroy()) 
{
	// Comment for redirecting to login page when logout is successful
	header("Location: login.php");
}

?>