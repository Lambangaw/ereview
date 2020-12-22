<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?= base_url('signup/'); ?>SignUp/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?= base_url('signup/'); ?>SignUp/css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <img src="<?= base_url('signup/'); ?>signup/images/signup-bg.jpg" alt="">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="creatingaccount" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="nama" id="nama" placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="email" id="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="sandi" id="sandi" placeholder="Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="email" id="email" placeholder="Your Email" />
                        </div>
                        <br />
                        peran :
                        <select name="peran">
                            <option value="1" selected>
                                Editor
                            </option>
                            <option value="2">
                                Reviewer
                            </option>
                        </select>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="http://localhost/ereview/index.php/accountctl/checkinglogin" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?= base_url('signup/'); ?>signup/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('signup/'); ?>signup/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>