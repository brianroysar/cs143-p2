<?php
/* Review page review.php: A page that lets users add a review to a movie.

1. When the request URL contains only an id parameter like http://localhost:8888/review.php?id=705,
the page must include input boxes to let the user to input their name, the rating of the movie and
their comment on the movie.

2. When the request contains mid, name, rating and comment parameters, you must insert a row to the
Review table with the provided values. The value for the time column should be the time when the review
is submitted. The returned page from this URL must display “confirmation text” saying that the review has
been successfully added.*/
?>


<h1>Review Page</h1>