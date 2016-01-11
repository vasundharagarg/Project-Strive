        <?php

  $ques=$_REQUEST['ques'];
  $opt1=$_REQUEST['opt1'];
$opt2=$_REQUEST['opt2'];
$opt3=$_REQUEST['opt3'];
$opt4=$_REQUEST['opt4'];
  $ans=$_REQUEST['ans'];
  $topic_id=$_REQUEST['topic_id'];
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strive";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//$sql = "INSERT INTO questions(ques, options, ans,topic_id)
//VALUES ('$ques',' 1:'.'$opt1'.',2:'.'$opt2'.',3:'.'$opt3'.',4:'.'$opt4', '$ans','$topic_id')";
$sql = "INSERT INTO questions(ques, options, ans,topic_id)
VALUES ('$ques','$opt1', '$ans','$topic_id')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

                ?>
