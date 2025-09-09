<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mis búsquedas</title>
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
</head>
<body>
<div class="nav">
  <?php $cand_unread = cand_unread_count($conexion); ?>
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw">
  <div>
    <a href="index.php?route=dashboard">Mi panel</a>
    <a href="index.php?route=empleos">Empleos</a>
    <a href="index.php?route=favoritos">Favoritos</a>
    <a href="index.php?route=notificaciones_candidato" class="nav-bell">
      <span>🔔</span>
      <?php if (!empty($cand_unread)): ?>
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

  <div class="card" style="margin-bottom:12px">
    <h2 style="margin:0">Mis búsquedas guardadas <?= isset($busquedas_total) ? "({$busquedas_total})" : "" ?></h2>
  </div>

  <div class="card">
    <?php if (empty($busquedas)): ?>
      <p>No has guardado búsquedas aún.</p>
    <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:12px">
        <?php foreach ($busquedas as $b): ?>
          <?php
            $tags = [];
            if (!empty($b['q']))          $tags[] = '🔎 '.htmlspecialchars($b['q']);
            if (!empty($b['categoria']))  $tags[] = '📂 '.htmlspecialchars($b['categoria']);
            if (!empty($b['ubicacion']))  $tags[] = '📍 '.htmlspecialchars($b['ubicacion']);
            if ($b['salario_min'] !== null && $b['salario_min'] !== '') $tags[] = '💸 ≥ '.number_format((float)$b['salario_min'],2);
            $tags[] = '↕ '.(($b['sort']==='mejor_pagados') ? 'Mejor pagados' : 'Recientes');

            $params = array_filter([
              'route'       => 'empleos',
              'q'           => $b['q'] ?? '',
              'categoria'   => $b['categoria'] ?? '',
              'ubicacion'   => $b['ubicacion'] ?? '',
              'salario_min' => $b['salario_min'] ?? '',
              'sort'        => $b['sort'] ?? 'recientes',
            ], fn($v)=>$v!=='' && $v!==null);
            $qs = http_build_query($params);
          ?>
          <div class="card" style="padding:12px">
  <div style="font-weight:800"><?= htmlspecialchars($b['nombre'] ?: '(sin nombre)') ?></div>
  <div style="color:#94a3b8; margin:6px 0">
    <?php
      $tags = [];
      if (!empty($b['q']))          $tags[] = '🔎 '.htmlspecialchars($b['q']);
      if (!empty($b['categoria']))  $tags[] = '📂 '.htmlspecialchars($b['categoria']);
      if (!empty($b['ubicacion']))  $tags[] = '📍 '.htmlspecialchars($b['ubicacion']);
      if ($b['salario_min'] !== null && $b['salario_min'] !== '') $tags[] = '💸 ≥ '.number_format((float)$b['salario_min'],2);
      $tags[] = '↕ '.(($b['sort']==='mejor_pagados') ? 'Mejor pagados' : 'Recientes');
      echo implode(' · ', $tags);
    ?>
  </div>

  <?php
    $params = array_filter([
      'route'=>'empleos',
      'q'=>$b['q'] ?? '',
      'categoria'=>$b['categoria'] ?? '',
      'ubicacion'=>$b['ubicacion'] ?? '',
      'salario_min'=>$b['salario_min'] ?? '',
      'sort'=>$b['sort'] ?? 'recientes',
    ], fn($v)=>$v!=='' && $v!==null);
    $qs = http_build_query($params);
  ?>

    <div style="display:flex; gap:8px; margin-top:8px; flex-wrap:wrap">
        <a class="btn btn-primary" href="index.php?<?= $qs ?>">Buscar ahora</a>

        <!-- Renombrar (toggle simple con JS inline) -->
        <button class="btn" type="button" onclick="this.nextElementSibling.style.display = (this.nextElementSibling.style.display==='none'?'block':'none')">Renombrar</button>
        <form method="post" action="index.php" style="display:none; gap:8px; align-items:center; margin-top:6px">
        <?= csrf_input() ?>
        <input type="hidden" name="route" value="busquedas.renombrar">
        <input type="hidden" name="id_busqueda" value="<?= (int)$b['id_busqueda'] ?>">
        <input class="input" name="nombre" value="<?= htmlspecialchars($b['nombre'] ?: '') ?>" placeholder="Nuevo nombre" style="min-width:200px">
        <button class="btn">Guardar</button>
        </form>

        <!-- Eliminar -->
        <form method="post" action="index.php" onsubmit="return confirm('¿Eliminar esta búsqueda?');">
        <?= csrf_input() ?>
        <input type="hidden" name="route" value="busquedas.eliminar">
        <input type="hidden" name="id_busqueda" value="<?= (int)$b['id_busqueda'] ?>">
        <button class="btn">Eliminar</button>
        </form>
    </div>

    <div style="color:#64748b; font-size:12px; margin-top:8px">
        Guardada: <?= htmlspecialchars($b['created_at'] ?? '') ?>
    </div>
    </div>

        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if (!empty($_GET['debug'])): ?>
    <div class="card" style="margin-top:12px">
      <pre><?php echo htmlspecialchars(print_r($busquedas, true)); ?></pre>
    </div>
  <?php endif; ?>
</div>

<div class="footer-space"></div>
</body>
</html>
