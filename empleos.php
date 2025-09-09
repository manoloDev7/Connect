<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Empleos</title>
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
</head>
<body>
<div class="nav">
  <?php $cand_unread = cand_unread_count($conexion); ?>
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" >
  <div>
    
    
    <?php if (!empty($_SESSION['usuario_id']) && ($_SESSION['tipo_usuario'] ?? '')==='candidato'): ?>
      
      <a href="index.php?route=dashboard">Mi panel</a>
      <a href="index.php?route=favoritos">Favoritos</a>
      <a href="index.php?route=mis_postulaciones">Mis postulaciones</a>
    
      <a href="index.php?route=busquedas">Mis búsquedas</a>
      <a href="index.php?route=notificaciones_candidato" class="nav-bell">
        🔔
        <?php if ($cand_unread > 0): ?>
          <span class="badge badge--pill"><?= (int)$cand_unread ?></span>
        <?php endif; ?>
      </a>
    <?php endif; ?>
    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">
  <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <!-- Filtros -->
  <div class="card" style="margin-bottom:12px">
    <form method="get" action="index.php" style="display:grid;grid-template-columns:1.2fr 1fr 1fr 1fr 1fr auto;gap:8px;align-items:end">
      <input type="hidden" name="route" value="empleos">
      <div>
        <label>Búsqueda</label>
        <input class="input" type="search" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Puesto, empresa, descripción">
      </div>
      <div>
        <label>Categoría</label>
        <select class="input" name="categoria">
          <?php $catSel = $_GET['categoria'] ?? ''; ?>
          <option value="">Todas</option>
          <?php
            $cats = ['Administración','Ventas','Atención al cliente','Logística','Tecnologías de la Información','Construcción','Educación','Salud','Producción / Operaciones','Recursos Humanos','Marketing','Mantenimiento','Seguridad','Gastronomía / Turismo','Otros'];
            foreach ($cats as $c) { $sel = ($catSel===$c)?'selected':''; echo "<option $sel>".htmlspecialchars($c)."</option>"; }
          ?>
        </select>
      </div>
      <div>
        <label>Ubicación</label>
        <input class="input" name="ubicacion" value="<?= htmlspecialchars($_GET['ubicacion'] ?? '') ?>" placeholder="Ciudad/Estado">
      </div>
      <div>
        <label>Salario mínimo</label>
        <input class="input" type="number" step="0.01" name="salario_min" value="<?= htmlspecialchars($_GET['salario_min'] ?? '') ?>" placeholder="Ej. 10000">
      </div>
      <div>
        <label>Ordenar por</label>
        <?php $sortSel = $_GET['sort'] ?? 'recientes'; ?>
        <select class="input" name="sort">
          <option value="recientes" <?= $sortSel==='recientes'?'selected':'' ?>>Recientes</option>
          <option value="mejor_pagados" <?= $sortSel==='mejor_pagados'?'selected':'' ?>>Mejor pagados</option>
        </select>
      </div>
      <div>
        <button class="btn btn-primary" type="submit">Filtrar</button>
      </div>
    </form>
  </div>

  <!-- Guardar búsqueda -->
  <?php if (!empty($_SESSION['usuario_id']) && ($_SESSION['tipo_usuario'] ?? '')==='candidato'): ?>
    <div class="card" style="margin-bottom:12px">
      <form method="post" action="index.php" style="display:flex; gap:8px; align-items:end; flex-wrap:wrap">
        <?= csrf_input() ?>
        <input type="hidden" name="route" value="busquedas.guardar">
        <input type="hidden" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        <input type="hidden" name="categoria" value="<?= htmlspecialchars($_GET['categoria'] ?? '') ?>">
        <input type="hidden" name="ubicacion" value="<?= htmlspecialchars($_GET['ubicacion'] ?? '') ?>">
        <input type="hidden" name="salario_min" value="<?= htmlspecialchars($_GET['salario_min'] ?? '') ?>">
        <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort'] ?? 'recientes') ?>">

        <div>
          <label>Nombre de la búsqueda</label>
          <input class="input" name="nombre" placeholder="Ej. TI en CDMX + $15k">
        </div>
        <label style="display:flex;gap:6px;align-items:center">
          <input type="checkbox" name="email_alert" value="1"> Enviarme email ahora con resultados
        </label>
        <button class="btn">Guardar búsqueda</button>
      </form>

    </div>
  <?php endif; ?>

  <!-- Resultados -->
  <div class="card">
    <?php if (empty($empleos)): ?>
      <p>No hay empleos con estos filtros.</p>
    <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:12px">
        <?php foreach ($empleos as $e): ?>
          <div class="card" style="padding:12px">
            <?php
              $empresa = $e['nombre_empresa'] ?? ($e['nombre_negocio'] ?? '');
              $logo    = $e['empresa_logo'] ?? '';
            ?>
            <div style="display:flex; gap:10px; align-items:center; margin-bottom:6px">
              <?php if ($logo): ?>
                <img src="<?= htmlspecialchars($logo) ?>" alt="Logo"
                    style="width:40px;height:40px;border-radius:8px;object-fit:cover">
              <?php else: ?>
                <div style="width:40px;height:40px;border-radius:8px;background:#334155;display:flex;align-items:center;justify-content:center;color:#cbd5e1">🔊</div>
              <?php endif; ?>
              <div style="font-weight:700"><?= htmlspecialchars($empresa) ?></div>
            </div>

            <div style="font-weight:800"><?= htmlspecialchars($e['puesto']) ?></div>
            <div style="color:#cbd5e1"><?= htmlspecialchars($e['nombre_negocio'] ?? '') ?> · <?= htmlspecialchars($e['ubicacion'] ?? '') ?></div>
            <?php if (!empty($e['salario'])): ?>
              <div class="chip" style="margin:6px 0">
                💸 <?= htmlspecialchars($e['salario_moneda'] ?? 'MXN') ?> <?= number_format((float)$e['salario'],2) ?> / <?= htmlspecialchars($e['salario_periodicidad'] ?? 'mes') ?>
              </div>
              <span class="chip <?= (int)($e['num_postulantes'] ?? 0) ? 'badge--blue' : 'badge--muted' ?>">
                👥 <?= (int)($e['num_postulantes'] ?? 0) ?>
              </span>

              <?php if (!empty($e['created_at'])): ?>
                <span class="chip">⏱ <?= htmlspecialchars(time_ago($e['created_at'])) ?></span>
              <?php endif; ?>
            <?php endif; ?>
            <div style="display:flex; gap:8px; margin-top:8px; flex-wrap:wrap">
              <a class="btn btn-primary" href="index.php?route=empleo&id=<?= (int)$e['id_post'] ?>">Ver</a>
              <?php if (!empty($_SESSION['usuario_id']) && ($_SESSION['tipo_usuario'] ?? '')==='candidato'): ?>
                <form method="post" action="route=favorito.toggle" style="display:inline">
                  <?= csrf_input() ?>
                  <input type="hidden" name="route" value="favorito.toggle">
                  <input type="hidden" name="id_post" value="<?= (int)$e['id_post'] ?>">
                  <?php $fav = !empty($favIds[(int)$e['id_post']]); ?>
                  <button class="btn" type="submit"><?= $fav ? '⭐ Quitar' : '☆ Favorito' ?></button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <?php if (($pages ?? 1) > 1): ?>
        <div style="margin-top:10px;font-size:30px; text-decoration: none;" >
          <?php for ($p=1; $p<=$pages; $p++): ?>
            <?php
              $params = $_GET;
              $params['page']=$p;
              $qs = http_build_query(array_merge(['route'=>'empleos'], $params));
            ?>
            <?php if ($p == ($page ?? 1)): ?>
              <strong><?= $p ?></strong>
            <?php else: ?>
              <a href="index.php?<?= $qs ?>"><?= $p ?></a>
            <?php endif; ?>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
<div class="footer-space"></div>
</body>
</html>
