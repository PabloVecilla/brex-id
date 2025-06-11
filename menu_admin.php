<?php include "valida_usuario.php" ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? "Brex-id"; ?></title>
    <link rel="stylesheet" href="brex-id.css?v=15">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script src="https://kit.fontawesome.com/d65c17a29d.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <!-- BARRA DE NAVEGACIÓN -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary container-fluid">
            <div class="container-fluid">
              <a class="navbar-brand" href="home.php">Brex-id</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="admin.php">Añadir Contenido</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ver_even.php">Mostrar eventos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ver_art.php">Mostrar artículos</a>
                  </li>
                  <li>
                    <form class="d-flex" role="search" action="buscar.php" method="get">
                      <input class="form-control me-2" type="search" placeholder="Buscar artículos o eventos..." aria-label="Buscar artículos o eventos..." required name="bus"/>
                      <button class="btn btn-outline" type="submit">Buscar</button>
                    </form>
                  </li>
                  <li class="nav-item right">
                    <a href="logout.php" class="nav-link">Cerrar sesión</a>
                  </li>
                </ul>
              </div>
              
            </div>
          </nav>
    </header>