<?php
//CODE TO PROVIDE AN INTERFACE TO THE TEACHER TO CLASSIFY QUESTIONS IN THE QUESTION PAPER ALREADY UPLOADED IN THE index.php file
session_start();

$filename = $_SESSION['filename'];
$quant_topic = $_SESSION['quant_topic'];
$reasoning_topic = $_SESSION['reasoning_topic'];
$verbal_topic = $_SESSION['verbal_topic'];
$N = count($quant_topic);

$search1 = "Ques:";
$search2 = "A.";
$search3 = "B.";
$search4 = "C.";
$search5 = "D.";
$search6 = "Ans:";

$matches1 = array();
$matches2 = array();
$matches3 = array();
$matches4 = array();
$matches5 = array();
$matches6 = array();

$handle = fopen("C:\wamp\www\Project-Strive-master/test.txt","r") or exit("Unable to open file!!!");
if ($handle)
{
    while (!feof($handle))
    {
        $buffer = fgets($handle);
        if(strpos($buffer, $search1) !== FALSE)
            $matches1[] = $buffer;
            
        if(strpos($buffer, $search2) !== FALSE)
            $matches2[] = $buffer;
            
        if(strpos($buffer, $search3) !== FALSE)
            $matches3[] = $buffer;
            
        if(strpos($buffer, $search4) !== FALSE)
            $matches4[] = $buffer;
            
        if(strpos($buffer, $search5) !== FALSE)
            $matches5[] = $buffer;
            
        if(strpos($buffer, $search6) !== FALSE)
            $matches6[] = $buffer;
    }
    fclose($handle);
}
$n=count($matches1);

?>

<html>
<head>

<script src="jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#b1").click(function(){
        
         var i=$(this).attr("title");
        var topic_id=$("input[type='radio']:checked").val();
        var ques = $('#ques').val();
     var opt1 = $('#opt1').val();
     var opt2 = $('#opt2').val();
     var opt3 = $('#opt3').val();
     var opt4 = $('#opt4').val();
     var ans = $('#ans').val();
        $.ajax({
          type: 'GET',
          url: 'process.php',
          data: { ques: ques, opt1: opt1, opt2: opt2, opt3: opt3, opt4: opt4, ans: ans,topic_id:topic_id },
          success: function(response) {
            $('#result').html(response);
            }
            });
        
         var n=<?php echo json_encode($n); ?>;
        if(n==i)
        {
            window.location.href='alldone.html';
        }
        else
        {
            i++;
        $(this).attr("title",i);
        }
        
       var a1=<?php echo json_encode($matches1);?>;
       var b1=a1[i].substring(5);
       $("#ques").attr("value",b1);
        var a2=<?php echo json_encode($matches2);?>;
       var b2=a2[i].substring(2);
       $("#opt1").attr("value",b2);
        var a3=<?php echo json_encode($matches3);?>;
       var b3=a3[i].substring(2);
       $("#opt2").attr("value",b3);
        var a4=<?php echo json_encode($matches4);?>;
       var b4=a4[i].substring(2);
       $("#opt3").attr("value",b4);
        var a5=<?php echo json_encode($matches5);?>;
       var b5=a5[i].substring(2);
       $("#opt4").attr("value",b5);
        var a6=<?php echo json_encode($matches6);?>;
       var b6=a6[i].substring(4);
       $("#ans").attr("value",b6);
        
      
        });
});
</script>

</head>
<body>
<form>
<?php $i=0;?>
Ques: &nbsp; &nbsp; &nbsp;<input type="text" name="ques" id="ques" value= "<?php echo substr($matches1[0],5)?>"/>  <br /><br />
A. &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="option1" id="opt1" value='<?php echo substr($matches2[0],2)?>'/> <br /><br />
B. &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="option2" id="opt2" value='<?php echo substr($matches3[0],2)?>' /> <br /><br />
C. &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="option3" id="opt3" value='<?php echo substr($matches4[0],2)?>'/> <br /><br />
D. &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="option4" id="opt4" value='<?php echo substr($matches5[0],2)?>'/> <br /><br />
Ans: &nbsp; &nbsp; &nbsp;&nbsp;<input type="text" name="answer" id="ans" value='<?php echo substr($matches6[0],4)?>'/> <br /><br />
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "strive";

for($j=0; $j < $N; $j++)
    {
        $x =$quant_topic[$j];
        // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
        $sql = "SELECT topic FROM topics WHERE topic_id = '$x'";
        
        // perform the query and store the result
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
    }

// if the $result contains at least one row
while ($row = mysqli_fetch_array($result))
{
      ?>
       <li class="topic-li"><input type="radio" name="topic_id" value='<?php echo htmlspecialchars($quant_topic[$j] )?>' class="input-fields"/><?php echo $row['topic']; ?></li>
  <?php 
 }

 }
 mysqli_close($conn);
?>
</form>
<button id="b1" name="next" title='<?php echo "$i"?>'>next </button>
<div id="result"></div>

</body>
</html>

