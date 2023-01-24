<?php
/*
 * This file is part of Health Code API.
 *
 * (c) Lucas Alves <codestep@codingstep.com.br>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Controllers;

use App\Models\CustomerModel;
use const FILTER_SANITIZE_NUMBER_INT;
use Framework\HTTP\Response;
use Framework\MVC\Controller;
use Framework\MVC\ModelInterface;
use JsonException;

/**
 * Controller Customer.
 *
 * @package app
 */
class CustomerController extends Controller
{
    /**
     * @var class-string<ModelInterface>
     */
    protected string $modelClass = CustomerModel::class;

    /**
     * Return all customers.
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function index() : Response
    {
        $errors = $this->validate($this->request->getGet(), [
            'page' => 'optional|number|greater:0',
            'perPage' => 'optional|number|greater:0',
        ]);

        if ( ! empty($errors)) {
            return $this->response->setJson($errors);
        }

        $page = ! empty($this->request->getGet('page', FILTER_SANITIZE_NUMBER_INT))
            ? $this->request->getGet('page', FILTER_SANITIZE_NUMBER_INT)
            : 1;
        $perPage = ! empty($this->request->getGet('perPage', FILTER_SANITIZE_NUMBER_INT))
            ? $this->request->getGet('perPage', FILTER_SANITIZE_NUMBER_INT)
            : 10;

        return $this->response->setJson(
            $this->model->paginate($page, $perPage) // @phpstan-ignore-line
        );
    }

    /**
     * Return customer.
     *
     * @param int $identify
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function show(int $identify) : Response
    {
        $customer = $this->model->getCustomerById($identify); // @phpstan-ignore-line

        if (\is_null($customer)) {
            return $this->response->setJson([
                'errors' => lang('customer.notFound'),
            ]);
        }

        return $this->response->setJson([
            '__id' => $customer->id,
            'name' => $customer->name,
            'birthday' => $customer->birthday,
            'gender' => $customer->gender,
            'healthProblem' => $customer->healthProblem,
        ]);
    }

    /**
     * Return new customer created.
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function create() : Response
    {
        $errors = $this->validate($this->request->getPost(), [
            'name' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|in:m,f',
            'healthProblem' => 'required|array',
        ], [
            'name' => lang('customer.name'),
            'birthday' => lang('customer.birthday'),
            'gender' => lang('customer.gender'),
            'healthProblem' => lang('customer.healthProblem'),
        ]);

        if ( ! empty($errors)) {
            return $this->response->setJson([
                'errors' => $errors,
            ]);
        }

        $created = $this->model->create($this->request->getPost());

        if ($created === false) {
            return $this->response->setJson([
                'errors' => lang('base.unexpected'),
            ]);
        }

        $customer = $this->model->getCustomerById($created); // @phpstan-ignore-line

        return $this->response->setJson([
            '__id' => $customer->id,
            'name' => $customer->name,
            'birthday' => $customer->birthday,
            'gender' => $customer->gender,
            'healthProblem' => $customer->healthProblem,
        ]);
    }

    /**
     * Return updated customer.
     *
     * @param int $identify
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function update(int $identify) : Response
    {
        $customer = $this->model->getCustomerById($identify); // @phpstan-ignore-line

        if (\is_null($customer)) {
            return $this->response->setJson([
                'errors' => lang('customer.customerNotFound'),
            ]);
        }

        $errors = $this->validate($this->request->getPost(), [
            'name' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|in:m,f',
            'healthProblem' => 'required|array',
        ], [
            'name' => lang('customer.name'),
            'birthday' => lang('customer.birthday'),
            'gender' => lang('customer.gender'),
            'healthProblem' => lang('customer.healthProblem'),
        ]);

        if ( ! empty($errors)) {
            return $this->response->setJson([
                'errors' => $errors,
            ]);
        }

        $updated = $this->model->update($identify, $this->request->getPost());

        if ($updated === false) {
            return $this->response->setJson([
                'errors' => lang('base.unexpected'),
            ]);
        }

        $customer = $this->model->getCustomerById($updated); // @phpstan-ignore-line

        return $this->response->setJson([
            '__id' => $customer->id,
            'name' => $customer->name,
            'birthday' => $customer->birthday,
            'gender' => $customer->gender,
            'healthProblem' => $customer->healthProblem,
        ]);
    }

    /**
     * Return replaced customer.
     *
     * @param int $identify
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function replace(int $identify) : Response
    {
        $customer = $this->model->getCustomerById($identify); // @phpstan-ignore-line

        if (\is_null($customer)) {
            return $this->response->setJson([
                'errors' => lang('customer.customerNotFound'),
            ]);
        }

        $errors = $this->validate($this->request->getPost(), [
            'name' => 'required|string',
            'birthday' => 'required|date',
            'gender' => 'required|in:m,f',
            'healthProblem' => 'required|array',
        ], [
            'name' => lang('customer.name'),
            'birthday' => lang('customer.birthday'),
            'gender' => lang('customer.gender'),
            'healthProblem' => lang('customer.healthProblem'),
        ]);

        if ( ! empty($errors)) {
            return $this->response->setJson([
                'errors' => $errors,
            ]);
        }

        $replaced = $this->model->replace($identify, $this->request->getPost()); // @phpstan-ignore-line

        if ($replaced === false) {
            return $this->response->setJson([
                'errors' => lang('base.unexpected'),
            ]);
        }

        $customer = $this->model->getCustomerById($replaced); // @phpstan-ignore-line

        return $this->response->setJson([
            '__id' => $customer->id,
            'name' => $customer->name,
            'birthday' => $customer->birthday,
            'gender' => $customer->gender,
            'healthProblem' => $customer->healthProblem,
        ]);
    }

    /**
     * Delete customer.
     *
     * @param int $identify
     *
     * @throws JsonException
     *
     * @return Response
     */
    public function delete(int $identify) : Response
    {
        $customer = $this->model->getCustomerById($identify); // @phpstan-ignore-line

        if (\is_null($customer)) {
            return $this->response->setJson([
                'errors' => lang('customer.customerNotFound'),
            ]);
        }

        $deleted = $this->model->delete($identify);

        if ($deleted === false) {
            return $this->response->setJson([
                'errors' => lang('base.unexpected'),
            ]);
        }

        return $this->response->setJson([
            'message' => 'deleted',
        ]);
    }
}
