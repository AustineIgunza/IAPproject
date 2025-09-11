<?php
class Forms {
    public function signup() {
?>
<form action="mail.php" method="post">
  <div class="mb-3">
    <label for="exampleInputName1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputName1" name="name" aria-describedby="nameHelp" required>
    <div id="nameHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
  </div>
  <?php $this->submit_button('Sign Up', 'signup'); ?> 
  <a href="signin.php">Already have an account? Login</a>
</form>
<?php
    }

    private function submit_button($value, $name) {
?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>">
            <?php echo $value; ?>
        </button>
<?php
    }

    public function signin() {
?>
<form action="signin_handler.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
  </div>
  <?php $this->submit_button('Sign In', 'signin'); ?> 
  <a href="signup.php">Don't have an account? Sign Up</a>
</form>
<?php
    }
}
