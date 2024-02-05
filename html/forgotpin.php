<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Pin</title>
    <link rel="stylesheet" href="../css/forgotpin.css">
</head>
<body>
    <?php
        $DBHost = "localhost";
        $DBUser = "root";
        $DBPass = "";
        $DBName = "bankdb";

        $conn = mysqli_connect($DBHost, $DBUser, $DBPass, $DBName);
        $fetchdata = "SELECT * FROM users";
        $result = mysqli_query($conn, $fetchdata);
    ?>
    <main>
        <section>
            <div class="form">
                <form method="POST">
                    <h1> Recover Account </h1>
                    <input type="text" name="bankNumber" placeholder="Bank Number" required>
                    <input type="text" name="emailAddress" placeholder="Email Address" required>
                    <input type="password" name="newPassword" placeholder="New Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                    <input type="submit" name="submit" value="Find Account" class="btnFind">
                </form>
                    <?php
                        if(isset($_POST["submit"])){
                            $findaccount = "SELECT * FROM users WHERE bankNumber='".$_POST['bankNumber']."' AND emailAddress='".$_POST['emailAddress']."'";
                            $accounts = mysqli_query($conn, $findaccount);
                            $useraccount = mysqli_fetch_assoc($accounts);
                            $bankNumber = $_POST["bankNumber"];
                            $emailAddress = $_POST["emailAddress"];
                            $newPassword = $_POST["newPassword"];
                            $confirmPassword = $_POST["confirmPassword"];

                            if (mysqli_num_rows($accounts) == 0) {
                                echo "<p> Account Not Found. </p>";
                            }
                            else if ($newPassword != $confirmPassword) {
                                echo "<p> Passwords are not the same. </p>";
                            }
                            else {
                                $userId = $useraccount["userId"];
                                mysqli_query($conn, "UPDATE users SET password='$confirmPassword' WHERE userId='$userId'");
                                echo "<p> Account recovered successfully. </p>";
                            }
                        }
                    ?>
                    <div class="links">
                        <a class="btnRecover" href="login.html">Return to Login</a>
                    </div>
            </div>
        </section>
    </main>
</body>
</html>