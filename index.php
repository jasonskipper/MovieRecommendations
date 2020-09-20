
<?php

$EMAIL_ID = 690327006; // 9-digit integer value (i.e., 123456789)
$API_KEY = "c385e4a"; // API key (string) provided by Open Movie DataBase (i.e$

session_start(); // Connect to the existing session

require_once '/home/common/php/dbInterface.php'; // Add database functionality
require_once '/home/common/php/mail.php'; // Add email functionality
require_once '/home/common/php/p4Functions.php'; // Add Project 4 base functions

processPageRequest(); // Call the processPageRequest() function

// DO NOT REMOVE OR MODIFY THE CODE OR PLACE YOUR CODE ABOVE THIS LINE

function addMovieToCart($imdbID)
{       
    if(movieExistsInDB($imdbID) === 0) {
        $result= file_get_contents('http://www.omdbapi.com/?apikey='.$GLOBALS['API_KEY'].'&i='.$imdbID.'&type=movie&r=json');
        $movieInfo = json_decode($result, true);

        addMovie($movieInfo["imbdID"], $movieInfo["Title"], $movieInfo["Year"],
        $movieInfo["Rated"], $movieInfo["Runtime"], $movieInfo["Genre"],
        $movieInfo["Actors"], $movieInfo["Director"], $movieInfo["Writer"],
        $movieInfo["Plot"], $movieInfo["Poster"]);
    }
    addMovieToShoppingCart($_SESSION["userId"], movieExistsInDB($imdbID));
    displayCart();
}

function displayCart()
{
    getMoviesInCart($_SESSION["userId"]);
    require_once('./templates/cart_form.html');
}

function processPageRequest()
{
    if(!isset($_SESSION["displayName"])) {
        header("Location: ./logon.php");
        die();
    }
    if(empty($_GET['action'])) {
        displayCart();
    } else if($_GET['action'] === "add") {
        addMovieToCart($_GET['imdb_id']);
        displayCart();
    } else if($_GET['action'] === "remove") {
        removeMovieFromCart($_GET['movie_id']);
        displayCart();
    }       
}

function removeMovieFromCart($movieID)
{       
    removeMovieFromShoppingCart($_SESSION["userId"], $movieID);
    displayCart();
}

?>
