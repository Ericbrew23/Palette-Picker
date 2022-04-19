<!DOCTYPE html>
<html>
<head>
  
    <div class="topnav">
      <ul>
        <li><input type="text" placeholder="Search.."></li>
        <li><a class="active" href="#home">Alerts</a></li>
        <li><a class="active" href=#profile>Profile</a></li>
      </ul>
      </div>
    <div class="header">
      <img id="rainbowImg"
      src="images/RainbowHeader.png"
      alt="A rainbow gradient with 
        black stripes."
    />
    </div>
    <?php
    $user = $_GET['username'];
    //echo "username = " . $user;
    ?>  
<title><?php echo $user ?></title>
</head>
<body>
<h1>Saved Palettes:</h1>
<div id="container">
    <p class="boxed">
       
    </p>  
    <p class="boxed">
      
    </p>  
    <p class="boxed">
        
    </p>  
    <p class="boxed">
        
    </p>  
  </div>
  <div>
<h1>Friends:</h1>
<p id="circle">
</p>
<p id="circle">
</p>
<p id="circle">
</p>
<p id="circle">
</p>
     
</div>
  </div>
</body>
</html>

<style> 
* { padding: 0; margin: 0;}
.topnav {
  width: 100%;
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
li {
  display: inline;
  float: left;
  padding:14px 12px;
  margin:0;
  
}
li a {
  display: block;
  color: white;
  text-align: center;
}
#rainbowImg {
  object-fit: fill;
  max-width: 100%;
  height:auto;  
}
    .header {
      border: 5px solid #333;
  background-color: #333;
  margin: 0;
  /*
     width: 100%;
     text-align: center;

     background: "images/RainbowHeader.png"; 
     color: white;
     font-size: 30px;*/
   }
   .boxed {
   border: 1px solid black ;
   text-align: center; 
   width: 200px;
   height: 200px; 
   display: inline-block;
   background: rgb(250, 247, 247)
 }
 #circle {
      width: 180px;
      height: 180px;
      justify-content: center;
      text-align: center;
      border: 1px solid black; 
      border-radius: 70px;
      border-radius: 70px;
      border-radius: 70px;
      background: rgb(250, 247, 247);
      display: inline-block; 
    }
 

