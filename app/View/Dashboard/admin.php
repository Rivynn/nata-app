<div class="container-fluid">

    <!-- Welcome -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h3 class="font-weight-bold text-primary mb-2">

                Halo, <?= explode(' ', user()['name'])[0] ?> 👋

            </h3>

            <p class="text-muted mb-0">

                Selamat datang di
                <strong><?= app_name() ?></strong>.

                Kelola data peserta pelatihan tenaga kerja secara mudah, cepat, dan terintegrasi.

            </p>

        </div>

    </div>

    <!-- Statistik -->

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-primary shadow-sm h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                                Total User

                            </div>

                            <div class="h3 mb-0 font-weight-bold">

                                <?= $totalUsers ?>

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-users fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-success shadow-sm h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                Pegawai

                            </div>

                            <div class="h3 mb-0 font-weight-bold">

                                <?= $totalEmployees ?>

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-id-card fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-info shadow-sm h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">

                                Peserta

                            </div>

                            <div class="h3 mb-0 font-weight-bold">

                                <?= $totalParticipants ?>

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-warning shadow-sm h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

                                Pelatihan

                            </div>

                            <div class="h3 mb-0 font-weight-bold">

                                <?= $totalTrainings ?>

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-book fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Quick Access -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h6 class="m-0 font-weight-bold text-primary">

                Menu Cepat

            </h6>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-lg-4 mb-4">

                    <div class="card dashboard-menu h-100">

                        <div class="card-body text-center">

                            <i class="fas fa-users fa-3x text-primary mb-3"></i>

                            <h5 class="font-weight-bold">

                                Kelola User

                            </h5>

                            <p class="text-muted">

                                Tambah, ubah dan kelola akun pengguna.

                            </p>

                            <a
                                    href="<?= url('/admin/users') ?>"
                                    class="btn btn-primary btn-sm">

                                Kelola

                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 mb-4">

                    <div class="card dashboard-menu h-100">

                        <div class="card-body text-center">

                            <i class="fas fa-user-graduate fa-3x text-success mb-3"></i>

                            <h5 class="font-weight-bold">

                                Data Peserta

                            </h5>

                            <p class="text-muted">

                                Kelola seluruh peserta pelatihan.

                            </p>

                            <a
                                    href="<?= url('/admin/participants') ?>"
                                    class="btn btn-success btn-sm">

                                Lihat

                            </a>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4 mb-4">

                    <div class="card dashboard-menu h-100">

                        <div class="card-body text-center">

                            <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>

                            <h5 class="font-weight-bold">

                                Laporan

                            </h5>

                            <p class="text-muted">

                                Cetak laporan peserta dan pelatihan.

                            </p>

                            <a
                                    href="<?= url('/admin/reports') ?>"
                                    class="btn btn-danger btn-sm">

                                Cetak

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

