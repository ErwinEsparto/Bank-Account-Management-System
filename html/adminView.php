<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Accounts List </title>
    <link rel="stylesheet" href="../css/adminView.css">
</head>
<body>
    <?php
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPass = "";
        $DBName = "bankdb";

        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
        $fetchdata = "SELECT * FROM users WHERE accountType=2";
        $result = mysqli_query($conn, $fetchdata);
    ?>

    <header>
        <div class="logo">
            <a href="#"> WIN Bank </a>
        </div>
        <nav>
            <a class="active" href="#"> Accounts </a>
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
                    $rownum = mysqli_num_rows($result);

                    if($rownum>0){
                        while ($accounts = mysqli_fetch_assoc($result)){
                            echo "
                            <tr class='account'>
                                <td>".$accounts['firstName']." ".$accounts['lastName']."</td>
                                <td>".$accounts['bankNumber']."</td>
                                <td>".$accounts['password']."</td>
                                <td>".$accounts['emailAddress']."</td>
                                <td>".$accounts['address']."</td>
                                <td>".$accounts['contactNumber']."</td>
                                <td>".$accounts['birthDate']."</td>
                                <td>".$accounts['gender']."</td>
                                <td>".$accounts['dateCreated']."</td>
                                <td>
                                    <a href='adminEdit.php?userId=".$accounts['userId']."'> Edit </a>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    

    <script src="../javascript/script.js"></script>
</body>
</html>