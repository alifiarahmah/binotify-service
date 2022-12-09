<div class="login-container">
    <h1 class="login-title">To continue, please log in first.</h1>
    <form action="login/validate" method="post" class="login-form">
        <input class="login-input" type="text" name="username" placeholder="Username" />
        <input class="login-input" type="password" name="password" placeholder="Password" />
        <input type="submit" value="Login" />
    </form>
    <p>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>
    </p>
    <p class="login-register">Don't have an account? <a href="register">Register</a></p>
</div>