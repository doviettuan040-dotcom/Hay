    </div><!-- /.max-w-md -->
</div><!-- /.left-col -->

<!-- Footer -->
<div class="text-center mt-14 mb-10">
    <span class="inline-block text-[10px] font-black tracking-[0.4em] uppercase px-6 py-2 rounded-full border border-white/50 text-white/70">
        <?php echo htmlspecialchars($siteData['site_info']['footer_text'] ?? '@thanhtapcode'); ?>
    </span>
</div>

<!-- Audio Player -->
<audio id="bgMusic" preload="auto"></audio>

<script src="assets/js/main.js"></script>
<script>
    // Pass PHP data to JavaScript
    const siteData = {
        music: {
            playlist: <?php echo json_encode($siteData['music']['playlist']); ?>,
            songNames: <?php echo json_encode($siteData['music']['song_names']); ?>
        }
    };
</script>
</body>
</html>
