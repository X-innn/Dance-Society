<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
  
/* team */
article
{
    margin:0px;
    padding:0px;
    box-sizing:border-box;
    font-family: "Poppins", sans-serif;
    text-align: center;
    color:black;
    line-height:1.5;
    letter-spacing:1px;
}

.wrapper
{
    min-height:100vh;
    width:100%;

}

.testimonial
{
    padding:30px 100px;
}

article h1
{
    font-size:50px;
    font-weight:800;
    text-transform: uppercase;
}

article h1:after
{
    height:5px;
    width:225px;
    background:white;
    display:block;
    margin:auto;
}

article img
{
    height:200px;
    width:200px;
    border:2px solid white;
    border-radius: 50%;
    margin-top:60px;
}

blockquote
{
    font-family: sans-serif;
    font-size: 25px;
    margin-top:30px;
}
            </style>
        <title>About Team</title>
    </head>
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
      <li><a href="#"><i class="fa fa-diamond"></i>Event</a>
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
        <div class="wrapper">
            <div class="testimonial">
                <article>
                <h1>Our Team</h1>
                <img src="web photo/mem1.jpeg">
                <blockquote>
                    Name : Low Yae Wen <br>
                    Email : lyw123@gmail.com <br>
                    Phone ： 012-3456789 <br>
                </blockquote>
                
                <img src="web photo/mem4.jpg">
                <blockquote>
                    Name : Vanshan <br>
                    Email : vanshan123@gmail.com <br>
                    Phone ： 012-369852147 <br>
                </blockquote>
               
                
                <img src="web photo/mem2.jpeg">
                <blockquote>
                    Name : Leong Pei Shing<br>
                    Email : lps123@gmail.com <br>
                    Phone ： 012-9876543<br>
                </blockquote>
     
                
                <img src="web photo/mem3.jpeg">
                <blockquote>
                    Name : Tan Jian Pang <br>
                    Email : tjp123@gmail.com <br>
                    Phone ： 012-147852369 <br>
                </blockquote>
                
                <img src="web photo/mem5.jpeg">
                <blockquote>
                    Name : Arvin <br>
                    Email : arvin123@gmail.com <br>
                    Phone ： 012-75312489 <br>
                </blockquote>
                </article>
            </div>
        </div>
        <footer class="text-center">
                <p>Copyright &copy; 2024 All right reserved by Well Dance Society</p>
            </footer>
    </body>
</html> 