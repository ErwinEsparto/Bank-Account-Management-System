<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transaction History </title>
    <link rel="stylesheet" href="../css/history.css">
</head>
<body>
    <?php
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPass = "";
        $DBName = "bankdb";

        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
        $transactionquery = "SELECT * FROM transactions WHERE userId='".$_GET['userId']."'";
        $transactions = mysqli_query($conn, $transactionquery);

        $accountquery = "SELECT * FROM users 
        WHERE userId='".$_GET['userId']."'";
        $accounts = mysqli_query($conn, $accountquery);
    ?>
    
    <header>
        <div class="logo">
            <a href="#"> WIN Bank </a>
        </div>
        <nav>
            <a href="home.php?userId=<?php echo $_GET['userId']; ?>"> Home </a>
            <a href="transactions.php?userId=<?php echo $_GET['userId']; ?>"> Transactions </a>
            <a class="active" href="#"> History </a>
            <a href="crypto.php?userId=<?php echo $_GET['userId']; ?>"> Cryptocurrency </a>
        </nav>
        <button class="hamburger" href="#"> 
            <div class="bar"></div>
        </button>
    </header>
    <nav class="profile-nav inactive">
        <div class="personalinfo">
            <section class="name">
                <?php $account = mysqli_fetch_assoc($accounts); ?>
                <h2> <?php echo $account['firstName']; ?> <?php echo $account['lastName']; ?> </h2>
                <h2> <?php echo $account['bankNumber']; ?> </h2> <hr>
            </section>
            <section class="details">
                <p class="title"> Personal Information: </p>
                <p class='category'> Address: </p>
                <p class="detailinfo"> <?php echo $account['address']; ?> </p>
                <p class='category'> Email Address: </p>
                <p class="detailinfo"> <?php echo $account['emailAddress']; ?> </p>
                <p class='category'> Contact Number: </p>
                <p class="detailinfo"> <?php echo $account['contactNumber']; ?> </p>
                <p class='category'> Birthdate: </p>
                <p class="detailinfo"> <?php echo $account['birthDate']; ?> </p>
                <p class='category'> Gender: </p>
                <p class="detailinfo"> <?php echo $account['gender']; ?> </p>
                <p class='category'> Date Created: </p>
                <p class="detailinfo"> <?php echo $account['dateCreated']; ?> </p>
            </section>
        </div>
        <div class="logout">
            <a href="editProfile.php?userId=<?php echo $_GET['userId']; ?>"> Edit Profile </a>
            <a href="changepin.php?userId=<?php echo $_GET['userId']; ?>"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <section class='table'>
        <center>
            <table class="transactions">
                <thead>
                    <tr class="column">
                        <th>Bank Number</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Balance</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $rowNum = mysqli_num_rows($transactions);

                        if($rowNum>0){
                            while ($transaction = mysqli_fetch_assoc($transactions)){
                                echo "
                                <tr class='transactions'>
                                    <td>".$transaction['bankNumber']."</td>
                                    <td>".$transaction['amount']."</td>
                                    <td>".$transaction['type']."</td>
                                    <td>".$transaction['from']."</td>
                                    <td>".$transaction['to']."</td>
                                    <td>".$transaction['balance']."</td>
                                    <td>".$transaction['date']."</td>
                                </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </center>
    </section>

    <script src="../javascript/script.js"></script>
</body>
</html>