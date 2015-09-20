<?php
$_layout = "page";
$_title = "notfound";
$_parm = '{ "title": "ERROR: 404" }';
?>

<div>
  <h1>Oops!</h1>
  <h3>Looks like the page you requested was not found</h3>
  <a href="/">Return Home?</a>
  <error>

    <h5>ERROR: 404</h5>
    <p><?php echo $site->url; ?> could not be found</p>

  </error>

</div>
