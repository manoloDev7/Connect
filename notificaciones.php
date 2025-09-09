<!doctype html><html><head>
<meta charset="utf-8"><title>Notificaciones</title>
 <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
<link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
<style>
.badge-dot{display:inline-block;width:8px;height:8px;border-radius:50%;margin-right:6px;background:#22c55e;}
.badge-muted{background:#9ca3af;}
.item{display:flex;justify-content:space-between;align-items:center;padding:10px;border-bottom:1px solid #1f2937;}
.item.unread{background:#0b1220;}
.actions a{margin-left:8px;text-decoration:none;}
.subtitle{color:#9ca3af;margin:0 0 8px;}

</style>
</head><body>
<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <div>
    <a href="index.php?route=dashboard_empresa">Dashboard</a>
    <a href="index.php?route=ofertas">Ofertas</a>
    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">
  <div class="card" style="margin-bottom:12px">
    <h2 style="margin:0">Notificaciones</h2>
    <p class="subtitle">Sin leer: <strong><?= (int)($notif_unread ?? 0) ?></strong></p>
    <form method="post" action="index.php?route=notificaciones.readall" onsubmit="return confirm('Marcar todas como leídas?')">
      <?= function_exists('csrf_input') ? csrf_input() : '' ?>
      <button class="btn btn-secondary" type="submit">Marcar todas como leídas</button>
    </form>
  </div>

  <div class="card">
    <?php if (!empty($notifs)): ?>
      <?php foreach ($notifs as $n): 
        $isUnread = (int)$n['is_read'] === 0;
        $link = "index.php?route=postulantes&id=".(int)$n['id_post'];
      ?>
        <div class="item <?= $isUnread ? 'unread':'' ?>">
          <div>
            <div>
              <span class="badge-dot <?= $isUnread? '' : 'badge-muted' ?>"></span>
              <strong><?= htmlspecialchars($n['titulo']) ?></strong>
            </div>
            <div style="color:#9ca3af;font-size:.95rem;margin-top:4px">
              <?= htmlspecialchars($n['mensaje'] ?? '') ?>
              <?php if (!empty($n['puesto'])): ?>
                — <em><?= htmlspecialchars($n['puesto']) ?></em>
              <?php endif; ?>
              <div style="margin-top:4px;font-size:.85rem;">
                <?= htmlspecialchars($n['created_at']) ?>
              </div>
            </div>
          </div>
          <div class="actions">
            <?php $link = !empty($n['url']) ? $n['url'] : 'index.php?route=postulantes&id='.(int)$n['id_post']; ?>
            <a class="btn" href="<?= htmlspecialchars($link) ?>">Ver</a>

            <?php if ($isUnread): ?>
              <a class="btn btn-secondary" href="index.php?route=notificaciones&id=<?= (int)$n['id_notificacion'] ?>" style="color:#ffffff;">Marcar leída</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No tienes notificaciones por ahora.</p>
    <?php endif; ?>
  </div>
</div>
<div class="footer-space"></div>
</body></html>
