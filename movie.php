<?php
/* Movie page movie.php: A page that shows a movie information based on the movie id 
provided as the id parameter of the URL. 
For example, the URL http://localhost:8888/movie.php?id=705 must display the information 
on the movie “Charlies Angels.” This page must

1. Show hyperlinks to the actor pages for each actor that was in this movie. (DONE)
2. Show the average score of the movie based on the user feedback. (DONE)
3. Show all user comments, including the reviewer’s name, rating, comments and the time it was provided. (DONE)
4. Contain an “add Comment” link/button, which links to the movie’s review page described below. */
?>

<h1>Movie Page</h1>

<?php

// Connecting to database
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// Using GET to identify which movie we want information on
$movie_id = $_GET['id'];

// Query to get information on the specific actor
$query = "SELECT * FROM Movie WHERE id ='".$movie_id."'";

// Making the movie name the query 
$movie_name = $_GET['movie'];
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
    // echo $query;
    // print "<br>";
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
    print "$id, $title, $year, $rating, $company<br>";
}

print "<br>";

if ($movie_id){
    // Showing the average score of the movie based on user review
$query = "SELECT AVG(R.rating) as avg_rating FROM Movie as M, Review as R WHERE id ='".$movie_id."' and M.id = R.mid";
$rs = $db->query($query);

while ($row = $rs->fetch_assoc()) { 
    $avg = $row['avg_rating']; 
    print "average rating: $avg <br>";
}

// Showing all user comments, including the reviewer’s name, rating, comments and the time it was provided.
$query = "SELECT * FROM Review WHERE mid = '".$movie_id."'";
$rs = $db->query($query);

print "Reviews: <br>";

while ($row = $rs->fetch_assoc()) { 
    $name = $row['name']; 
    $time = $row['time']; 
    $rating = $row['rating'];
    $comment = $row['comment'];
    print "Reviewer Name: $name, Time of Review: $time, Rating: $rating, Comment: $comment<br>"; 
}

// Showing the actors that are in the movie chosen
print "Actors that are in the movie:";
print "<br>";

$query = "SELECT * 
FROM Actor as A, MovieActor as MA 
WHERE MA.mid ='".$movie_id."' and A.id = MA.aid";
$rs = $db->query($query);

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



?>