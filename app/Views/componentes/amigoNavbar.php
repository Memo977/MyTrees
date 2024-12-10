<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('amigo/dashboard') ?>">
            <i class="bi bi-tree"></i> Un Millón de Árboles
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('amigo/dashboard') ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('amigo/arboles') ?>">
                        <i class="bi bi-tree"></i> Mis Árboles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('amigo/arboles-disponibles') ?>">
                        <i class="bi bi-shop"></i> Comprar
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
                        <li><a class="dropdown-item" href="<?= base_url('amigo/perfil') ?>">
                                <i class="bi bi-person"></i> Mi Perfil
                            </a></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>