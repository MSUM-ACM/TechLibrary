<?php
$_layout = "page";
$_title = "home";
?>
<div class="sort">
  Sort:
  <select>
    <option>A-Z</option>
    <option>Z-A</option>
    <option>Wait list ^</option>
    <option>Wait list v</option>
  </select>
</div>
<h1>All Inventory</h1>
<?php for ($i=0; $i < 6; $i++) {
  ?>
  <div class="item">
    <div class="img-item">
      <span></span>
    </div>
    <div>
      <h2>Raspberry Pi</h2>
      <h4>B series</h4>
      <p>Wait list: 0</p>
      <p>A Microcomputer capable of running a full linux operating system with programmable Input Output Pins</p>
    </div>
  </div>
  <?php
} ?>
