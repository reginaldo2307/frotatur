<?php
$dir = __DIR__ . '/resources/views/superadmin';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        
        $content = preg_replace('/@extends\(\'layouts\.admin\'\)\s*@section\(\'content\'\)/m', '<x-app-layout>', $content);
        $content = preg_replace('/@endsection/m', '</x-app-layout>', $content);
        
        file_put_contents($file->getPathname(), $content);
        echo "Updated: " . $file->getPathname() . "\n";
    }
}
