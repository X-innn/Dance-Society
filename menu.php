<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Event</title>
</head>
<style>
  * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
  }

  body {
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
    background-color:#e6e6fa;
  }

  label.logo {
    color: #ff6347;
    font-size: 40px;
    line-height: 80px;
    padding: 0 100px;
    font-weight: bold;
  }

  .menu-bar {
    background: #00bfff;
    text-align: center;
  }

  .menu-bar ul {
    display: inline-flex;
    list-style: none;
    color: blue;
  }

  .menu-bar ul li {
    width: 120px;
    margin: 15px;
    padding: 15px;
  }

  .event{
    background-color:grey;
  }

  .menu-bar ul li a {
    text-decoration: none;
    color: blue;
  }

  .menu-bar{
    background-color:#00bfff;
  }
  
  .menu-bar ul li a:hover {
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .eventpage{
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .menu-bar .fa {
    margin-right: 8px;
  }

  .sub-menu-1 {
    display: none;
  }
  li:hover{
    background: rgb(213, 243, 95);
    border-radius: 3px;
  }

  .menu-bar ul li:hover .sub-menu-1 {
    display: block;
    position: absolute;
    background: rgb(213, 243, 95);
    margin-top: 15px;
    margin-left: -15px;
  }

  .menu-bar ul li:hover .sub-menu-1 ul {
    display: block;
    margin: 10px;
  }

  .menu-bar ul li:hover .sub-menu-1 ul li {
    width: 150px;
    padding: 10px;
    border-bottom: 1px dotted white;
    background: transparent;
    border-radius: 0;
    text-align: left;
  }

  .menu-bar ul li:hover .sub-menu-1 ul li:last-child {
    border-bottom: none;    
  }

  .menu-bar ul li:hover .sub-menu-1 ul li a:hover {
    color: red;
  }

  .fa-angle-right {
    float: right;
  }

  .sub-menu-2 {
    display: none;
  }

  .hover-me:hover .sub-menu-2 {
    position: absolute;
    display: block;
    margin-top: -40px;
    margin-left: 140px;
    background: rgb(213, 243, 95);
  }

  .footer {
    background: rgb(213, 243, 95);
  }

  /*event*/
  .menu_container {
    width: auto;
    height: 50px;
    display: flex;
  }

  .search_container {
    text-align: center;
  }

  .sbox {
    display: flex;
    margin-top: 20px;
    margin-bottom: 20px;
    height:30px;
  }

  .abox{
    display:flex;
    justify-content:center;
    align-items:center;
  }

  .f{
    flex:9;
  }

  .search .search_button {
    padding: 8px;
    width: 200px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }

  .search_button {
    padding: 8px;
    width: 10%;
    background-color: mediumspringgreen;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .reset {
    padding-top: 8px;
    padding-bottom: 10px;
    width: 10%;
    background-color: mediumspringgreen;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    height:135%;
    flex:1;
  }

  .search_button:hover {
    background-color: skyblue;
  }

  .event_container {
    weight:auto;
    min-height:500px;
    box-shadow: 1px 1px;
    
  }

  .search_container {
    display: grid;
    grid-template-columns: repeat(3, minmax(500px, 1fr));
    gap: 5px;
    margin:5px 5px 5px 5px;
    justify-content: space-around;
    width:auto;
  }

  div>img {
    width: auto;
    height: 250px;
  }

  .event_discription {
    width: auto;
    height: 115px;
    padding-left: 5px;
    margin-bottom: 5%;
  }

  .text-center{
    margin-top:70px;
  }
</style>

<body>
  <div class="menu-bar">
    <label class="logo"><a class="navbar-brand" href="index.php">Well Dance Society</a></label>
    <ul>
      <li class="active"><a href="index.php"><i class="fa fa-home"></i>Home</a>
        <div class="sub-menu-1">
          <ul>
            <li><a href="register.php">Register</a></li>
            <li class="hover-me"><a href="#">Login</a><i class="fa fa-angle-right"></i>
              <div class="sub-menu-2">
                <ul>
                  <li><a href="admin_login.php">Admin Login</a></li>
                  <li><a href="login.php">User Login</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <li><a href="teamMember.php"><i class="fa fa-user"></i>Abouts Us</a>
      </li>
      <li><a href="contact.php"><i class="fa fa-phone"></i>Contact Us</a></li>
      <li class="eventpage"><a href="#"><i class="fa fa-diamond"></i>Event</a>
        <div class="sub-menu-1"> 
          <ul>
            <li><a href="menu.php">Browse Event</a></li>
            <li><a href="booking.php">Book Event</a></li>
          </ul>
        </div>
      </li>
      <li><a href="#"><i class="fa fa-hand-o-up"></i>Book</a>
        <div class="sub-menu-1">
          <ul>
            <li><a href="bookRecord.php">Booked Record</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  <div class="abox">
    <div class=sbox>
    <form action="" class="f" onsubmit="search(); return false;">
      <input style="width: 88%;" type="text" class="search" id="searchInput" placeholder="search something...."></input>
      <button type="submit" class="search_button" value="Search">
        <img src="image/search.png" alt="Search" style="width: 50%;">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </form>
    <button class="reset" onclick="resetSearch()">Reset</button>
    </div>
  </div>
  <div class="search_container">
    <?php
    require_once('helper.php');

    $sql = "SELECT * FROM events";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {
      
          echo '<div class="event_container">';
          echo '<div class="event">';
          echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
          echo '</div>';
          echo '<div class="event_discription">';
          echo '<h3 style="font-weight:bold;">' . $row["name"] . '</h3>';
          echo '<p style="font-size:20px;">' . $row["description"] . '</p>';
          echo '<br>';
          echo '<br>';
          echo '</div>';
          echo '</div>';
        }
      }
    else {
    echo "0 results";
    }
    $con->close();
    ?>
  </div>

  </div>






  <script>
  function search() {
    var searchInput = document.getElementById("searchInput").value.toLowerCase();
    var eventContainers = document.querySelectorAll(".event_container");
    for (var i = 0; i < eventContainers.length; i++) {
      var eventName = eventContainers[i].getElementsByClassName("event_discription")[0].getElementsByTagName("h3")[0].innerText.toLowerCase();
      if (eventName.includes(searchInput)) {
        eventContainers[i].style.display = "block";
      } else {
        eventContainers[i].style.display = "none";
      }
    }
  }

  function resetSearch() {
    var eventContainers = document.querySelectorAll(".event_container");
    eventContainers.forEach(function(container) {
    container.style.display = "block";
    });
  }
  </script>

</body>

<footer class="text-center">
  <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
</footer>

</html>