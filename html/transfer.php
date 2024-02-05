<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transfer </title>
    <link rel="stylesheet" href="../css/transfer.css">
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
            <a href="changepin.php?userId=<?php echo $_GET['userId']; ?>"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <main>
        <section class="form">
            <form method="POST">
                <h1> Transfer </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="senderType"> Transfer From: </label>
                <select name="senderType">
                    <option value="Savings"> Savings Account </option>
                    <option value="CryptoSavings"> CryptoSavings </option>
                </select>
                <label for="receiverType"> Transfer To: </label>
                <select name="receiverType">
                    <option value="GCASH"> GCASH </option>
                    <option value="LandBank"> LandBank </option>
                    <option value="BPI"> BPI </option>
                </select>
                <input type="number" name="firstAmount" placeholder="Amount" min="500" max="10000" step="100" oninput="validity.valid||(value='');" required>
                <input type="number" name="secondAmount" placeholder="Confirm Amount" min="500" max="10000" step="100" oninput="validity.valid||(value='');" required>
                <p> Note: There is a ₱10 transaction fee for every ₱500. </p>
                <input type="password" name="currentPin" placeholder="Enter Pin" required>
                <input type="submit" name="submit" value="Transfer">
                <?php
                    if(isset($_POST["submit"])){
                        $senderType = $_POST["senderType"];
                        $receiverType = $_POST["receiverType"];
                        $amountOne = (float)$_POST["firstAmount"];
                        $amountTwo = (float)$_POST["secondAmount"];
                        $transactionFee = (int)($amountTwo/500)*10;
                        $currentPin = $_POST["currentPin"];
                        $newSavings =  (float)($account['savings']-$amountTwo)-$transactionFee;
                        $newCryptoSavings =  (float)($account['cryptosavings']-$amountTwo)-$transactionFee;

                        if ($account['password'] != $currentPin) {
                            echo "<p> Pin is incorrect. </p>";
                        }
                        else if ($amountOne != $amountTwo) {
                            echo "<p> Amounts are not the same. </p>";
                        }
                        else if (($amountTwo+$transactionFee > $account['savings']) && ($amountOne+$transactionFee > $account['savings']) && $senderType=="Savings") {
                            echo "<p> You do not have enough savings. </p>";
                        }
                        else if (($amountTwo+$transactionFee > $account['cryptosavings']) && ($amountOne+$transactionFee > $account['cryptosavings'] && $senderType=="CryptoSavings")) {
                            echo "<p> You do not have enough cryptosavings. </p>";
                        }
                        else {
                            if($senderType=="Savings"){
                                $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                ('{$account['bankNumber']}', '$amountTwo', 'Transfer', '$senderType', '$receiverType', '$newSavings', now(), '".$_GET['userId']."') ";
                                $addHistory = mysqli_query($conn, $historyQuery);
    
                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET savings=$newSavings WHERE userId='".$_GET['userId']."'");
                                echo "<p> Successfully transferred funds. </p>";
                            }
                            else {
                                $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                ('{$account['bankNumber']}', '$amountTwo', 'Transfer', '$senderType', '$receiverType', '$newSavings', now(), '".$_GET['userId']."') ";
                                $addHistory = mysqli_query($conn, $historyQuery);

                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET cryptosavings=$newCryptoSavings WHERE userId='".$_GET['userId']."'");
                                echo "<p> Successfully transferred funds. </p>";
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