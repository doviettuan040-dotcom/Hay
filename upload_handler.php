<?php
// upload_handler.php
header('Content-Type: application/json');

// Cấu hình upload
$uploadDir = __DIR__ . '/uploads/background/';

// Tạo thư mục nếu chưa có
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$response = ['success' => false, 'path' => '', 'error' => ''];

// Kiểm tra có file upload không
if (empty($_FILES)) {
    $response['error'] = 'Không có file nào được upload';
    echo json_encode($response);
    exit;
}

// Xử lý upload desktop background
if (isset($_FILES['bg_desktop']) && $_FILES['bg_desktop']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['bg_desktop'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($ext, $allowed)) {
        $response['error'] = 'Định dạng không hỗ trợ. Cho phép: jpg, png, gif, webp';
        echo json_encode($response);
        exit;
    }
    
    $filename = 'desktop_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $targetPath = $uploadDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $response['success'] = true;
        $response['path'] = '/uploads/background/' . $filename;
        $response['type'] = 'desktop';
    } else {
        $response['error'] = 'Không thể lưu file, kiểm tra quyền thư mục';
    }
}
// Xử lý upload mobile background
elseif (isset($_FILES['bg_mobile']) && $_FILES['bg_mobile']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['bg_mobile'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($ext, $allowed)) {
        $response['error'] = 'Định dạng không hỗ trợ. Cho phép: jpg, png, gif, webp';
        echo json_encode($response);
        exit;
    }
    
    $filename = 'mobile_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $targetPath = $uploadDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $response['success'] = true;
        $response['path'] = '/uploads/background/' . $filename;
        $response['type'] = 'mobile';
    } else {
        $response['error'] = 'Không thể lưu file, kiểm tra quyền thư mục';
    }
}
// Xử lý upload video
elseif (isset($_FILES['bg_video']) && $_FILES['bg_video']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['bg_video'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if ($ext !== 'mp4') {
        $response['error'] = 'Chỉ hỗ trợ file MP4';
        echo json_encode($response);
        exit;
    }
    
    $filename = 'video_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $targetPath = $uploadDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $response['success'] = true;
        $response['path'] = '/uploads/background/' . $filename;
        $response['type'] = 'video';
    } else {
        $response['error'] = 'Không thể lưu video, kiểm tra quyền thư mục';
    }
}
else {
    // Lỗi từ PHP
    $errorMessages = [
        UPLOAD_ERR_INI_SIZE => 'File quá lớn (vượt quá upload_max_filesize)',
        UPLOAD_ERR_FORM_SIZE => 'File quá lớn (vượt quá MAX_FILE_SIZE)',
        UPLOAD_ERR_PARTIAL => 'File chỉ được upload một phần',
        UPLOAD_ERR_NO_FILE => 'Không có file nào được chọn',
        UPLOAD_ERR_NO_TMP_DIR => 'Thiếu thư mục tạm',
        UPLOAD_ERR_CANT_WRITE => 'Không thể ghi file',
        UPLOAD_ERR_EXTENSION => 'Upload bị chặn bởi extension'
    ];
    
    $errorCode = $_FILES['bg_desktop']['error'] ?? $_FILES['bg_mobile']['error'] ?? $_FILES['bg_video']['error'] ?? 0;
    $response['error'] = $errorMessages[$errorCode] ?? 'Lỗi không xác định';
}

echo json_encode($response);
?>
