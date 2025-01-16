<?php

namespace App\Http\Controllers;

use App\Services\MenuServiceInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menuItems = $this->menuService->getMenuItems();
        return view('menu.menu', compact('menuItems'));
    }
}