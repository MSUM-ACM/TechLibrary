<?php
$_layout="page";
$_title="Login";
 ?>

 <form method="post" action="<?php echo $site->url; ?>">
   <h1>Sign in</h1>
   <input type="textbox" name="Username" autofocus="true" placeholder="username...">
   <input type="password" name="Username" autofocus="true" placeholder="password...">
   <input type="submit" name="login" value="login">
   <a href="#">Don't have an account?</a>
 </form>
