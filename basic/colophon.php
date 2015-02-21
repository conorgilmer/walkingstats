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

<p>
<ul>
<li>Bootstrap - www.getbootstrap.com</li>
<li>FPDF - www.fpdf.org</li>
<li>phpMyGraph - http://phpmygraph.abisvmm.nl/</li>
</ul>
    </p>
    <p>
    </p>

<p>Software used
<ul>
<li>VIM - www.vim.org </li>
<li>NetBeans - netbeans.org </li>
</ul></p>



</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>
