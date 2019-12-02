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
                <div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit nemo amet dicta nobis rerum, delectus, animi rem odio cupiditate laboriosam placeat perferendis quisquam voluptatibus consequatur neque modi voluptatum, suscipit dolorum?
                    Reiciendis, illo, vitae voluptatibus error tenetur autem eaque sapiente, deserunt porro quae nihil ipsa culpa magnam aliquam sequi magni ratione esse eius nam. Quisquam, mollitia inventore repellat est enim assumenda?
                    Quisquam id culpa sint eaque. Adipisci, ducimus id! Aliquid ea nam numquam officia, facere eveniet quae soluta dolore architecto modi incidunt aperiam corrupti quaerat totam! Inventore aperiam similique voluptatem aut.
                    Unde quisquam, debitis vero ut, aliquam neque vitae libero voluptates ipsum ad veritatis iusto culpa minima assumenda atque, architecto laborum? Nam consequatur excepturi unde sit facilis commodi adipisci amet qui.
                    Sint officiis deserunt natus quo doloribus ad quis quisquam dolorum ipsam nemo modi reiciendis, consequatur sapiente, quam id culpa. Vel dicta, iure illo quibusdam assumenda laborum fuga laboriosam quae eum.</div>
            </div>
        </section>
    </main>


</body>

</html>