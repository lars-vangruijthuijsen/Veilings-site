<?php
include('server.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    clearFieldsOnErrors($errors);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Style the container for inputs */
        .container {
            background-color: #f1f1f1;
            padding: 20px;
        }

        /* The message box is shown when the user clicks on the password field */
        #message {
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
            text-align: left;
        }

        #message p {
            padding: 10px 35px;
            font-size: 18px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
</head>
<body>
<div class="header">
    <img class="img" src="." alt="Description of the image" width="75" height="50">
    <h2 class="header-txt">Register</h2>
</div>

<form method="post" action="register.php">
    <!-- Display errors here -->
    <div>
        <?php if (count($errors) > 0): ?>
            <?php foreach ($errors as $error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach ?>
            <?php clearFieldsOnErrors($errors); ?>
        <?php endif ?>
    </div>

    <div class="input-group">
        <label>Name *</label>
        <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
    </div>
    <div class="input-group">
        <label>Email *</label>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
    </div>

    <div class="input-group">
        <label>Password *</label>
        <input type="password" name="password_1" id="password" required>
        <div id="message">
            <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="specialCharacter" class="invalid">A <b>special character</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
    </div>

    <div class="input-group">
        <label>Confirm password *</label>
        <input type="password" name="password_2" required>
    </div>

    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>

    <p><br>Already a member? <a href="login.php">Sign in</a></p>
</form>

<script>
    var myInput = document.getElementById("password");
    var message = document.getElementById("message");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var specialCharacter = document.getElementById("specialCharacter");
    var length = document.getElementById("length");

    // Initially, hide the password requirements message
    message.style.display = "none";

    myInput.onfocus = function () {
        message.style.display = "block";
    }

    myInput.onblur = function () {
        if (myInput.value === "") {
            message.style.display = "none";
        }
    }

    myInput.oninput = function () {
        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;
        var specialChar = /[!@#$%^&+_<>?.~\-]/;

        // Check if all criteria are met
        var isLowerCase = myInput.value.match(lowerCaseLetters);
        var isUpperCase = myInput.value.match(upperCaseLetters);
        var isNumber = myInput.value.match(numbers);
        var isSpecialChar = myInput.value.match(specialChar);
        var isLengthValid = myInput.value.length >= 8;

        // Update the validation marks for each criteria
        letter.classList.toggle("valid", isLowerCase !== null);
        letter.classList.toggle("invalid", isLowerCase === null);

        capital.classList.toggle("valid", isUpperCase !== null);
        capital.classList.toggle("invalid", isUpperCase === null);

        number.classList.toggle("valid", isNumber !== null);
        number.classList.toggle("invalid", isNumber === null);

        specialCharacter.classList.toggle("valid", isSpecialChar !== null);
        specialCharacter.classList.toggle("invalid", isSpecialChar === null);

        length.classList.toggle("valid", isLengthValid);
        length.classList.toggle("invalid", !isLengthValid);
    }
</script>

</body>
</html>
