<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM registration WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        

        // echo "<pre>";
        // print_r($row);
        // var_dump(password_verify($password, $row['password']));
        // echo "</pre>";
        // exit;

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];

            // Check if the user came from order.php
            if (isset($_SESSION['redirect_to'])) {
                $redirect_to = $_SESSION['redirect_to'];
                unset($_SESSION['redirect_to']);
                header("Location: $redirect_to");
            } else
            {
                header("Location: menu.php"); // Default redirect
            }
            exit();
        } else {
            echo "<p style='color:red;'>Incorrect password.</p>";
        }
    } else {
        echo "<p style='color:red;'>User not found.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Bites Bakery</title>
    <link rel="stylesheet" href="css/log_in.css">
    <link rel="stylesheet" href="./fontawesome/css/all.css">
</head>

<body> <!-- Navigation Bar -->
    <div class="transparent-bg">
        <div class="login-container">
            <?php if (isset($_GET['success'])) { ?>
                <p style="color: green;">Signup successful! Please login.</p>
            <?php } ?>
            <h2>Welcome to sweet bites bakery</h2>
            <p>
                please log in to continue
            </p>
     
           
                        <form action="#" method="POST">
     <div class=" input-group">
                    <label for="email">Email</label>
                    <input type="email"  id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit">Log in</button>
            </form>
                <p>Dont have an account?<a href="signup.php">Register here</a></p>
               
                </div>
        </div>
       </body>
</html>