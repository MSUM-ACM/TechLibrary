<?php
$_layout = "default";
?>

<content class='<?php echo (isset($page->title) ? $page->title : "");?> '>
  <?php echo $content;?>
</content>
