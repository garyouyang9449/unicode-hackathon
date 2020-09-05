<?php 
    // connect to DB
    include('config/connect_db.php');

    $email = $password = $firstname = $lastname = $gender = $major = $hobbies = '';
    $error = array('email' => '', 'password' => '', 'firstname' => '',
'lastname' => '', '$gender' => '', '$major' => ''); // map to store possible error

    // check if the user clicked the submit button
    if(isset($_POST['submit'])) {
        // check if email field is empty
        if(empty($_POST['email'])) {
            //echo "email error <br />";
            $error['email'] = 'email is empty';
        } else {
            //echo htmlspecialchars('email is '.$_POST['email']);
            $email = $_POST['email'];
        }
        
        // check if password field is empty
        if(empty($_POST['password'])) {
            //echo "password is empty <br />";  
            $error['password'] = 'password is emtpy';
        } else {
            //echo htmlspecialchars('. password is '. $_POST['password']);
            $password = $_POST['password'];
        }

        // check if lastname field is empty
        if(empty($_POST['firstname'])) {
            //echo "firstname error <br />";
            $error['firstname'] = 'firstname is empty';
        } else {
            //echo htmlspecialchars('. firstname is '.$_POST['firstname']);
            $firstname = $_POST['firstname'];
        }

        // check if lastname field is empty
        if(empty($_POST['lastname'])) {
            //echo "lastname error <br />";
            $error['lastname'] = 'lastname is empty';
        } else {
            //echo htmlspecialchars('. lastname is '.$_POST['lastname']);
            $lastname = $_POST['lastname'];
        }

        // check if gender field is empty
        if(empty($_POST['gender'])) {
            //echo "gender error <br />";
            $error['gender'] = 'gender is empty';
        } else {
            //echo htmlspecialchars('. gender is '.$_POST['gender']);
            $gender = $_POST['gender'];
        }

        // check if major field is empty
        if(empty($_POST['major'])) {
            //echo "major error <br />";
            $error['major'] = 'major is empty';
        } else {
            //echo htmlspecialchars('. major is '.$_POST['major']);
            $major = $_POST['major'];
        }

        // check if hobbies field is empty
        if(empty($_POST['hobbies'])) {
            //echo "hobbies error <br/>";
            $error['hobbies'] = 'hobbies is empty';
        } else {
            //echo htmlspecialchars('. hobbies is '.$_POST['hobbies']);
            //echo '<br/>';
            $hobbies = $_POST['hobbies'];
        }

        // check if the error every key in error map has empty value,
        // if not, an error occured
        if(array_filter($error)) {
            //echo 'some error existed <br/>';
        } else {
            // add data to database
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            
            // check if email already exists
            $email_select_query = "SELECT 1 FROM users WHERE Email = '$email'";
            $email_result = $conn->query($email_select_query);

            // if email does not exist, insert new email
            if($email_result->num_rows > 0) {
                // email already exists
                //echo ". email already exists <br/>";
            }
            else {
                // insert to users table
                $users_insert_query = "INSERT INTO users(Email, Password, FirstName, LastName, Gender, Major) VALUES ('$email', '$password', '$firstname', '$lastname', '$gender','$major')";
                if(mysqli_query($conn, $users_insert_query)) {
                    //echo 'insert to users table success <br/>';
                } else {
                    //echo 'insert to users table error '. mysqli_error($conn) . '<br/>';
                }
            }

            // insert hobby one at a time
            foreach(explode(',', $_POST['hobbies']) as $hobby) {
                $hobby_select_query = "SELECT 1 FROM hobbies WHERE Hobby = '$hobby'";
                $hobby_result = $conn->query($hobby_select_query);
                
                // check if connection is successful
                if($hobby_result) {
                    // if hobby does not exist, insert new hobby
                    if($hobby_result->num_rows > 0) {
                        //echo ". hobby already exists <br/>";
                    } else {
                        // get the last insert hobbyID
                        $last_id = mysqli_query($conn, "SELECT MAX(HobbyID) FROM hobbies");
                        $row = mysqli_fetch_row($last_id);
                        $new_id= $row[0] + 1;
                        
                        // insert new hobby
                        $hobbies_insert_query = "INSERT INTO hobbies(HobbyID, Hobby) VALUES ('$new_id', '$hobby')";
                        if(mysqli_query($conn, $hobbies_insert_query)){
                            //echo 'insert hobby success' . '<br/>';
                        } else{
                            //echo 'insert to hobby error ' . mysqli_error($conn) . '<br/>';
                        }

                        // build relationship
                        $relationship_insert_query = "INSERT INTO user_to_hobbies(Email, HobbyID) VALUES('$email', '$new_id')";
                        if(mysqli_query($conn, $relationship_insert_query)) {
                            //echo 'insert relationship successful <br/>';
                        } else {
                            //echo 'insert relationship error' . mysqli_error($conn) . '<br/>';
                        }
                    }
                }
            }
        }
    }
    // close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册网页</title>
    <style>
        body {
            background-image: url('register.jpg');
            background-size: 100%;
            background-repeat: no-repeat;

            text-align: center;
            color: pink;
        }
    </style>
</head>

<body>
    <section class="container grey-text">
        <br>
        <br>
        <br>
        <br>
        <h4 class="center">Register</h4>
        <form class="white" action="register.php" method="POST">
            <label>Your Email</label>
            <input type="text" name="email">
            <label>Password</label>
            <input type="text" name="password">
            <label>First Name</label>
            <input type="text" name="firstname">
            <label>LastName</label>
            <input type="text" name="lastname">
            <label>Gender</label>
            <input type="text" name="gender">
            <label>Major</label>
            <input type="text" name="major">
            <label>Hobbies (Comma Separated)</label>
            <input type="text" name="hobbies">
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
</body>
</html>