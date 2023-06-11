    <link rel="stylesheet" href="css/history.css">
    <div class="navbar">
        <div class="logo">
            <img src="images/sparkslogo.png" class="logo-img" />
        </div>
        <div class="menu">
            <a href="home.html">Home</a>
            <a href="customer.php">Customers</a>
        </div>
    </div>
	<div class="container">
        <h2>Transaction History</h2>
        
       <br>
       <div>
    <table>
        <th>
            <tr>
                <th>S.No.</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
            </tr>
        </th>
        <tbody>
        <?php

            include 'dbconnect.php';

            $sql ="select * from transaction";

            $query =mysqli_query($con, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td><?php echo $rows['sno']; ?></td>
            <td><?php echo $rows['sender']; ?></td>
            <td><?php echo $rows['receiver']; ?></td>
            <td><?php echo $rows['balance']; ?> </td>
            
                
        <?php
            }

        ?>
        </tbody>
    </table>

    </div>
</div>

</body>
</html>