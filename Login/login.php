<?php include 'server.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <img class="img" src="" alt="Description of the image" width="75" height="50">
    <h2 class="header-txt">Login</h2>
</div>

<form method="post" action="login.php">
    <!-- Display errors here -->
    <?php if (count($errors) > 0): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <div class="input-group">
        <label>Username or Email</label>
        <input type="text" name="username_email" required>
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>

    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
</form>
</body>
</html>
