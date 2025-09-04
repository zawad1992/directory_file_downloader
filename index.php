<?php
// Function to format file size
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}

// Get all files in current directory
$files = array_diff(scandir('.'), array('..', '.'));
$fileList = array();

// Get current script name to exclude it
$currentScript = basename($_SERVER['PHP_SELF']);

foreach ($files as $file) {
    if (is_file($file)) {
        // Skip PHP files and the current script
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $skippedExtensions = ['php', 'html', 'css', 'js', 'bat', 'sh', 'cmd', 'ini', 'json', 'xml', 'yml', 'yaml', 'md'];
        if (in_array($extension, $skippedExtensions) || $file === $currentScript) {
            continue;
        }
        
        $fileInfo = array(
            'name' => $file,
            'size' => filesize($file),
            'modified' => filemtime($file),
            'extension' => $extension
        );
        $fileList[] = $fileInfo;
    }
}

// Sort files by name
usort($fileList, function($a, $b) {
    return strcasecmp($a['name'], $b['name']);
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Directory - Download Center</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .file-icon {
            width: 24px;
            text-align: center;
        }
        .file-row:hover {
            background-color: #e9ecef;
        }
        .header-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row">
            <div class="col-12 header-bg text-white py-4 mb-4">
                <div class="container">
                    <h1 class="mb-0"><i class="fas fa-folder-open me-2"></i>File Directory</h1>
                    <p class="mb-0 opacity-75">Browse and download files from this directory</p>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- File Statistics -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?php echo count($fileList); ?></h5>
                            <p class="card-text">Total Files</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <?php 
                                $totalSize = array_sum(array_column($fileList, 'size'));
                                echo formatBytes($totalSize);
                                ?>
                            </h5>
                            <p class="card-text">Total Size</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-info">
                                <?php echo count(array_unique(array_column($fileList, 'extension'))); ?>
                            </h5>
                            <p class="card-text">File Types</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-warning">
                                <i class="fas fa-clock"></i>
                            </h5>
                            <p class="card-text">Last Updated</p>
                            <small class="text-muted">
                                <?php 
                                if (!empty($fileList)) {
                                    $lastModified = max(array_column($fileList, 'modified'));
                                    echo date('M j, Y', $lastModified);
                                }
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Files List -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Available Files</h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($fileList)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No files found</h5>
                            <p class="text-muted">This directory appears to be empty.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-file me-2"></i>File Name</th>
                                        <th><i class="fas fa-hdd me-2"></i>Size</th>
                                        <th><i class="fas fa-calendar me-2"></i>Modified</th>
                                        <th><i class="fas fa-download me-2"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fileList as $file): ?>
                                        <tr class="file-row">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="file-icon me-2">
                                                        <?php
                                                        $ext = $file['extension'];
                                                        $iconClass = 'fas fa-file';
                                                        
                                                        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])) {
                                                            $iconClass = 'fas fa-file-image text-success';
                                                        } elseif (in_array($ext, ['mp4', 'avi', 'mov', 'mkv', 'wmv'])) {
                                                            $iconClass = 'fas fa-file-video text-danger';
                                                        } elseif (in_array($ext, ['mp3', 'wav', 'flac', 'aac'])) {
                                                            $iconClass = 'fas fa-file-audio text-warning';
                                                        } elseif (in_array($ext, ['pdf'])) {
                                                            $iconClass = 'fas fa-file-pdf text-danger';
                                                        } elseif (in_array($ext, ['doc', 'docx'])) {
                                                            $iconClass = 'fas fa-file-word text-primary';
                                                        } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                            $iconClass = 'fas fa-file-excel text-success';
                                                        } elseif (in_array($ext, ['zip', 'rar', '7z'])) {
                                                            $iconClass = 'fas fa-file-archive text-warning';
                                                        } elseif (in_array($ext, ['txt', 'log'])) {
                                                            $iconClass = 'fas fa-file-alt text-secondary';
                                                        } elseif (in_array($ext, ['php', 'html', 'css', 'js'])) {
                                                            $iconClass = 'fas fa-file-code text-info';
                                                        }
                                                        ?>
                                                        <i class="<?php echo $iconClass; ?>"></i>
                                                    </span>
                                                    <span><?php echo htmlspecialchars($file['name']); ?></span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    <?php echo formatBytes($file['size']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <?php echo date('M j, Y g:i A', $file['modified']); ?>
                                                </small>
                                            </td>
                                            <td>
                                                <a href="<?php echo htmlspecialchars($file['name']); ?>" 
                                                   class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fas fa-download me-1"></i>Download
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-4 mb-3">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Generated on <?php echo date('F j, Y g:i A'); ?>
                </small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>