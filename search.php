
<?php

$API_KEY = "c385e4a"; // API key (string) provided by Open Movie DataBase (i.e$

session_start(); // Connect to the existing session

processPageRequest(); // Call the processPageRequest() function

function displaySearchForm()
{
    require_once("./templates/search_form.html");
}

function displaySearchResults($searchString)
{       
    $results = file_get_contents('http://www.omdbapi.com/?apikey='.$GLOBALS['API_KEY'].'&s='.urlencode($searchString).'&type=movie&r=json');
    $resultsArray = json_decode($results, true)["Search"];
    require_once("./templates/results_form.html");
}
function processPageRequest()
{
    if(!isset($_SESSION["displayName"])) {
        header("Location: ./logon.php");
        die();
    }
    if(empty($_POST) || !isset($_POST['keyword'])) {
        displaySearchForm();
    } else if(!empty($_POST) && isset($_POST['keyword'])) {
        displaySearchResults($_POST['keyword']);
    }
}
?>
