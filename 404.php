<!DOCTYPE html>
<html>
  <?php include "_includes/head.php";?>
  <body>
    <?php include "_includes/header.php"; ?>
    <content class="notfound">

      <div>
        <h1>Oops!</h1>
        <h3>Looks like the page you requested was not found</h3>
        <a href="/">Return Home?</a>
        <error>

          <h5>ERROR: 404</h5>
          <p><?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?> could not be found</p>

        </error>

      </div>
    </content>
  </body>
</html>
