<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transfer </title>
    <link rel="stylesheet" href="../css/invest.css">
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
            <a href="editProfile.php?userId=<?php echo $_GET['userId']; ?>"> Edit Profile </a>
            <a href="changepin.php?userId=<?php echo $_GET['userId']; ?>"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <main>
        <section class="form">
            <form method="POST">
                <h1> Invest </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="accountType"> Invest From: </label>
                <select name="accountType">
                    <option value="Savings"> Savings Account </option>
                    <option value="CryptoSavings"> CryptoSavings </option>
                </select>
                <input type="number" name="firstAmount" placeholder="Amount" min="500" max="10000" step="100" oninput="validity.valid||(value='');" required>
                <input type="number" name="secondAmount" placeholder="Confirm Amount" min="500" max="10000" step="100" oninput="validity.valid||(value='');" required>
                <input type="password" name="currentPin" placeholder="Enter Pin" required>
                <input type="submit" name="submit" value="Invest">
                <div class="results">
                    <?php
                        if(isset($_POST["submit"])){
                            $accountType = $_POST["accountType"];
                            $amountOne = (float)$_POST["firstAmount"];
                            $amountTwo = (float)$_POST["secondAmount"];
                            $currentPin = $_POST["currentPin"];
                            $newSavings = (float)$account['savings']-$amountTwo;
                            $newCryptoSavings = (float)$account['cryptosavings']-$amountTwo;
                            $investCurrent = (float)$account['investCurrent']+$amountTwo;

                            if ($account['password'] != $currentPin) {
                                echo "<p> Pin is incorrect. </p>";
                            }
                            else if ($amountOne != $amountTwo) {
                                echo "<p> Amounts are not the same. </p>";
                            }
                            else {
                                if ($accountType=="Savings"){
                                    $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                    ('{$account['bankNumber']}', '$amountTwo', 'Invest', '$accountType', 'Investment', '$newSavings', now(), '".$_GET['userId']."') ";
                                    $addHistory = mysqli_query($conn, $historyQuery);

                                    $userId = $_POST["id"];
                                    mysqli_query($conn, "UPDATE users SET savings=$newSavings, investCurrent=$investCurrent WHERE userId='".$_GET['userId']."'");
                                    echo "<p> Invested Successfully. </p>";
                                    echo "<a href=invest.php?userId=$userId> Click here to refresh your investment. </a>";
                                }
                                else {
                                    $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                    ('{$account['bankNumber']}', '$amountTwo', 'Invest', '$accountType', 'Investment', '$newCryptoSavings', now(), '".$_GET['userId']."') ";
                                    $addHistory = mysqli_query($conn, $historyQuery);

                                    $userId = $_POST["id"];
                                    mysqli_query($conn, "UPDATE users SET cryptosavings=$newCryptoSavings, investCurrent=$investCurrent WHERE userId='".$_GET['userId']."'");
                                    echo "<p> Invested Successfully. </p>";
                                    echo "<a href=invest.php?userId=$userId> Click here to refresh your investment. </a>";
                                }
                            }
                        }
                    ?>
                </div>
            </form>
        </section>
        <section class="form">
            <form method="POST">
                <h1> Redeem </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="targetAmount"> Target Amount: </label>
                <input type="number" name="targetAmount" value="<?php echo $account['investTarget']; ?>" readonly required>
                <label for="currentAmount"> Current Amount: </label>
                <input type="number" name="currentAmount" value="<?php echo $account['investCurrent']; ?>" readonly required>
                <label for="receiverType"> Transfer To: </label>
                <select name="receiverType">
                    <option value="Savings"> Savings Account </option>
                    <option value="CryptoSavings"> CryptoSavings </option>
                </select>
                <?php
                    if ($account['investTarget'] > $account['investCurrent']){
                        echo '<p> You do not have enough investment to redeem. </p>';
                    }
                    else {
                        echo '<input type="password" name="currentPin" placeholder="Enter Pin" required>';
                        echo '<input type="submit" name="redeem" value="Redeem">';

                        if (isset($_POST["redeem"])){
                            $receiverType = $_POST["receiverType"];
                            $targetAmount = (float)$_POST["targetAmount"];
                            $currentAmount = (float)$_POST["currentAmount"];
                            $currentPin = $_POST["currentPin"];
                            $savings = (float)$account['savings']+$targetAmount;
                            $cryptoSavings = (float)$account['cryptosavings']+$targetAmount;

                            if ($account['password'] != $currentPin) {
                                echo "<p> Pin is incorrect. </p>";
                            }
                            else {
                                if ($receiverType=="Savings"){
                                    $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                    ('{$account['bankNumber']}', '$targetAmount', 'Redeem', 'Investment', '$receiverType', '$savings', now(), '".$_GET['userId']."') ";
                                    $addHistory = mysqli_query($conn, $historyQuery);
    
                                    $userId = $_POST["id"];
                                    mysqli_query($conn, "UPDATE users SET savings=$savings, investStatus=0, investTarget=0, investCurrent=0 WHERE userId='".$_GET['userId']."'");
                                    echo "<p> Redeemed Successfully. </p>";
                                }
                                else {
                                    $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                    ('{$account['bankNumber']}', '$targetAmount', 'Redeem', 'Investment', '$receiverType', '$cryptoSavings', now(), '".$_GET['userId']."') ";
                                    $addHistory = mysqli_query($conn, $historyQuery);
    
                                    $userId = $_POST["id"];
                                    mysqli_query($conn, "UPDATE users SET cryptosavings=$cryptoSavings, investStatus=0, investTarget=0, investCurrent=0 WHERE userId='".$_GET['userId']."'");
                                    echo "<p> Redeemed Successfully. </p>";
                                }
                            }
                        }
                    }
                ?>
            </form>
        </section>
    </main>

    <script src="../javascript/script.js"></script>
</body>
</html>