<?php

return [

    // 移行処理の標準出力への出力
    'MIGRATION_JOB_MONITOR' => env('MIGRATION_JOB_MONITOR', true),

    // 移行処理のログへの出力
    'MIGRATION_JOB_LOG' => env('MIGRATION_JOB_LOG', true),

    // NC2 のアップロードファイルのパス
    'NC2_EXPORT_UPLOADS_PATH' => env('NC2_EXPORT_UPLOADS_PATH'),
];
