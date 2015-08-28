<!DOCTYPE html>
<html>

<?php
ini_set('display_errors', 1);
include "_includes/head.php";
?>

<body>
  <?php include "_includes/header.php";?>
  <content class="home">
    <div class="sort">
      Sort:
      <select>
        <option>A-Z</option>
        <option>Z-A</option>
        <option>Wait list ^</option>
        <option>Wait list v</option>
      </select>
    </div>
    <?php
$section = "All Inventory";
include "_includes/itemlist.php";

?>
  </content>
</body>

</html>
