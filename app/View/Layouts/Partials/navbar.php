<?php

    $user = user();

?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle -->
    <button
            id="sidebarToggleTop"
            class="btn btn-link d-md-none rounded-circle mr-3">

        <i class="fa fa-bars"></i>

    </button>

    <!-- Judul Halaman -->
    <h5 class="mb-0 text-gray-800 font-weight-bold">

        <?= $title ?? 'Dashboard' ?>

    </h5>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow">

            <a
                    class="nav-link dropdown-toggle d-flex align-items-center"
                    href="#"
                    id="userDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">

                <div class="text-right mr-3 d-none d-lg-block">

                    <div class="font-weight-bold text-gray-800">

                        <?= $user['name'] ?>

                    </div>

                    <small class="text-muted">

                        <?= ucfirst($user['role']) ?>

                    </small>

                </div>

                <?php if (has_avatar()): ?>

                    <img
                            src="<?= avatar() ?>"
                            alt="<?= $user['name'] ?>"
                            class="img-profile rounded-circle shadow"
                            style="
                            width:40px;
                            height:40px;
                            object-fit:cover;
                        ">

                <?php else: ?>

                    <div class="avatar-circle">

                        <?= initials($user['name']) ?>

                    </div>

                <?php endif; ?>

            </a>

            <div
                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">

                <a
                        class="dropdown-item"
                        href="<?= url('/profile') ?>">

                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

                    Profil

                </a>

                <a
                        class="dropdown-item"
                        href="<?= url('/profile/edit') ?>">

                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>

                    Ubah Profil

                </a>

                <a
                        class="dropdown-item"
                        href="<?= url('/profile/password') ?>">

                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>

                    Ubah Password

                </a>

                <div class="dropdown-divider"></div>

                <a
                        class="dropdown-item text-danger"
                        href="<?= url('/logout') ?>">

                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>

                    Logout

                </a>

            </div>

        </li>

    </ul>

</nav>