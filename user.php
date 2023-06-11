<?php
include('dbconnect.php');
$rowid=$_GET['id'];
if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['Balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                echo $sql1['Balance'];
                $newbalance = $sql1['Balance'] - $amount;
                $sql = "UPDATE customers set Balance=$newbalance where id=$from";
                mysqli_query($con,$sql);
             

                // adding amount to reciever's account
                $newbalance = $sql2['Balance'] + $amount;
                $sql = "UPDATE customers set Balance=$newbalance where id=$to";
                mysqli_query($con,$sql);
                
                $sender = $sql1['Name'];
                $receiver = $sql2['Name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($con,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transaction-history.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/customer.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/sparkslogo.png" class="logo-img" />
        </div>
        <div class="menu">
            <a href="#">Home</a>
            <a href="customer.php">Customers</a>
        </div>
    </div>
    <div class="container">
        <!-- <h1 style="text-align: center; margin-top:30px">Transaction</h1> -->
            <?php
                include 'dbconnect.php';
                // $sid=$_GET['id'];
                $sql = "SELECT * FROM  customers where id=$rowid";
                // $result=mysqli_query($con,$sql);
                $result = $con-> query($sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($con);
                }
                $row=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit"  ><br>
    <div>
        <table>
            <tr>
                <th>Sr no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
            </tr>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['Name'] ?></td>
                <td><?php echo $row['Email'] ?></td>
                <td><?php echo $row['Balance'] ?></td>
            </tr>
        </table>
    </div>
    <br>
    <label style="text-align:center">Transfer To:</label>
    <select name="to" class="form-control" required>
    <option value="" disabled selected>Choose</option>
    <?php
        include 'dbconnect.php';
        // $sid=$_GET['id'];
        $sql = "SELECT * FROM  customers where id!='id'";
        $result = $con-> query($sql);
        if(!$result)
        {
            echo "Error ".$sql."<br>".mysqli_error($con);
        }
        while($row = mysqli_fetch_assoc($result)) {
    ?>
    <option class="table" value="<?php echo $row['id'];?>" >
                    
    <?php echo $row['Name'] ;?> (Balance: 
    <?php echo $row['Balance'] ;?> ) 
                
    </option>
    <?php 
        } 
    ?>
    <div>
        </select>
        <br>
        <br>
        <label>Amount:</label>
        <input type="number"  name="amount" required>   
        <br><br>
        <div class="text-center" >
            <button class="transact-btn" name="submit" type="submit" id="btn">Transfer</button>
        </div>
    </form>
    </div>
</body>
    </html>




