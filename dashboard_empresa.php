<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard Empresa</title>
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
  <style>
    .kpis{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px}
    .kpi{background:#000000;color:#e2e8f0;padding:14px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.25)}
    .kpi h3{margin:0 0 6px;font-size:14px;color:#94a3b8}
    .kpi .v{font-size:28px;font-weight:800}
    .grid{display:grid;grid-template-columns:1fr;gap:12px}
    @media(min-width:900px){.grid{grid-template-columns:2fr 1fr}}
    .card{background:#000000;color:#e2e8f0;padding:14px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.25)}
    .muted{color:#94a3b8}
    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border-bottom:1px solid #1f2937}
    th{color:#94a3b8;text-align:left}
    .badge{display:inline-block;padding:3px 8px;border-radius:999px;background:#1f2937;color:#e5e7eb;font-size:12px}
    body{
      background: linear-gradient(to bottom, black 10%, #c1c8c8ff 50%, black 100%);
         
    }
    .hola{font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; margin-left:1.9vw;padding:1vw;}
    a{font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; color:#ffffff;}
    .filter-chip{
      display:inline-flex; gap:8px; align-items:center;
      padding:6px 10px; border-radius:9999px;
      background:#1f2937; border:1px solid #374151; font-size:.9rem;
    }
    .filter-chip .chip-action{
      padding:4px 8px; border-radius:9999px; text-decoration:none;
      background:#111827; border:1px solid #4b5563;
    }

    .nav a.nav-bell{position:relative;display:inline-flex;align-items:center;gap:.25rem}
    .badge{display:inline-block;padding:.2rem .5rem;border-radius:.5rem;font-size:.8rem;background:#0ea5b7;color:#fff}
    .badge--pill{border-radius:999px;min-width:1.25rem;text-align:center}


  </style>
</head>
<body class="theme-employer">

<div class="nav">
  <?php $emp_unread = emp_unread_count($conexion); ?>

  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <div>
    <a href="index.php?route=dashboard_empresa">Dashboard</a>
    <a href="index.php?route=ofertas">Ofertas</a>
    <a href="index.php?route=notificaciones" class="nav-bell">
      🔔
      <?php if ($emp_unread > 0): ?>
        <span class="badge badge--pill"><?= (int)$emp_unread ?></span>
      <?php endif; ?>
    </a>


    <a href="index.php?route=logout">Salir</a>
  </div>
</div>
<h1  class="hola">Hola, <?=htmlspecialchars($_SESSION['nombre'] ?? 'Empresa')?>!</h1>
<div class="container">
  <?php if (!empty($_SESSION['flash'])): foreach($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <div class="kpis" style="margin-bottom:12px">
    <div class="kpi"><h3>Ofertas publicadas</h3><div class="v"><?= (int)($kpis['total_ofertas'] ?? 0) ?></div></div>
    <div class="kpi"><h3>Postulaciones (hoy)</h3><div class="v"><?= (int)($kpis['post_hoy'] ?? 0) ?></div><div class="muted">Últimos 7 días: <?= (int)($kpis['post_semana'] ?? 0) ?></div></div>
    <div class="kpi">
      <h3>Vistas (hoy)</h3>
      <div class="v"><?= (int)($kpis['vistas_hoy'] ?? 0) ?></div>
      <div class="muted">Últimos 7 días: <?= (int)($kpis['vistas_semana'] ?? 0) ?></div>
      <?php if(empty($kpis['views_enabled'])): ?><div class="muted">* Activa job_views para ver vistas</div><?php endif; ?>
    </div>
    <div class="kpi"><h3>Conversión 30d</h3><div class="v"><?= number_format((float)($kpis['conv_30'] ?? 0),1) ?>%</div></div>
  </div>

  <div class="grid">
    <div class="card">
      <h2 style="margin:0 0 8px">Actividad últimos 14 días</h2>
      <?php if (!empty($labels_json)): ?>
        <canvas id="chart14" height="120"></canvas>
      <?php else: ?>
        <p class="muted">Sin datos por ahora.</p>
      <?php endif; ?>
    </div>

    <div class="card">
      <h2 style="margin:0 0 8px">Top 5 ofertas (por postulaciones)</h2>
      <?php if (!empty($top)): ?>
        <table>
          <thead><tr><th>Puesto</th><th>Postulantes</th><?php if(!empty($kpis['views_enabled'])): ?><th>Vistas</th><?php endif; ?></tr></thead>
          <tbody>
            <?php foreach ($top as $t): ?>
              <tr>
                <td><a href="index.php?route=dashboard_empresa&post_id=<?= (int)$t['id_post'] ?>">
                  <?= htmlspecialchars($t['puesto']) ?></a>
                </td>
                

                <td><?= (int)$t['postulantes'] ?></td>
                <?php if(!empty($kpis['views_enabled'])): ?><td><?= (int)($t['vistas'] ?? 0) ?></td><?php endif; ?>
              </tr>
            <?php endforeach; ?>
            <?php if (!empty($offer_title)): ?>
                  <div class="card" style="margin-top:12px">
                    <span class="chip">Filtrando por: <strong><?= htmlspecialchars($offer_title) ?></strong></span>
                    <a class="badge" href="index.php?route=dashboard_empresa" style="margin-left:8px">Quitar filtro</a>
                  </div>
            <?php endif; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="muted">Aún no hay postulaciones.</p>
      <?php endif; ?>
      <?php if (!empty($det_day) && !empty($det_metric)): ?>
  <div class="card" style="margin-top:12px">
    <h2 style="margin:0 0 8px">
      Detalle del <?= htmlspecialchars($det_day) ?> · 
      <?= $det_metric==='apps' ? 'Postulaciones' : 'Vistas' ?>
    </h2>
    <?php if (!empty($det_rows)): ?>
          <table>
            <thead><tr><th>Puesto</th><th><?= $det_metric==='apps' ? 'Postulantes' : 'Vistas' ?></th><th></th></tr></thead>
            <tbody>
              <?php foreach ($det_rows as $r): ?>
                <tr>
                  <td><?= htmlspecialchars($r['puesto']) ?></td>
                  <td><?= (int)$r['cnt'] ?></td>
                  <td><a class="badge" href="index.php?route=oferta.edit&id=<?= (int)$r['id_post'] ?>">Abrir oferta</a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p class="muted">Sin datos para ese día.</p>
        <?php endif; ?>
        <div style="margin-top:8px">
          <a class="badge" href="index.php?route=dashboard_empresa">Limpiar filtro</a>
        </div>
      </div>
    <?php endif; ?>

    </div>
  </div>
</div>

<div class="footer-space"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels   = <?= $labels_json ?? '[]' ?>;
  const dataApps = <?= $apps_json ?? '[]' ?>;
  const dataViews= <?= $views_json ?? '[]' ?>;

  if (labels.length) {
    const ctx = document.getElementById('chart14').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [
          {label:'Postulaciones', data:dataApps, tension:.3, fill:false},
          {label:'Vistas',        data:dataViews, tension:.3, fill:false}
        ]
      },
      options: {
        responsive:true,
        plugins:{ legend:{ position:'top' } },
        scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } } },
        onClick: (evt, elements) => {
          if (!elements.length) return;
          const el = elements[0];
          const idxPoint = el.index;
          const dsIndex  = el.datasetIndex; // 0=apps, 1=views
          const day = labels[idxPoint];
          const metric = (dsIndex === 0) ? 'apps' : 'views';
          //Redirige al detalle del día
          const url = new URL(window.location.href);
          url.searchParams.set('day', day);
          url.searchParams.set('metric', metric);
          window.location = url.toString();
        },
        hover: {
          onHover: (e, elements) => {
            e.native.target.style.cursor = elements.length ? 'pointer' : 'default';
          }
        }
      }
    });
  }
</script>

<script>
async function refreshNotif(){
  try{
    const r = await fetch('index.php?route=notif_count', {cache:'no-store'});
    const j = await r.json();
    const b = document.getElementById('notif-badge');
    if (!b) return;
    const n = (j && typeof j.unread==='number') ? j.unread : 0;
    if (n > 0) { b.textContent = n; b.style.display = 'inline-block'; }
    else { b.style.display = 'none'; }
  }catch(e){}
}
refreshNotif();
setInterval(refreshNotif, 20000); // cada 20s
</script>

</body>
</html>
