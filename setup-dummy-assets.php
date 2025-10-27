<?php

/**
 * Script untuk membuat dummy assets untuk development
 * Jalankan: php setup-dummy-assets.php
 */

// Buat direktori yang dibutuhkan
$directories = [
    'storage/app/public/news',
    'storage/app/public/gallery',
    'storage/app/public/sliders',
    'storage/app/public/dips',
    'storage/app/public/regulations',
    'storage/app/public/departments',
    'storage/app/public/agendas',
];

foreach ($directories as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "✅ Created directory: $dir\n";
    }
}

// Buat file dummy .gitkeep untuk menjaga struktur folder
foreach ($directories as $dir) {
    $gitkeep = $dir.'/.gitkeep';
    if (! file_exists($gitkeep)) {
        file_put_contents($gitkeep, '');
        echo "✅ Created .gitkeep in: $dir\n";
    }
}

echo "\n🎉 Setup dummy assets completed!\n";
echo "📝 Note: Upload real images through admin panel or copy from backup\n";
