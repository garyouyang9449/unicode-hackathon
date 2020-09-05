<?php 
    include('config/connect_db.php');

    $email = 'a'; // get this from sign in page
    $password = ''; // get this from sign in page

    $users_query = "SELECT * FROM users WHERE Email = '$email'";
    $hobbies_query = "SELECT Hobby FROM hobbies WHERE HobbyID IN (SELECT HobbyID FROM user_to_hobbies WHERE Email = '$email')";

    $users_result = $conn->query($users_query);
    $hobbies_result = $conn->query($hobbies_query);
    $users = '';
    $hobbies = '';
    if($users_result) {
        $users = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
    } else {
        echo mysqli_error($conn) . '<br/>';
    }
    
    if($hobbies_result) {
        $hobbies = mysqli_fetch_all($hobbies_result, MYSQLI_ASSOC);    
    } else {
        echo mysqli_error($conn) . '<br/>';
    }
    mysqli_free_result($users_result);
    mysqli_free_result($hobbies_result);
    // close connection
    mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>personal_profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>

    <div class="main-nav">
        <ul class="nav">
          <li class="name">Haihao Sun</li>
          <li><a href="main.html">Home</a></li>
        </ul>
    </div>

    <header>
      <img src="data:image/jpeg;base64,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" alt="Yaoming" class="profile-image">
      <h1 class="tag name"><?php echo $users[0]['FirstName'].' '.$users[0]['LastName']; ?></h1>
      <p class="tag location">Nanjing, China</p>
    </header>

    <main class="flex">
      <div class="card">
        <h2>About Me</h2>
        <p>
        I am a junior student majoring in Computer Science and Engineering at UCSD Jacobs School of Engineering.
        </p>

        <p>
        My hobbies usually come and go. I enjoy playing chess, travelling, hanging out with friends, playing video games such as pokemon, and developing(AKA coding). Sportswise, I like skateboard, tennis, basketball,ping-pong, and cross-country.

        </p>

      </div>

      <div class="card">
        <h2>My Hobbies</h2>
        <p>My Hobbies include, but not limited to </p>
        <ul class="skills">
            <?php foreach($hobbies as $hobby) {?>
              <li><?php echo $hobby['Hobby']; ?></li>
            <?php } ?>
        </ul>

        <h2>My Goals</h2>
        <p>I love technology and problem-solving; my goals include learning and introspecting from my experience and interactions with others, building products which amaze people around me, and eveentually having a positive and impressive impact on the world through my contribution.</p>
      </div>

    </main>
    <footer>
      <ul>
        <li><a target="_blank" href="https://www.linkedin.com/in/haihao-sun/" class="social linkedin">LinkedIn</a></li>
        <li><a target="_blank" href="https://github.com/TribbianniSun" class="social github">Github</a></li>
      </ul>
    </footer>
  </body>
  </html>