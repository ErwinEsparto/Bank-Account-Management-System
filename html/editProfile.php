<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Profile </title>
    <link rel="stylesheet" href="../css/editProfile.css">
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
            <a href="#"> Edit Profile </a>
            <a href="changepin.php?userId=<?php echo $_GET['userId']; ?>"> Change Pin </a>
            <a href="welcome.html"> Logout </a>
        </div>
    </nav>
    <main>
        <section class="editprofileform">
            <form method="POST">
                <h1> Edit Profile </h1>
                <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                <label for="address">Address: </label>
                <input type="text" name="address" placeholder="Address" value="<?php echo $account['address']; ?>" required>
                <label for="contactNumber">Contact Number: </label>
                <input type="text" name="contactNumber" placeholder="Contact Number" value="<?php echo $account['contactNumber']; ?>" required>
                <label for="emailAddress">Email Address: </label>
                <input type="text" name="emailAddress" placeholder="Email Address" value="<?php echo $account['emailAddress']; ?>" required>
                <label for="birthDate">Birth Date: </label>
                <input type="date" name="birthDate" placeholder="Birth Date" value="<?php echo $account['birthDate']; ?>" required>
                <input type="password" name="password" placeholder="Current Pin" required>
                <input type="submit" name="submit" value="Update Profile">
            </form>
            <?php
                if(isset($_POST["submit"])){
                    $address = $_POST["address"];
                    $contactNumber = $_POST["contactNumber"];
                    $emailAddress = $_POST["emailAddress"];
                    $birthDate = $_POST["birthDate"];
                    $password = $_POST["password"];

                    if ($account['password'] != $password) {
                        echo "<p> Incorrect Pin. </p>";
                    }
                    else {
                        $userId = $_POST["id"];
                        mysqli_query($conn, "UPDATE users SET address='$address', contactNumber='$contactNumber', emailAddress='$emailAddress', birthDate='$birthDate'  WHERE userId='".$_GET['userId']."'");
                        echo "<p> Profile Details updated. </p>";
                    }
                }
            ?>
        </section>
    </main>
    <script src="../javascript/script.js"></script>
</body>
</html>