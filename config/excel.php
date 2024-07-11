<?php

use Maatwebsite\Excel\Excel;

return [
    'exports' => [
        'chunk_size'             => 1000,
        'pre_calculate_formulas' => false,
        'csv'                    => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => PHP_EOL,
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
            'output_encoding'        => '',
            'test_auto_detect'       => true,
        ],
        'properties'             => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],
    ],
    'imports'            => [
        'read_only' => true,
        'heading'   => [
            'row'           => 1,
            'formatter'     => 'slug',
        ],
        'csv'       => [
            'delimiter'        => ',',
            'enclosure'        => '"',
            'escape_character' => '\\',
            'contiguous'       => false,
            'input_encoding'   => 'UTF-8',
        ],
        'properties'             => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],
    ],
    'extension_detector' => [
        'xlsx'     => Excel::XLSX,
        'csv'      => Excel::CSV,
        'tsv'      => Excel::TSV,
        'ods'      => Excel::ODS,
        'xls'      => Excel::XLS,
        'slk'      => Excel::SLK,
        'xml'      => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm'      => Excel::HTML,
        'html'     => Excel::HTML,
        'pdf'      => Excel::DOMPDF,
    ],
    'value_binder'       => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],
    'cache'              => [
        'driver'     => 'memory',
        'batch'      => [
            'size'     => 1000,
        ],
        'cache'      => [
            'store'    => null,
        ],
        'local'      => [
            'path'     => storage_path('framework/cache/laravel-excel'),
        ],
    ],
    'transactions'       => [
        'handler' => Maatwebsite\Excel\Transactions\TransactionHandler::class,
    ],
    'temporary_files'    => [
        'local_path'  => storage_path('framework/cache/laravel-excel'),
        'remote_disk' => null,
        'remote_prefix' => null,
        'force_resync_remote' => null,
    ],
];
