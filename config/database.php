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
 * Database config.
 *
 * @see App::database()
 * @see Framework\Database\Database::makeConfig()
 * @see https://docs.aplus-framework.com/guides/libraries/mvc/index.html#database-service
 */
return [
    'default' => [
        'config' => [
            'username' => 'root',
            'password' => 'password',
            'schema' => 'health_code_api',
            'host' => 'mariadb',
        ],
        'logger_instance' => 'default',
    ],
];
