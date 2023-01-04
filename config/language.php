<?php
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Language config.
 *
 * @see App::language()
 * @see https://docs.aplus-framework.com/guides/libraries/mvc/index.html#language-service
 */

use Framework\Language\FallbackLevel;

return [
    'default' => [
        'default' => 'en',
        'supported' => [
            'en',
            'es',
            'pt-br',
        ],
        'fallback_level' => FallbackLevel::none,
        'directories' => [
            APP_DIR . 'Languages',
        ],
        'find_in_namespaces' => false,
        'negotiate' => false,
    ],
];
