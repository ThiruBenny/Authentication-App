<?php
$conn = mysqli_connect("localhost", "root", "", "test");

// Choose a function depends on value of $_POST["action"]
if($_POST["action"] == "insert"){
 insert();
}

// Function
function insert(){
  global $conn;

  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];


  // Check if variable value is empty
  if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    // Output
    echo "";
    exit;
  }

// Validate languages
//$languagesArray = explode(',', $languages);
//$countLanguages = count($languagesArray);
// if($countLanguages <= 1){
// Output
//  echo 3;

}