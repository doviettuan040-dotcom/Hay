<?php
// =============================================
// Functions File - Complete Version
// =============================================

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Admin credentials (CHANGE THESE FOR SECURITY!)
define('ADMIN_USERNAME', 'Username');
define('ADMIN_PASSWORD_HASH', password_hash('Password', PASSWORD_DEFAULT));

// Define data file path
if (!defined('DATA_FILE')) {
    define('DATA_FILE', __DIR__ . '/../data/site_data.json');
}

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        return true;
    }
    return false;
}

/**
 * Load site data from JSON file
 */
function loadSiteData() {
    // Check if data file exists
    if (!file_exists(DATA_FILE)) {
        return getDefaultData();
    }
    
    // Read and decode JSON
    $content = file_get_contents(DATA_FILE);
    $data = json_decode($content, true);
    
    // Return data or default if invalid
    if (is_array($data)) {
        return $data;
    }
    return getDefaultData();
}

/**
 * Save site data to JSON file
 */
function saveSiteData($data) {
    $dir = dirname(DATA_FILE);
    
    // Create directory if not exists
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
    
    // Save to file
    return file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

/**
 * Get default site data
 */
function getDefaultData() {
    return [
        // Site information
        'site_info' => [
            'site_name' => 'Home | Me Profile',
            'site_title' => 'LuanOri Profile',
            'site_description' => 'LuanOri',
            'site_keywords' => 'LuanOri',
            'footer_text' => '㉿ klnxpluanori',
            'brand_first' => '㉿ KLNXP',
            'brand_second' => 'LUANORI'
        ],
        
        // Profile information
        'profile' => [
            'name' => '㉿klnxpluanori',
            'title' => 'Home | Me Profile',
            'subtitle' => 'mã nguồn ngon',
            'avatar' => 'https://pbs.twimg.com/media/Fn-ozYhXwAI0-xG.png'
        ],
        
        // Social links
        'social_links' => [
            [
                'name' => 'TikTok',
                'url' => 'https://t.me/LuanOri04',
                'icon' => 'fa-brands fa-tiktok',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Telegram',
                'url' => 'https://t.me/LuanOri04',
                'icon' => 'fa-brands fa-telegram',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Facebook',
                'url' => 'https://fb.com/LuanOri',
                'icon' => 'fa-brands fa-facebook',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Discord',
                'url' => 'https://t.me/LuanOri',
                'icon' => 'fa-brands fa-discord',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Telegram2',
                'url' => 'https://t.me/LuanOri04',
                'icon' => 'fab fa-telegram',
                'color' => '#3b82f6'
            ]
        ],
        
        // Navbar cards
        'navbar_cards' => [
            [
                'title' => 'LuanOri',
                'subtitle' => 't.me',
                'url' => 'https://t.me/LuanOri04',
                'icon' => 'fa-regular fa-thumbs-up'
            ]
        ],
        
        // Categories
        'categories' => [
            'FILE' => [
                [
                    'title' => 'ANDROID APK PROXY',
                    'image' => 'https://i.postimg.cc/DvMYx1JG/IMG-20251219-195638-303.jpg',
                    'url' => 'https://t.me/LuanOri04',
                    'badge' => 'New',
                    'badge_color' => '#ff0000'
                ],
                [
                    'title' => 'Download Certificate',
                    'image' => 'https://i.postimg.cc/DvMYx1JG/IMG-20251219-195638-303.jpg',
                    'url' => 'https://t.me/LuanOri04',
                    'badge' => 'UPDATE',
                    'badge_color' => '#22c55e'
                ]
            ],
            'Link Cài Trực Tiếp' => [
                [
                    'title' => 'TrollStore',
                    'image' => 'https://i.postimg.cc/DvMYx1JG/IMG-20251219-195638-303.jpg',
                    'url' => 'https://t.me/LuanOri04',
                    'badge' => 'New',
                    'badge_color' => '#22c55e'
                ]
            ],
            'Esign' => [
                [
                    'title' => 'Aramco Services Company',
                    'image' => 'https://i.postimg.cc/DvMYx1JG/IMG-20251219-195638-303.jpg',
                    'url' => 'https://t.me/LuanOri04',
                    'badge' => 'NEW',
                    'badge_color' => '#22c55e'
                ]
            ],
            'Ksign' => [
                [
                    'title' => 'Aramco Services Company',
                    'image' => 'https://i.postimg.cc/DvMYx1JG/IMG-20251219-195638-303.jpg',
                    'url' => 'https://t.me/LuanOri04',
                    'badge' => 'NEW',
                    'badge_color' => '#22c55e'
                ]
            ]
        ],
        
        // Music
        'music' => [
            'playlist' => [
                '/music/Cảm Ơn Em (Style Huy PT Remix).mp3',
                '/music/Em Thua Cô Ta Remix (Bản Chuẩn TikTok).mp3',
                '/music/Hẹn Hò Nhưng Không Yêu (LD Remix).mp3',
                '/music/Lụy Tình (Style Huy PT Remix).mp3',
                '/music/Mở Lối Cho Em (Style Huy PT Remix).mp3',
                '/music/Phim Ba Người Remix (Bản Hot TikTok).mp3'
            ],
            'song_names' => [
                'Cảm Ơn Em (Style Huy PT Remix)',
                'Em Thua Cô Ta Remix (Bản Chuẩn TikTok)',
                'Hẹn Hò Nhưng Không Yêu (LD Remix)',
                'Lụy Tình (Style Huy PT Remix)',
                'Mở Lối Cho Em (Style Huy PT Remix)',
                'Phim Ba Người Remix (Bản Hot TikTok)'
            ]
        ],
        
        // Background
        'background' => [
            'type' => 'image',
            'url' => 'https://sf-static.upanhlaylink.com/img/image_20260325dfb963723fc036a212237025f8df9876.jpg',
            'mobile_url' => 'background.jpg'
        ],
        
        // Footer text
        'footer_text' => '@luanori',
        
        // Sidebar menu
        'sidebar_menu' => [
            [
                'title' => 'Trang chủ',
                'icon' => 'fa-solid fa-home',
                'url' => 'index.php'
            ],
            [
                'title' => 'Admin Panel',
                'icon' => 'fa-solid fa-user-shield',
                'url' => 'LuanOriCpanel.php'
            ],
            [
                'title' => 'Hỗ trợ',
                'icon' => 'fa-solid fa-question-circle',
                'url' => '#'
            ],
            [
                'title' => 'Liên hệ',
                'icon' => 'fa-brands fa-telegram',
                'url' => 'https://t.me/LuanOri04'
            ]
        ]
    ];
}

/**
 * Handle admin login
 */
function handleAdminLogin() {
    // Check if login form submitted
    if (isset($_POST['admin_login'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Verify credentials
        if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_message'] = 'Đăng nhập thành công!';
            header('Location: LuanOriCpanel.php');
            exit;
        }
        
        return 'Sai tên đăng nhập hoặc mật khẩu!';
    }
    
    return null;
}

/**
 * Handle admin logout
 */
function handleAdminLogout() {
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}

/**
 * Handle all form submissions from admin
 */
function handleFormSubmissions(&$siteData) {
    // Check if admin is logged in and request is POST
    if (!isAdminLoggedIn() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    
    // ==================== 1. UPDATE SITE INFO ====================
if (isset($_POST['update_site_info'])) {
    // Khởi tạo mảng site_info nếu chưa có
    if (!isset($siteData['site_info'])) {
        $siteData['site_info'] = [];
    }
    
    // Cập nhật thông tin
    $siteData['site_info']['site_name'] = $_POST['site_name'] ?? $siteData['site_info']['site_name'] ?? '';
    $siteData['site_info']['site_title'] = $_POST['site_title'] ?? $siteData['site_info']['site_title'] ?? '';
    $siteData['site_info']['brand_first'] = $_POST['brand_first'] ?? $siteData['site_info']['brand_first'] ?? '';
    $siteData['site_info']['brand_second'] = $_POST['brand_second'] ?? $siteData['site_info']['brand_second'] ?? '';
    $siteData['site_info']['footer_text'] = $_POST['footer_text'] ?? $siteData['site_info']['footer_text'] ?? '';
    $siteData['site_info']['site_description'] = $_POST['site_description'] ?? $siteData['site_info']['site_description'] ?? '';
    $siteData['site_info']['site_keywords'] = $_POST['site_keywords'] ?? $siteData['site_info']['site_keywords'] ?? '';
    
    // Lưu vào file
    saveSiteData($siteData);
    
    // Thông báo và chuyển hướng
    $_SESSION['admin_message'] = 'Cập nhật cài đặt thành công!';
    header('Location: LuanOriCpanel.php');
    exit;
}
    
    // ==================== 2. UPDATE BACKGROUND ====================
    if (isset($_POST['update_background'])) {
        // Update background
        $siteData['background']['type'] = $_POST['bg_type'] ?? $siteData['background']['type'] ?? 'image';
        $siteData['background']['url'] = $_POST['bg_url'] ?? $siteData['background']['url'] ?? '';
        $siteData['background']['mobile_url'] = $_POST['bg_mobile_url'] ?? $siteData['background']['mobile_url'] ?? '';
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Cập nhật background thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== 3. UPDATE PROFILE ====================
    if (isset($_POST['update_profile'])) {
        // Update profile
        $siteData['profile']['name'] = $_POST['profile_name'] ?? $siteData['profile']['name'] ?? '';
        $siteData['profile']['title'] = $_POST['profile_title'] ?? $siteData['profile']['title'] ?? '';
        $siteData['profile']['subtitle'] = $_POST['profile_subtitle'] ?? $siteData['profile']['subtitle'] ?? '';
        $siteData['profile']['avatar'] = $_POST['profile_avatar'] ?? $siteData['profile']['avatar'] ?? '';
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Cập nhật hồ sơ thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== 4. UPDATE SIDEBAR MENU ====================
    if (isset($_POST['update_sidebar'])) {
        $newSidebarMenu = array();
        
        // Get data from form
        $titles = $_POST['menu_title'] ?? array();
        $icons = $_POST['menu_icon'] ?? array();
        $urls = $_POST['menu_url'] ?? array();
        
        // Build new sidebar menu
        for ($i = 0; $i < count($titles); $i++) {
            if (!empty($titles[$i])) {
                $newSidebarMenu[] = array(
                    'title' => trim($titles[$i]),
                    'icon' => trim($icons[$i] ?? 'fa-solid fa-link'),
                    'url' => trim($urls[$i] ?? '#')
                );
            }
        }
        
        // Update sidebar menu
        if (!empty($newSidebarMenu)) {
            $siteData['sidebar_menu'] = $newSidebarMenu;
        } else {
            // Default menu if empty
            $siteData['sidebar_menu'] = array(
                array('title' => 'Trang chủ', 'icon' => 'fa-solid fa-home', 'url' => 'index.php'),
                array('title' => 'Admin Panel', 'icon' => 'fa-solid fa-user-shield', 'url' => 'LuanOriCpanel.php')
            );
        }
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Cập nhật Sidebar Menu thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== 5. ADD CATEGORY ITEM ====================
    if (isset($_POST['add_category_item'])) {
        $category = trim($_POST['category_name'] ?? '');
        
        // Validate category name
        if (empty($category)) {
            $_SESSION['admin_message'] = 'Vui lòng nhập tên danh mục!';
            header('Location: LuanOriCpanel.php');
            exit;
        }
        
        // Create category if not exists
        if (!isset($siteData['categories'][$category])) {
            $siteData['categories'][$category] = array();
        }
        
        // Add new item
        $siteData['categories'][$category][] = array(
            'title' => $_POST['item_title'] ?? '',
            'image' => $_POST['item_image'] ?? '',
            'url' => $_POST['item_url'] ?? '',
            'badge' => $_POST['item_badge'] ?? '',
            'badge_color' => $_POST['item_badge_color'] ?? '#22c55e'
        );
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Thêm mục thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== DELETE FULL CATEGORY ====================
if (isset($_POST['delete_full_category'])) {
    $category = $_POST['delete_full_category'] ?? '';
    if (isset($siteData['categories'][$category])) {
        unset($siteData['categories'][$category]);
        saveSiteData($siteData);
        $_SESSION['admin_message'] = 'Xóa danh mục "' . $category . '" thành công!';
    }
    header('Location: LuanOriCpanel.php');
    exit;
}
    
    // ==================== 7. UPDATE SOCIAL LINKS ====================
    if (isset($_POST['update_social'])) {
        $newSocialLinks = array();
        
        // Get data from form
        $names = $_POST['social_name'] ?? array();
        $urls = $_POST['social_url'] ?? array();
        $icons = $_POST['social_icon'] ?? array();
        
        // Build new social links
        for ($i = 0; $i < count($names); $i++) {
            if (!empty($names[$i])) {
                $newSocialLinks[] = array(
                    'name' => $names[$i],
                    'url' => $urls[$i] ?? '#',
                    'icon' => $icons[$i] ?? 'fab fa-telegram',
                    'color' => '#3b82f6'
                );
            }
        }
        
        // Update social links
        $siteData['social_links'] = $newSocialLinks;
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Cập nhật liên kết thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== 8. UPDATE MUSIC ====================
    if (isset($_POST['update_music'])) {
        // Get playlist from textarea
        $playlistRaw = $_POST['playlist'] ?? '';
        $songNamesRaw = $_POST['song_names'] ?? '';
        
        // Convert to array (split by new line)
        $playlist = explode("\n", str_replace("\r", "", $playlistRaw));
        $songNames = explode("\n", str_replace("\r", "", $songNamesRaw));
        
        // Filter empty values
        $playlist = array_filter($playlist);
        $songNames = array_filter($songNames);
        
        // Update music
        $siteData['music']['playlist'] = array_values($playlist);
        $siteData['music']['song_names'] = array_values($songNames);
        
        // Save to file
        saveSiteData($siteData);
        
        // Set success message
        $_SESSION['admin_message'] = 'Cập nhật danh sách nhạc thành công!';
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
    
    // ==================== 9 ADD NAVBAR CARDS ====================
if (isset($_POST['update_navbar_cards'])) {
    $newNavbarCards = [];
    $index = 0;
    
    // Lấy tất cả dữ liệu từ form
    while (isset($_POST["navbar_title_{$index}"])) {
        $title = $_POST["navbar_title_{$index}"] ?? '';
        $subtitle = $_POST["navbar_subtitle_{$index}"] ?? '';
        $url = $_POST["navbar_url_{$index}"] ?? '#';
        $icon = $_POST["navbar_icon_{$index}"] ?? 'fa-regular fa-thumbs-up';
        
        if (!empty($title)) {
            $newNavbarCards[] = [
                'title' => trim($title),
                'subtitle' => trim($subtitle),
                'url' => trim($url),
                'icon' => trim($icon)
            ];
        }
        $index++;
    }
    
    $siteData['navbar_cards'] = $newNavbarCards;
    saveSiteData($siteData);
    $_SESSION['admin_message'] = 'Cập nhật Navbar Cards thành công!';
    header('Location: LuanOriCpanel.php');
    exit;
}
    
    // ==================== 10. DELETE NAVBAR CARD ====================
    if (isset($_POST['delete_navbar_card'])) {
        $index = (int)($_POST['delete_navbar_index'] ?? -1);
        
        // Check if card exists
        if (isset($siteData['navbar_cards'][$index])) {
            // Remove card
            array_splice($siteData['navbar_cards'], $index, 1);
            
            // Save to file
            saveSiteData($siteData);
            
            // Set success message
            $_SESSION['admin_message'] = 'Xóa Navbar Card thành công!';
        }
        
        // Redirect to refresh page
        header('Location: LuanOriCpanel.php');
        exit;
    }
}

/**
 * Render social icon HTML
 */
function renderSocialIcon($icon) {
    return '<i class="' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . ' text-base"></i>';
}

/**
 * Safe HTML output function
 */
function safeHtml($string, $default = '') {
    if ($string === null || $string === '') {
        return htmlspecialchars($default, ENT_QUOTES, 'UTF-8');
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
