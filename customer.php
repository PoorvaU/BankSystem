

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customer.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,100&display=swap"
      rel="stylesheet"/>
    <title>Customers</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/sparkslogo.png" class="logo-img" />
        </div>
        <div class="menu">
            <a href="home.html">Home</a>
            <a href="customer.php">Customers</a>
        </div>
    </div>
    <table>
        <tr>
            <th>Sr no</th>
            <th>Name</th>
            <th>Email id</th>
            <th>Balance</th>
            <th>View</th>
        </tr>

<?php
    include 'dbconnect.php';
    $sql= "SELECT * from customers";
    $result = $con-> query($sql);
    while($row = $result-> fetch_assoc()){
?>
    <tr>
        <td><?php echo $row['id']?></td>
        <td><?php echo $row['Name']?></td>
        <td><?php echo $row['Email']?></td>
        <td><?php echo $row['Balance']?></td>
        <td><a href="user.php?id=<?php echo $row['id'] ;?>"><button class="transact-btn">Transact</button></td>
    </tr>
    <?php
    }
    ?>
    
</table>

</body>
</html>