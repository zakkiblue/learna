<body>
    <nav class="navbar">
        <div class="foto-profil">
            <img src="<?= base_url('assets/img/profile/'); ?><?= $user['image']; ?>" alt="Profile foto">

        </div>
        <p><?= $user['name']; ?></p>
        <ul>
            <a href="#" class="nav-item">
                <li>Home</li>
            </a>
            <a href="<?= base_url('user_mipa/materi/') ?>" class="nav-item">
                <li>Materi</li>
            </a>
            <a href="#" class="nav-item">
                <li>Profil</li>
            </a>
        </ul>
        <a class="logout" href="<?= base_url(); ?>auth/logout">
            <p class="logout">Logout</p>
        </a>
    </nav>