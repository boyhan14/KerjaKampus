<?php
/**
 * KerjaKampus - Production Deployment & Cache Clearing Utility
 * Akses: http://kerjakampus.my.id/clear_cache.php atau http://kerjakampus.my.id/public/clear_cache.php
 */

header('Content-Type: text/html; charset=utf-8');
echo "<!DOCTYPE html><html><head><title>KerjaKampus - Deployment & Cache Manager</title>";
echo "<style>body{font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;background:#0f172a;color:#f8fafc;padding:30px;line-height:1.6;} .card{background:#1e293b;border:1px solid #334155;border-radius:16px;padding:24px;max-width:780px;margin:0 auto 20px;} h1{color:#818cf8;margin-top:0;} .success{color:#34d399;font-weight:bold;} .warn{color:#fbbf24;font-weight:bold;} .info{color:#38bdf8;} .btn{display:inline-block;background:#4f46e5;color:white;text-decoration:none;padding:12px 24px;border-radius:12px;font-weight:bold;margin-top:10px;font-size:13px;}</style></head><body>";
echo "<div class='card'><h1>⚡ KerjaKampus Deploy & Cache Manager</h1>";

$baseDir = __DIR__;
// Jika dipanggil dari dalam public/, baseDir adalah parent
if (basename($baseDir) === 'public') {
    $baseDir = dirname($baseDir);
}
$results = [];

// 1. CEK DAN EKSTRAK SEMUA PATCH ZIP JIKA ADA (update_terbaru.zip, patch_all.zip, patch_premium.zip, patch_update.zip)
$zipFiles = ['update_terbaru.zip', 'patch_all.zip', 'patch_premium.zip', 'patch_update.zip'];
$extractedCount = 0;

foreach ($zipFiles as $zipName) {
    $zipPath = $baseDir . '/' . $zipName;
    if (file_exists($zipPath) && class_exists('ZipArchive')) {
        $zip = new ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            $numFiles = $zip->numFiles;
            $zip->extractTo($baseDir);
            $zip->close();
            $results[] = "<span class='success'>✅ Berhasil ekstrak {$zipName} ({$numFiles} file diekstrak & di-overwrite ke server).</span>";
            $extractedCount++;
        }
    }
}

if ($extractedCount === 0) {
    $results[] = "<span class='info'>ℹ️ Tidak menemukan file zip baru di root (atau file sudah diekstrak manual via Upload & Unzip).</span>";
}

// 2. CEK JIKA FILE TEREKSTRAK KE SUBFOLDER (misal /htdocs/update_terbaru/...)
$subfolders = ['update_terbaru', 'patch_all', 'patch_premium', 'patch_update'];
foreach ($subfolders as $folder) {
    $folderPath = $baseDir . '/' . $folder;
    if (is_dir($folderPath)) {
        $copied = 0;
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($folderPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            $subPath = substr($item->getPathname(), strlen($folderPath) + 1);
            $target = $baseDir . '/' . $subPath;
            if ($item->isDir()) {
                if (!is_dir($target)) { @mkdir($target, 0777, true); }
            } else {
                @copy($item->getPathname(), $target);
                $copied++;
            }
        }
        $results[] = "<span class='success'>✅ Terdeteksi subfolder '{$folder}', berhasil memindahkan {$copied} file ke folder utama!</span>";
    }
}

// 3. BERSIHKAN COMPILED BLADE VIEWS (storage/framework/views/*.php)
$viewsDir = $baseDir . '/storage/framework/views';
$deletedViews = 0;
if (is_dir($viewsDir)) {
    $files = glob($viewsDir . '/*.php');
    foreach ($files as $file) {
        if (is_file($file)) {
            @unlink($file);
            $deletedViews++;
        }
    }
    $results[] = "<span class='success'>✅ Berhasil menghapus {$deletedViews} file cache Blade views (storage/framework/views).</span>";
} else {
    $results[] = "<span class='warn'>⚠️ Folder storage/framework/views tidak ditemukan.</span>";
}

// 4. BERSIHKAN BOOTSTRAP CACHE
$bootstrapCacheDir = $baseDir . '/bootstrap/cache';
$deletedBootCache = 0;
if (is_dir($bootstrapCacheDir)) {
    $bootFiles = ['config.php', 'routes-v7.php', 'events.php', 'services.php', 'packages.php'];
    foreach ($bootFiles as $bf) {
        $full = $bootstrapCacheDir . '/' . $bf;
        if (is_file($full)) {
            @unlink($full);
            $deletedBootCache++;
        }
    }
    $results[] = "<span class='success'>✅ Berhasil membersihkan bootstrap cache ({$deletedBootCache} file).</span>";
}

// 5. BERSIHKAN OPCACHE JIKA ADA
if (function_exists('opcache_reset')) {
    @opcache_reset();
    $results[] = "<span class='success'>✅ PHP OPcache berhasil di-reset.</span>";
}

// 6. VALIDASI FILE ADMIN REPORTS TERBARU
$reportsViewFile = $baseDir . '/resources/views/admin/reports.blade.php';
if (file_exists($reportsViewFile)) {
    $content = file_get_contents($reportsViewFile);
    if (strpos($content, 'Terapkan Filter') !== false && strpos($content, 'target_type') !== false) {
        $results[] = "<span class='success'>🎉 STATUS: File admin/reports.blade.php SUDAH VERSI TERBARU (Sistem Filter Aktif)!</span>";
    } else {
        $results[] = "<span class='warn'>⚠️ PERINGATAN: File resources/views/admin/reports.blade.php di server MASIH VERSI LAMA. Silakan upload & unzip update_terbaru.zip!</span>";
    }
}

// 7. VALIDASI AUTHOR FARKHAN NABIEK MAKARIM
$appFile = $baseDir . '/resources/views/layouts/app.blade.php';
if (file_exists($appFile)) {
    $appContent = file_get_contents($appFile);
    if (strpos($appContent, 'Farkhan Nabiel Makarim') !== false) {
        $results[] = "<span class='success'>🎉 STATUS: Layout app.blade.php SUDAH MEMILIKI AUTHOR Farkhan Nabiel Makarim!</span>";
    } else {
        $results[] = "<span class='warn'>⚠️ Layout app.blade.php belum memiliki author Farkhan Nabiel Makarim.</span>";
    }
}

// 8. VALIDASI PROYEK CONTROLLER & VIEW
$projectCtrl = $baseDir . '/app/Http/Controllers/ProjectController.php';
if (file_exists($projectCtrl)) {
    $ctrlContent = file_get_contents($projectCtrl);
    if (strpos($ctrlContent, 'isAdmin') !== false) {
        $results[] = "<span class='success'>🎉 STATUS: ProjectController SUDAH MENDUKUNG AKSES ADMIN & FILTER STATUS!</span>";
    }
}

// Tampilkan Semua Hasil
echo "<ul>";
foreach ($results as $res) {
    echo "<li style='margin-bottom:8px;'>{$res}</li>";
}
echo "</ul>";

echo "<hr style='border:0;border-top:1px solid #334155;margin:20px 0;'>";
echo "<p style='font-size:14px;color:#94a3b8;'>Silakan buka kembali halaman-halaman yang diperbarui (tekan <strong>Ctrl + F5</strong> di browser untuk hard-refresh):</p>";
echo "<div style='display:flex;gap:10px;flex-wrap:wrap;'>";
echo "<a href='/admin/reports' class='btn' style='background:#e11d48;' target='_blank'>Laporan Admin (/admin/reports) &rarr;</a>";
echo "<a href='/notifications' class='btn' style='background:#4f46e5;' target='_blank'>Pusat Notifikasi (/notifications) &rarr;</a>";
echo "<a href='/projects' class='btn' style='background:#0891b2;' target='_blank'>Daftar Proyek (/projects) &rarr;</a>";
echo "<a href='/profile' class='btn' style='background:#7c3aed;' target='_blank'>Profil Saya (/profile) &rarr;</a>";
echo "<a href='/' class='btn' style='background:#059669;' target='_blank'>Beranda (/) &rarr;</a>";
echo "</div>";

echo "</div></body></html>";
