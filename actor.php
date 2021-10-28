<?php
/* Actor page actor.php: A page that shows an actor information.

1. This page must take the actor id as the id parameter of the request URL 
and display the corresponding actor’s information, including their name and 
the movies that they were in. For example, the URL http://localhost:8888/actor.php?id=4033 
must display the information on Ms. Drew Barrymore. (DONE)

Note: Any name=value pair appearing after ? in the URL (e.g., id=4033 
in http://localhost:8888/actor.php?id=4033) is available as $_GET['name'] (e.g., _GET['id']) 
in your PHP code. 

2. For every movie that the actor was in, the actor page must include a hyperlink to the corresponding 
“movie page” described next. (DONE)

*/ 
?>

<h1>Actor Page</h1>

<?php

// Connecting to database
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// Using GET to identify which actor we want information on
$actor_id = $_GET['id'];
// Query to get information on the specific actor
$query = "SELECT * FROM Actor WHERE id ='".$actor_id."'";

// Making the query
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
print "<br>";

// Getting the information relating to the movies that the actor has played in
print "Movies that actor is in: ";
print "<br>";

$query = "SELECT * 
FROM (SELECT * 
FROM Actor as A, MovieActor as MA 
WHERE id ='".$actor_id."' and A.id = MA.aid) as temp, Movie as M 
WHERE temp.mid = M.id";

$rs = $db->query($query);

while ($row = $rs->fetch_assoc()) { 
    $mid = $row['mid']; 
    $title = $row['title']; 
    echo "<a href='movie.php?id=$mid'> $mid, $title </a>";
    print "<br>"; 
}

?>
