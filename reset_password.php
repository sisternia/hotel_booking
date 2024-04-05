<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once("inc/links.php"); ?>
</head>

<style>
    div.login-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
    }
</style>

<body>
    <?php
    if (isset($_GET['email']) && isset($_GET['verification_code'])) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `user_cred` WHERE  `email`='$_GET[email]' 
                AND `verification_code`='$_GET[verification_code]' 
                AND `t_expire`='$date'";
        $result = mysqli_query($con, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                echo "
                    <body class='bg-light'>
                        <div class='login-form text-center rounded bg-white shadow overflow-none'>
                            <form method='POST'>
                                <h4 class='bg-dark text-white py-3'>Create New Password</h4>
                                <div class='p-4'>
                                    <div class='mb-4'>
                                        <input name='password' required type='password' class='form-control shadow-none text-center' placeholder='Password' />
                                    </div>
                                    <button name='updatepassword' type='submit' class='btn text-white custom-bg shadow-none'>Update</button>
                                    <input type='hidden' name='email' value='$_GET[email]' >
                                </div>
                            </form>
                        </div>
                    </body>
                ";
            } else {
                echo "
                    <script>
                        alert('Invalid or Expired Link');
                        window . location . href = 'index.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script>
                    alert('Sever Down!Try again later');
                    window . location . href = 'index.php';
                </script>
            ";
        }
    }
    ?>

    <?php
    if (isset($_POST['updatepassword'])) {
        $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $update = "UPDATE `user_cred` SET `password`='$pass',`verification_code`= NULL,`t_expire`= NULL WHERE `email`='$_GET[email]'";
        if (mysqli_query($con, $update)) {
            echo "
                <script>
                    alert('Password Updated Successfully');
                    window . location . href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Sever Down!Try again later');
                    window . location . href = 'index.php';
                </script>
            ";
        }
    }
    ?>
</body>

</html>