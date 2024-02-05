<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transfer </title>
    <link rel="stylesheet" href="../css/firstInvest.css">
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
                <h1> First time investing? </h1>
                <p class="description"> 
                    Grow your wealth with strategic investments in stocks, bonds, or real estate. Despite risks, smart decisions and diversification can lead to long-term gains. 
                    Start investing now for a brighter financial future.
                </p>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="targetAmount"> Target Amount: </label>
                <input type="number" name="targetAmount" min="5000" step="1000" oninput="validity.valid||(value='');" required>
                <label for="confirmAmount"> Confirm Amount: </label>
                <input type="number" name="confirmAmount" min="5000" step="1000" oninput="validity.valid||(value='');" required>
                <input type="password" name="currentPin" placeholder="Enter Pin" required>
                <input type="submit" name="submit" value="Invest Now!">
                <div class="results">
                    <?php
                        if(isset($_POST["submit"])){
                            $targetAmount = (float)$_POST["targetAmount"];
                            $confirmAmount = (float)$_POST["confirmAmount"];
                            $currentPin = $_POST["currentPin"];

                            if ($account['password'] != $currentPin) {
                                echo "<p> Pin is incorrect. </p>";
                            }
                            else if ($targetAmount != $confirmAmount) {
                                echo "<p> Amounts are not the same. </p>";
                            }
                            else {
                                $userId = $_POST["id"];
                                mysqli_query($conn, "UPDATE users SET investStatus=1, investTarget=$confirmAmount WHERE userId='".$_GET['userId']."'");
                                echo "<p> Successfully recorded. </p>";
                                echo "<a href=transactions.php?userId=$userId> Click here to refresh your invest status. </a>";
                            }
                        }
                    ?>
                </div>
                
            </form>
            <div class="img">
                <img src="../images/firstInvest.jpg">
            </div>
        </section>
    </main>

    <script src="../javascript/script.js"></script>
</body>
</html>