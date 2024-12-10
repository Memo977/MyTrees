<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
            <i class="bi bi-tree"></i> Un Millón de Árboles
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url($baseRoute . '/staff') ?>">
                        <i class="bi bi-person-badge"></i> Gestionar Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/especies') ?>">
                        <i class="bi bi-tree"></i> Especies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('admin/arboles') ?>">
                        <i class="bi bi-flower1"></i> Árboles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/amigos') ?>">
                        <i class="bi bi-people"></i> Amigos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url($baseRoute . '/historial') ?>">
                        <i class="bi bi-clock-history"></i> Historial
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?= session()->get('nombre') ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>