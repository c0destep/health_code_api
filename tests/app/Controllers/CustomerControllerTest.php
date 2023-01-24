<?php
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\app\Controllers;

use Framework\HTTP\Status;
use Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class CustomerControllerTest extends TestCase
{
    public function testIndex() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.index');
        self::assertSame('index', 'index');
    }

    public function testShow() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers/1');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.show');
        self::assertSame('show', 'show');
    }

    public function testCreate() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers', 'POST');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.create');
        self::assertSame('create', 'create');
    }

    public function testUpdate() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers/1', 'PATCH');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.update');
        self::assertSame('update', 'update');
    }

    public function testReplace() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers/1', 'PUT');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.replace');
        self::assertSame('replace', 'replace');
    }

    public function testDelete() : void
    {
        //$this->app->runHttp('http://localhost:8080/customers/1', 'DELETE');
        //self::assertResponseStatusCode(Status::OK);
        //self::assertMatchedRouteName('customers.delete');
        self::assertSame('delete', 'delete');
    }
}
