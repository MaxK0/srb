<?php

use GuzzleHttp\RequestOptions;
use Spatie\Sitemap\Crawler\Profile;

return [
    'guzzle_options' => [
        RequestOptions::COOKIES => true,
        RequestOptions::CONNECT_TIMEOUT => 10,
        RequestOptions::TIMEOUT => 10,
        RequestOptions::ALLOW_REDIRECTS => false,
    ],
    'execute_javascript' => false,
    'chrome_binary_path' => null,
    'crawl_profile' => Profile::class,
    'sites' => [
        'main' => [
            'url' => config('app.url'),
            'paths' => [
                '/',
                '/dashboard',
                // Employees
                '/employees',
                '/employees/create',
                '/employees/{employee}',
                '/employees/{employee}/edit',
                // Businesses
                '/businesses',
                '/businesses/create',
                '/businesses/{business}',
                '/businesses/{business}/edit',
                // Branches
                '/branches/create',
                '/branches/{branch}',
                '/branches/{branch}/edit',
                // Positions
                '/positions',
                '/positions/create',
                '/positions/{position}',
                '/positions/{position}/edit',
            ],
        ],
    ],
];

