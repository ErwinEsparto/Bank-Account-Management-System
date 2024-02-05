<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Deposit </title>
    <link rel="stylesheet" href="../css/deposit.css">
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
                <h1> Deposit </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="mot"> Mode of Payment: </label>
                <select name="mot">
                    <option value="GCASH"> GCASH </option>
                </select>
                <label for="type"> Type of Currency: </label>
                <select name="type">
                    <option value="Peso"> ₱: Philippines Peso </option>
                    <option value="Dollars"> $: U.S Dollars </option>
                    <option value="Yen"> ¥: Yen </option>
                </select>
                <input type="number" name="firstAmount" placeholder="Amount" min="20" max="10000" step="10" oninput="validity.valid||(value='');" required>
                <input type="number" name="secondAmount" placeholder="Confirm Amount" min="20" max="10000" step="10" oninput="validity.valid||(value='');" required>
                <input type="password" name="currentPin" placeholder="Enter Pin" required>
                <input type="submit" name="submit" value="Deposit">
                <?php
                    if(isset($_POST["submit"])){
                        $modeType = $_POST["mot"];
                        $currencyType = $_POST["type"];
                        $amountOne = (float)$_POST["firstAmount"];
                        $amountTwo = (float)$_POST["secondAmount"];
                        $currentPin = $_POST["currentPin"];

                        if ($account['password'] != $currentPin) {
                            echo "<p> Pin is incorrect. </p>";
                        }
                        else if ($amountOne != $amountTwo) {
                            echo "<p> Amounts are not the same. </p>";
                        }
                        else {
                            if ($currencyType=="Peso"){
                                $newSavings =  (float)$account['savings']+$amountTwo;
                                $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                ('{$account['bankNumber']}', '$amountTwo', 'Deposit', '$modeType', 'Savings', '$newSavings', now(), '".$_GET['userId']."') ";
                                $addHistory = mysqli_query($conn, $historyQuery);

                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET savings=$newSavings WHERE userId='".$_GET['userId']."'");
                                echo "<p> Funds added to your savings. </p>";
                            }
                            else if ($currencyType=="Dollars"){
                                $dollarAmount = (float)$amountTwo*56;
                                $newSavings = (float)$account['savings']+$dollarAmount;

                                $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                ('{$account['bankNumber']}', '$dollarAmount', 'Deposit', '$modeType', 'Savings', '$newSavings', now(), '".$_GET['userId']."') ";
                                $addHistory = mysqli_query($conn, $historyQuery);

                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET savings=$newSavings WHERE userId='".$_GET['userId']."'");
                                echo "<p> Funds added to your savings. </p>";
                            }
                            else{
                                $yenAmount = (float)$amountTwo*0.38;
                                $newSavings = (float)$account['savings']+$yenAmount;

                                $historyQuery = "INSERT INTO transactions (bankNumber, amount, type, `from`, `to`, balance, `date`, userId) VALUES
                                ('{$account['bankNumber']}', '$yenAmount', 'Deposit', '$modeType', 'Savings', '$newSavings', now(), '".$_GET['userId']."') ";
                                $addHistory = mysqli_query($conn, $historyQuery);

                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET savings=$newSavings WHERE userId='".$_GET['userId']."'");
                                echo "<p> Funds added to your savings. </p>";
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