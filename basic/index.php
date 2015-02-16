<?php
/* Walking Tracker */
/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
*/
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

include (TEMPLATE_PATH . "/public/header.html");


?>


<div class="container">

    <div class="row">
    <div class="span12">
    
    <h1>Walking Tracker</h1>

<p>Basic Walking Recording.
<ol>
<li>List all walks
<li>Add, Edit, Delete a walk</li>
<li>List Places/Routes</li>
<li>Add, Edit, Delete a route</li>
</ol>
    </p>
    <p>
    <h1>To Do</h1>
    </p>

<p>Some improvements.
<ol>
<li>Add Graphs - Distance, Time, Speed etc.</li>
<li>Add Maps, Pics </li>
<li>Stats</li>
<li>export to csv</li>
<li>Update by phone app </li>
</ol></p>

        
    </div>
    
    
    
    
   
    
    
    </div>
    
    
  
    
    

</div>



<?php include (TEMPLATE_PATH . "/public/footer.html"); ?>