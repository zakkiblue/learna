<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/landing.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/landing.css.map">
    <title>LearnA</title>
</head>

<body>
    <header>
        <div class="logo-container">
            <img src="<?= base_url('assets/img/landing'); ?>/logo.svg" alt="logo">
            <h4 class="logo">LearnA</h4>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a class="nav-link" href="#">Home</a></li>
                <li><a class="nav-link" href="#">About</a></li>
                <li><a class="nav-link" href="#">Fa'Q</a></li>
            </ul>
        </nav>
        
    </header>
    <main>
        <section class="presentation">
            <div class="introduction">
                <div class="intro-text">
                    <h1>LearnA belajar siapkan diri</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="cta">
                    <button class="cta-select">Login</button>
                    <button class="cta-add">Registrasi</button>
                </div>

            </div>
            <div class="cover">
                <img src="./img/matebook.png" alt="matebook">
            </div>
        </section>
    </main>
    <img class="big-eclipse" src="<?= base_url('assets/img/landing'); ?>/big-eclipse.svg" alt="eclipse big">
    <img class="mid-eclipse" src="<?= base_url('assets/img/landing'); ?>/mid-eclipse.svg" alt="eclipse">
    <img class="small-eclipse" src="./img/small-eclipse.svg" alt="eclipse">

</body>

</html>