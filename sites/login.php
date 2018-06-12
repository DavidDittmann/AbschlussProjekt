<form id="log_form" name="logForm" method="POST" action="?log=1" onsubmit="return validateLog()">
  <div class="imgcontainer">
    <img src="./res/img/img_avatar.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input class="log_form_input" type="text" name="uname" placeholder="Username" required>

    <label for="psw"><b>Password</b></label>
    <input class="log_form_input" type="password" name="pw" placeholder="Passwort123!" required>
        
    <button class="reg_form_input" id="submit" type="submit" value="Submit">Login</button>
  </div>
</form>