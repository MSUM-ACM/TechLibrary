<?php

/***************************************************************************
* ONLINE LIBRARY APPLICATION (OLA)               http://ola.sourceforge.net/
* (c) 2004 S. Rawlinson and N. Flear    Licenced under GPL (see licence.txt)
****************************************************************************
* index.php - version 2.1
* - the main entry point for the program
***************************************************************************/


require_once ("standard.inc.php");

// check variables and url parameters

// decide which (help/welcome) page to serve by default
// based on the type of user
if (is_admin ()) {
  $page = "help_librarian.tpl";
  $title = "Volunteer Help";
}
else {
  $page = "help_welcome.tpl";
  $title = "Welcome";
}

// override which page to serve
// based on the 'action' parameter, if present
if (exists_param ("action")) {
  if ($HTTP_GET_VARS["action"] == "welcome") {
    $page = "help_welcome.tpl";
    $title = "Welcome";
  }
  else if ($HTTP_GET_VARS["action"] == "help") {
    $page = "help_general.tpl";
    $title = "Help";
  }
  else if ($HTTP_GET_VARS["action"] == "login") {
    $page = "login.tpl";
    $title = "Login";
  }
  else if ($HTTP_GET_VARS["action"] == "lib") {
    $page = "help_librarian.tpl";
    $title = "Volunteer Help";
  }
}

// print page
$list = array ("EMPTY" => "");
$output = simple_tpl ($page, $list);
output_html ($title, $output);

?>
