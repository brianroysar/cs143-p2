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
inputs and send it over to the server as a URL parameter, read a tutorial on HTML Forms.*/
?>


<h1>Search Page</h1>