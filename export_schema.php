<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['users', 'scores', 'screenshots', 'likes'];
$csvData = [];
$csvData[] = ['Table', 'Column', 'Type', 'Nullable', 'Key', 'Default', 'Extra'];

foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        $columns = DB::select("SHOW FULL COLUMNS FROM `$table`");
        foreach ($columns as $column) {
            $csvData[] = [
                $table,
                $column->Field,
                $column->Type,
                $column->Null,
                $column->Key,
                $column->Default,
                $column->Extra
            ];
        }
        $csvData[] = ['', '', '', '', '', '', '']; // Empty row for separation
    }
}

$fp = fopen('database_structure.csv', 'w');
fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF)); // Byte Order Mark for Excel
foreach ($csvData as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo "Schema exported to database_structure.csv\n";
