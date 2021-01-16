<?php $error = null; ?>
<?php if (!empty($_POST)) : ?>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/repository/userRepository.php";
    $usernameOrEmail = $_POST["form-email"];
    $userPassword = $_POST["form-password"];
    $userRepository = new UserRepository();
    $user = $userRepository->getByEmail($usernameOrEmail);
    if ($user == null) $user = $userRepository->getByUsername($usernameOrEmail);
    if ($user == null) $error = "Login failed";
    else if ($user->password === $userPassword) {
        session_id(uniqid());
        if (session_start()) {
            $_SESSION["userid"] = $user->id;
            header("Location: index.php");
            exit;
        }
    } else {
        $error = "Login failed";
    }
    ?>
<?php endif; ?>
<?php
session_start();
if (isset($_SESSION["userid"])) header("Location: index.php");
?>
<!DOCTYPE html>

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/shared/styles.php" ?>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/shared/navbar.php" ?>
    <div style="display: flex;justify-content:center;padding-top:4vh;">
        <form style="width: 22rem;" method="post" action="login.php">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" name="form-email" class="form-control" placeholder="Email or Username" required />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="form-password" class="form-control" placeholder="Password" required />
            </div>
            <div style="color:red;" class="mb-2"><?php echo $error ?></div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
    </div>
</body>
<?php include_once $_SERVER['DOCUMENT_ROOT']."/shared/scripts.php" ?>

</html>