<?php

/* 
 * Copyright (C) 2013 peter
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include_once (__DIR__).'/_resources/peredur.inc.php';

$registration_error = false;
function callback_message($error,$message){
  global $registration_error;
  $registration_error = $error;
  $class = ($error ? "danger" : "success");
  echo "<p><label class='label label-$class'>$message</label></p>";
}

if (isset($_POST['username'], $_POST['email'], $_POST['p'], $_POST['first_name'], $_POST['last_name'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        callback_message(true,"The email address you entered is not valid.");
    }
    
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        callback_message(true,"Invalid password configuration.");
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
    
    $prep_stmt = "SELECT user_id FROM Users WHERE email = ?";
    $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            callback_message(true,"A user with this email address already exists.");
        }
    } else {
        callback_message(true,"Database error checking unique email.");
    }
    
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($registration_error)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password 
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO Users (first_name, last_name, username, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssss', $first_name, $last_name, $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
		callback_message(true,"Database error on registration insert.");
            } else callback_message(false,"Registration Success! Now try logging in for the first time.");
        }

    }
}

require_once((__DIR__)."/_resources/footer.inc.php");

?>
