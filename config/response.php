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
 * Response config.
 *
 * @see App::response()
 * @see https://docs.aplus-framework.com/guides/libraries/mvc/index.html#response-service
 */
return [
    'default' => [
        'headers' => [],
        'auto_etag' => false,
        'auto_language' => false,
        'cache' => null,
        'language_instance' => 'default',
        'request_instance' => 'default',
    ],
];
