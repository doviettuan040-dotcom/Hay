// =============================================
// Main JavaScript File
// =============================================

// Sidebar toggle
const menuBtn = document.getElementById('menuBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });
}

if (overlay) {
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
}

// Particles effect
const particlesContainer = document.getElementById('particles');
function createParticle() {
    if (!particlesContainer) return;
    const p = document.createElement('div');
    p.classList.add('particle');
    const size = Math.random() * 4 + 2;
    p.style.width = size + 'px';
    p.style.height = size + 'px';
    p.style.left = Math.random() * window.innerWidth + 'px';
    p.style.animationDuration = (Math.random() * 5 + 5) + 's';
    particlesContainer.appendChild(p);
    setTimeout(() => p.remove(), 10000);
}
setInterval(createParticle, 200);

// Mouse glow effect
const glow = document.getElementById('mouseGlow');
if (glow) {
    document.addEventListener('mousemove', (e) => {
        glow.style.left = e.clientX + 'px';
        glow.style.top = e.clientY + 'px';
    });
}

// Live clock
function startClock() {
    const clockElements = document.querySelectorAll('.live-clock');
    setInterval(() => {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('vi-VN', { hour12: false });
        const dateStr = now.toLocaleDateString('vi-VN');
        clockElements.forEach(el => {
            if (el) el.innerHTML = `🕒 ${timeStr} | ${dateStr}`;
        });
    }, 1000);
}

// Music Player
let audioElem = null;
let currentSongIndex = 0;
let playlist = [];
let songNames = [];

function initMusicPlayer() {
    audioElem = document.getElementById('bgMusic');
    if (!audioElem) return;
    
    // Get data from PHP injected variable
    if (typeof siteData !== 'undefined' && siteData.music) {
        playlist = siteData.music.playlist || [];
        songNames = siteData.music.songNames || [];
    } else {
        // Fallback data
        playlist = ['/music/Cảm Ơn Người Đã Thức Cùng Tôi Remix.mp3'];
        songNames = ['Cảm Ơn Người Đã Thức Cùng Tôi Remix'];
    }
    
    if (playlist.length === 0) return;
    
    createMusicControls();
    createSongList();
    createSongNotification();
    playCurrentSong();
    setTimeout(autoPlayMusic, 1000);
    audioElem.addEventListener('ended', playNextSong);
}

function createMusicControls() {
    const controls = document.createElement('div');
    controls.className = 'music-controls';
    controls.innerHTML = `
        <button class="music-btn" onclick="playPreviousSong()" title="Bài trước">
            <i class="bi bi-skip-backward-fill"></i>
        </button>
        <button class="music-btn" onclick="togglePlayPause()" title="Phát/Tạm dừng">
            <i class="bi bi-play-fill" id="playIcon"></i>
            <i class="bi bi-pause-fill" id="pauseIcon" style="display:none"></i>
        </button>
        <button class="music-btn" onclick="playNextSong()" title="Bài tiếp theo">
            <i class="bi bi-skip-forward-fill"></i>
        </button>
        <button class="music-btn select-btn" onclick="openSongList()" title="Chọn bài hát">
            <i class="bi bi-music-note-list"></i>
        </button>
    `;
    document.body.appendChild(controls);
}

function createSongList() {
    const songList = document.createElement('div');
    songList.className = 'song-list-panel';
    songList.innerHTML = `
        <div class="song-list-header">
            <span>Chọn bài hát</span>
            <button class="close-list-btn" onclick="closeSongList()"><i class="bi bi-x"></i></button>
        </div>
        <div class="song-list-content">
            ${songNames.map((song, i) => `
                <div class="song-list-item ${i === currentSongIndex ? 'active' : ''}" onclick="selectSong(${i})">
                    <i class="bi bi-music-note"></i>
                    <span>${escapeHtml(song)}</span>
                    ${i === currentSongIndex ? '<i class="bi bi-check"></i>' : ''}
                </div>`).join('')}
        </div>
    `;
    document.body.appendChild(songList);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function createSongNotification() {
    const n = document.createElement('div');
    n.className = 'song-notification';
    n.innerHTML = `
        <div class="notification-content">
            <i class="bi bi-music-note-beamed"></i>
            <span id="currentSongText">Đang phát: ${songNames[0] || ''}</span>
        </div>`;
    document.body.appendChild(n);
}

function playCurrentSong() {
    if (!audioElem || playlist.length === 0) return;
    audioElem.src = playlist[currentSongIndex];
    audioElem.volume = 0.7;
    audioElem.load();
    
    document.querySelectorAll('.song-list-item').forEach((el, i) => {
        if (el) el.classList.toggle('active', i === currentSongIndex);
    });
}

function playNextSong() {
    if (playlist.length === 0) return;
    currentSongIndex = (currentSongIndex + 1) % playlist.length;
    playCurrentSong();
    audioElem.play();
    updateMusicIcons('play');
    showSongNotification();
}

function playPreviousSong() {
    if (playlist.length === 0) return;
    currentSongIndex = (currentSongIndex - 1 + playlist.length) % playlist.length;
    playCurrentSong();
    audioElem.play();
    updateMusicIcons('play');
    showSongNotification();
}

function togglePlayPause() {
    if (!audioElem) return;
    if (audioElem.paused) {
        audioElem.play();
        updateMusicIcons('play');
    } else {
        audioElem.pause();
        updateMusicIcons('pause');
    }
}

function updateMusicIcons(state) {
    const playIcon = document.getElementById('playIcon');
    const pauseIcon = document.getElementById('pauseIcon');
    if (playIcon && pauseIcon) {
        playIcon.style.display = state === 'play' ? 'none' : 'block';
        pauseIcon.style.display = state === 'play' ? 'block' : 'none';
    }
}

function openSongList() {
    const panel = document.querySelector('.song-list-panel');
    if (panel) panel.classList.add('show');
}

function closeSongList() {
    const panel = document.querySelector('.song-list-panel');
    if (panel) panel.classList.remove('show');
}

function selectSong(index) {
    currentSongIndex = index;
    playCurrentSong();
    audioElem.play()
        .then(() => {
            updateMusicIcons('play');
            showSongNotification();
            closeSongList();
        })
        .catch(() => {
            updateMusicIcons('pause');
            showSongNotification();
            closeSongList();
        });
}

function showSongNotification() {
    const n = document.querySelector('.song-notification');
    const textSpan = document.getElementById('currentSongText');
    if (textSpan && songNames[currentSongIndex]) {
        textSpan.textContent = `Đang phát: ${songNames[currentSongIndex]}`;
    }
    if (n) {
        n.classList.add('show');
        setTimeout(() => n.classList.remove('show'), 3000);
    }
}

function autoPlayMusic() {
    if (!audioElem) return;
    audioElem.load();
    const p = audioElem.play();
    if (p !== undefined) {
        p.then(() => {
            updateMusicIcons('play');
            showSongNotification();
        }).catch(() => {
            document.body.addEventListener('click', enableAudioOnInteraction, { once: true });
        });
    }
}

function enableAudioOnInteraction() {
    if (!audioElem) return;
    audioElem.play()
        .then(() => {
            updateMusicIcons('play');
            showSongNotification();
        })
        .catch(e => console.log('Không thể phát nhạc:', e));
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    startClock();
    initMusicPlayer();
});
