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

use App;
use Framework\Database\Definition\Table\TableDefinition;
use Framework\HTTP\Status;
use Tests\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class CustomerControllerTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->prepareDatabase();
    }

    protected function prepareDatabase() : void
    {
        $database = App::database('default');
        $table = 'customers';
        $database->dropTable($table)->ifExists()->run();
        $database->createTable($table)
            ->definition(static function (TableDefinition $def) : void {
                $def->column('id')->int(11)->primaryKey()->autoIncrement();
                $def->column('name')->varchar(32);
                $def->column('birthday')->date();
                $def->column('gender')->enum('male', 'female');
                $def->column('healthProblem')->text();
            })->run();
        $database->insert($table)
            ->columns('name', 'birthday', 'gender', 'healthProblem')
            ->values([
                ['John Doe', '2000-10-31', 'male', 'gripe'],
                ['Mary Doe', '2002-05-20', 'female', 'covid'],
            ])->run();
    }

    public function testIndex() : void
    {
        $this->app->runHttp('http://localhost:8080/customers');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.index');
    }

    public function testShow() : void
    {
        $this->app->runHttp('http://localhost:8080/customers/1');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.show');
    }

    public function testCreate() : void
    {
        $this->app->runHttp('http://localhost:8080/customers', 'POST');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.create');
    }

    public function testUpdate() : void
    {
        $this->app->runHttp('http://localhost:8080/customers/1', 'PATCH');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.update');
    }

    public function testReplace() : void
    {
        $this->app->runHttp('http://localhost:8080/customers/1', 'PUT');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.replace');
    }

    public function testDelete() : void
    {
        $this->app->runHttp('http://localhost:8080/customers/1', 'DELETE');
        self::assertResponseStatusCode(Status::OK);
        self::assertMatchedRouteName('customers.delete');
    }
}
