<?php
session_start();

require('assets/vendor/autoload.php');
use Rakit\Validation\Validator;

$validator = new Validator;

require("backend/db.php");
$db = new DB;

if(isset($_POST["signup"])){ 
  $validation = $validator->make($_POST,[
    'username'    => 'required',
    'email'       => 'required|email',
    'password'    => 'required|min:8',
    'password_confirmation' => 'required|same:password'
  ]);
  $validation->validate();

  if($validation->fails()){
    $errors = $validation->errors()->firstOfAll();
  } else {
    $data = array(
      'username' => $_POST['username'],
      'email' => $_POST['email'],
      'password' => $_POST['password']
    );

    if(!$db->checkEmailAndUsername($data)){
      $errors[0] = "Username or Email already exist! Please choose another one!";
    } else {
      if(!$db->saveUserdata($data)){  
        $errors[0] = "DB Connection cannot estasblished right now!";
      } else {
        $success = "Success Register"; 
      }
    }
  }
} else 
if(isset($_POST['signin'])){
  $validation = $validator->make($_POST,[
    'username'    => 'required',
    'password'    => 'required'
  ]);
  $validation->validate();

  if($validation->fails()){
    $errors = $validation->errors()->firstOfAll();
  } else {
    $data = array(
      'username' => $_POST['username'],
      'password' => $_POST['password']
    );

    if(!$db->checkLogin($data)){
      $errors[0] = "Username or Password wrong!";
    } else {
      if(isset($_POST['remember'])){
        setcookie('username',$_POST['username'],time() + (86400 * 30), "/");
      }

      $_SESSION['username'] = $_POST['username'];
      header("location: manage/index.php");
    }
  }
} else
if(isset($_SESSION['username'])){
  header('location: manage/index.php');
} 
else if(isset($_COOKIE['username'])){
  $_SESSION['username'] = $_COOKIE['username'];
  header("location: manage/index.php");
}

?>

<?php include_once("template/header.php"); ?>

<main class="align-item-center min-vh-100 py-3 py-md-0" id="main">
  <section id="formsign">
    <div class="container">

    <?php
      if(!empty($errors)){
        foreach($errors as $error){
          echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
        }
      }

      if(!empty($success)){
        echo "<div class='alert alert-success' role='alert'>".$success."</div>";
      }
    ?>

      <div class="row mb-4">
        <div class="col-md-6 mx-auto p-0 align-item-center">
          <div class="card">
            <div class="login-box">
              <div class="login-snip"> 
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                <label for="tab-1" class="tab">Login</label> 
                <input id="tab-2" type="radio" name="tab" class="sign-up">
                <label for="tab-2" class="tab">Sign Up</label>
                <div class="login-space">
                  <form action="" method="post">
                    <div class="login">
                      <div class="group"><label for="user" class="label">Username</label> <input name="username" id="user" type="text" class="input" placeholder="Enter your username"> </div>
                      <div class="group"><label for="pass" class="label">Password</label> <input name="password" id="pass" type="password" class="input" data-type="password" placeholder="Enter your password"> </div>
                      <div class="group"><input name="remember" id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                      <div class="group"> <input type="submit" name="signin" class="button" value="Sign In"> </div>
                      <div class="hr"></div>
                      <div class="foot">
                        <a href="#">Forgot Password?</a> 
                      </div>
                    </div>
                  </form>
                  <form action="" method="post">
                    <div class="sign-up-form">
                      <div class="group"> <label for="user" class="label">Username</label> <input name="username" id="user" type="text" class="input" placeholder="Create your username"> </div>
                      <div class="group"> <label for="pass" class="label">Password</label> <input name="password" id="pass" type="password" class="input" data-type="password" placeholder="Create your password"> </div>
                      <div class="group"> <label for="pass" class="label">Repeat Password</label> <input name="password_confirmation" id="pass" type="password" class="input" data-type="password" placeholder="Repeat your password"> </div>
                      <div class="group"> <label for="pass" class="label">Email Address</label> <input name="email" id="pass" type="text" class="input" placeholder="Enter your email address"> </div>
                      <div class="group"> <input type="submit" name="signup" class="button" value="Sign Up"> </div>
                      <div class="hr"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include_once("template/footer.php"); ?>