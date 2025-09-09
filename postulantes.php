<!doctype html><html><head><meta charset="utf-8"><title>Postulantes</title>
<?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
<link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
<style>
    a{
        color:#ffffff;
    }

    body{
      background: linear-gradient(to bottom, black 20%, #919494ff 60%, black 100%);
    }



</style>


</head><body class="theme-employer">
<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <div>
    <a href="index.php?route=dashboard_empresa">Dashboard</a>
    <a href="index.php?route=ofertas">Ofertas</a>
    <a href="index.php?route=notificaciones" style="position:relative">
      🔔
      <span id="notif-badge" style="
        position:absolute; top:-6px; right:-10px;
        background:#ef4444; color:#fff; font-size:12px;
        padding:2px 6px; border-radius:9999px; display:none;
      "></span>
    </a>
    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">
    <?php if (empty($job)) { echo "Oferta no encontrada."; exit; } ?>
    <div class="card" style="margin-bottom:12px">
    <form method="get" action="index.php" style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:8px;align-items:end">
        <input type="hidden" name="route" value="postulantes">
        <input type="hidden" name="id"    value="<?= (int)$job['id_post'] ?>">
        <div>
        <label>Estado</label>
        <?php $estadoSel = $_GET['estado'] ?? ''; ?>
        <select class="input" name="estado">
            <option value="">Todos</option>
            <?php
            $opts = ['nuevo'=>'Nuevo','en_proceso'=>'En proceso','entrevista'=>'Entrevista','rechazado'=>'Rechazado','contratado'=>'Contratado'];
            foreach ($opts as $val=>$lab) {
                $sel = ($estadoSel===$val)?'selected':'';
                echo "<option value=\"$val\" $sel>$lab</option>";
            }
            ?>
        </select>
        </div>
        <div>
        <label>Desde</label>
        <input class="input" type="date" name="desde" value="<?= htmlspecialchars($_GET['desde'] ?? '') ?>">
        </div>
        <div>
        <label>Hasta</label>
        <input class="input" type="date" name="hasta" value="<?= htmlspecialchars($_GET['hasta'] ?? '') ?>">
        </div>
        <div>
        <button class="btn btn-primary" type="submit">Filtrar</button>
        </div>
    </form>
    </div>

    

  <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>


  <div class="card">
    <div style="margin-top:30px">
      <a class="btn btn-primary" href="index.php?route=ofertas">← Volver a mis ofertas</a>
    </div><br>
    <?php if (empty($postulantes)): ?>
      <p>No hay postulaciones todavía.</p>
    <?php else: ?>
      <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(320px,1fr)); gap:12px">
        <?php foreach ($postulantes as $p): ?>
          <div class="card" style="padding:14px">
            <div style="font-weight:800"><?= htmlspecialchars(($p['Nombre'] ?? '').' '.($p['Apellido'] ?? '')) ?></div>
            <div style="color:#cbd5e1; font-size:14px; margin:4px 0"><?= htmlspecialchars($p['Email']) ?></div>

            <?php if (!empty($p['mensaje'])): ?>
              <div style="font-size:14px; color:#e5e7eb; margin:6px 0">
                “<?= htmlspecialchars($p['mensaje']) ?>”
              </div>
            <?php endif; ?>
            <?php if (!empty($p['cv_path'])): ?>
            <div style="margin:6px 0; display:flex; gap:8px; flex-wrap:wrap">
                <!-- Abre y notifica -->
                <a class="btn btn-primary"
                  href="index.php?route=cv.view&s=<?= (int)$p['id_postulacion'] ?>"
                  target="_blank" rel="noopener">
                  📄 Ver CV (PDF)
                </a>


                <a class="btn" href="<?= htmlspecialchars($p['cv_path']) ?>" download>⬇️ Descargar CV</a>
            </div>
            <?php else: ?>
            <div class="chip">Sin CV adjunto</div>
            <?php endif; ?>


            <form method="post" action="index.php" style="margin-top:8px">
              <?= csrf_input() ?>
              <input type="hidden" name="route" value="postulantes">
              <input type="hidden" name="id_post" value="<?= (int)$job['id_post'] ?>">
              <input type="hidden" name="id_postulacion" value="<?= (int)$p['id_postulacion'] ?>">

              <label>Estado</label>
              <?php
                // valor actual (si aún no existe campo en el SELECT original, caerá a 'nuevo')
                $estadoActual = $p['estado'] ?? 'nuevo';
                $opts = [
                  'nuevo' => 'Nuevo',
                  'en_proceso' => 'En proceso',
                  'entrevista' => 'Entrevista',
                  'rechazado' => 'Rechazado',
                  'contratado' => 'Contratado'
                ];
              ?>
              <select class="input" name="estado" required>
                <?php foreach ($opts as $val => $label): ?>
                  <option value="<?= $val ?>" <?= $estadoActual===$val?'selected':'' ?>><?= $label ?></option>
                <?php endforeach; ?>
              </select>

              <label>Notas internas (solo visibles para ti)</label>
              <textarea class="input" name="nota" maxlength="2000"><?= htmlspecialchars($p['nota'] ?? '') ?></textarea>

              <div style="display:flex; gap:8px; margin-top:8px">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a class="btn" href="mailto:<?= htmlspecialchars($p['Email']) ?>?subject=Seguimiento%20vacante%20<?= urlencode($job['puesto']) ?>">Contactar por email</a>
              </div>
              <div class="chips" style="margin-top:8px">
                <span class="chip">⏱ <?= htmlspecialchars($p['created_at']) ?></span>
                <?php if (!empty($p['updated_at'])): ?>
                  <span class="chip">✏️ <?= htmlspecialchars($p['updated_at']) ?></span>
                <?php endif; ?>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    
  </div>
</div>
<div class="footer-space"></div>
</body></html>
