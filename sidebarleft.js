document.write(/*html*/`
<!-- Sidebar left -->
  <nav id="sidebarleft" class="sidenav">
  <div id="dismiss">
    <i class="fas fa-times"></i>
  </div>
  <div class="sidebar-header">
    <h3>Account</h3>
  </div>
  <div class="sdprofile">
    <div class="sdp-left">
      <img src="img/profile5.jpg" alt="profile">
    </div>
    <div class="sdp-right">
      <div class="sd-name">Sarah Corner</div>
      <div class="sd-status">Exclusive Author</div>
    </div>
  </div>
  <ul class="list-unstyled components">
    <li>
      <a href="homepage.php"><i class="fas fa-home"></i> Home</a>
    </li>
    <li>
      <a href="#pagemyaccount" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user"></i> My Account <span><i class="fas fa-caret-down"></i></span></a>
      <ul class="collapse collapsible-body" id="pagemyaccount">
        <li>
          <a href="new_recipe.html">Add new recipe</a>
        </li>
        <li>
          <a href="profile.html">Profile</a>
        </li>

        <li>
          <a href="setting.html">Setting</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#pagesubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-clone"></i> Pages <span><i class="fas fa-caret-down"></i></span></a>
      <ul class="collapse collapsible-body" id="pagesubmenu">
        <li>
          <a href="recipe_list.html">Recipe list</a>
        </li>
        <li>
          <a href="recipe_page.html">Recipe page</a>
        </li> 
         <li>
          <a href="news_list.html">News list</a>
        </li>
        <li>
          <a href="news.html">News Page</a>
        </li>
        <li>
          <a href="register.html">Register</a>
        </li>
        <li>
          <a href="login.html">Login</a>
        </li>
        <li>
          <a href="new_recipe.html">New recipe</a>
        </li>
        <li>
          <a href="profile.html">Profile</a> 
        </li>
      </ul>
    </li>
    <li>
      <a href="favorite.html"><i class="fas fa-heart"></i> Favorites</a>
    </li>
    <li>
      <a href="#"><i class="fas fa-star"></i> Rate</a>
    </li>
    <li>
      <a href="feedback.html"><i class="fas fa-envelope"></i> Feedback</a>
    </li>
    <li>
      <a href="setting.html"><i class="fas fa-cog"></i> Settings</a>
    </li>
  </ul>
  </nav>
  <!-- .Sidebar left -->
  `);