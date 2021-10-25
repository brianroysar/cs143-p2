<?php
/* Movie page movie.php: A page that shows a movie information based on the movie id 
provided as the id parameter of the URL. 
For example, the URL http://localhost:8888/movie.php?id=705 must display the information 
on the movie “Charlies Angels.” This page must

1. Show hyperlinks to the actor pages for each actor that was in this movie.
2. Show the average score of the movie based on the user feedback.
3. Show all user comments, including the reviewer’s name, rating, comments and the time it was provided.
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



?>