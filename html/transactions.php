<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transactions </title>
    <link rel="stylesheet" href="../css/transactions.css">
</head>
<body>
    <?php
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPass = "";
        $DBName = "bankdb";

        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
        $fetchdata = "SELECT * FROM users WHERE userId='".$_GET['userId']."'";
        $result = mysqli_query($conn, $fetchdata);
    ?>

    <header>
        <div class="logo">
            <a href="#"> Bank Name </a>
        </div>
        <nav>
            <a href="home.php?userId=<?php echo $_GET['userId']; ?>"> Home </a>
            <a class="active" href="#"> Transactions </a>
            <a href="history.php?userId=<?php echo $_GET['userId']; ?>"> History </a>
            <a href="crypto.php?userId=<?php echo $_GET['userId']; ?>"> Cryptocurrency </a>
        </nav>
        <button class="hamburger" href="#"> 
            <div class="bar"></div>
        </button>
    </header>
    <nav class="profile-nav inactive">
        <div class="personalinfo">
            <section class="name">
                <?php $account = mysqli_fetch_assoc($result); ?>
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
    <main>
        <section class="top">
            <a href="withdraw.php?userId=<?php echo $_GET['userId']; ?>">
                <section class="withdraw">
                    <div class="img">
                        <img src="../images/withdraw.png">
                    </div>
                    <div class="description">
                        <h2> Withdraw </h2>
                        <p> Withdrawal is the process of taking money from a bank account, reducing the balance, and making funds available for personal use. </p>
                    </div>
                </section>
            </a>
            <a href="deposit.php?userId=<?php echo $_GET['userId']; ?>">
                <section class="deposit">
                    <div class="img">
                        <img src="../images/deposit.png">
                    </div>
                    <div class="description">
                        <h2> Deposit </h2>
                        <p> Deposit is placing money into a bank account, securing funds, earning potential interest, and facilitating future transactions and withdrawals. </p>
                    </div>
                </section>
            </a>
        </section>
        <section class="bottom">
            <a href="transfer.php?userId=<?php echo $_GET['userId']; ?>">
                <section class="transfer">
                    <div class="img">
                        <img src="../images/transfer.png">
                    </div>
                    <div class="description">
                        <h2> Transfer </h2>
                        <p> Transfer involves moving money between accounts, individuals, or financial institutions, facilitating the relocation of funds for various purposes efficiently. </p>
                    </div>
                </section>
            </a>
            <?php
                $userId = $_GET['userId'];
                if($account['investStatus']==1){
                    echo"
                    <a href='invest.php?userId=$userId'>
                        <section class='invest'>
                            <div class='img'>
                                <img src='../images/invest.png'>
                            </div>
                            <div class='description'>
                                <h2> Invest </h2>
                                <p> Investments offer opportunities to grow wealth through various financial instruments, providing returns on deposits and fostering long-term financial security. </p>
                            </div>
                        </section>
                    </a>";
                }
                else {
                    echo"
                    <a href='firstInvest.php?userId=$userId'>
                        <section class='invest'>
                            <div class='img'>
                                <img src='../images/invest.png'>
                            </div>
                            <div class='description'>
                                <h2> Invest </h2>
                                <p> Investments offer opportunities to grow wealth through various financial instruments, providing returns on deposits and fostering long-term financial security. </p>
                            </div>
                        </section>
                    </a>";
                }
            ?>
            
        </section>
    </main>

    <script src="../javascript/script.js"></script>
</body>
</html>