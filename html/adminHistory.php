<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transactions List </title>
    <link rel="stylesheet" href="../css/adminHistory.css">
</head>
<body>
    <?php
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPass = "";
        $DBName = "bankdb";

        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
        $fetchdata = "SELECT users.firstName, users.lastName, transactions.bankNumber, transactions.from, transactions.to, transactions.type, 
        transactions.amount, transactions.balance, transactions.date
        FROM transactions 
        INNER JOIN users ON transactions.userId=users.userId" ;
        $result = mysqli_query($conn, $fetchdata);
    ?>

    <header>
        <div class="logo">
            <a href="#"> WIN Bank </a>
        </div>
        <nav>
            <a href="adminView.php?userId=<?php echo $_GET['userId']; ?>"> Accounts </a>
            <a class="active" href="#"> History </a>
            <a class="logout" href="welcome.html"> Logout </a>
        </nav>
    </header>
    <main>
        <section class="table">
            <table class="accounts">
                <thead>
                    <tr class="column">
                        <th>Name</th>
                        <th>Bank Number</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $rownum = mysqli_num_rows($result);

                    if($rownum>0){
                        while ($transactions = mysqli_fetch_assoc($result)){
                            echo "
                            <tr class='account'>
                                <td>".$transactions['firstName']." ".$transactions['lastName']."</td>
                                <td>".$transactions['bankNumber']."</td>
                                <td>".$transactions['from']."</td>
                                <td>".$transactions['to']."</td>
                                <td>".$transactions['type']."</td>
                                <td>".$transactions['amount']."</td>
                                <td>".$transactions['balance']."</td>
                                <td>".$transactions['date']."</td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    

    <script src="../javascript/script.js"></script>
</body>
</html>