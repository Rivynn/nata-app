<ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar">

    <!-- Brand -->

    <a
            class="sidebar-brand d-flex align-items-center justify-content-center"
            href="<?= url(dashboard_url()) ?>">

        <div class="sidebar-brand-icon">

            <img
                    src="<?= asset('img/logo-nobg.png') ?>"
                    class="img-fluid"
                    style="width:42px;height:42px;object-fit:contain;">

        </div>

        <div class="sidebar-brand-text mx-2">

            <?= app_name() ?>

        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <?php foreach(menu() as $index => $menu): ?>

        <?php if(!can($menu['roles'])) continue; ?>

        <?php if(!empty($menu['children'])): ?>

            <?php

            $collapseId = 'menu-'.$index;

            $active = false;

            foreach($menu['children'] as $child){

                if(is_active($child['url'])){

                    $active = true;

                    break;

                }

            }

            ?>

            <li class="nav-item <?= $active ? 'active' : '' ?>">

                <a
                        class="nav-link <?= $active ? '' : 'collapsed' ?>"
                        href="#"
                        data-toggle="collapse"
                        data-target="#<?= $collapseId ?>"
                        aria-expanded="<?= $active ? 'true' : 'false' ?>">

                    <i class="<?= $menu['icon'] ?>"></i>

                    <span><?= $menu['title'] ?></span>

                </a>

                <div
                        id="<?= $collapseId ?>"
                        class="collapse <?= $active ? 'show' : '' ?>"
                        data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">

                        <?php foreach($menu['children'] as $child): ?>

                            <a
                                    class="collapse-item <?= is_active($child['url']) ?>"
                                    href="<?= url($child['url']) ?>">

                                <i class="<?= $child['icon'] ?> fa-sm mr-2"></i>

                                <?= $child['title'] ?>

                            </a>

                        <?php endforeach; ?>

                    </div>

                </div>

            </li>

        <?php else: ?>

            <?php

            $url = $menu['url'];

            if($url == '/'){

                $url = dashboard_url();

            }

            ?>

            <li class="nav-item <?= is_active($url) ?>">

                <a
                        class="nav-link"
                        href="<?= url($url) ?>">

                    <i class="<?= $menu['icon'] ?>"></i>

                    <span><?= $menu['title'] ?></span>

                </a>

            </li>

        <?php endif; ?>

    <?php endforeach; ?>

    <hr class="sidebar-divider">

    <li class="nav-item">

        <a
                class="nav-link"
                href="<?= url('/logout') ?>">

            <i class="fas fa-fw fa-sign-out-alt"></i>

            <span>Logout</span>

        </a>

    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">

        <button
                class="rounded-circle border-0"
                id="sidebarToggle">
        </button>

    </div>

</ul>