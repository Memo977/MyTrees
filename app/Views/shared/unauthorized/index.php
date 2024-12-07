<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso No Autorizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
            url('https://www.arenalobservatorylodge.com/wp-content/uploads/2023/01/Volcan-Arenal-4.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #e0e0e0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        animation: fadeIn 0.5s ease-out;
        max-width: 500px;
        width: 90%;
        padding: 2rem;
    }

    .error-icon {
        font-size: 4rem;
        color: #dc3545;
        margin-bottom: 1rem;
    }

    .btn-primary {
        background-color: rgba(92, 107, 192, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
    }

    .btn-primary:hover {
        background-color: rgba(63, 81, 181, 0.95);
        transform: translateY(-2px);
    }

    h1 {
        color: #ffffff;
        font-size: 2rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    p {
        color: #e0e0e0;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .page-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
        pointer-events: none;
        z-index: -1;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <div class="page-overlay"></div>
    <div class="card text-center">
        <div class="card-body">
            <i class="bi bi-exclamation-triangle-fill error-icon"></i>
            <h1>Acceso No Autorizado</h1>
            <p>No tienes permisos para acceder a esta sección. Por favor, contacta al administrador si crees que esto es
                un error.</p>
            <a href="<?= base_url('login') ?>" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
        </div>
    </div>
</body>

</html>