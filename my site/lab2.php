<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style2.css">
    <script src="JS/newupload.js" defer></script>
    <title>Main page</title>
  </head>
<body vlink="#FFFFF0" link="#ffffff" alink="#FF4500" onload="upload()">
  <div class="hat">
    <?php $page_id = 1; ?>
    <?php session_start(); ?>
    <a  href="lab2.php">Electric cars</a>
    <?php if (isset($_SESSION['logedin'])):?>
      <button onclick="location.href='exit.php'" class="loginbtn" >Logout</button>
      <button onclick="document.getElementById('id02').style.display='block'" class="loginbtn" >My form</button>
    <?php else: ?>
      <button onclick="document.getElementById('id01').style.display='block'" class="loginbtn" >Login</button>
    <?php endif; ?>
    <?php if (isset($_SESSION['admin'])):?>
      <button onclick="document.getElementById('id03').style.display='block'" class="loginbtn" >My admin</button>
    <?php endif; ?>
    <!-- Button to open the modal login form -->
    <!--<button onclick="document.getElementById('id01').style.display='block'" class="loginbtn" >Login</button>-->
    <!-- The Modal -->

    <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'"
    class="close" title="Close Modal">&times;</span>

      <!-- Modal Content -->
      <form class="modal-content animate" action="login.php" method="post">
        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" <?php if(isset($_COOKIE['remember'])){echo 'value='.$_COOKIE['remember'];} ?> required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="loginpsw" required>

          <button type="submit">Login</button>
          <label>
            <input type="hidden" checked="checked" value="0" name="remember">
            <input type="checkbox" checked="checked" value="1" name="remember"> Remember me
          </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <span class="psw">Forgot password?</span>
        </div>
        <div class="container">
          <button type="button" onclick="document.location='registrationpage.php'" name="button">Registrate</button>
        </div>
      </form>
    </div>
    <div id="id02" class="modal">
      <span onclick="document.getElementById('id02').style.display='none'"
    class="close" title="Close Modal">&times;</span>

      <!-- Modal Content -->
      <form class="modal-content animate">
        <div class="container">
          <p>Your username is <?php echo $_SESSION['logedin'] ?></p>
        </div>
      </form>

    </div>

    <div id="id03" class="modal">
      <span onclick="document.getElementById('id03').style.display='none'"
    class="close" title="Close Modal">&times;</span>

      <!-- Modal Content -->
        <div class="container">
          <button onclick="document.location='checkcoments.php'" class="signupbtn" >New comments</button></br>
          <button onclick="document.location='banedusers.php'" class="signupbtn" >Baned users</button></br>
          <button onclick="document.location='newadmin.php'" class="signupbtn" >New admin</button></br>
          <button onclick="document.location='addcar.php'" class="signupbtn" >New car</button></br>
        </div>

    </div>


  </div>
<!--Line which responsible for search and filter options-->
<div class="controls">
  <!--Line with buttons responsible for type of cars-->
  <div class="sortline">
    <label for="ct">Car type:</label>
    <select id="ct" class="Select-Type" name="Type" onchange="filter()">
      <option value="All">All</option>
      <option value="Hatchback">Hatchback</option>
      <option value="Sedan">Sedan</option>
      <option value="MPV">MPV</option>
      <option value="SUV">SUV</option>
      <option value="Crossover">Crossover</option>
      <option value="Coupe">Coupe</option>
      <option value="Convertible">Convertible</option>
    </select>
    <label for="cm">Car model:</label>
    <select id="cm" class="Select-Model" name="Model" onchange="filter()">
      <option value="All">All</option>
      <option value="Tesla">Tesla</option>
      <option value="BMW">BMW</option>
      <option value="Audi">Audi</option>
      <option value="Nissan">Nissan</option>
      <option value="Jaguar">Jaguar</option>
      <option value="Mercedes">Mercedes</option>
    </select>
      <!--<label>Type:</label>
      <button class="filter" >All</button>
      <button class="filter" >Hatchback</button>
      <button class="filter" >Sedan</button>
      <button class="filter" >MPV</button>
      <button class="filter" >SUV</button>
      <button class="filter" >Crossover</button>
      <button class="filter" >Coupe</button>
      <button class="filter" >Convertible</button>
      <br />  <br />
    </div>-->
      <!--Line with buttons responsible for cars brands-->
    <!--<div class="sortline">
      <label>Model:</label>
      <button class="filter" id="Allfilter">All</button>
      <button class="filter" id="Audifilter">Audi</button>
      <button class="filter" id="BMWfilter" >BMW</button>
      <button class="filter" id="Mercedesfilter">Mercedes</button>
      <br />  <br />
    </div>-->
  <!--Form with searchline-->
  <form class="searchlane" onsubmit="return false" align="top">
    <input type="search"  onkeydown="if(event.keyCode == 13){search()}" id="Searchline" name="srch" placeholder="Search" align="right">
    <input onclick="search()" type="button" id="Searchbutton" value="GO" >
    <input onclick="showall()" type="button" id="Showallbutton" value="Show all" >
  </form>
</div>
<?php if(isset($_COOKIE['registred'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">Users with this name is already exists</div>');
      }
      if(isset($_COOKIE['wronguser'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">Wrong username or password</div>');
      }
      if(isset($_COOKIE['exemail'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">Users with this email is already exists</div>');
      }
      if(isset($_COOKIE['wasregistred'])){
        echo('<div align="center"  style="font-size:20pt; background-color:green; margin: 8px 2px">You were registred</div>');
      }
      if(isset($_COOKIE['userinvalid'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">Wrong symbols in your username' . '</div>');
      }
      if(isset($_COOKIE['emailinvalid'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">Very strange email' .'</div>');
      }
      if(isset($_COOKIE['passwordilinvalid'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">You hadnt repeat the password' .'</div>');
      }
      if(isset($_COOKIE['ban'])){
        echo('<div align="center"  style="font-size:20pt; background-color:red; margin: 8px 2px">You are banned till ' . $_COOKIE['ban'] . '</div>');
      }
?>
<!-- Flexbox with links for pages with cars-->
<div id="cars" class="Cars"><div id="p_prldr"><div class="contpre"></div></div></div>
<div class="downlane">
  Contacts 2019
</div>
  </body>
</html>
