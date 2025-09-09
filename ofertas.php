<!doctype html><html><head><meta charset="utf-8"><title>Mis Ofertas</title>
<?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
<link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Urbanist&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Manrope&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Sora&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap');
    body{
      background: linear-gradient(to bottom, black 20%, #c1c8c8ff 60%, black 100%);
    }
    .crud{
        text-decoration: none;
        color:#01acb4;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 500;
        
    }
    .input{
      color:#ffffff;
    }
    
    
</style>


</head><body class="theme-employer">

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
<div class="container">
  <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <div class="card" style="margin-bottom:16px">
    <h2 style="margin:0 0 8px">Publicar oferta</h2>
    <form method="post" action="index.php?route=ofertas">
        <?= csrf_input() ?>
      <input class="input" name="nombre_negocio" required placeholder="Nombre negocio">
      <input class="input" name="puesto"         required placeholder="Puesto">
      <input class="input" name="numero_contacto" required placeholder="Contacto">
      <input class="input" name="ubicacion"      required placeholder="Ubicación">

      <label>Categoría</label>
      <select class="input" name="categoria" id="categoria" required onchange="toggleOtro()">
        <option value="">Seleccione…</option>
        <option>Administración</option><option>Ventas</option>
        <option>Atención al cliente</option><option>Logística</option>
        <option>Tecnologías de la Información</option><option>Construcción</option>
        <option>Educación</option><option>Salud</option>
        <option>Producción / Operaciones</option><option>Recursos Humanos</option>
        <option>Marketing</option><option>Mantenimiento</option>
        <option>Seguridad</option><option>Gastronomía / Turismo</option>
        <option value="otros">Otros</option>
      </select>
      <input class="input" style="display:none" id="categoria_otro" name="categoria_otro" placeholder="Especifique categoría">

      <textarea class="input" name="descripcion" placeholder="Descripción"></textarea>

      <h3 style="margin-top:10px">Salario (opcional)</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr; gap:8px">
        <div>
            <label>Monto</label>
            <input class="input" type="number" step="0.01" name="salario" placeholder="Ej. 12000.00">
        </div>
        <div>
            <label>Periodicidad</label>
            <select class="input" name="salario_periodicidad">
            <option value="hora">Hora</option>
            <option value="día">Día</option>
            <option value="semana">Semana</option>
            <option value="quincena">Quincena</option>
            <option value="mes" selected>Mes</option>
            <option value="año">Año</option>
            </select>
        </div>
        <div>
            <label>Moneda</label>
            <select class="input" name="salario_moneda">
            <option value="MXN" selected>MXN</option>
            <option value="USD">USD</option>
            </select>
        </div>
        </div>

      <div style="margin-top:8px">
        <button class="btn btn-primary" type="submit">Publicar Oferta</button>
      </div>
    </form>
  </div>

  <div class="card" style="margin-bottom:16px">
    <form method="get" action="index.php" style="display:flex; gap:8px; align-items:center">
      <input type="hidden" name="route" value="ofertas">
      <input class="input" type="search" name="q" value="<?= htmlspecialchars($q ?? '') ?>" placeholder="Buscar por puesto, ubicación o categoría…">
      <button class="btn btn-primary">Buscar</button>
    </form>
  </div>

  <div class="card">
    <h2 style="margin:0 0 8px">Mis ofertas publicadas</h2>
    <table class="table">
      <thead><tr><th>Puesto</th><th>Ubicación</th><th>Categoría</th><th>Salario</th><th>Acciones</th></tr></thead>

      <tbody>
        <?php foreach(($ofertas ?? []) as $o): ?>
          <tr>
            
            <th class="col-puesto clamp-2"><?= htmlspecialchars($o['puesto']) ?></th>
            <td class="col-ubicacion"><?= htmlspecialchars($o['ubicacion']) ?></td>
            <td class="col-categoria"><?= htmlspecialchars($o['categoria']) ?></td>
            
            <td>
            <?php
                $sal = $o['salario'] ?? null;
                if ($sal !== null && $sal !== '') {
                $mon = $o['salario_moneda'] ?? 'MXN';
                $per = $o['salario_periodicidad'] ?? 'mes';
                echo htmlspecialchars($mon).' '.number_format((float)$sal, 2).' / '.htmlspecialchars($per);
                } else {
                echo '<span class="chip">—</span>';
                }
            ?>
            </td>

            <td class="col-actions">
                <div class="actions">
                  <a class="btn btn-secondary btn-sm"  href="index.php?route=oferta.edit&id=<?= (int)$o['id_post'] ?>">Editar</a>
                  <a class="btn btn-danger btn-sm" style="color:#01acb4; href="index.php?route=oferta.delete&id=<?= (int)$o['id_post'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                  <?php $n = (int)($o['num_postulantes'] ?? 0); ?>
                  <a class="badge <?= $n ? 'badge--blue' : 'badge--muted' ?>"
                    href="index.php?route=postulantes&id=<?= (int)$o['id_post'] ?>">
                    <span class="dot"></span> 👥 Postulantes <?= $n ?>
                  </a>
                </div>
            </td>


          </tr>
        <?php endforeach; ?>
        <?php if (empty($ofertas)): ?>
          <tr><td colspan="5">No hay resultados.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <?php if (($pages ?? 1) > 1): ?>
      <div style="margin-top:10px;">
        <?php for ($p=1; $p<=$pages; $p++): ?>
          <?php if ($p == ($page ?? 1)): ?>
            <strong>[<?= $p ?>]</strong>
          <?php else: ?>
            <a href="index.php?route=ofertas&page=<?= $p ?>&q=<?= urlencode($q ?? '') ?>">[<?= $p ?>]</a>
          <?php endif; ?>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="footer-space"></div>

<script>
function toggleOtro(){
  var sel = document.getElementById('categoria');
  var otro = document.getElementById('categoria_otro');
  if(sel.value === 'otros'){ otro.style.display='block'; otro.required = true; }
  else { otro.style.display='none'; otro.required = false; otro.value=''; }
}
</script>
</body></html>
