<?php
/* Review page review.php: A page that lets users add a review to a movie.

1. When the request URL contains only an id parameter like http://localhost:8888/review.php?id=705,
the page must include input boxes to let the user to input their name, the rating of the movie and
their comment on the movie. (DONE)

2. When the request contains mid, name, rating and comment parameters, you must insert a row to the
Review table with the provided values. The value for the time column should be the time when the review
is submitted. The returned page from this URL must display “confirmation text” saying that the review has
been successfully added. (DONE) */
?>


<h1>Review Page</h1>
<?php
// Connecting to database
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// Using GET to get id field
$id = $_POST['id'];
if ($id == null){
    $id = $_GET['id'];
}
$name = $_POST['name'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$date = date('Y-m-d\Th:i:s', time());

if ($id && $name && $rating && $comment){
    $query = "INSERT INTO Review (name, time, mid, rating, comment)
    VALUES ('$name', '$date', $id, $rating, '$comment')";
    //echo $query;
    $db->query($query);
    $db->commit();
    echo "Thank you for the review!";
}
else {
    print "Leave a review for movie #".$id;
    echo "<form action='review.php' method='post'>
    Name: <input type='text' name='name'><br>
    Rating(numeric): <input type='number' name='rating'><br>
    Comment: <input type='text' name='comment'><br>
    <input type='hidden' name='id' value={$id}><br>
    <input type='submit'>
    </form>";
}
?>
