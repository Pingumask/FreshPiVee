<form action="handle_log_in.php" method="post">
    <h2>Log In</h2>
    <input type="text" name="email" placeholder="email" required/>
    <input type="password" name="password" placeholder="password" required/>
    <input type="submit" value="Sign Up"/>
</form>

<form action="handle_sign_up.php" method="post">
    <h2>Sign Up</h2>
    <input type="text" name="nickname" placeholder="Nickname" pattern="[a-Z].*{7,}" required/>
    <input type="email" name="email" placeholder="E-mail" patter=".*@.*" required/>
    <input type="password" name="password" placeholder="Password" required/>
    <input type="password" name="confirmPassword" placeholder="Confirm Password" required/>
    <input type="date" name="birthday" placeholder="Birthday" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required/>
    <input type="submit" value="Log In"/>
</form>