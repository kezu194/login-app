<?php

    session_start();

    $dns = "mysql:host=db;dbname=php_docker";
    $db = new PDO($dns, "php_docker", "password");

    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['username'], $_POST['password']) ) {
	    // Could not get the data that should have been sent.
        $_SESSION['number_of_try'] += 1;
        $_SESSION['last_try_login'] = time();
	    exit("Please fill both the username and password fields!");
    }

    // Make sure the submitted registration values are not empty.
    if (empty($_POST['username']) || empty($_POST['password'])) {
	    // One or more values are empty.
        $_SESSION['number_of_try'] += 1;
        $_SESSION['last_try_login'] = time();
	    exit('Please complete the registration form');
    }

    $_POST['username'] = strip_tags($_POST['username']);
    $_POST['password'] = strip_tags($_POST['password']);

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    $stmt = $db->prepare('SELECT id, password FROM accounts WHERE username = ?');
	// Store the result so we can check if the account exists in the database.
	$stmt->execute([$_POST['username']]);

    if ($stmt->rowCount() > 0) {
        $stmt = $stmt->fetchAll();
        $id = $stmt[0][0];
        $password = $stmt[0][1];
        // Account exists, now we verify the password.
        if (password_verify($_POST['password'], $password)) {
            // Create sessions, so we know the user is logged in.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['number_of_try'] = 0;
            $_SESSION['last_try_login'] = time();
            header('Location: home.php');
        } else {
            // Incorrect password
            $_SESSION['number_of_try'] += 1;
            $_SESSION['last_try_login'] = time();
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        $_SESSION['number_of_try'] += 1;
        $_SESSION['last_try_login'] = time();
        echo 'Incorrect username and/or password!';
    }
    echo "<br><a href='index.php'>login page</a>";
    
?>