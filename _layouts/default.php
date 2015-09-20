<!DOCTYPE html>
<html>
  <?php echo $site->import("head",$page);?>
  <body>
    <div id="wrapper">
      <?php echo $site->import("header");?>
      <?php echo $content;?>
    </div>
    <?php echo $site->import("footer"); ?>
  </body>
</html>
