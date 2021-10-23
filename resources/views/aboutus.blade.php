<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="HandheldFriendly" content="true">
    <title>About Us</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');
    .text {

    }
    * {
        font-family: "Montserrat",sans-serif;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        max-width: 100%;

    }
    
        /* Tablet Landscape */
    @media screen and (max-width: 1060px) {
        #primary { width:67%; }
        #secondary { width:30%; margin-left:3%;}  
    }

    /* Tabled Portrait */
    @media screen and (max-width: 768px) {
        #primary { width:100%; }
        #secondary { width:100%; margin:0; border:none; }
    }
    
    html {
      font-size: 62.5%;
        background: url("Images/placehold.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
    }

    .logo{
        margin-right: auto;
        background-color:#3A79B8;
        cursor: pointer;
        width: 65px;
        height: 65px;
    }

    li,a{
        background-color:#3A79B8;
        font-weight: 500;
        font-size: 18px;
        color: white;
        text-decoration: none;
    }

    header{
        background-color:#3A79B8;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 30px 10%;
        width: 100%;
    }

    .nav_links {
        background-color:#3A79B8;
        list-style: none;
        display: table;
    }
    
    .nav_links li {
        background-color:#3A79B8;
        display: inline-block;
        padding: 0px 20px;
        float: none;
    }

    .nav_links li a{
        background-color:#3A79B8;
        transition: all 0.3s ease 0s;
    }

    .nav_links li a:hover{
        color: #0088a9;
    }

    .containerArisen{
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 200px;
    }

    img{
      max-width: 100%
    }

    .img-col{
      flex-basis: 30%;
    }

    .text-col{
      font-size: 4vw;
      flex-basis: 40%;
      max-width: 100%;
      margin-right: 100px;
    }

    .meet {
        margin-bottom: 100px;
        font-size: 64px;
        text-align: center;
    }

    /* Three columns side by side */
    .column {
        display: flex;
        float: left;
        width: 33%;
        margin-bottom: 30px;
        padding: 0 8px;
    }

    /* Display the columns below each other instead of side by side on small screens */
    @media screen and (max-width: 650px) {
    .column {
        width: 100%;
        display: block;
    }
    }

    /* Add some shadows to create a card effect */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
    }

    /* Some left and right padding inside the container */
    .container {
        padding: 0 16px;
    }

    /* Clear floats */
    .container::after, .row::after {
        content: "";
        clear: both;
        display: table;
    }

    .title {
        color: grey;
    }

    </style>
</head>

<body>
    <header>
        <img class="logo" src="Images\AdDU Logo\University Seal White.png" alt="logo">
        <nav>
            <ul class="nav_links">
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Statistics</a></li>
                <li><a href="#">Heat Map</a></li>
            </ul>
        </nav>
    </header>

        <div class="containerArisen">

          <div class="text-col">
            <h1>About Us</h1>
          </div>

          <div class="img-col">
            <img src="Images/ARISEn/ARISEN Lab Logo.png" alt="">
          </div>

        </div>


        <p class="meet">Meet The Team</p>

        <div class="row">
            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="Jane" style="width:100%">
                <div class="container">
                  <h2>Jane Doe</h2>
                  <p class="title">CEO &amp; Founder</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>
          
            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="Mike" style="width:100%">
                <div class="container">
                  <h2>Mike Ross</h2>
                  <p class="title">Art Director</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>
          
            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="John" style="width:100%">
                <div class="container">
                  <h2>John Doe</h2>
                  <p class="title">Designer</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>

            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="Jane2" style="width:100%">
                <div class="container">
                  <h2>Jane Doe II</h2>
                  <p class="title">CEO &amp; Founder II</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>
          
            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="Mike2" style="width:100%">
                <div class="container">
                  <h2>Mike Ross II</h2>
                  <p class="title">Art Director II</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>
          
            <div class="column">
              <div class="card">
                <img src="Images/TM.png" alt="John2" style="width:100%">
                <div class="container">
                  <h2>John Doe II</h2>
                  <p class="title">Designer II</p>
                  <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                  <p>example@example.com</p>
                </div>
              </div>
            </div>
          </div>
</body>
</html>