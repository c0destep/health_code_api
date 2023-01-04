<?php declare(strict_types=1);
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests;

abstract class TestCase extends \Framework\Testing\TestCase
{
    protected array | string | null $configs = CONFIG_DIR;
}
