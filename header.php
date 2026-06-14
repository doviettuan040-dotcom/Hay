<!DOCTYPE html>
<html lang="vi">
<head>
    <title><?php echo htmlspecialchars($siteData['site_info']['site_title'] ?? 'Me Profile'); ?> - <?php echo htmlspecialchars($siteData['site_info']['site_name'] ?? 'Me Profile'); ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo htmlspecialchars($siteData['site_info']['site_description'] ?? 'Hỗ Trợ Mod Game Uy Tín Số 1.'); ?>"/>
    <meta name="keywords" content="<?php echo htmlspecialchars($siteData['site_info']['site_keywords'] ?? 'telegram Me Profile'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="https://sf-static.upanhlaylink.com/img/image_202604302173ac17f92a66d2919bf1f8f6b61aab.jpg">
</head>
<body class="pb-16">

<!-- Dynamic Background -->
<div class="bg-dynamic">
    <?php if ($siteData['background']['type'] === 'image'): ?>
        <picture>
            <source media="(min-width: 769px)" srcset="<?php echo htmlspecialchars($siteData['background']['url']); ?>">
            <source media="(max-width: 768px)" srcset="<?php echo htmlspecialchars($siteData['background']['mobile_url']); ?>">
            <img src="<?php echo htmlspecialchars($siteData['background']['url']); ?>" alt="Background">
        </picture>
    <?php endif; ?>
</div>

<!-- Overlays -->
<div class="bg-overlay" style="background: #000000; opacity: 0;"></div>
<div id="overlay"></div>
<div id="bg-overlay"></div>

<!-- Navbar -->
<header class="bg-white/70 backdrop-blur-lg h-16 flex justify-between items-center px-6 sticky top-0 z-50 border-b border-white/50">
    <span class="text-slate-800 font-black italic text-xl uppercase tracking-tighter">
        <span class="text-blue-600"><?php echo htmlspecialchars($siteData['site_info']['brand_first'] ?? 'Huutien'); ?></span> 
        <?php echo htmlspecialchars($siteData['site_info']['brand_second'] ?? 'Mods'); ?>
    </span>
    <div class="flex items-center gap-3">
        <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
        <div class="admin-btn" onclick="window.location.href='admin.php'">
            <i class="fa-solid fa-user-shield"></i>
        </div>
        <i id="menuBtn" class="fa-solid fa-bars-staggered text-slate-800 text-2xl cursor-pointer"></i>
    </div>
</header>

<!-- Sidebar -->
<div id="sidebar">
    <div class="flex flex-col items-center text-center mb-6 pb-4 border-b border-white/20">
        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mb-3 shadow-lg">
            <i class="fa-solid fa-crown text-3xl text-white"></i>
        </div>
        <h2 class="text-xl font-bold text-white"><?php echo htmlspecialchars($siteData['site_info']['site_name'] ?? 'Me Profile'); ?></h2>
        <p class="text-xs text-white/50 mt-1">Menu</p>
    </div>
    <?php foreach ($siteData['sidebar_menu'] as $menu): ?>
        <a href="<?php echo htmlspecialchars($menu['url']); ?>" <?php echo strpos($menu['url'], 'http') === 0 ? 'target="_blank"' : ''; ?>>
            <i class="<?php echo htmlspecialchars($menu['icon']); ?>"></i> 
            <?php echo htmlspecialchars($menu['title']); ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Particles & Mouse Glow -->
<div class="particles" id="particles"></div>
<div class="mouse-glow" id="mouseGlow"></div>

<!-- Snowflakes -->
<div class="snowflakes">
    <div class="snowflake" style="left:10%; animation-duration:10s;">❄</div>
    <div class="snowflake" style="left:30%; animation-duration:8s;">•</div>
    <div class="snowflake" style="left:50%; animation-duration:12s;">❄</div>
    <div class="snowflake" style="left:70%; animation-duration:9s;">•</div>
    <div class="snowflake" style="left:85%; animation-duration:15s;">❆</div>
</div>

<!-- Main Content Container -->
<div class="left-col relative z-10">
    <div class="max-w-md mx-auto">
