<?php
/* Search page search.php: A page that lets users search for an actor/movie through a keyword search interface.

1. If no parameter is given in the URL, the page must display one or more search boxes to let the user search 
for a movie and for an actor. (For an actor/actress, you should examine first/last name, and for a movie, 
you should examine title.)

2. If (a set of) keyword(s) are provided as the actor parameter of the URL, the page must return the list of 
actors whose first or last name contains the keyword(s). Clicking on each actor must lead to the corresponding 
actor page.

3. If (a set of) keyword(s) are provided as the movie parameter of the URL, the page must return the list of 
movies whose title contains the keyword(s). Clicking on each movie must lead to the corresponding movie page.

4. The search page should support multi-word search, such as “Tom Hanks,” and be case-insensitive.
For multi-word search, interpret space as “AND”. That is, return all actors that contain “Tom” AND “Hanks”
in their first or last name columns. To support case-insensitive search, you can apply the LOWER() function to
both the column (to be searched in) and the string (that you search for).

Note: If you do not know how you can create a “search box” in your page, so that the browser can user 
inputs and send it over to the server as a URL parameter, read a tutorial on HTML Forms. (ALL DONE)*/ 
?>

<h1>Search Page</h1>

<?php
// Connecting to database
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// Using GET
$movie_name = $_GET['movie'];

$actor_name = $_GET['actor'];

if ($movie_name){
    $query = "SELECT * FROM Movie WHERE";
    $split_array = explode(" ", $movie_name);
    $len_array = count($split_array);
    for ($x = 0; $x < $len_array; $x++) {
        $query = $query . " title LIKE '%".$split_array[$x]."%'";
        if ($x != $len_array-1){
            $query = $query . " AND";
        }
    }

    $rs = $db->query($query);

    // Showing the results of query to movie basic information
    print "id, title, year, rating, company<br>";

    while ($row = $rs->fetch_assoc()) { 
        $id = $row['id']; 
        $title = $row['title']; 
        $year = $row['year'];
        $rating = $row['rating'];
        $company = $row['company'];
        echo "<a href='movie.php?id=$id'> $id, $title, $year, $rating, $company </a>";
        print "<br>";
}

}

else if ($actor_name){
    $query = "SELECT * FROM Actor WHERE";
    $split_array = explode(" ", $actor_name);
    $len_array = count($split_array);
    for ($x = 0; $x < $len_array; $x++) {
        $query = $query . " concat(first,last) LIKE '%".$split_array[$x]."%'";
        if ($x != $len_array-1){
            $query = $query . " AND";
        }
    }

    $rs = $db->query($query);

    // Showing the results of query to actor basic information
    print "id, first, last, sex, dob, dod <br>";

    while ($row = $rs->fetch_assoc()) { 
        $id = $row['id']; 
        $first = $row['first']; 
        $last = $row['last'];
        $sex = $row['sex'];
        $dob = $row['dob'];
        $dod = $row['dod'];
        if ($dod == NULL) {
            $dod = "Still Alive";
        }
        echo "<a href='actor.php?id=$id'> $id, $first, $last, $sex, $dob, $dod </a>";
        print "<br>"; 
    }
}

else{
    echo '<h2> SEARCH BY ACTOR/ACRESS NAME </h2> 
    <form action="/search.php">
      <label for="actor">Actor/Actress: </label><br>
      <input type="text" id="actor" name="actor"><br>
      <input type="submit" value="Submit">
    </form>
    
    <h2> SEARCH BY MOVIE NAME </h2> 
    <form action="/search.php">
      <label for="movie">Movie:</label><br>
      <input type="text" id="movie" name="movie"><br>
      <input type="submit" value="Submit">
    </form>';

}

?>




