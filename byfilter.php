<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
    box-sizing: border-box;
}
body {
    margin: 0;
}


.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
    float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 20px 16px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: black;
	
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    width: 100%;
    left: 0;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content .header {
    background: black;
    padding: 16px;
    color: white;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 25%;
    padding: 10px;
    background-color: #ccc;
    height: 250px;
}

.column a {
    float: none;
    color: black;
    padding: 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.column a:hover {
    background-color: #ddd;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
        height: auto;
    }
}

.button {
    background-color: Black;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    
}

div.ex44 {
	color: white ;
    text-align: center;
	font-style: italic;
    border: 1px solid black;
    padding: 25px ;
    background-color: black;
	margin: 0px;
}
div.ex2{
    background-color: black;
	float: right;
	margin-right:12px;
}
</style>
</head>
<body>

<div class = "ex44">
        <h1>PROMINENT</h1></div>


<div class="navbar">
  <a class="active" href="DescOfStore.php">About Us</a>
  <a class="active" href="contactUs.php">Contact Us</a>
  <a href="inventory.php">Browse Inventory</a>
  <a href="MailingList.php">Mailing List</a>
  <div class = "ex2">
  <a href="shopping-cart.php">
          <i class="fa fa-shopping-cart" style="font-size:30px;color:lightblue"></i>
        </a></div>
		<form method="post" action="byfilter.php?action=Apply">
	<div class="dropdown">
    <button class="dropbtn" type = "button">Dropdown Filters 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="header">
        <h2>Filter</h2>
      </div>   
      <div class="row">
        <div class="column">
          <h3>Type</h3>
		  <label>Long<input name = "typeLong" type="checkbox" ></label><br>
          

          <label>Short<input name= "typeShort" type="checkbox" ></label><br>
          
        </div>
        <div class="column">
          <h3>Size</h3>
          <label>small<input name = "Ssize" type="checkbox" ></label><br>
          <label>large<input name = "Lsize" type="checkbox" ></label><br>
		  <label>Medium<input name = "Msize" type="checkbox" ></label><br>
          
        </div>
        <div class="column">
          <h3>Price</h3>
		  <label>$100.00<input name = "price100" type="checkbox" ></label><br>
		   <label>$50.00<input name = "price50" type="checkbox" ></label><br>
		   <label>$150.00<input name = "price150" type="checkbox" ></label><br>
			<label>$200.00<input name = "price200" type="checkbox" ></label><br>
        </div>
        <div class="column">
          <h3>Color</h3>
          <label>Blue<input name = "colorBlue" type="checkbox" ></label><br>
          <label>Green<input name = "colorGreen" type="checkbox" ></label><br>
		  <label>Beige<input name = "colorBeige" type="checkbox" ></label><br>
		  <label>White<input name = "colorWhite" type="checkbox" ></label><br>
		  <label>Red<input name = "colorRed" type="checkbox" ></label><br>
		  <label>Black<input name = "colorBlack" type="checkbox" ></label><br>
		  <label>Velvet<input name = "colorVelvet" type="checkbox" ></label><br>
		  <label>Orange<input name = "colorOrange" type="checkbox" ></label><br>
    
        </div>
		
		<button class = "button" type="submit" value="Submit">Apply</button>
	<button class = "button" type="reset" value="Reset">Clear All</button>
      </div>
    </div>

  </div>
  </form>
  
</div>
<p>Hoover over 'Dropdown Filters' to filter the dress of your choice.</p>
<p> choose only one checkbox at a time. </p>
<?php
		require_once 'login.php'; // file that contains database credentials

		$conn = new mysqli($hn, $un, $pw, $db);
		if($conn->connect_error)die ($conn->connect_error);
	$action = isset($_GET['action'])?$_GET['action']:"";
		if($action = "Apply" && $_SERVER["REQUEST_METHOD"]=="POST"){
		if (isset($_POST['typeLong']))
		{	
			$long = 'long';
			$query = "SELECT * FROM products WHERE dressType ='$long'";
		}
		else if (isset($_POST['typeShort']))
		{	
			$short = 'short';
			$query = "SELECT * FROM products WHERE dressType ='$short'";
		}
		else if (isset($_POST['Ssize']))
		{	
			$small = 'small';
			$query = "SELECT * FROM products WHERE dressSize ='$small'";
		}
		else if (isset($_POST['Lsize']))
		{	
			$large = 'large';
			$query = "SELECT * FROM products WHERE dressSize ='$large'";
		}
		else if (isset($_POST['Msize']))
		{	
			$medium = 'Medium';
			$query = "SELECT * FROM products WHERE dressSize ='$medium'";
		}
		else if (isset($_POST['price100']))
		{	

		$query = "SELECT * FROM products WHERE price = '100'";
		}
		else if (isset($_POST['price50']))
		{	

		$query = "SELECT * FROM products WHERE price = '50'";
		}
		else if (isset($_POST['price150']))
		{	

		$query = "SELECT * FROM products WHERE price = '150'";
		}
		else if (isset($_POST['price200']))
		{	

		$query = "SELECT * FROM products WHERE price = '200'";
		}
		
		else if (isset($_POST['colorBlue']))
		{	
		$blue = 'blue';

		$query = "SELECT * FROM products WHERE dressColor = 'blue'";
		}
		
		else if (isset($_POST['colorGreen']))
		{	
		$green = 'green';

		$query = "SELECT * FROM products WHERE dressColor = 'green'";
		}
		
		else if (isset($_POST['colorBeige']))
		{	
		
		$query = "SELECT * FROM products WHERE dressColor = 'beige'";
		}
		
		else if (isset($_POST['colorWhite']))
		{	
		$query = "SELECT * FROM products WHERE dressColor = 'white'";
		}
		
		else if (isset($_POST['colorRed']))
		{	
		$query = "SELECT * FROM products WHERE dressColor = 'red'";
		}
		
		else if (isset($_POST['colorBlack']))
		{	
		$query = "SELECT * FROM products WHERE dressColor = 'black'";
		}
		else if (isset($_POST['colorVelvet']))
		{	
		$query = "SELECT * FROM products WHERE dressColor = 'velvet'";
		}
		else if (isset($_POST['colorOrange']))
		{	
		$query = "SELECT * FROM products WHERE dressColor = 'orange'";
		}
		
		else{
			echo "Nothing Selected. So Displaying All the Combinations We Have.";
			$query = "SELECT * FROM products";
		}
		 
		}
		$result = $conn->query($query);
        if (!$result) 
            die($conn->error);
		
		
		//if ($result->num_rows > 0) {
    // output data of each row
   /* while($row = $result->fetch_assoc()) {
		echo "$row";
        echo "<br> type: ". $row["type"]. " - size: ". $row["size"]. "-color:  ". $row["color"]." -product id: ". $row["productId"] . "<br>";
    }
	} else {
    echo "0 results";
	}*/
	 
	$conn->close();
	//echo "<button class = "button" type="submit" value="Submit" href = >ADD TO CART </button>";
	?>
	
	<div class="row">
    <div class="container" style="width:200px;height:200px;">
      <?php while($row = $result->fetch_assoc()):?>
      <div class="col-md-4">
        <div class="thumbnail"> <img src="<?php print $row['image']?>" width = "200" height = "200" alt="Dresses">
          <div class="caption">
            <p style="text-align:center;"><?php print $row['name']?></p>
            <p style="text-align:center;color:#04B745;"><b>$<?php print $row['price']?></b></p>
            <form method="post" action="shopping-cart.php?action=addcart">
              <p style="text-align:center;color:#04B745;">
                <button type="submit" class="btn btn-warning">Add To Cart</button>
                <input type="hidden" name="product_id" value="<?php print $row['product_id']?>">
              </p>
            </form>
          </div>
        </div>
      </div>
      <?php endwhile;?>
    </div>
  </div>
  
	

</body>
</html>
