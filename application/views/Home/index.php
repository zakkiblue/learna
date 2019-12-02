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
                <li><a class="nav-link" href="#about">About</a></li>

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
                    <a href="<?= base_url('auth'); ?>"><button class="cta-select">Login</button></a>
                    <a href="<?= base_url('auth/signup'); ?>"><button class="cta-add">Registrasi</button></a>
                </div>

            </div>
            <div class="cover">
                <img src="<?= base_url('assets/img/landing'); ?>/online_quiz.svg" alt="cover">
            </div>
        </section>
        <section id="about">
            <div class="background"></div>
            <div class="image">
                <img src="<?= base_url('assets/img/landing'); ?>/toga.svg" alt="toga">
            </div>
            <div class="text">
                <h2>About</h2>
                <div>LearnA merupakan platform e-learning protoype yang ditujukan untuk siswa sma atau sederajatnya untuk mempersiapkan diri menuju ujian atau kelulusan. Berisi materi tentang mata pelajaran baik dari jurusa Matematika dan Ilmu Pengetahuan Alam ataupun Ilmu Pengetahuan Sosial.</div>
            </div>
        </section>
    </main>


</body>

</html>