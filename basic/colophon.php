<?php
session_start();

/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

include_once(APPLICATION_PATH . "/inc/session.inc.php");


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

//Set up variable so 'active' class set on navbar link
$activeHome = "active";

include (TEMPLATE_PATH . "/header.html");

?>
<div class="container">
<div class="row">
<div class="span12">
<h1>Colophon - technologies and tools used</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<p>Technologies used
<ul>
<li>PHP - <a target="_blank" href="http://www.php.net">www.php.net</a></li>
<li>MySql - <a target="_blank" href="http://www.mysql.org">www.mysql.org</a></li>
<li>Bootstrap - <a target="_blank" href="http://www.getbootstrap.com">www.getboostrap.com</a></li>
<li>FPDF - <a target="_blank" href="http://www.fpdf.org">www.fpdf.org</a></li>
<li>phpMyGraph - <a target="_blank" href="http://phpmygraph.abisvmm.nl/">phpmygraph.abisvmm.nl</a></li>
</ul>
    </p>
    <p>
    </p>

<p>Tools used
<ul>
<li>VIM - <a target="_blank" href="http://www.vim.org">www.vim.org</a></li>
<li>NetBeans - <a target="_blank" href="https://netbeans.org">netbeans.org</a></li>
<li>phpMyADmin - <a target="_blank" href="http://www.phpmyadmin.net">www.phpmyadmin.net</a></li>
<li>Apache webserver - <a target="_blank" href="http://www.apache.org">www.apache.org</a></li>
<li>XAMPP - <a target="_blank" href="https://www.apachefriends.org/index.html">https://www.apachefriends.org/index.html</a></li>
</ul></p>



</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>
