<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar oferta</title>
  <?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
  <link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
  <style>
    /* Extras suaves encima de tu app.css */
    body{
      background: linear-gradient(to bottom, black 30%, #c1c8c8ff 700%, black 100%);
         
    }
    .crumbs a{ color:#ffffff; text-decoration:none }
    .crumbs a:hover{ text-decoration:underline }
    .grid2{ display:grid; grid-template-columns: 1.2fr .8fr; gap:14px }
    @media (max-width: 980px){ .grid2{ grid-template-columns:1fr; } }
    .kbar{ display:flex; gap:8px; align-items:center; flex-wrap:wrap }
    .form-grid{ display:grid; grid-template-columns:1fr 1fr; gap:12px }
    @media (max-width: 780px){ .form-grid{ grid-template-columns:1fr; } }
    .label{ display:block; font-size:15px; color:#ffffff; margin:4px 0 }
    .muted{ color:#94a3b8 }
    .chip{ display:inline-block; padding:4px 8px; border-radius:999px; background:#111827; color:#cbd5e1; font-size:12px }
    .danger{ background:#01acb4 !important; color:#000000; }
    .preview-card .head{ display:flex; gap:10px; align-items:center; }
    .preview-logo{ width:48px; height:48px; border-radius:10px; object-fit:cover; background:#334155; display:flex; align-items:center; justify-content:center }
    .row{ display:flex; gap:10px; align-items:center; flex-wrap:wrap }
    .sep{ height:1px; background:#1f2937; margin:10px 0 }
    .right .card{ position:sticky; top:16px }
    .btn-link{ background:transparent; border:1px solid #334155; color:#cbd5e1 }
    .btn-link:hover{ background:#172033 }
    .help{ font-size:14px; color:#9aa7b8 }
    .counter{ font-size:12px; color:#9aa7b8; text-align:right }
  </style>
</head>
<body>

<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <div>
    <a href="index.php?route=dashboard_empresa">Dashboard</a>
    <a href="index.php?route=ofertas">Ofertas</a>
    <a href="index.php?route=logout">Salir</a>
  </div>
</div>

<div class="container">
  <?php if (!empty($_SESSION['flash'])): foreach($_SESSION['flash'] as $f): ?>
    <div class="flash <?= $f['t']==='ok'?'flash--ok':'flash--err' ?>"><?= htmlspecialchars($f['m']) ?></div>
  <?php endforeach; $_SESSION['flash']=[]; endif; ?>

  <div class="crumbs" style="margin-bottom:10px">
    <a href="index.php?route=ofertas">← Volver a mis ofertas</a>
  </div>

  <?php if (empty($oferta)): ?>
    <div class="card"><p>Oferta no encontrada.</p></div>
  <?php else: ?>
  <div class="grid2">
    <div class="left">
      <div class="card" style="margin-bottom:12px">
        <div class="row" style="justify-content:space-between">
          <h2 style="margin:0">Editar oferta #<?= (int)$oferta['id_post'] ?></h2>
          <div class="kbar">
            <a class="btn btn-link" href="index.php?route=empleo&id=<?= (int)$oferta['id_post'] ?>" target="_blank">Ver publicación</a>
            <a class="btn danger" href="index.php?route=oferta.delete&id=<?= (int)$oferta['id_post'] ?>" onclick="return confirm('¿Eliminar esta oferta?')">Eliminar</a>
          </div>
        </div>
      </div>

      <form class="card" method="post" action="index.php?route=oferta.edit&id=<?= (int)$oferta['id_post'] ?>">
        <?php if (function_exists('csrf_input')) echo csrf_input(); ?>

        <div class="form-grid">
          <div>
            <label class="label">Nombre del negocio</label>
            <input class="input" name="nombre_negocio" id="f_nombre_negocio"
                   value="<?= htmlspecialchars($oferta['nombre_negocio'] ?? '') ?>" required>
          </div>
          <div>
            <label class="label">Puesto</label>
            <input class="input" name="puesto" id="f_puesto"
                   value="<?= htmlspecialchars($oferta['puesto'] ?? '') ?>" required>
          </div>
          <div>
            <label class="label">Teléfono/Contacto</label>
            <input class="input" name="numero_contacto" id="f_contacto"
                   value="<?= htmlspecialchars($oferta['numero_contacto'] ?? '') ?>" placeholder="+52 55...">
          </div>
          <div>
            <label class="label">Ubicación</label>
            <input class="input" name="ubicacion" id="f_ubicacion"
                   value="<?= htmlspecialchars($oferta['ubicacion'] ?? '') ?>" placeholder="CDMX, Puebla, etc.">
          </div>

          <div>
            <label class="label">Categoría</label>
            <?php
              $catVal = $oferta['categoria'] ?? '';
              $catEsOtro = $catVal && !in_array($catVal, [
                'Administración','Ventas','Atención al cliente','Logística',
                'Tecnologías de la Información','Construcción','Educación','Salud',
                'Producción / Operaciones','Recursos Humanos','Marketing',
                'Mantenimiento','Seguridad','Gastronomía / Turismo','Otros'
              ], true);
              $catSelect = $catEsOtro ? 'otros' : ($catVal ?: '');
              $catOtro   = $catEsOtro ? $catVal : '';
            ?>
            <select class="input" name="categoria" id="f_categoria" onchange="toggleOtro()">
              <option value="">Seleccione…</option>
              <?php
                $ops = [
                  'Administración','Ventas','Atención al cliente','Logística',
                  'Tecnologías de la Información','Construcción','Educación','Salud',
                  'Producción / Operaciones','Recursos Humanos','Marketing',
                  'Mantenimiento','Seguridad','Gastronomía / Turismo'
                ];
                foreach ($ops as $op) {
                  $sel = ($catSelect === $op) ? 'selected' : '';
                  echo "<option {$sel}>".htmlspecialchars($op)."</option>";
                }
              ?>
              <option value="otros" <?= $catSelect==='otros'?'selected':'' ?>>Otros</option>
            </select>
            <input class="input" style="margin-top:8px; <?= $catSelect==='otros'?'':'display:none' ?>"
                   id="f_categoria_otro" name="categoria_otro" placeholder="Especifique categoría"
                   value="<?= htmlspecialchars($catOtro) ?>">
            <div class="help">Si no encuentras tu categoría, elige “Otros” y escribe la tuya.</div>
          </div>

          <div>
            <label class="label">Salario</label>
            <div class="row">
              <input class="input" type="number" step="0.01" min="0" style="max-width:200px"
                     name="salario" id="f_salario"
                     value="<?= htmlspecialchars($oferta['salario'] ?? '') ?>" placeholder="15000.00">
              <select class="input" style="max-width:120px" name="salario_moneda" id="f_moneda">
                <?php
                  $mon = $oferta['salario_moneda'] ?? 'MXN';
                  foreach (['MXN','USD'] as $m) {
                    $sel = $mon===$m?'selected':'';
                    echo "<option {$sel}>$m</option>";
                  }
                ?>
              </select>
              <select class="input" style="max-width:160px" name="salario_periodicidad" id="f_per">
                <?php
                  $per = $oferta['salario_periodicidad'] ?? 'mes';
                  foreach (['hora','día','semana','quincena','mes','año'] as $p) {
                    $sel = $per===$p?'selected':'';
                    echo "<option {$sel}>$p</option>";
                  }
                ?>
              </select>
            </div>
            <div class="help">Ejemplo: 15000 MXN / mes</div>
          </div>

          <div style="grid-column:1/-1">
            <label class="label">Descripción</label>
            <?php $desc = $oferta['descripcion'] ?? ''; $maxDesc = 2000; ?>
            <textarea class="input" name="descripcion" id="f_desc" rows="7" maxlength="<?= $maxDesc ?>"
                      placeholder="Describe responsabilidades, requisitos, beneficios…"><?= htmlspecialchars($desc) ?></textarea>
            <div class="counter"><span id="cnt"><?= strlen($desc) ?></span>/<?= $maxDesc ?> caracteres</div>
          </div>
        </div>

        <div class="sep"></div>
        <div class="row" style="justify-content:flex-end">
          <a class="btn btn-link" href="index.php?route=ofertas">Cancelar</a>
          <button class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>

    <div class="right">
      <!-- PREVIEW EN VIVO -->
      <div class="card preview-card">
        <h3 style="margin:0 0 8px">Vista previa</h3>
        <div class="head">
          <div id="pv_logo" class="preview-logo">🏢</div>
          <div>
            <div id="pv_puesto" style="font-weight:800; font-size:18px">
              <?= htmlspecialchars($oferta['puesto'] ?? 'Puesto') ?>
            </div>
            <div class="muted" id="pv_sub">
              <?= htmlspecialchars($oferta['nombre_negocio'] ?? '') ?>
              <?php if (!empty($oferta['ubicacion'])): ?>
                · <?= htmlspecialchars($oferta['ubicacion']) ?>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top:8px">
          <?php if (!empty($oferta['categoria'])): ?>
            <span class="chip" id="pv_cat">📂 <?= htmlspecialchars($oferta['categoria']) ?></span>
          <?php else: ?>
            <span class="chip" id="pv_cat" style="display:none"></span>
          <?php endif; ?>
          <?php if (!empty($oferta['salario'])): ?>
            <span class="chip" id="pv_sal">💸 <?= htmlspecialchars($oferta['salario_moneda'] ?? 'MXN') ?> <?= number_format((float)$oferta['salario'],2) ?>/<?= htmlspecialchars($oferta['salario_periodicidad'] ?? 'mes') ?></span>
          <?php else: ?>
            <span class="chip" id="pv_sal" style="display:none"></span>
          <?php endif; ?>
        </div>

        <div class="sep"></div>
        <div class="muted" id="pv_desc" style="white-space:pre-wrap; line-height:1.45">
          <?= nl2br(htmlspecialchars($oferta['descripcion'] ?? '')) ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<div class="footer-space"></div>

<script>
  // Toggle de "Otros" en categoría
  function toggleOtro(){
    const sel = document.getElementById('f_categoria');
    const otro = document.getElementById('f_categoria_otro');
    if (sel.value === 'otros'){ otro.style.display='block'; otro.required = true; }
    else { otro.style.display='none'; otro.required=false; otro.value=''; }
  }

  // Contador descripción + Preview en vivo
  (function(){
    const puesto  = document.getElementById('f_puesto');
    const negocio = document.getElementById('f_nombre_negocio');
    const ubi     = document.getElementById('f_ubicacion');
    const catSel  = document.getElementById('f_categoria');
    const catOtro = document.getElementById('f_categoria_otro');
    const sal     = document.getElementById('f_salario');
    const mon     = document.getElementById('f_moneda');
    const per     = document.getElementById('f_per');
    const desc    = document.getElementById('f_desc');
    const cnt     = document.getElementById('cnt');

    const pvPuesto = document.getElementById('pv_puesto');
    const pvSub    = document.getElementById('pv_sub');
    const pvCat    = document.getElementById('pv_cat');
    const pvSal    = document.getElementById('pv_sal');
    const pvDesc   = document.getElementById('pv_desc');

    function update(){
      pvPuesto.textContent = puesto.value || 'Puesto';
      const sub = [];
      if (negocio.value) sub.push(negocio.value);
      if (ubi.value)     sub.push('· '+ubi.value);
      pvSub.textContent = sub.join(' ');

      let cat = catSel.value === 'otros' ? (catOtro.value || '') : catSel.value;
      if (cat){ pvCat.style.display='inline-block'; pvCat.textContent = '📂 '+cat; }
      else { pvCat.style.display='none'; }

      if (sal.value){
        pvSal.style.display='inline-block';
        const num = Number(sal.value);
        pvSal.textContent = '💸 '+(mon.value||'MXN')+' '+(isFinite(num)?num.toFixed(2):sal.value)+'/'+(per.value||'mes');
      } else {
        pvSal.style.display='none';
      }

      pvDesc.textContent = desc.value;
      cnt.textContent = desc.value.length;
    }

    ['input','change'].forEach(ev=>{
      [puesto,negocio,ubi,catSel,catOtro,sal,mon,per,desc].forEach(el=>{
        if (el) el.addEventListener(ev, update);
      });
    });
    update();
  })();
</script>
</body>
</html>
