<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cryptocurrency </title>
    <link rel="stylesheet" href="../css/crypto.css">
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
            <a href="#"> WIN Bank </a>
        </div>
        <nav>
            <a href="home.php?userId=<?php echo $_GET['userId']; ?>"> Home </a>
            <a href="transactions.php?userId=<?php echo $_GET['userId']; ?>"> Transactions </a>
            <a href="history.php?userId=<?php echo $_GET['userId']; ?>"> History </a>
            <a class="active" href="#"> Cryptocurrency </a>
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
            <div class="container">
                <h1>Cryptocurrency</h1>
                <div id="savings">
                    <div class="head">
                        <h2> Current Balance: </h2>
                    </div>
                    <div class="savingscontainer">
                        <img src="../images/cryptobalance.gif"/>
                        <div class="cryptosavings">
                            <h3> CryptoSavings:  </h3>
                            <p> ₱<?php echo $account['cryptosavings']; ?> </p>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <img src="../images/cryptopic.jpg">
                    <p class="description"> Cryptocurrency is a digital or virtual form of currency that uses cryptography for security. 
                        Bitcoin is the first and most well-known cryptocurrency.
                    </p>
                </div>
            </div>
            <div class="purchase">
                <form method="POST">
                    <h1> Purchase </h1>
                    <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                    <label for="accountType"> From: </label>
                    <input type="text" name="accountType" value="Savings" readonly required>
                    <input type="number" name="amountOne" placeholder="Amount" min="1" max="100" step="1" oninput="validity.valid||(value='');" required>
                    <input type="number" name="amountTwo" placeholder="Confirm Amount" min="1" max="100" step="1" oninput="validity.valid||(value='');" required>
                    <label for="type"> Type of CryptoCurrency: </label>
                    <select name="type">
                        <option value="Bitcoin"> ₿: Bitcoin </option>
                    </select>
                    <input type="password" name="currentPin" placeholder="Enter Pin" required>
                    <input type="submit" name="submit" value="Purchase">
                </form>
                <?php
                    if(isset($_POST["submit"])){
                        $accountType = $_POST["accountType"];
                        $amountBitcoin = (float)$_POST["amountTwo"];
                        $amountOne = (float)$_POST["amountOne"]*2500000;
                        $amountTwo = (float)$_POST["amountTwo"]*2500000;
                        $currentPin = $_POST["currentPin"];
                        $newCryptoSavings = (float)$account['cryptosavings']+$amountTwo;
                        $newSavings = (float)$account['savings']-$amountTwo;

                        if ($account['password'] != $currentPin) {
                            echo "<p class='result'> Pin is incorrect. </p>";
                        }
                        else if ($amountOne != $amountTwo) {
                            echo "<p class='result'> Amounts are not the same. </p>";
                        }
                        else if (($amountTwo > $account['savings']) && ($amountOne > $account['savings'])) {
                            echo "<p class='result'> You do not have enough savings. </p>";
                        }
                        else {
                            $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                            ('{$account['bankNumber']}', '$amountBitcoin', 'Bitcoin', '$accountType', 'CryptoSavings', '$newSavings', now(), '".$_GET['userId']."') ";
                            $addHistory = mysqli_query($conn, $historyQuery);

                            $userId = $_POST["id"];
                            mysqli_query($conn, "UPDATE users SET cryptosavings=$newCryptoSavings, savings=$newSavings WHERE userId='".$_GET['userId']."'");
                            echo "<p class='result'> Purchased Successfully. </p>";
                        }
                    }
                ?>
            </div>
        </section>
    </main>
    <script src="../javascript/script.js"></script>
</body>
</html>