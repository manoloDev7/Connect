<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Favoritos</title>
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

  <div class="card">
    <h2 style="margin:0 0 12px">Mis favoritos</h2>

    <?php if (empty($empleos)): ?>
      <p>No tienes ofertas guardadas.</p>
    <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:12px">
        <?php foreach ($empleos as $e): ?>
          <?php
            $empresa = $e['nombre_empresa'] ?? ($e['nombre_negocio'] ?? '');
            $logo    = $e['empresa_logo'] ?? '';
          ?>
          <div class="card" style="padding:12px">
            <div style="display:flex; gap:12px; align-items:center">
              <?php if ($logo): ?>
                <img src="<?= htmlspecialchars($logo) ?>" alt="Logo"
                     style="width:48px;height:48px;object-fit:cover;border-radius:10px">
              <?php else: ?>
                <div style="width:48px;height:48px;border-radius:10px;background:#334155;display:flex;align-items:center;justify-content:center;color:#cbd5e1">🏢</div>
              <?php endif; ?>
              <div>
                <div style="font-weight:800"><?= htmlspecialchars($e['puesto']) ?></div>
                <div style="color:#cbd5e1">
                  <?= htmlspecialchars($empresa) ?>
                  <?php if (!empty($e['ubicacion'])): ?> · <?= htmlspecialchars($e['ubicacion']) ?><?php endif; ?>
                </div>
              </div>
            </div>

            <?php if (!empty($e['salario'])): ?>
              <div class="chip" style="margin:8px 0 0">
                💸 <?= htmlspecialchars($e['salario_moneda'] ?? 'MXN') ?>
                <?= number_format((float)$e['salario'],2) ?>
                / <?= htmlspecialchars($e['salario_periodicidad'] ?? 'mes') ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($e['categoria'])): ?>
              <div class="chip" style="margin-top:6px">📂 <?= htmlspecialchars($e['categoria']) ?></div>
            <?php endif; ?>

            <div style="display:flex; gap:8px; margin-top:12px; flex-wrap:wrap">
              <a class="btn btn-primary" href="index.php?route=empleo&id=<?= (int)$e['id_post'] ?>">Ver</a>

              <form method="post" action="index.php" style="display:inline">
                <?= csrf_input() ?>
                <input type="hidden" name="route" value="favorito.toggle">
                <input type="hidden" name="id_post" value="<?= (int)$e['id_post'] ?>">
                <button class="btn" type="submit">⭐ Quitar</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="footer-space"></div>
</body>
</html>
