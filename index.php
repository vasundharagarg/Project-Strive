<?php
//CODE TO TAKE INPUT OF THE TOPICS COVERED IN THE QUESTION PAPER AND UPLOAD THE QUESTION PAPER
session_start();
$successmsg = null;
$errormsg = null;
$display = 'none';
if(isset($_REQUEST['upload']))
{
  //QUESITON PAPER UPLOAD
  if($_FILES['file']['size'] > 0 && $_FILES["file"]["error"] == 0)
  {
    $paperid = $_REQUEST['paperid'];
    $papertitle = $_REQUEST['papertitle'];
    $_SESSION['filename'] = $paperid."-".$papertitle;
    $_SESSION['quant_topic'] = $_REQUEST['quant_topic'];
    $_SESSION['reasoning_topic'] = $_REQUEST['reasoning_topic'];
    $_SESSION['verbal_topic'] = $_REQUEST['verbal_topic'];


    $tmpname = $_FILES['file']['tmp_name'];
    if(move_uploaded_file("$tmpname","questionpapers/$paperid"."-".$papertitle))
    {
      $successmsg = "<span style='font-size: 1.1em; color: #2cb53e;'>Question Paper Uploaded Successfully!</span>";
      $display = 'block';
    }
  }
  else
  {
      $errormsg = "<span style='font-size: 1.1em; color: #f00;'>Something went wrong! Please try again!</span>";
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Project Strive</title>
    <link rel="stylesheet" href="css/master.css" media="screen" charset="utf-8"/>

    <script type="text/javascript">

    </script>
  </head>
  <body>
    <div class="wrapper">
      <header>
        Project Strive
      </header>

      <div class="content">
        <div class="next">
          <ul class="next-ul">
            <li class="next-li"><?php if(isset($successmsg)) echo $successmsg; if(isset($errormsg)) echo $errormsg; ?></li>
            <li class="next-li" style='display: <?php echo $display; ?>'><a href="classify-questions.php"><input type="button" value="Classify Questions >>>" id='next-button' class="buttons"></a></li>
          </ul>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="subjects">
            <div class="paperdetails-div">
              <div class="subject-heading">Paper Details</div>
              <ul class="paperdetails-ul">
                <li class="paperdetails-li"><input type="text" name="paperid" placeholder="Paper ID" class="input-fields" autofocus required></li>
                <li class="paperdetails-li"><input type="text" name="papertitle" placeholder="Paper Title" class="input-fields" required> </li>
              </ul>
            </div>

            <div class="center subject-div" id='quantdiv'>
              <div class="subject-heading">Quantitative</div>
              <ul class='subject-ul'>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q1" class="input-fields" id="q1"/><label for="q1">Number System</label></li>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q2" class="input-fields" id="q2"/><label for="q2">Permutations &amp Combinations</label></li>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q3" class="input-fields" id="q3"/><label for="q3">Time Speed Distance</label></li>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q4" class="input-fields" id="q4"/><label for="q4">Time and Work</label></li>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q5" class="input-fields" id="q5"/><label for="q5">Cubes</label></li>
                <li class="topic-li"><input type="checkbox" name="quant_topic[]" value="q6" class="input-fields" id="q6"/><label for="q6">Profit &amp Loss</label></li>
              </ul>
            </div>

            <div class="center subject-div" id='verbaldiv'>
              <div class="subject-heading">Reasoning</div>
              <div>
                <ul class='subject-ul'>
                  <li class="topic-li"><input type="checkbox" name="reasoning_topic[]" value="r1" class="input-fields" id="r1"/><label for="r1">Data Inpretation</label></li>
                  <li class="topic-li"><input type="checkbox" name="reasoning_topic[]" value="r2" class="input-fields" id="r2"/><label for="r2">Syllogism</label></li>
                  <li class="topic-li"><input type="checkbox" name="reasoning_topic[]" value="r3" class="input-fields" id="r3"/><label for="r3">Patterns</label></li>
                  <li class="topic-li"><input type="checkbox" name="reasoning_topic[]" value="r4" class="input-fields" id="r4"/><label for="r4">Assumptions</label></li>
                  <li class="topic-li"><input type="checkbox" name="reasoning_topic[]" value="r5" class="input-fields" id="r5"/><label for="r5">Logic</label></li>
                </ul>
              </div>
            </div>

            <div class="center subject-div" id='reasoningdiv'>
              <div class="subject-heading">Verbal</div>
              <ul class='subject-ul'>
                <li class="topic-li"><input type="checkbox" name="verbal_topic[]" value="v1" class="input-fields" id="v1"/><label for="v1">Sentence Correction</label></li>
                <li class="topic-li"><input type="checkbox" name="verbal_topic[]" value="v2" class="input-fields" id="v2"/><label for="v2">Error Spotting</label></li>
                <li class="topic-li"><input type="checkbox" name="verbal_topic[]" value="v3" class="input-fields" id="v3"/><label for="v3">Reading Comprehension</label></li>
                <li class="topic-li"><input type="checkbox" name="verbal_topic[]" value="v4" class="input-fields" id="v4"/><label for="v4">Prepostions</label></li>
                <li class="topic-li"><input type="checkbox" name="verbal_topic[]" value="v5" class="input-fields" id="v5"/><label for="v5">Vocabulary</label></li>
              </ul>
            </div>

            <div class="center submit-div">
              <ul class="submit-ul">
                <li class="submit-li" id="file-input"><label>Upload Question Paper&nbsp;&nbsp;&nbsp;</label><input type="file" name="file" required></li>
                <li class="submit-li"><input type="submit" name="upload" value="Upload" class="buttons" id="upload"></li>
              </ul>
            </div>
          </div><!-- SUBJECTS DIV ENDS -->
        </form>

      </div><!--CONTENT DIV ENDS -->
    </div><!--WRAPPER DIV ENDS -->

  </body>
</html>
