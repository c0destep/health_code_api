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

use Framework\MVC\Controller;
use Framework\Routing\Attributes\Route;

/**
 * Class Home.
 *
 * @package app
 */
final class Home extends Controller
{
    /**
     * Renders the application homepage.
     */
    #[Route('GET', '/', name: 'home')]
    public function index() : string
    {
        return view('home/index');
    }
}
