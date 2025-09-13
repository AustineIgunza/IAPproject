<?php
class Forms {
    public function signup() {
?>
<form method="post" action="process_signup.php">
  <div class="mb-3">
    <label for="exampleInputName1" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="exampleInputName1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
  </div>
  <?php $this->submit_button('Sign Up', 'signup'); ?>
  <a href='signin.php'>Already have an account? Login</a>
</form>
<?php
    }

    private function submit_button($value, $name) {
?>
        <button type='submit' class="btn btn-primary" name='<?php echo $name; ?>'><?php echo $value; ?></button>
<?php
    }

    public function signin() {
?>
<form method="post" action="process_signin.php">
  <div class="mb-3">
    <label for="signinEmail" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email" id="signinEmail" required>
  </div>
  <div class="mb-3">
    <label for="signinPassword" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="signinPassword" required>
  </div>
  <?php $this->submit_button('Sign In', 'signin'); ?>
  <a href='signup.php'>Don't have an account? Sign Up</a>
</form>
<?php
    }
}
