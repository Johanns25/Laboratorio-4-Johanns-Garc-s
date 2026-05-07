<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laboratorio #4 — Autocarga en PHP</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --bg:        #0b0f1a;
      --surface:   #111827;
      --card:      #161d2e;
      --border:    #1e2d45;
      --accent:    #38bdf8;
      --accent2:   #818cf8;
      --green:     #34d399;
      --orange:    #fb923c;
      --text:      #e2e8f0;
      --muted:     #64748b;
      --code-bg:   #0d1117;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Sora', sans-serif;
      font-size: 15px;
      line-height: 1.7;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ── GRID BACKGROUND ── */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image:
        linear-gradient(rgba(56,189,248,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(56,189,248,.04) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none;
      z-index: 0;
    }

    main { position: relative; z-index: 1; flex: 1; }

    /* ── HEADER ── */
    header {
      border-bottom: 1px solid var(--border);
      padding: 0 48px;
      background: rgba(11,15,26,.85);
      backdrop-filter: blur(12px);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header-inner {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 16px;
      height: 60px;
    }

    .badge {
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      color: #fff;
      padding: 3px 10px;
      border-radius: 4px;
      letter-spacing: .06em;
      text-transform: uppercase;
    }

    .header-title {
      font-size: 14px;
      font-weight: 600;
      color: var(--muted);
      font-family: 'JetBrains Mono', monospace;
    }

    /* ── HERO ── */
    .hero {
      padding: 72px 48px 56px;
      max-width: 900px;
      margin: 0 auto;
    }

    .lab-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 12px;
      color: var(--accent);
      border: 1px solid var(--accent);
      padding: 4px 12px;
      border-radius: 20px;
      margin-bottom: 24px;
      letter-spacing: .08em;
    }

    .lab-tag::before {
      content: '';
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%,100% { opacity: 1; transform: scale(1); }
      50%      { opacity: .4; transform: scale(.7); }
    }

    h1 {
      font-size: clamp(28px, 5vw, 44px);
      font-weight: 700;
      line-height: 1.15;
      margin-bottom: 16px;
      background: linear-gradient(135deg, #e2e8f0 30%, var(--accent) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-sub {
      font-size: 16px;
      color: var(--muted);
      max-width: 580px;
    }

    /* ── CONTENT ── */
    .content {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 48px 80px;
      display: flex;
      flex-direction: column;
      gap: 40px;
    }

    /* ── SECTION CARD ── */
    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }

    .card-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 18px 24px;
      border-bottom: 1px solid var(--border);
      background: var(--surface);
    }

    .card-icon {
      font-size: 18px;
      width: 36px; height: 36px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 8px;
      background: rgba(56,189,248,.1);
      border: 1px solid rgba(56,189,248,.2);
    }

    .card-title {
      font-size: 14px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: var(--accent);
      font-family: 'JetBrains Mono', monospace;
    }

    .card-body { padding: 24px; }

    /* ── DESCRIPTION ── */
    .card-body p { color: var(--text); margin-bottom: 12px; }
    .card-body p:last-child { margin-bottom: 0; }

    /* ── FILE TREE ── */
    .file-tree {
      background: var(--code-bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 20px 24px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      line-height: 2;
    }

    .tree-item { display: flex; align-items: center; gap: 8px; }
    .tree-item.dir  { color: var(--accent); font-weight: 600; }
    .tree-item.file { color: var(--text); }
    .tree-item.sub  { padding-left: 24px; }
    .tree-item.sub2 { padding-left: 48px; }

    .tree-connector { color: var(--muted); }

    /* ── CODE BLOCK ── */
    .code-block {
      background: var(--code-bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .code-block:last-child { margin-bottom: 0; }

    .code-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 16px;
      background: var(--surface);
      border-bottom: 1px solid var(--border);
    }

    .code-filename {
      font-family: 'JetBrains Mono', monospace;
      font-size: 12px;
      color: var(--accent2);
      font-weight: 600;
    }

    .code-lang {
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      color: var(--muted);
      background: rgba(255,255,255,.05);
      padding: 2px 8px;
      border-radius: 4px;
    }

    pre {
      margin: 0;
      padding: 20px;
      overflow-x: auto;
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      line-height: 1.8;
    }

    .kw  { color: #c792ea; }
    .fn  { color: #82aaff; }
    .str { color: #c3e88d; }
    .cm  { color: #546e7a; font-style: italic; }
    .ns  { color: var(--orange); }
    .ret { color: var(--accent); }
    .num { color: var(--green); }

    /* ── CONCEPTS GRID ── */
    .concepts-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .concept-pill {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 16px 18px;
      transition: border-color .2s, transform .2s;
    }

    .concept-pill:hover {
      border-color: var(--accent);
      transform: translateY(-2px);
    }

    .concept-pill .emoji { font-size: 22px; margin-bottom: 8px; display: block; }
    .concept-pill h4 { font-size: 13px; font-weight: 700; margin-bottom: 4px; color: var(--accent); }
    .concept-pill p  { font-size: 12px; color: var(--muted); line-height: 1.5; }

    /* ── STEPS ── */
    .steps { display: flex; flex-direction: column; gap: 12px; }

    .step {
      display: flex;
      gap: 16px;
      align-items: flex-start;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 16px 20px;
    }

    .step-num {
      min-width: 32px; height: 32px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex; align-items: center; justify-content: center;
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .step-content h4 { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .step-content p  { font-size: 13px; color: var(--muted); }

    code {
      font-family: 'JetBrains Mono', monospace;
      background: rgba(56,189,248,.1);
      color: var(--accent);
      padding: 1px 6px;
      border-radius: 4px;
      font-size: .9em;
    }

    /* ── SCREENSHOT PLACEHOLDER ── */
    .screenshot-placeholder {
      border: 2px dashed var(--border);
      border-radius: 10px;
      min-height: 260px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 12px;
      color: var(--muted);
      font-size: 14px;
      background: repeating-linear-gradient(
        45deg,
        rgba(255,255,255,.015),
        rgba(255,255,255,.015) 10px,
        transparent 10px,
        transparent 20px
      );
      transition: border-color .2s;
    }

    .screenshot-placeholder:hover { border-color: var(--accent2); }

    .screenshot-placeholder .ph-icon {
      font-size: 40px;
      opacity: .4;
    }

    .screenshot-placeholder span {
      font-family: 'JetBrains Mono', monospace;
      font-size: 12px;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    /* ── OUTPUT BOX ── */
    .output-box {
      background: var(--code-bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 20px 24px;
      font-family: 'JetBrains Mono', monospace;
      font-size: 14px;
    }

    .output-line { display: flex; align-items: center; gap: 10px; margin-bottom: 6px; }
    .output-line:last-child { margin-bottom: 0; }
    .prompt { color: var(--green); }
    .out-val { color: var(--text); }

    /* ── FOOTER ── */
    footer {
      position: relative;
      z-index: 1;
      border-top: 1px solid var(--border);
      background: var(--surface);
      padding: 28px 48px;
    }

    .footer-inner {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }

    .footer-info { display: flex; flex-direction: column; gap: 4px; }

    .footer-name {
      font-weight: 700;
      font-size: 15px;
      color: var(--accent);
    }

    .footer-cedula {
      font-family: 'JetBrains Mono', monospace;
      font-size: 12px;
      color: var(--muted);
    }

    .footer-right {
      font-family: 'JetBrains Mono', monospace;
      font-size: 11px;
      color: var(--muted);
      text-align: right;
    }
  </style>
</head>
<body>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <span class="badge">Lab #4</span>
    <span class="header-title">Programación Web · PHP Autoload</span>
  </div>
</header>

<main>

  <!-- HERO -->
  <section class="hero">
    <div class="lab-tag">Laboratorio 04</div>
    <h1>Autocarga de Clases en PHP<br>con Composer (PSR-4)</h1>
    <p class="hero-sub">
      Implementación de la autocarga automática de clases utilizando Composer y el estándar PSR-4,
      organizando el proyecto en namespaces y directorios estructurados.
    </p>
  </section>

  <!-- CONTENT -->
  <div class="content">

    <!-- DESCRIPCIÓN -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">📋</div>
        <span class="card-title">Descripción del Laboratorio</span>
      </div>
      <div class="card-body">
        <p>
          En este laboratorio se implementó la <strong>autocarga (autoloading) de clases PHP</strong> mediante
          <strong>Composer</strong>, eliminando la necesidad de hacer <code>require</code> o <code>include</code>
          manualmente para cada archivo de clase.
        </p>
        <p>
          Se crearon dos clases distribuidas en distintos namespaces y directorios:
          <code>App\User</code> y <code>Database\Model\ProductModel</code>. A través de la configuración
          PSR-4 en el archivo <code>composer.json</code>, Composer genera automáticamente el mapa de
          clases que permite resolverlas al momento de instanciarlas.
        </p>
      </div>
    </div>

    <!-- CONCEPTOS CLAVE -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">💡</div>
        <span class="card-title">Conceptos Aplicados</span>
      </div>
      <div class="card-body">
        <div class="concepts-grid">
          <div class="concept-pill">
            <span class="emoji">📦</span>
            <h4>Composer</h4>
            <p>Gestor de dependencias y generador del autoloader para PHP.</p>
          </div>
          <div class="concept-pill">
            <span class="emoji">🗂️</span>
            <h4>PSR-4</h4>
            <p>Estándar de autocarga que mapea namespaces a directorios del proyecto.</p>
          </div>
          <div class="concept-pill">
            <span class="emoji">🔖</span>
            <h4>Namespaces</h4>
            <p>Organización lógica de clases para evitar colisiones de nombres.</p>
          </div>
          <div class="concept-pill">
            <span class="emoji">⚙️</span>
            <h4>vendor/autoload.php</h4>
            <p>Archivo generado por Composer que registra el autoloader automáticamente.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- ESTRUCTURA DEL PROYECTO -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">🗁</div>
        <span class="card-title">Estructura del Proyecto</span>
      </div>
      <div class="card-body">
        <div class="file-tree">
          <div class="tree-item dir">📁 AutocargaEjemplo/</div>
          <div class="tree-item sub file"><span class="tree-connector">├──</span> 📄 composer.json</div>
          <div class="tree-item sub file"><span class="tree-connector">├──</span> 📄 composer.lock</div>
          <div class="tree-item sub file"><span class="tree-connector">├──</span> 📄 prueba.php</div>
          <div class="tree-item sub dir"><span class="tree-connector">├──</span> 📁 App/</div>
          <div class="tree-item sub2 file"><span class="tree-connector">└──</span> 📄 User.php</div>
          <div class="tree-item sub dir"><span class="tree-connector">├──</span> 📁 Database/</div>
          <div class="tree-item sub2 dir"><span class="tree-connector">└──</span> 📁 Model/</div>
          <div class="tree-item sub2 file" style="padding-left:72px;"><span class="tree-connector">└──</span> 📄 ProductModel.php</div>
          <div class="tree-item sub dir"><span class="tree-connector">└──</span> 📁 vendor/</div>
          <div class="tree-item sub2 file"><span class="tree-connector">└──</span> 📄 autoload.php <span style="color:var(--muted);font-size:11px;">(generado)</span></div>
        </div>
      </div>
    </div>

    <!-- CÓDIGO FUENTE -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">💻</div>
        <span class="card-title">Código Fuente</span>
      </div>
      <div class="card-body">

        <!-- composer.json -->
        <div class="code-block">
          <div class="code-header">
            <span class="code-filename">composer.json</span>
            <span class="code-lang">JSON</span>
          </div>
          <pre>{
  <span class="str">"autoload"</span>: {
    <span class="str">"psr-4"</span>: {
      <span class="str">"App\\"</span>: <span class="str">"App/"</span>,
      <span class="str">"Database\\"</span>: <span class="str">"Database/"</span>
    }
  }
}</pre>
        </div>

        <!-- User.php -->
        <div class="code-block">
          <div class="code-header">
            <span class="code-filename">App/User.php</span>
            <span class="code-lang">PHP</span>
          </div>
          <pre><span class="kw">&lt;?php</span>
<span class="kw">namespace</span> <span class="ns">App</span>;

<span class="kw">class</span> <span class="fn">User</span>
{
    <span class="kw">public function</span> <span class="fn">getName</span>(): <span class="ret">string</span>
    {
        <span class="kw">return</span> <span class="str">"Dave"</span>;
    }
}</pre>
        </div>

        <!-- ProductModel.php -->
        <div class="code-block">
          <div class="code-header">
            <span class="code-filename">Database/Model/ProductModel.php</span>
            <span class="code-lang">PHP</span>
          </div>
          <pre><span class="kw">&lt;?php</span>
<span class="kw">namespace</span> <span class="ns">Database\Model</span>;

<span class="kw">class</span> <span class="fn">ProductModel</span>
{
    <span class="kw">public function</span> <span class="fn">getId</span>(): <span class="ret">int</span>
    {
        <span class="kw">return</span> <span class="num">123</span>;
    }
}</pre>
        </div>

        <!-- prueba.php -->
        <div class="code-block">
          <div class="code-header">
            <span class="code-filename">prueba.php</span>
            <span class="code-lang">PHP</span>
          </div>
          <pre><span class="kw">&lt;?php</span>

<span class="kw">use</span> <span class="ns">App\User</span>;
<span class="kw">use</span> <span class="ns">Database\Model\ProductModel</span>;

<span class="kw">require</span> <span class="str">'vendor/autoload.php'</span>;

<span class="cm">// Se instancian las clases sin require manual</span>
$user = <span class="kw">new</span> <span class="fn">User</span>();
<span class="fn">echo</span> $user-><span class="fn">getName</span>();   <span class="cm">// Dave</span>
<span class="fn">echo</span> <span class="str">"\n"</span>;

$products = <span class="kw">new</span> <span class="fn">ProductModel</span>();
<span class="fn">echo</span> $products-><span class="fn">getId</span>(); <span class="cm">// 123</span></pre>
        </div>
      </div>
    </div>

    <!-- PASOS PARA EJECUTAR -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">▶️</div>
        <span class="card-title">Pasos para Ejecutar</span>
      </div>
      <div class="card-body">
        <div class="steps">
          <div class="step">
            <div class="step-num">1</div>
            <div class="step-content">
              <h4>Instalar Composer</h4>
              <p>Asegúrate de tener Composer instalado globalmente en tu sistema. Verifica con <code>composer --version</code>.</p>
            </div>
          </div>
          <div class="step">
            <div class="step-num">2</div>
            <div class="step-content">
              <h4>Generar el autoloader</h4>
              <p>Ejecuta <code>composer dump-autoload</code> en la raíz del proyecto para generar la carpeta <code>vendor/</code>.</p>
            </div>
          </div>
          <div class="step">
            <div class="step-num">3</div>
            <div class="step-content">
              <h4>Ejecutar el script de prueba</h4>
              <p>Corre <code>php prueba.php</code> desde la terminal. Se imprimirá el nombre y el ID del producto.</p>
            </div>
          </div>
          <div class="step">
            <div class="step-num">4</div>
            <div class="step-content">
              <h4>Verificar la salida</h4>
              <p>La consola debe mostrar <code>Dave</code> en la primera línea y <code>123</code> en la segunda.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SALIDA ESPERADA -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">📤</div>
        <span class="card-title">Salida Esperada en Consola</span>
      </div>
      <div class="card-body">
        <div class="output-box">
          <div class="output-line">
            <span class="prompt">$</span>
            <span class="out-val">php prueba.php</span>
          </div>
          <div class="output-line" style="padding-left:20px;">
            <span class="out-val" style="color:var(--green);">Dave</span>
          </div>
          <div class="output-line" style="padding-left:20px;">
            <span class="out-val" style="color:var(--green);">123</span>
          </div>
        </div>
      </div>
    </div>

    <!-- CAPTURA DE EJECUCIÓN -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon">📸</div>
        <span class="card-title">Captura de Ejecución</span>
      </div>
      <div class="card-body">
        <img src="prueba de ejecucion.png" alt="Captura de ejecución" style="width:100%; border-radius:8px; display:block;" />
      </div>
    </div>

  </div><!-- /content -->
</main>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-info">
      <span class="footer-name">Johanns Garcés</span>
      <span class="footer-cedula">Cédula: 8-1000-355</span>
    </div>
    <div class="footer-right">
      Laboratorio #4 · Autocarga PHP<br>
      Programación Web
    </div>
  </div>
</footer>

</body>
</html>
