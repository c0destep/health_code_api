<?php
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Models;

use Framework\MVC\Model;
use Framework\Pagination\Pager;

class CustomerModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'customers';
    /**
     * @var bool
     */
    protected bool $autoTimestamps = true;
    /**
     * @var array<int, string>
     */
    protected array $allowedFields = [
        'name', 'birthday', 'gender',
        'healthProblem',
    ];
    /**
     * @var array<string, array<string>>
     */
    protected array $validationRules = [];
    /**
     * @var bool
     */
    protected bool $cacheActive = true;

    public function paginate(int $page, int $perPage = 10) : array
    {
        $data = $this->getDatabaseToRead()
            ->select()
            ->from($this->getTable())
            ->limit(...$this->makePageLimitAndOffset($page, $perPage))
            ->run()
            ->fetchArrayAll();
        foreach ($data as &$row) {
            $row = $this->makeEntity($row);
        }
        unset($row);
        $this->setPager(new Pager($page, $perPage, $this->count()));
        return $data;
    }

    /**
     * @return array<object>
     */
    public function getCustomers() : array
    {
        $query = $this->getDatabaseToRead()->select()
            ->from($this->getTable());
        return $query->run()->fetchAll();
    }

    /**
     * @param int|string $identify
     *
     * @return object|null
     */
    public function getCustomerById(int|string $identify) : ?object
    {
        $query = $this->getDatabaseToRead()->select()
            ->from($this->getTable())
            ->whereEqual('id', $identify);
        return $query->run()->fetch();
    }

    /**
     * @param string $name
     *
     * @return object|null
     */
    public function getCustomerByName(string $name) : ?object
    {
        $query = $this->getDatabaseToRead()->select()
            ->from($this->getTable())
            ->whereEqual('name', $name);
        return $query->run()->fetch();
    }
}
