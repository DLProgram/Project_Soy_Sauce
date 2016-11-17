<div data-sticky-container>
<!--   <div class="title-bar" data-responsive-toggle="nav-bar" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">Menu</div>
  </div> -->

  <div class="top-bar" id="nav-bar" data-options="marginTop:0;" data-sticky style="width:100%" >
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="menu-text">SS 2016</li>
        <li><a href="index.php">Home</a></li>
        <li><a href="team_stats.php">Team Statistics</a></li>
        
        <?php
        if ($_SESSION['color'] == 'admin'){
          echo "<li>
          <a href='check_data.php'>Check Data</a>
          </li>
          ";
          echo "<li>
            <a href='#'>Match Data</a>
            <ul class='menu'>
              <li>
                <a href='upload_match_data.php'>Upload Data From Computer</a>
              </li>
              <li>
                <a href='get_match_data_from_webpage.php'>Import Data From VEX Via</a>
              </li>
            </ul>
          </li>";
        }
        ?>
      </ul>
    </div>
    <div class="top-bar-right">
      <ul class="menu">
        <li><?php echo isset($_SESSION['login_user']) ? $_SESSION['login_user'] : "Username" ?></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
</div>
