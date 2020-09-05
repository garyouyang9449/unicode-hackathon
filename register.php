<?php 
    // connect to DB
    include('config/connect_db.php');

    $email = $password = $firstname = $lastname = $gender = $major = '';
    $error = array('email' => '', 'password' => '', 'firstname' => '',
'lastname' => '', '$gender' => '', '$major' => ''); // map to store possible error

    // check if the user clicked the submit button
    if(isset($_POST['submit'])){
        // check if email field is empty
        if(empty($_POST['email'])) {
            echo "email error <br />";
            $error['email'] = 'email is empty';
        } else {
            echo htmlspecialchars('email is '.$_POST['email']);
            $email = $_POST['email'];
        }
        
        // check if password field is empty
        if(empty($_POST['password'])) {
            echo "password is empty <br />";  
            $error['password'] = 'password is emtpy';
        } else {
            echo htmlspecialchars('. password is '. $_POST['password']);
            $password = $_POST['password'];
        }

        // check if lastname field is empty
        if(empty($_POST['firstname'])) {
            echo "firstname error <br />";
            $error['firstname'] = 'firstname is empty';
        } else {
            echo htmlspecialchars('. firstname is '.$_POST['firstname']);
            $firstname = $_POST['firstname'];
        }

        // check if lastname field is empty
        if(empty($_POST['lastname'])) {
            echo "lastname error <br />";
            $error['lastname'] = 'lastname is empty';
        } else {
            echo htmlspecialchars('. lastname is '.$_POST['lastname']);
            $lastname = $_POST['lastname'];
        }

        // check if gender field is empty
        if(empty($_POST['gender'])) {
            echo "gender error <br />";
            $error['gender'] = 'gender is empty';
        } else {
            echo htmlspecialchars('. gender is '.$_POST['gender']);
            $gender = $_POST['gender'];
        }

        // check if major field is empty
        if(empty($_POST['major'])) {
            echo "major error <br />";
            $error['major'] = 'major is empty';
        } else {
            echo htmlspecialchars('. major is '.$_POST['major']);
            $major = $_POST['major'];
        }

        // check if the error every key in error map has empty value,
        // if not, an error occured
        if(array_filter($error)) {
            echo ' error';
        } else {
            // add data to database
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            

            // check if email is unique
            $select_query = "SELECT COUNT(1) FROM users WHERE Email = '$email'";
            $result = $conn->query($select_query);
            
            if($result->num_rows > 0) {
                // email already exists
                echo ". email already exists </ br>";
            } else {
                $insert_query = "INSERT INTO users(Email, Password, FirstName, LastName, Gender, Major) VALUES ('$email', '$password', 'test', 'test', 'test','major')";
                if(mysqli_query($conn, $insert_query)) {
                    echo 'success';
                } else {
                    echo mysqli_error($conn);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <section class="container grey-text">
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
            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

</html>