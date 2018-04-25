<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Current Inventory</title>
        
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        
        <style>
            td {
            border: 1px solid black;
            padding: 1em 1em 1em 1em;
            }
            body {
            background-color: white;
            }


            h1 {
            color: white ;
            text-align: center;
            font-style: italic;
            }
            h2 {
            color: black;

            }
            h3 {
            color: black;

            }

            p{
                color: black;
                font-size: 20px

            }

            ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
            }

            li {
            float: left;
            }

            li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

            li a:hover {
            background-color: #111;
            }
            div {
            border: 1px solid black;
            padding: 25px ;
            background-color: black;
            margin: 0px;
            }
            div.ex2{
            background-color: black;
            float: right;
            margin-right:12px;
            margin-top: 12px;
            }
            
            </style>
            </head>


            <body>
            <div>
            <h1>PROMINENT</h1>
            </div>
                
                <ul>
                    <div class = "ex2"><a href="shopping-cart.php">
                    <i class="fa fa-shopping-cart" style="font-size:30px;color:lightblue"></i>
                    </a></div>
                    <li><a class="active" href="login_page.php">Log In</a></li>
                    <li><a class="active" href="byfilter.php">Browse by Filter</a></li>
                    <li><a class="active" href="Sales.php">Specials</a></li>
                    <li><a href="contactUs.php">Contact Us</a></li>
                    <li><a href="DescOfStore.php">About Us</a></li>
                    <div2
                    <a href="shopping-cart.php">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>

                    </ul>

        <h2>Current Inventory</h2>
        <p>Our current dresses inventory includes the following prom dresses.</p>

        <table>
        <?php 
        
  
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        require_once 'login.php';
        
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);

        $query  = "SELECT * FROM products";
        $result = $conn->query($query);

        if (!$result) 
            die($conn->error);

        $rows = $result->num_rows;
        if(isset($_POST['product'])){
            session_start();
            $dont = false;
            if(isset($_SESSION['username'])){
               add_wish($dont,$conn);         
             }else{
                 echo "You must be logged in to use this feature.";
             }
        }

       // echo"<th>Type</th>";
        echo"<th>Size</th>";
        echo"<th>Price</th>";
        echo"<th>Dress Name</th>";
        //echo"<th>Product Id</th>";
        /*
        $row = $result->fetch_array(MYSQLI_ASSOC);
        while($row){
            
            $img = $row['image'];
            echo '<img src="'.$img.'" width="175" height="175" />';
            echo "<br><br>";
            echo  'Dress Name: '. $row['name']. ' Price: '. $row['price'].'  Size: '. $row['dressSize'];
        }
        */
        for ($j = 0 ; $j < $rows ; ++$j)
        {
            echo"<tr>";
            $result->data_seek($j);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $img = $row['image'];
            $prod = $row['product_id'];
            
			//echo"<td>". $row['product_id']   ."<br></td>";
            //echo "<td>". $row['dressType']  ."<br></td>";
            echo"<td>". $row['dressSize']   ."<br></td>";
			echo"<td>". $row['price']   ."<br></td>";
            echo"<td>". $row['name']   ."<br></td>";
            echo"<td>". '<img src="'.$img.'" width="100" height="100" />'   ."<br></td>";
            echo "<form action=shopping-cart.php?action=addcart method=post>";
            echo"<td>". "<button type=\"submit\" class=\"btn btn-warning\">Add to Cart </button>"  ."<br></td>";
            echo "<input type=\"hidden\" name=\"product_id\" value=\"$prod\">";
            echo "</form>";
            echo "<form action = inventory.php method = post>";
            echo"<td>". "<button type=\"submit\" class=\"product\"> Add to WishList</button>"  ."<br></td>";
            echo "<input type=\"hidden\" name=\"product\" value=\"$prod\">";
            echo "</form>";
            echo"</tr>";
        }
        
        
        
        function add_wish($dont,$conn){
            $user = $_SESSION['username'];
            $wish = $_POST['product'];


            $query1 = "SELECT * FROM wishList WHERE username = '$user'";
            $result1 = $conn->query($query1);
              while($row3 = $result1->fetch_assoc()){
                if($wish === $row3['product_id']){
                  $dont = true;
                }  
              }
              if($dont){
                   echo "This item is already in your wish list.";
              }
              elseif(!$dont){
                  $query = "INSERT INTO wishList (username, product_id) VALUES ('$user','$wish')";
                  $result = $conn->query($query);
                  if(!$result){
                      echo "Wish not saved"; 
                 }  
              }   
         } 
     
        
        
        $result->close();
        $conn->close();
        ?>
        </table>
        <br><br>
    </body>
        
</html>
    
