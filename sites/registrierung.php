<!-- <div id="reg_content">
    
        <div class="reg_form_input_txt">Username: </div><input class="reg_form_input" name="user_val" id="user_val" type="text" placeholder="Username" required>
        <div class="reg_form_input_txt">Passwort: </div><input class="reg_form_input" name="pw1_val" id="pw1_val" type="password" placeholder="Password" required>
        <div class="reg_form_input_txt">Passwort wiederholen: </div><input class="reg_form_input" name="pw2_val" id="pw2_val" type="password" placeholder="Password" required>
        <div class="reg_form_input_txt">Adresse: </div><input class="reg_form_input" name="addr_val" id="addr_val" type="text" placeholder="Musterstrasse 99" required>
        <div class="reg_form_input_txt">Ortschaft: </div><input class="reg_form_input" name="ort_val" id="ort_val" type="text" placeholder="Musterort" required>
        <div class="reg_form_input_txt">Postleitzahl: </div><input class="reg_form_input" name="plz_val" id="plz_val" type="text" placeholder="1234" required>
        <div class="reg_form_input_txt">Emailadresse: </div><input class="reg_form_input" name="mail_val" id="mail_val" type="email" placeholder="email@example.com" required>
        <div class="reg_form_input_txt">Vorname: </div><input class="reg_form_input" name="vname_val" id="vname_val" type="text" placeholder="Max" required>
        <div class="reg_form_input_txt">Nachname: </div><input class="reg_form_input" name="nname_val" id="nname_val" type="text" placeholder="Mustermann" required>
        <div class="reg_form_input_txt">Abschicken: </div><input class="reg_form_input" id="submit" type="submit" value="Submit" required>
    
</div> -->

<form name="regForm" id="regist_form" method="POST" action="?reg=1" onsubmit="return validateReg()">
<div class="container">
    <label for="user_val"><b>Username</b></label>
    <input class="reg_form_input" name="user_val" id="user_val" type="text" placeholder="Username" required>

    <label for="pw1_val"><b>Password</b></label>
    <input class="reg_form_input" name="pw1_val" id="pw1_val" type="password" placeholder="Password" required>

    <label for="pw2_val"><b>Password wiederholen</b></label>
    <input class="reg_form_input" name="pw2_val" id="pw2_val" type="password" placeholder="Password" required>

    <label for="user_val"><b>Adresse</b></label>
    <input class="reg_form_input" name="addr_val" id="addr_val" type="text" placeholder="Musterstrasse 99" required>
    
    <label for="user_val"><b>Ortschaft</b></label>
    <input class="reg_form_input" name="ort_val" id="ort_val" type="text" placeholder="Musterort" required>

    <label for="user_val"><b>Postleitzahl</b></label>
    <input class="reg_form_input" name="plz_val" id="plz_val" type="text" placeholder="1234" required>
    
    <label for="user_val"><b>Emailadresse</b></label>
    <input class="reg_form_input" name="mail_val" id="mail_val" type="email" placeholder="email@example.com" required>

    <label for="user_val"><b>Vorname</b></label>
    <input class="reg_form_input" name="vname_val" id="vname_val" type="text" placeholder="Max" required>

    <label for="user_val"><b>Nachname</b></label>
    <input class="reg_form_input" name="nname_val" id="nname_val" type="text" placeholder="Mustermann" required>
        
    <button class="reg_form_input" id="submit" type="submit" value="Submit" required>Abschicken</button>
</div>
</form>