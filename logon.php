
<?php

$EMAIL_ID = 690327006; // 9-digit integer value (i.e., 123456789)

require_once '/home/common/php/dbInterface.php'; // Add database functionality
require_once '/home/common/php/mail.php'; // Add email functionality
require_once '/home/common/php/p4Functions.php'; // Add Project 4 base functions

processPageRequest(); // Call the processPageRequest() function


function authenticateUser($username, $password) 
{
        if(validateUser($username, $password) != NULL) {
                session_start();
                $_SESSION["userId"] = validateUser($username, $password)[0];
                $_SESSION["displayName"] = validateUser($username, $password)[1];
                $_SESSION["emailAddress"] = validateUser($username, $password)[2];
                return true;
        }
        return false;
        
}

function displayLoginForm($message = "")
{
        require_once("./templates/logon_form.html"); 
}

function processPageRequest()
{
        if(session_status() == PHP_SESSION_ACTIVE)
        {
                session_destroy();
        }
        if(!empty($_POST)) {
                displayLoginForm();
        } 
        if(isset($_POST['action'])) {
                if($_POST['action'] === "login") {
                        authenticateUser($_POST["$username"], $_POST["$password"]);
                        if(authenticateUser($_POST["$username"], $_POST["$password"])) {
                                header("Location: ./index.php");
                                die();
                        } else {
                                displayLoginForm("Error, user not authenticated.");
                        }
                }
        }
}
?>

