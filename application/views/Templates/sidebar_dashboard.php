<body>
    <nav class="navbar">
        <div class="foto-profil">
            <img src="<?= base_url('assets/img/profile/'); ?><?= $user['image']; ?>" alt="Profile foto">

        </div>
        <p><?= $user['name']; ?></p>
        <ul>
            <li>Home</li>
            <li>Profil</li>
            <li>Raport</li>
            <li>Bag</li>
        </ul>
        <a href="<?= base_url(); ?>auth/logout">
            <p class="logout">Logout</p>
        </a>
    </nav>