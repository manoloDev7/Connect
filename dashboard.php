<?php
if (empty($_SESSION['usuario_id'])) {
    header('Location: index.php?route=login');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
</head>
<body>

<!-- NAV -->
<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <?php $cand_unread = cand_unread_count($conexion); ?>

  <div>
    <a href="index.php?route=empleos">Empleos</a>
    <a href="index.php?route=favoritos">Favoritos</a>
    <a href="index.php?route=mis_postulaciones">Mis postulaciones</a>
    <a href="index.php?route=busquedas">Mis búsquedas</a>
    <a href="index.php?route=notificaciones_candidato" class="nav-bell">
      🔔
      <?php if ($cand_unread > 0): ?>
        <span class="badge badge--pill"><?= (int)$cand_unread ?></span>
      <?php endif; ?>
    </a>

    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">

  <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <!-- Bienvenida -->
  <div class="card" style="margin-bottom:16px">
    <h1 style="margin:0">Hola, <?=htmlspecialchars($_SESSION['nombre'] ?? 'Candidato')?></h1>
    
  </div>

  <!-- Búsqueda rápida -->
  <div class="card" style="margin-bottom:16px">
    <h3 style="margin:0 0 8px">Búsqueda rápida</h3>
    <form method="get" action="index.php" class="form" style="display:grid; gap:8px">
      <input type="hidden" name="route" value="empleos">
      <input class="input" type="search" name="q" placeholder="Palabra clave (ej. Contador, Vendedor, Soporte)" />
      <div style="display:grid; gap:8px; grid-template-columns: repeat(auto-fit, minmax(180px,1fr));">
        <input class="input" name="ubicacion" placeholder="Ubicación (ej. Puebla, CDMX)">
        <select class="input" name="categoria">
          <option value="">Categoría</option>
          <option>Administración</option>
          <option>Ventas</option>
          <option>Atención al cliente</option>
          <option>Logística</option>
          <option>Tecnologías de la Información</option>
          <option>Construcción</option>
          <option>Educación</option>
          <option>Salud</option>
          <option>Producción / Operaciones</option>
          <option>Recursos Humanos</option>
          <option>Marketing</option>
          <option>Mantenimiento</option>
          <option>Seguridad</option>
          <option>Gastronomía / Turismo</option>
          <option value="Otros">Otros</option>
        </select>
        <input class="input" type="number" name="salario_min" step="1" min="0" placeholder="Salario mínimo (MXN)">
      </div>
      <div>
        <button class="btn btn-primary" type="submit">Buscar empleos</button>
        
      </div>
    </form>
  </div>

  <!-- Accesos rápidos -->
  <div class="card" style="margin-bottom:16px">
    <h3 style="margin:0 0 8px">Accesos rápidos</h3>
    <div class="chips">
      <a class="chip" href="index.php?route=empleos">Explorar empleos</a>
      <a class="chip" href="index.php?route=favoritos">⭐ Favoritos</a>
      <a class="chip" href="index.php?route=mis_postulaciones">Mis postulaciones</a>
      <a class="chip" href="index.php?route=busquedas">Búsquedas guardadas</a>
    </div>
  </div>

  <!-- Explora por categorías (links listos) -->
  <div class="card" style="margin-bottom:16px">
    <h3 style="margin:0 0 8px">Explora por categoría</h3>
    <div class="chips">
      <a class="chip" href="index.php?route=empleos&categoria=Tecnologías%20de%20la%20Información">Tecnologías de la Información</a>
      <a class="chip" href="index.php?route=empleos&categoria=Ventas">Ventas</a>
      <a class="chip" href="index.php?route=empleos&categoria=Atención%20al%20cliente">Atención al cliente</a>
      <a class="chip" href="index.php?route=empleos&categoria=Logística">Logística</a>
      <a class="chip" href="index.php?route=empleos&categoria=Administración">Administración</a>
      <a class="chip" href="index.php?route=empleos&categoria=Salud">Salud</a>
      <a class="chip" href="index.php?route=empleos&categoria=Recursos%20Humanos">Recursos Humanos</a>
      <a class="chip" href="index.php?route=empleos&categoria=Gastronomía%20/%20Turismo">Gastronomía / Turismo</a>
      <a class="chip" href="index.php?route=empleos&categoria=Otros">Otros</a>
    </div>
  </div>

  <!-- Consejos -->
  <div class="card">
    <h3 style="margin:0 0 8px">Consejos rápidos</h3>
    <ul style="margin:0; padding-left:18px; line-height:1.6">
      <li>Usa la <strong>Búsqueda rápida</strong> para encontrar las mejores ofertas para ti
      <li>Agrega empleos a <strong>Favoritos</strong> con ⭐ y compáralos luego.</li>
      <li>Si una vacante te interesa, <strong>postúlate</strong> y (si la oferta lo permite) sube tu CV en PDF.</li>
    </ul>
  </div>

</div>

<div class="footer-space"></div>
</body>
</html>
