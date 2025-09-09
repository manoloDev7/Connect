<!doctype html>
<html>
<head><meta charset="utf-8"><title>Datos de Empresa</title>
<?php $v = @filemtime(__DIR__.'/../public/assets/app.css') ?: time(); ?>
<link rel="stylesheet" href="assets/app.css?v=<?= $v ?>">
<style>
  .location1{
    margin-top:130px;
  }
</style>
</head>
<body>
  <div class="location1">
    <div class="card">
      <h2>Completa tu perfil de empresa</h2>
      <?php if (!empty($_SESSION['flash'])): foreach ($_SESSION['flash'] as $f): ?>
      <div style="padding:8px;margin:8px 0; border-radius:6px; <?= $f['t']==='ok'?'background:#e7f7ed;color:#186a3b;border:1px solid #c9f0d8;':'background:#fdecea;color:#7a1f1d;border:1px solid #f5c6cb;' ?>">
        <?= htmlspecialchars($f['m']) ?>
      </div>
      <?php endforeach; $_SESSION['flash']=[]; endif; ?>

      <form method="post"
            action="index.php?route=empresa&user=<?= urlencode($_SESSION['usuario_id'] ?? ($_GET['user'] ?? '')) ?>"
            enctype="multipart/form-data">
        <?= csrf_input() ?>
        <input class="input" type="text" name="nombre_empresa" required placeholder="Nombre de la empresa"><br>
        <input class="input" type="text" name="direccion" placeholder="Dirección"><br>
        <input class="input" type="text" name="telefono" placeholder="Teléfono"><br>
        <label>Logo (JPG, PNG, WEBP; máx 2MB):</label>
        <input class="input" type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"><br>
        <textarea class="input" name="descripcion" placeholder="Descripción"></textarea><br>
        <button  type="submit">Guardar</button>
      </form> 
    </div>
  </div>
</body>
</html>
