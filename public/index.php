<?php
// Force disable all output buffering
if (ob_get_level()) ob_end_clean();

header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html><html><head><title>Debug</title></head><body style="font-family: sans-serif; padding: 2rem;">';
echo '<h1 style="color: green;">✅ SYSTEM CHECK: PHP IS WORKING</h1>';
echo '<p>If you see this, the Web Server (FrankenPHP) and PHP are correctly configured.</p>';

echo '<h2>Environment:</h2>';
echo '<ul>';
echo '<li><strong>PHP Version:</strong> ' . phpversion() . '</li>';
echo '<li><strong>Server Software:</strong> ' . $_SERVER['SERVER_SOFTWARE'] . '</li>';
echo '<li><strong>Document Root:</strong> ' . $_SERVER['DOCUMENT_ROOT'] . '</li>';
echo '<li><strong>Current Script:</strong> ' . __FILE__ . '</li>';
echo '</ul>';

echo '<h2>FileSystem Check:</h2>';
$dirs = [
    '/app',
    '/app/public',
    '/app/var',
    '/app/vendor'
];

foreach ($dirs as $dir) {
    echo "<div>Checking <code>$dir</code>: ";
    if (file_exists($dir)) {
        echo '<span style="color: green">EXISTS</span>';
        if (is_writable($dir)) {
            echo ' - <span style="color: green">WRITABLE</span>';
        } else {
            echo ' - <span style="color: red">NOT WRITABLE</span> (' . substr(sprintf('%o', fileperms($dir)), -4) . ')';
        }
    } else {
        echo '<span style="color: red">MISSING</span>';
    }
    echo "</div>";
}

echo '<h2>Symfony Requirements:</h2>';
$vendorAutoload = dirname(__DIR__).'/vendor/autoload_runtime.php';
echo "<div>Checking Autoloader (<code>$vendorAutoload</code>): ";
if (file_exists($vendorAutoload)) {
    echo '<span style="color: green">FOUND</span>';
} else {
    echo '<span style="color: red">MISSING - Composer install failed?</span>';
}
echo "</div>";

echo '<hr>';
echo '<h3>Attempting to boot Symfony Kernel...</h3>';

try {
    require_once $vendorAutoload;
    echo '<div style="color: green">Autoloader loaded.</div>';
} catch (Throwable $e) {
    echo '<div style="color: red; font-weight: bold;">CRITICAL ERROR loading autoloader: ' . $e->getMessage() . '</div>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
    die('</body></html>');
}

echo '<p>Debug script end. If you see this, remove this debug code from public/index.php to run the app.</p>';
echo '</body></html>';
die();

// Original code below...
use App\Kernel;
// ...
