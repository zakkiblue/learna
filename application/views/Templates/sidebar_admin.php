<body>
    <nav class="navbar">
        <div class="foto-profil">
            <img src="<?= base_url('assets/img/profile/'); ?><?= $user['image']; ?>" alt="Profile foto">

        </div>
        <p><?= $user['name']; ?></p>
        <ul>
            <a href="<?= base_url('admin') ?>" class="nav-item">
                <li>Home</li>
            </a>
            <a href="<?= base_url('admin/profil/') ?>" class="nav-item">
                <li>Profil</li>
            </a>
            <a href="<?= base_url('admin/manage_materi/') ?>" class="nav-item">
                <li>Manage Materi</li>
            </a>
            <a href="<?= base_url('admin/monitor_siswa/') ?>" class="nav-item">
                <li>Monitor Siswa</li>
            </a>
            <a href="<?= base_url('admin/manage_quiz/') ?>" class="nav-item">
                <li>Manage Kuis</li>
            </a>
        </ul>
        <a class="logout" href="<?= base_url('auth/'); ?>logout">
            <p class="logout">Logout</p>
        </a>
    </nav>