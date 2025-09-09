<!doctype html><html><head><meta charset="utf-8"><title><?= htmlspecialchars($job['puesto'] ?? 'Empleo') ?></title>
<?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
<link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">

<?php
  $puesto   = $empleo['puesto'] ?? 'Vacante';
  $empresa  = $empleo['nombre_empresa'] ?? ($empleo['nombre_negocio'] ?? 'Empresa');
  $descRaw  = $empleo['descripcion'] ?? '';
  $desc     = mb_substr(trim(strip_tags($descRaw)), 0, 400);
  $salary   = isset($empleo['salario']) && $empleo['salario'] !== '' ? (float)$empleo['salario'] : null;
  $moneda   = $empleo['salario_moneda'] ?? 'MXN';
  $period   = $empleo['salario_periodicidad'] ?? 'month';
  // map a schema.org
  $unitMap  = ['hora'=>'HOUR','día'=>'DAY','semana'=>'WEEK','quincena'=>'WEEK','mes'=>'MONTH','año'=>'YEAR'];
  $unit     = $unitMap[$period] ?? 'MONTH';

  $scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $base     = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $url      = "{$scheme}://{$host}{$base}/index.php?route=empleo&id=".(int)$empleo['id_post'];

  // logo absoluto (si tienes ruta relativa)
  $logo = $empleo['logo_empresa'] ?? '';
  if ($logo && str_starts_with($logo, '/')) { $logo = "{$scheme}://{$host}{$logo}"; }
  elseif ($logo && !preg_match('#^https?://#',$logo)) { $logo = "{$scheme}://{$host}{$base}/{$logo}"; }

  $created  = !empty($empleo['created_at']) ? date('c', strtotime($empleo['created_at'])) : date('c');
  $json = [
    '@context' => 'https://schema.org',
    '@type'    => 'JobPosting',
    'title'    => $puesto,
    'description' => $desc,
    'hiringOrganization' => [
      '@type' => 'Organization',
      'name'  => $empresa,
      'logo'  => $logo ?: null
    ],
    'employmentType' => 'FULL_TIME',
    'datePosted' => $created,
    'applicantLocationRequirements' => ['@type'=>'Country','name'=>'Mexico'],
    'jobLocation' => [[
      '@type' => 'Place',
      'address' => [
        '@type'=>'PostalAddress',
        'addressLocality' => $empleo['ubicacion'] ?? 'México',
        'addressCountry'  => 'MX'
      ]
    ]],
    'url' => $url
  ];
  if ($salary) {
    $json['baseSalary'] = [
      '@type'=>'MonetaryAmount',
      'currency'=>$moneda,
      'value'=>[
        '@type'=>'QuantitativeValue',
        'value'=>$salary,
        'unitText'=>$unit
      ]
    ];
  }
?>
<script type="application/ld+json">
  <?= json_encode($json, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?>
</script>



</head><body>
<div class="nav">
  <img src="../src-y-fotos/logoCorto3.png" alt="" height="90vw" href="index.php?route=dashboard">
  <div>
    
    <?php if (!empty($_SESSION['usuario_id']) && ($_SESSION['tipo_usuario'] ?? '') === 'empresa'): ?>
      <a href="index.php?route=dashboard_empresa">Dashboard Empresa</a>
    <?php elseif (!empty($_SESSION['usuario_id'])): ?>
      <a href="index.php?route=dashboard">Mi panel</a>
      <a href="index.php?route=empleos">Empleos</a>
      <a href="index.php?route=mis_postulaciones">Mis postulaciones</a>
    <?php endif; ?>
    <?php if (empty($_SESSION['usuario_id'])): ?>
      <a href="index.php?route=login">Iniciar sesión</a>
    <?php else: ?>
      <a href="index.php?route=logout">Salir</a>
    <?php endif; ?>
  </div>
</div>

<div class="container">
  <div class="card">
    <?php
      $empresa = $job['nombre_empresa'] ?? $job['nombre_negocio'] ?? '';
      $logo    = $job['empresa_logo'] ?? '';   // ← usamos el alias
      $ubi     = $job['ubicacion'] ?? '';
    ?>
    <div style="display:flex; gap:12px; align-items:center; margin-bottom:8px">
      <?php if ($logo): ?>
        <img src="<?= htmlspecialchars($logo) ?>" alt="Logo"
            style="width:64px;height:64px;border-radius:12px;object-fit:cover">
      <?php else: ?>
        <div style="width:64px;height:64px;border-radius:12px;background:#334155;display:flex;align-items:center;justify-content:center;color:#cbd5e1">🏢</div>
      <?php endif; ?>

      <div>
        <h1 style="margin:0"><?= htmlspecialchars($job['puesto']) ?></h1>
        <div style="color:#cbd5e1">
          <?= htmlspecialchars($empresa) ?>
          <?php if ($ubi !== ''): ?> · 📍 <?= htmlspecialchars($ubi) ?><?php endif; ?>
          <?php if (!empty($job['categoria'])): ?> · <?= htmlspecialchars($job['categoria']) ?><?php endif; ?>
        </div>
      </div>
    </div>



    <div style="margin-top:14px; font-size:15px; line-height:1.5">
      <?= nl2br(htmlspecialchars($job['descripcion'] ?? '')) ?>
    </div>

    <div style="margin-top:14px">
      <strong>Contacto:</strong>
      <div><?= htmlspecialchars($job['numero_contacto'] ?: 'No especificado') ?></div>
    </div>
    <?php
        // Link de WhatsApp si hay número
        $wa = '';
        if (!empty($job['numero_contacto'])) {
            $waNum = preg_replace('/[^0-9]/', '', $job['numero_contacto']); // sólo dígitos
            if ($waNum !== '') { $wa = 'https://wa.me/'.$waNum; }
        }
    ?>

    <div style="margin-top:16px; display:flex; gap:8px; flex-wrap:wrap">
    <div style="margin-top:11px">
      <a class="btn btn-primary" href="index.php?route=empleos">← Volver a empleos</a>
    </div>
    


    <?php if (!empty($_SESSION['usuario_id']) && ($_SESSION['tipo_usuario'] ?? '') === 'candidato'): ?>
    <?php if (!empty($yaPostulado)): ?>
        <?php if ($wa): ?>
        <a class="btn btn-primary" href="<?= htmlspecialchars($wa) ?>" target="_blank" rel="noopener">Contactar por WhatsApp</a>
        <?php endif; ?>
        <div class="chip" style="background:rgba(78,222,222,.15);border:1px solid rgba(78,222,222,.55);">
        ✅ Ya te postulaste a esta oferta
        </div>
        <a class="btn btn-primary" href="index.php?route=mis_postulaciones">Ver mis postulaciones</a>
    <?php else: ?>
        <form method="post" action="index.php?route=postular" enctype="multipart/form-data" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap">
        <?= csrf_input() ?>
        <input type="hidden" name="route"   value="postular">
        <input type="hidden" name="id_post" value="<?= (int)$job['id_post'] ?>">
        <input class="input" name="mensaje" maxlength="1000" placeholder="Mensaje opcional (máx 1000)">
        <input class="input" type="file" name="cv" accept="application/pdf">
        <?php if (!empty($job['salario'])): ?>
        <div class="chip" style="margin:6px 0">
            💸 <?= htmlspecialchars($job['salario_moneda'] ?? 'MXN') ?>
            <?= number_format((float)$job['salario'], 2) ?>
            / <?= htmlspecialchars($job['salario_periodicidad'] ?? 'mes') ?>
        </div>
        <?php endif; ?>

        <button class="btn btn-primary" type="submit">Postular</button>
        <div style="font-size:12px;color:#cbd5e1">PDF, máx. 2 MB</div>
        </form>
    <?php endif; ?>
    <?php else: ?>
    <a class="btn btn-primary" href="index.php?route=login">Inicia sesión para postular</a>
    <?php endif; ?>

</div>



    
  </div>
</div>
<div class="footer-space"></div>
</body></html>
