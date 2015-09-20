<header>
  <container>
  <a href="/"><span id="logo"></span></a>

  <form method="get">
    <input type="textbox" placeholder="Search..." name="SKEY"></input>
    <input class="img-search" type="submit" name="submit" value="submit"></input>
  </form>


  <input type=checkbox id="toggle-nav">
  <nav>
    <label for="toggle-nav" id="menu" class="img-menu"></label>
    <div class="links">
      <div id="close"><label for="toggle-nav" class="img-back"></label></div>
      <div id="profile">
          <a href="/account.php">
            <span><h1>Profile</h1></span>
            <p>John Doe</p>
          </a>
          <input type="checkbox" id="drop-ul">
          <label for="drop-ul" id="submenu" class="img-droparrow"></label>
          <ul>

            <a href="/account.php"><li>Your Profile</li></a>
            <a href="/account.php/?view=checkedout"><li>Checked out</li></a>
            <a href="/account.php/?view=wishlist"><li>Wish List</li></a>
            <a href="/account.php/?view=cart"><li>Cart</li></a>
            <line><h5>User Settings</h5></line>
            <a href="/account.php/?view=settings"><li>Settings</li></a>
            <a href="/signout.php"><li>Sign Out</li></a>
          </ul>
      </div>
      <div id="cart">
        <a href="/account.php/?view=cart">
          <span></span>
          <p>Cart</p>
        </a>
      </div>
    </div>
  </nav>
</container>
</header>
