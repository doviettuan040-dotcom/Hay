<?php
// =============================================
// Database Configuration
// =============================================

// For JSON file storage (current setup)
define('STORAGE_TYPE', 'json'); // 'json' or 'mysql'

// JSON storage path
define('DATA_DIR', __DIR__ . '/../data/');
define('SITE_DATA_FILE', DATA_DIR . 'site_data.json');

// MySQL configuration (if you want to switch to database later)
define('DB_HOST', 'localhost');
define('DB_NAME', 'luanori_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * PDO connection for MySQL (optional future use)
 */
function getPDOConnection() {
    if (STORAGE_TYPE !== 'mysql') {
        return null;
    }
    
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

/**
 * Create MySQL tables (if needed)
 */
function createMySQLTables() {
    $pdo = getPDOConnection();
    if (!$pdo) return false;
    
    $sql = "
    CREATE TABLE IF NOT EXISTS `site_settings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `setting_key` VARCHAR(100) NOT NULL UNIQUE,
        `setting_value` TEXT,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS `profile` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255),
        `title` VARCHAR(255),
        `subtitle` TEXT,
        `avatar` VARCHAR(500),
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    CREATE TABLE IF NOT EXISTS `social_links` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100),
        `url` VARCHAR(500),
        `icon` VARCHAR(100),
        `color` VARCHAR(50),
        `sort_order` INT DEFAULT 0
    );
    
    CREATE TABLE IF NOT EXISTS `categories` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `sort_order` INT DEFAULT 0
    );
    
    CREATE TABLE IF NOT EXISTS `category_items` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `category_id` INT NOT NULL,
        `title` VARCHAR(255),
        `image` VARCHAR(500),
        `url` VARCHAR(500),
        `badge` VARCHAR(50),
        `badge_color` VARCHAR(20),
        `sort_order` INT DEFAULT 0,
        FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
    );
    
    CREATE TABLE IF NOT EXISTS `music` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `playlist_url` VARCHAR(500),
        `song_name` VARCHAR(255),
        `sort_order` INT DEFAULT 0
    );
    ";
    
    try {
        $pdo->exec($sql);
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

// Ensure data directory exists
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// Create .htaccess to protect data directory
$htaccessContent = "Order Deny,Allow\nDeny from all";
if (!file_exists(DATA_DIR . '.htaccess')) {
    file_put_contents(DATA_DIR . '.htaccess', $htaccessContent);
}
?>
