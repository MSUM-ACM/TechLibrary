<?php
$site->dataExists();
$title = (isset($page->parm->title)) ? $page->parm->title : $page->title;
if(strcasecmp($title,"home") === 0) $title = "";
$title = (empty(trim($title))) ? $site->data->title : $site->data->title . " | " . $title;

?>
<head>
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="/_css/main.css">
  <link rel="shortcut icon" type="image/png" href="/_img/favicon.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" async="" src="/_js/functions.js"></script>
  <script type="text/javascript" async="" src="/_js/jquery.min.js"></script>
</head>
