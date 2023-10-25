<form class="login_form" action="src/model.php" method="POST">
  <div>
    <p >Please fill in this form to create an account.</p>
    
    <div>
      <label for="login_log" ><b>login</b></label><br>
      <input type="text" placeholder="Enter login" name="login_log" id="login_log" class="form_input" required><br>
    </div>
    
    <div>
      <label for="psw_log"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="psw_log" id="psw_log" class="form_input"  required><br>
    </div>

    <button type="submit" class="loginbtn">login</button>
  </div>

</form>