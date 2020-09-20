
function displayMovieInformation(movie_id)
{
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
                document.getElementById("modalWindowContent").innerHTML = this.$
                showModalWindow();
                };
        request.open("GET", "./movieinfo.php?movie_id=" + movie_id, true);
        request.send();
}

function forgotPassword()
{
        window.location.replace("./logon.php?action=forgot");
}

function showModalWindow()
{
    var modal = document.getElementById('modalWindow');
    var span = document.getElementsByClassName("_close")[0];

    span.onclick = function() 
    { 
        modal.style.display = "none";
    }

    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
 
    modal.style.display = "block";
}


function addMovie(imdbID)
{
    window.location.replace("./index.php?action=add&imdb_id=" + imdbID);     
}

function confirmCancel()
{
    if(!confirm("Return to shopping cart?")) {
        return false;
    } else {
        window.location.replace("./index.php");
    }
}

function confirmCheckout()
{
    if(!confirm("Checkout from shopping cart?")) {
        return false;
    } else {
        window.location.replace("./index.php?action=checkout");
    }
        
}


function confirmLogout()
{
    if(!confirm("Log out of shopping cart?")) {
        return false;
    } else {
        window.location.replace("./logon.php?action=logoff");
    }      
}

function confirmRemove(title, movieID)
{
    if(!confirm("Remove ${title} from shopping cart?")) {
        return false;
    } else {
        window.location.replace("./index.php?action=remove&movie_id=" + movieID);
    }      
}
