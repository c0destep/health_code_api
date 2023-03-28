<?php
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use App\Controllers\CustomerController;
use Framework\Routing\RouteCollection;

App::router()->serve('http://localhost:8080', static function (RouteCollection $routes) : void {
    $routes->resource('/customers', CustomerController::class, 'customers');
    $routes->notFound(static fn () => not_found());
});
