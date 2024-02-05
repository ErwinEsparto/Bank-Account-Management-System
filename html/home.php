<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
    <link rel="stylesheet" href="../css/home.css">
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
            <a class="active" href="#"> Home </a>
            <a href="transactions.php?userId=<?php echo $_GET['userId']; ?>"> Transactions </a>
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
            <a href="changepin.php?userId=<?php echo $_GET['userId']; ?>"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <main>
        <section class="welcome">
            <div class="title">
                <h1> Welcome back, <?php echo $account['firstName']; ?> </h1>
                <p> Check out these news today. </p>
            </div>
            <div class="balance">
                <div class="head">
                    <h2> Current Balance: </h2>
                    <a href="transactions.php?userId=<?php echo $_GET['userId']; ?>"> Cash In </a>
                </div>
                <div class="container">
                    <div class="savingscontainer">
                        <div class="savings">
                            <h3> Savings: </h3>
                            <p> ₱<?php echo $account['savings']; ?> </p>
                        </div>
                        <div class="cryptosavings">
                            <h3> CryptoSavings:  </h3>
                            <p> ₱<?php echo $account['cryptosavings']; ?> </p>
                        </div>
                    </div>
                    <img src="../images/money.gif"/>
                </div>
            </div>
        </section>
        <section class="news">
            <div class="upper">
                <div class="upperNews">
                    <div class="icon">
                        <img src="../images/crypto.gif"/>
                    </div>
                    <div class="description">
                        <h3> Cryptocurrency </h3>
                        <p> Now Available </p>
                    </div>
                </div>
                <div class="upperNews">
                    <div class="icon">
                        <img src="../images/interest.gif"/>
                    </div>
                    <div class="description">
                        <h3> Savings Interest </h3>
                        <p> Up to 7% annually! </p>
                    </div>
                </div>
                <div class="upperNews">
                    <div class="icon">
                        <img src="../images/international.gif"/>
                    </div>
                    <div class="description">
                        <h3> International Transaction </h3>
                        <a href="balance.php?userId=<?php echo $_GET['userId']; ?>"> To Be Announced </a>
                    </div>
                </div>
            </div>
            <div class="lower">
                <a href="https://www.moneymanagement.com.au/news/financial-planning" target="_blank" class="lowerNews financialNews">
                    <div class="icon">
                        <img src="../images/financial.png"/>
                    </div>
                    <div class="description">
                        <h3> Financial Advice </h3>
                        <p> Check this out!  </p>
                    </div>
                </a>
                <a href="https://cybersecuritynews.com/" target="_blank" class="lowerNews securityNews">
                    <div class="icon">
                        <img src="../images/security.png"/>
                    </div>
                    <div class="description">
                        <h3> Cybersecurity Awareness </h3>
                        <p> Vigilance, Education, Protection. </p>
                    </div>
                </a>
            </div>
        </section>
    </main>

    <script src="../javascript/script.js"></script>
</body>
</html>