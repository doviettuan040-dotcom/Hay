<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

// Load site data
$siteData = loadSiteData();

include 'includes/header.php';
?>

<!-- Profile Hero Section -->
<div class="flex flex-col items-center pt-10">
    <div class="avatar-container">
        <div class="w-28 h-28 rounded-full bg-white shadow-2xl p-1 overflow-hidden">
            <img src="<?php echo htmlspecialchars($siteData['profile']['avatar']); ?>"
                 class="w-full h-full rounded-full object-cover">
        </div>
    </div>

    <p class="mt-6 font-bold italic text-sm tracking-widest uppercase bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text text-transparent">
        <?php echo htmlspecialchars($siteData['profile']['title']); ?>
    </p>

    <h1 class="text-3xl font-black text-yellow-400 text-center mt-1 flex items-center justify-center gap-2">
        <?php echo htmlspecialchars($siteData['profile']['name']); ?>
        <img class="verify" src="/webp/verify2.webp" alt="Verified">
    </h1>

    <p class="mt-6 font-bold italic text-sm tracking-widest uppercase bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent drop-shadow-[0_0_10px_rgba(59,130,246,0.7)]">
        <?php echo htmlspecialchars($siteData['profile']['subtitle']); ?>
    </p>

    <!-- Social Icons -->
    <div class="flex gap-5 mt-8 flex-wrap justify-center">
        <?php foreach ($siteData['social_links'] as $social): ?>
            <a href="<?php echo htmlspecialchars($social['url']); ?>"
               target="_blank" rel="noopener noreferrer"
               class="w-14 h-14 rounded-xl bg-white shadow-md flex items-center justify-center text-2xl
                      hover:bg-blue-500 hover:text-white transition-all duration-300
                      transform hover:scale-110 hover:shadow-xl"
               style="color: <?php echo htmlspecialchars($social['color']); ?>;">
                <?php echo renderSocialIcon($social['icon']); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Navbar Cards -->
<div class="mt-10 space-y-4 px-4">
    <?php foreach ($siteData['navbar_cards'] as $card): ?>
        <div class="glass-card p-5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="<?php echo htmlspecialchars($card['icon']); ?>"></i>
                </div>
                <div>
                    <p class="font-black text-slate-700"><?php echo htmlspecialchars($card['title']); ?></p>
                    <p class="text-[10px] text-blue-500 font-bold uppercase tracking-tighter">
                        <?php echo htmlspecialchars($card['subtitle']); ?>
                    </p>
                </div>
            </div>
            <a href="<?php echo htmlspecialchars($card['url']); ?>" class="btn-action">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<!-- Category Sections -->
<?php foreach ($siteData['categories'] as $catName => $items): ?>
    <h2 class="section-title flex justify-center items-center gap-3">
        <?php echo htmlspecialchars($catName); ?>
        <span class="relative flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-600 shadow-[0_0_15px_rgba(59,130,246,0.8)]"></span>
        </span>
    </h2>

    <div class="space-y-4 px-[15px]">
        <?php foreach ($items as $item): ?>
            <div class="list-container relative p-[2px] bg-gradient-to-r from-blue-600 via-red-500 to-blue-600
                        animate-[bg-move_3s_linear_infinite] bg-[length:200%_200%]
                        shadow-[0_20px_40px_rgba(59,130,246,0.3)]">
                <div class="bg-white/90 backdrop-blur-3xl rounded-[28px] overflow-hidden">
                    <div class="list-row group !border-none relative overflow-hidden px-6 py-5 transition-all duration-500 hover:bg-white/50">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/60 to-transparent
                                    -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] pointer-events-none"></div>

                        <div class="flex items-center relative z-10">
                            <div class="relative">
                                <div class="absolute inset-0 bg-blue-500 blur-xl opacity-20 group-hover:opacity-50 transition-opacity"></div>
                                <img src="<?php echo htmlspecialchars($item['image']); ?>"
                                     alt="<?php echo htmlspecialchars($item['title']); ?>"
                                     class="relative z-10 w-16 h-16 rounded-2xl border-2 border-white shadow-xl
                                            transform group-hover:scale-110 transition-transform duration-500">
                                <?php if (!empty($item['badge'])): ?>
                                    <div class="badge-new" style="background: <?php echo htmlspecialchars($item['badge_color']); ?>">
                                        <?php echo htmlspecialchars($item['badge']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="ml-5">
                                <p class="font-black text-transparent bg-clip-text bg-gradient-to-r
                                          from-blue-800 to-red-800 text-sm tracking-tight
                                          group-hover:tracking-wider transition-all uppercase">
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </p>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    <p class="live-clock text-[10px] text-slate-500 font-extrabold uppercase tracking-widest italic">
                                        Loading...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo htmlspecialchars($item['url']); ?>"
                           class="relative z-10 w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center
                                  justify-center text-xl shadow-2xl group-hover:bg-blue-600
                                  group-hover:rotate-[360deg] transition-all duration-700 border border-white/20">
                            <i class="fa-solid fa-bolt-lightning text-yellow-400"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
