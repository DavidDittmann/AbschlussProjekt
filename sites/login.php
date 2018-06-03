<div id="log_div">
    <form id="log_form" name="logForm" method="POST" action="?log=1" onsubmit="return validateLog()">
        <div class="log_form_input_txt">Username: </div><input class="log_form_input" type="text" name="uname" placeholder="Username" required>
        <div class="log_form_input_txt">Passwort: </div><input class="log_form_input" type="password" name="pw" placeholder="Passwort123!" required>
        <div class="log_form_input_txt">Abschicken: </div><input class="reg_form_input" id="submit" type="submit" value="Submit">
    </form>
</div>