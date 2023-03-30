<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
  /* $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;*/

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         //$insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form id="myForm" action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="confirm_password" placeholder="confirm password" class="box" required>
      <input type="submit" name="submit" value="register now" class="btn" onclick = "insert();">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>
   <script type="text/javascript">
      // Prevent form from submit or refresh
      var form = document.getElementById("myForm");
      function handleForm(event) { event.preventDefault(); }
      form.addEventListener('submit', handleForm);
      // Function
      function insert(){
        $(document).ready(function(){

          // Make an array of languages to insert multiple checkbox values of languages
          var languages = [];
          $("input[name=languages]").each(function(){
            if($(this).is(":checked")){
              languages.push($(this).val());
            }
          });

          $.ajax({
            // Action
            url: 'function.php',
            // Method
            type: 'POST',
            data: {
              // Get value
              name: $("input[name=name]").val(),
              email: $("input[name=email]").val(),
              password: $("input[name=password]").val(),
              confirm_password: $("select[name=confirm_password]").val(),
              action: "insert"
            },
            success:function(response){
              // Response is the output of action file
              if(response == 1){
                alert("Data Added Successfully!");
              }
             /* else if(response == 2){
                alert("Email Is Not Available");
              }
              else if(response == 3){
                alert("You Must Be Able To Speak More Than 1 Language");
              }*/
              else{
                
              }
            }
          });
        });
      }
    </script>

</div>

</body>
</html>