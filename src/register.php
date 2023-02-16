<?php
    $dns = "mysql:host=db;dbname=php_docker";
    $db = new PDO($dns, "php_docker", "password");

    // Now we check if the data was submitted, isset() function will check if the data exists.
    if (!isset($_POST['username'], $_POST['password'])) {
	    // Could not get the data that should have been sent.
	    exit('Please complete the registration form!');
    }
    // Make sure the submitted registration values are not empty.
    if (empty($_POST['username']) || empty($_POST['password'])) {
	    // One or more values are empty.
	    exit('Please complete the registration form');
    }

    // We need to check if the account with that username exists.
    $stmt = $db->prepare('SELECT id, password FROM accounts WHERE username = ?');
	$stmt->execute([$_POST['username']]);
	$count = $stmt->rowCount();
	// Store the result so we can check if the account exists in the database.
	if ($count != NULL) {
	    // Username already exists
	    echo 'Username exists, please choose another!';
	} else {
        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('Username is not valid!');
        }
        if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            exit('Password must be between 5 and 20 characters long!');
        }

	    // Username doesn't exists, insert new account
        $stmt = $db->prepare('INSERT INTO accounts (username, password) VALUES (?, ?)');
	    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
	    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $uniqid = uniqid();
	    $stmt->execute([$_POST['username'], $password]);
	    echo "You have successfully registered! You can now login!<br><a href='index.php'>login page</a>";
    }
	
?>