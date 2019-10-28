<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <title>LOGIN</title>
</head>

<body>
    <?= $this->session->flashdata('massage'); ?>
    <section class="login">
        <div class="contents">
            <div class="form-login">
                <h1 class="login-text">Login</h1>
                <p>Sign in to your account</p>
                <form action="" method="post">
                    <input type="text" name="email" placeholder="Email">
                    <small class="form-error"><?= form_error('email'); ?></small>
                    <input type="password" name="password" placeholder="Password">
                    <small class="form-error"><?= form_error('password'); ?></small>
                    <button type="submit">Login</button>
                </form>
            </div>
            <div class="banner-login">
                <h2 class="login-banner">Don't have an account ?</h2>
                <P>Sign up now to start an exciting learning experience.</P>
                <a href="<?= base_url('Auth/signup') ?>" class="sign-up">Get Started</a>
            </div>
        </div>
    </section>
</body>

</html>