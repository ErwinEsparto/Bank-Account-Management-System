<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit Account </title>
    <link rel="stylesheet" href="../css/adminEdit.css">
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
            <a class="active" href="adminView.php?userId=<?php echo $_GET['userId']; ?>"> Accounts </a>
            <a href="adminHistory.php?userId=<?php echo $_GET['userId']; ?>"> History </a>
            <a class="logout" href="welcome.html"> Logout </a>
        </nav>
    </header>
    <main>
        <section class="table">
            <table class="accounts">
                <thead>
                    <tr class="column">
                        <th>Name</th>
                        <th>Bank Number</th>
                        <th>Pin</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Birth Date</th>
                        <th>Gender</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $account = mysqli_fetch_assoc($result);
                    
                    echo "
                    <tr class='accounts'>
                        <td>".$account['firstName']." ".$account['lastName']."</td>
                        <td>".$account['bankNumber']."</td>
                        <td>".$account['password']."</td>
                        <td>".$account['emailAddress']."</td>
                        <td>".$account['address']."</td>
                        <td>".$account['contactNumber']."</td>
                        <td>".$account['birthDate']."</td>
                        <td>".$account['gender']."</td>
                        <td>".$account['dateCreated']."</td>
                        <td>
                            <a href='adminView.php?userId=".$account['userId']."'> Back </a>
                        </td>
                    </tr>";
                    ?>
                </tbody>
            </table>
            <form method="POST">
                <section>
                    <input type='hidden' name='id' value="<?php echo $account['userId']; ?>" required>
                    <label for="firstName">First Name: </label>
                    <input type="text" name="firstName" placeholder="First Name" value="<?php echo $account['firstName']; ?>" required>
                    <label for="lastName">Last Name: </label>
                    <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $account['lastName']; ?>" required>
                    <label for="bankNumber">Bank Number: </label>
                    <input type="text" name="bankNumber" placeholder="Bank Number" value="<?php echo $account['bankNumber']; ?>" required>
                    <label for="password">Pin: </label>
                    <input type="password" name="password" placeholder="Password" value="<?php echo $account['password']; ?>" required>
                </section>
                <section>
                    <label for="emailAddress">Email Address: </label>
                    <input type="text" name="emailAddress" placeholder="Email Address" value="<?php echo $account['emailAddress']; ?>" required>
                    <label for="address">Address: </label>
                    <input type="text" name="address" placeholder="Address" value="<?php echo $account['address']; ?>" required>
                    <label for="contactNumber">Contact Number: </label>
                    <input type="text" name="contactNumber" placeholder="Contact Number" value="<?php echo $account['contactNumber']; ?>" required>
                    <label for="birthDate">Birth Date: </label>
                    <input type="date" name="birthDate" placeholder="Birth Date" value="<?php echo $account['birthDate']; ?>" required>
                    <input type="submit" name="submit" value="Save Changes">
                    <?php
                        if(isset($_POST["submit"])){
                            $firstName = $_POST["firstName"];
                            $lastName = $_POST["lastName"];
                            $bankNumber = $_POST["bankNumber"];
                            $password = $_POST["password"];
                            $emailAddress = $_POST["emailAddress"];
                            $address = $_POST["address"];
                            $contactNumber = $_POST["contactNumber"];
                            $birthDate = $_POST["birthDate"];

                            $userId = $_POST["id"];
                            mysqli_query($conn, "UPDATE users SET 
                            firstName='$firstName', 
                            lastName='$lastName', 
                            bankNumber='$bankNumber', 
                            password='$password',
                            emailAddress='$emailAddress',
                            address='$address',
                            contactNumber='$contactNumber',
                            birthDate='$birthDate'
                            WHERE userId='".$_GET['userId']."'");
                            echo "<p> Profile Details updated. </p>";
                        }
                    ?>
                </section>
            </form>
        </section>
    </main>
    

    <script src="../javascript/script.js"></script>
</body>
</html>