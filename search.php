<?php

/***************************************************************************
* ONLINE LIBRARY APPLICATION (OLA)               http://ola.sourceforge.net/
* (c) 2004 S. Rawlinson and N. Flear    Licenced under GPL (see licence.txt)
****************************************************************************
* search.php - version 2.1
* - displays search results of the resource table
***************************************************************************/


require_once ("standard.inc.php");

// check variables and url parameters
check_param_empty ();
check_param ("submit");

if (empty ($errormsg)) {
  if ($HTTP_GET_VARS["submit"] == "Search") {
    check_param ("search_type");
    check_param ("search_text");
  }
  else if ($HTTP_GET_VARS["submit"] == "Browse") {
    check_param ("browse_media");
    check_param ("browse_subject");
  }
  else {
    $errormsg .= "Error: Bad url format. Incorrect submit=xxx.<br>";
  }
}

// consult database
if (empty ($errormsg)) {

  // set $pos to form
  $pos = 0;
  if (exists_param ("pos") && $HTTP_GET_VARS["pos"] % ROWS_PER_PAGE == 0) {
    $pos = (int) $HTTP_GET_VARS["pos"];
  }

  $sql = "SELECT * FROM resource ";

  // if Serach
  if ($HTTP_GET_VARS["submit"] == "Search") {
    $sql .= "WHERE ";
    if ($HTTP_GET_VARS["search_type"] == "title") {
      $sql .= "title LIKE '%" . $HTTP_GET_VARS["search_text"] . "%' ";
      $sql .= "ORDER BY title ASC";
    }
    else if ($HTTP_GET_VARS["search_type"] == "author") {
      $sql .= "author LIKE '%" . $HTTP_GET_VARS["search_text"] . "%' ";
      $sql .= "ORDER BY title ASC";
    }

  // if Browse
  }
  else if ($HTTP_GET_VARS["submit"] == "Browse") {
    if ($HTTP_GET_VARS["browse_media"] != "All") {
      $sql .= "WHERE media = '" . $HTTP_GET_VARS["browse_media"] . "' ";
      $sql .= "ORDER BY title ASC";
    }
    else if ($HTTP_GET_VARS["browse_subject"] != "All") {
      $sql .= "WHERE subject = '" . $HTTP_GET_VARS["browse_subject"] . "' ";
      $sql .= "ORDER BY title ASC";
    }
    else {
      $sql .= "ORDER BY subject, title ASC";
    }
  }

  $rs = get_recordset ($sql, ROWS_PER_PAGE, $pos);

  // get Page count for pager index
  $rs2 = get_recordset ($sql);
  if ($rs2) {
    $rs_count = db_rows_returned($rs2);
    $page_count = ceil($rs_count / ROWS_PER_PAGE);
  } else {
    $page_count = 0;
  }

}
if (empty ($errormsg)) {
  $result = db_make_2D_array ($rs);
}


// print page
if (empty ($errormsg)) {
  global $pos;

  $tpl = new FastTemplate ("tpl");
  $tpl->define (array (
      "row" => "search_row.tpl",
      "table" => "search.tpl"));

  while (list ($key, $val) = each ($result)) {

    // define output keys
    $id = $val["resource_id"];
    $media = $val["media"];
    $subject = $val["subject"];
    $title =  $val["title"];
    $author = $val["author"];
    $year = $val["year"];

    // alternate colour in table
    if (0 == ($key % 2)) {
      $row_colour = "type2";  // light grey
    }
    else {
      $row_colour = "type1";  // white
    }

    if ($media == "") $media = "&nbsp;";
    if ($subject == "") $subject = "&nbsp;";
    if ($title == "") $title = "&nbsp;";
    if ($author == "") $author = "&nbsp;";
    if ($year == "") $year = "&nbsp;";

    // url to view
    $view = "href=\"view.php?id=" . $id . "\"";

    $tpl->assign (array (
      "MEDIA" => $media,
      "SUBJECT" => $subject,
      "TITLE" => $title,
      "AUTHOR" => $author,
      "YEAR" => $year,
      "VIEW" => $view,
      "COLOUR" => $row_colour));
    $tpl->parse ("ROWS", ".row");
  }

  // remove the old &pos= from the query string
  // (assumes it is at the end and nothing after it!!)
  if (intval (strpos (getenv ("QUERY_STRING"), "&pos")) != 0) {
    $query = substr (getenv ("QUERY_STRING"), 0,
        strpos (getenv ("QUERY_STRING"), "&pos"));
  }
  else {
    $query = getenv ("QUERY_STRING");
  }

  if ($pos >= ROWS_PER_PAGE) {
    $prev = "<a href=\"search.php?" . $query . "&pos=" . ($pos - ROWS_PER_PAGE) . "\"><<< Previous</a>";
  }
  else {
    $prev = "&nbsp;";
  }

  if (count ($result) == ROWS_PER_PAGE) {
    $next = "<a href=\"search.php?" . $query . "&pos=" . ($pos + ROWS_PER_PAGE) . "\">Next >>></a>";
  }
  else {
    $next = "&nbsp;";
  }

  // generate page_list
  $page_list = "";
  for ($i = 0; $i<$page_count; ++$i) {
     $tmp = $i+1;
     if ($pos == $i*ROWS_PER_PAGE) {
        $page_list .= $tmp . " ";
     } else {
        $page_list .= "<a href=\"search.php?" . $query . "&pos=" . $i*ROWS_PER_PAGE . "\">" . $tmp . "</a> ";
     }
  } 

  $tpl->assign (array ("NEXT" => $next, "PREV" => $prev, "PAGELIST" => $page_list));
  $tpl->parse ("CONTENT", "table");

  $output = $tpl->fetch ("CONTENT");
}
output_html ("Search", $output);

?>