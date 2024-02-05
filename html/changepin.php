<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Change Pin </title>
    <link rel="stylesheet" href="../css/changepin.css">
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
            <a href="#"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <main>
        <section class="form">
            <form method="POST">
                <h1> Change Pin </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <input type="password" name="currentPin" placeholder="Current Pin" required>
                <input type="password" name="newPin" placeholder="New Pin" required>
                <input type="password" name="otherNewPin" placeholder="Confirm New Pin" required>
                <input type="submit" name="submit" value="Change" class="btnChange">
                <?php
                    if(isset($_POST["submit"])){
                        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
                        $findpin = "SELECT * FROM users WHERE userId='".$_GET['userId']."' AND password='".$_POST['currentPin']."'";
                        $pinresult = mysqli_query($conn, $findpin);
                        $userpin = mysqli_fetch_assoc($pinresult);
                        $currentPin = $_POST["currentPin"];
                        $newPin = $_POST["newPin"];
                        $newPin2 = $_POST["otherNewPin"];

                        if (mysqli_num_rows($pinresult) == 0) {
                            echo "<p> Incorrect Old Pin. </p>";
                        }
                        else if ($userpin['password'] == $newPin) {
                            echo "<p> New Pin cannot be the same with Old Pin. </p>";
                        }
                        else if ($newPin != $newPin2) {
                            echo "<p> New Pins are not the same. </p>";
                        }
                        else {
                            $userId = $_POST["id"];
                            mysqli_query($conn, "UPDATE users SET password='$newPin' WHERE userId='".$_GET['userId']."'");
                            echo "<p> Changed Pin successfully. </p>";
                        }
                    }
                ?>
            </form>
        </section>
    </main>
    <script src="../javascript/script.js"></script>
</body>
</html>