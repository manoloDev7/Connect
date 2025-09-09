<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Mi panel</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="assets/app.css">
  <style>
    
  </style>
</head>
<body>

  <!-- NAV superior (usa tus clases existentes) -->
  <div class="nav">
    <div><a href="index.php">Connect</a></div>
    <div class="opo">
      <a class="btn btn-secondary btn-sm" href="index.php?route=empleos">Explorar empleos</a>
      <a class="btn btn-secondary btn-sm" href="index.php?route=favoritos">Favoritos</a>
      
      <a class="btn btn-secondary btn-sm" href="index.php?route=logout">Salir</a>
    </div>
  </div>

  <div class="container">

    <!-- Flashes (mismo patrón que usas en otras vistas) -->
    <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
      <div class="flash <?= $f['t']==='ok' ? 'flash--ok' : 'flash--err' ?>">
        <?= htmlspecialchars($f['m']) ?>
      </div>
    <?php endforeach; $_SESSION['flash']=[]; endif; ?>

    <h2 style="margin:0 0 12px">Hola, <?= htmlspecialchars($_SESSION['nombre'] ?? 'Candidato') ?></h2>

    <!-- Acciones rápidas -->
    <div class="card" style="margin-bottom:16px">
      <h3 style="margin:0 0 8px">Acciones rápidas</h3><br>
      <div>
        <a class="btn btn-primary"   href="index.php?route=empleos">Buscar empleos</a>
        <a class="btn btn-secondary" href="index.php?route=favoritos">Ver favoritos</a>
        
      </div>
    </div>

    <!-- Sugerencias -->
    <div class="card" style="margin-bottom:16px">
      <h3 style="margin:0 0 8px">Sugerencias</h3>
      <ul style="margin:0; padding-left:18px; line-height:1.6">
        <li>Completa tu perfil y sube tu CV en PDF.</li>
        <li>Activa alertas con “Búsquedas guardadas”.</li>
        <li>Guarda ofertas con ⭐ para revisarlas después.</li>
      </ul>
    </div>

    <!-- Qué sigue -->
    <div class="card">
      <h3 style="margin:0 0 8px">¿Qué sigue?</h3>
      <ol style="margin:0; padding-left:18px; line-height:1.6">
        <li>Entra a <strong>Explorar empleos</strong> y filtra por categoria/ubicación.</li>
        <li>Guarda una búsqueda (palabra clave + filtros) para consultarla rápido.</li>
        <li>Revisa tus favoritos y postúlate.</li>
      </ol>
      
    </div>

  </div>

  <div class="footer-space"></div>
</body>
</html>
