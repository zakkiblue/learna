<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <title>Register</title>
</head>

<body>
    <section class="login">
        <div class="contents signup">
            <div class="banner-login signup">
                <h2 class="login-banner">Start your journey</h2>
                <P>Sign up now to start an exciting learning experience.</P>

                <a href="<?= base_url('Auth') ?>" class="sign-up">LOGIN</a>
            </div>
            <div class="form-login signup">
                <h1 class="login-text">Registration</h1>
                <p>register Your Account</p>
                <form action="<?= base_url('Auth/signup') ?>" method="post">
                    <input type="text" name="name" placeholder="Name">
                    <small class="form-error"><?= form_error('name'); ?></small>
                    <input type="text" name="email" placeholder="Email">
                    <small class="form-error"><?= form_error('email'); ?></small>
                    <input type="password" name="password1" placeholder="Password" id="password1">
                    <small class="form-error"><?= form_error('password1'); ?></small>
                    <input type="password" name="password2" placeholder="Password" id="password2">
                    <select name="jurusan" id="jurusan" class="styled-select">
                        <option value="mipa">Matematika dan Ilmu Pengetahuan Alam</option>
                        <option value="ips">Ilmu Pengetahuan Sosial</option>
                    </select>
                    <button type="submit">Sign Up</button>
                </form>
            </div>

        </div>
    </section>
</body>

</html>