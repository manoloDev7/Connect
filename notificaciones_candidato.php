<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"><title>Mis notificaciones</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
  <style>
    

  </style>
</head>
<body>
<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw">
  <div>
    <a href="index.php?route=dashboard">Mi panel</a>
    <a href="index.php?route=empleos">Empleos</a>
    <a href="index.php?route=mis_postulaciones">Mis postulaciones</a>
    <a href="index.php?route=busquedas">Mis búsquedas</a>
    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">
  <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <div class="card" style="margin-bottom:12px">
    <h2 style="margin:0">Mis notificaciones</h2>
    <div>
      <a class="badge badge--blue" href="index.php?route=notifc.leer.todo">Marcar todas como leídas</a>
    </div>
  </div>

  <div class="card">
    <?php if (empty($notifs_cand)): ?>
      <p>No tienes notificaciones.</p>
    <?php else: ?>
      <ul class="list">
        <?php foreach ($notifs_cand as $n): ?>
          <li class="list-item" style="display:flex;justify-content:space-between;gap:8px">
            <div>
              <div><strong><?= htmlspecialchars($n['tipo']) ?></strong> — <?= htmlspecialchars($n['mensaje']) ?></div>
              <div class="muted"><?= htmlspecialchars($n['created_at']) ?></div>
              <?php if (!empty($n['url'])): ?>
                <div style="margin-top:6px"><a class="btn btn-secondary btn-sm" href="<?= htmlspecialchars($n['url']) ?>">Abrir</a></div>
              <?php endif; ?>
            </div>
            <div>
              <?php if (!(int)$n['leida']): ?>
                <a class="btn" href="index.php?route=notifc.leer&id=<?= (int)$n['id_notif'] ?>">Marcar leída</a>
              <?php else: ?>
                <span class="chip">Leída</span>
              <?php endif; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<div class="footer-space"></div>
</body>
</html>
