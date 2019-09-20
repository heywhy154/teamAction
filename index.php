<?php
include_once("./auth/validation.php");
if (isset($_SESSION['user']) != null) {
  header("location: dashboard");
}
$title = null;
$style_path = "assets/css/index.css";
include_once("./includes/head.php");
?>
<main id="main" class="position-fixed h-100 w-100">
  <div id="loginCaption" class="mt-5 text-center">
    <p class="mb-0 p-2"> Team Action </p>
    <p id="navCaption">Login to your Account</p>
  </div>
  <div id="regForm">
    <nav>
      <a href="#" class="active" for="login">Log in</a><a href="#" for="signup">Sign up</a>
    </nav>
    <div class="d-flex justify-content-center forms">
      <form id="loginSection" method="POST">
        <?php if (isset($error)) : ?>
          <div class="alert alert-danger h6 show fb_alert" role="alert">
            <small>Please enter correct login details</small>
          </div>
        <?php endif; ?>
        <fieldset class="fg">
          <label for="email">Email Address</label>
          <input type="email" name="email">
        </fieldset>

        <fieldset class="fg">
          <label for="password">Password</label>
          <input type="password" name="password">
        </fieldset>

        <fieldset class="fg">
          <label for="remember_me"><input type="checkbox"> <span class="spanbox">Remember me</span></label>
        </fieldset>

        <fieldset class="fg">
          <input type="submit" name="login" value="Log in" class="bg-success">
          <a href="#" class="float-right">Forgot password?</a>
        </fieldset>

      </form>
      <!-- end of login section -->
      <form id="signupSection">
        <div class="progress pgbar">
          <div class="progress-bar progress-bar-striped progress-bar-animated w-100 bg-info" role="progressbar">
            Processing registration...</div>
        </div>
        <div class="section active">

          <fieldset class="fg">
            <label><label for="Name">Full name</label></label>
            <input type="text" name="name" maxlength="50">
          </fieldset>

          <fieldset class="fg">
            <label><label for="Email">Email Address</label></label>
            <input type="email" name="email">
          </fieldset>

          <fieldset class="fg">
            <label><label>What's your Dev Stack</label></label>
            <input type="radio" name="position" value="UI/UX" checked> UI/UX &nbsp;&nbsp;
            <input type="radio" name="position" value="Front End"> Front end &nbsp;&nbsp;
            <input type="radio" name="position" value="Back End"> Back end
          </fieldset>


          <fieldset class="fg">
            <input type="button" for="nexprv" value="Next" class="bg-info">
          </fieldset>

        </div>
        <input type="reset" class="d-none">
        <div class="section">

          <fieldset class="fg">
            <label><label for="Username">Username</label></label>
            <input type="text" name="username" maxlength="20">
          </fieldset>

          <fieldset class="fg">
            <label><label for="Password">Password</label></label>
            <input type="password" name="p1">
          </fieldset>

          <fieldset class="fg">
            <label><label for="Password">Confirm password</label></label>
            <input type="password" name="p2">
          </fieldset>

          <fieldset class="fg">
            <input type="button" for="nexprv" value="Previous" class="bg-info">
            <input type="button" value="Sign Up" for="signup" class="float-right bg-success">
          </fieldset>

        </div>

      </form>
      <!-- end of signup section -->
    </div>
  </div>
  <div id="footer">
    <p class="mb-0 text-light text-center font-weight-bold" style="font-size: 14px">&COPY 2019 HNGI. Designed with <i class="fa fa-heart text-danger"></i> by TeamAction </p>
  </div>
</main>
<?php include_once("./includes/footer.php"); ?>