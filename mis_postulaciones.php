<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mis postulaciones</title>
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
  <style>
    a{
      color:#ffffff;
      text-decoration:none;
    }
  </style>
</head>
<body>
<div class="nav">
  <?php $cand_unread = cand_unread_count($conexion); ?>
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw">
  <div>
    <a href="index.php?route=dashboard">Mi panel</a>
    <a href="index.php?route=empleos">Empleos</a>
    <a href="index.php?route=favoritos">Favoritos</a>
    <a href="index.php?route=busquedas">Mis búsquedas</a>
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
  <?php if (!empty($_SESSION['flash'])): foreach($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <div class="card">
    <h2 style="margin:0 0 12px">Mis postulaciones</h2>

    <?php if (empty($mis_post)): ?>
      <p>Aún no te has postulado.</p>
    <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:12px">
        <?php foreach ($mis_post as $r): ?>
          <?php
            $empresa = $r['nombre_empresa'] ?: ($r['nombre_negocio'] ?? '');
            $logo    = $r['empresa_logo'] ?? '';
            $estado  = $r['estado'] ?? 'enviado';
          ?>
          <div class="card" style="padding:12px">
            <div style="display:flex; gap:10px; align-items:center">
              <?php if ($logo): ?>
                <img src="<?= htmlspecialchars($logo) ?>" alt="Logo"
                     style="width:48px;height:48px;border-radius:10px;object-fit:cover">
              <?php else: ?>
                <div style="width:48px;height:48px;border-radius:10px;background:#334155;display:flex;align-items:center;justify-content:center;color:#cbd5e1">🏢</div>
              <?php endif; ?>
              <div>
                <div style="font-weight:800">
                  <a href="index.php?route=empleo&id=<?= (int)$r['post_id'] ?>">
                    <?= htmlspecialchars($r['puesto']) ?>
                  </a>
                </div>
                <div style="color:#94a3b8">
                  <?= htmlspecialchars($empresa) ?>
                  <?php if (!empty($r['ubicacion'])): ?> · <?= htmlspecialchars($r['ubicacion']) ?><?php endif; ?>
                </div>
              </div>
            </div>

            <?php if (!empty($r['salario'])): ?>
              <div class="chip" style="margin-top:8px">
                💸 <?= htmlspecialchars($r['salario_moneda'] ?? 'MXN') ?>
                <?= number_format((float)$r['salario'], 2) ?>
                / <?= htmlspecialchars($r['salario_periodicidad'] ?? 'mes') ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($r['categoria'])): ?>
              <div class="chip" style="margin-top:6px">📂 <?= htmlspecialchars($r['categoria']) ?></div>
            <?php endif; ?>

            <div style="display:flex; gap:8px; margin-top:10px; flex-wrap:wrap; align-items:center">
              <span class="badge <?= $estado==='aceptado'?'badge--green':($estado==='rechazado'?'badge--red':'badge--muted') ?>">
                <?= htmlspecialchars(ucfirst($estado)) ?>
              </span>
              <span style="color:#64748b; font-size:18px">
                <?= htmlspecialchars($r['postulacion_fecha']) ?>
              </span>
            </div>

            <?php if (!empty($r['mensaje'])): ?>
              <div style="margin-top:5px;color:#cbd5e1;">
                <strong >Tu mensaje:</strong> <?= nl2br(htmlspecialchars($r['mensaje'])) ?>
              </div>
            <?php endif; ?>

            <div style="display:flex; gap:8px; margin-top:10px; flex-wrap:wrap">
              <a class="btn btn-primary" href="index.php?route=empleo&id=<?= (int)$r['post_id'] ?>">Ver oferta</a>
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
