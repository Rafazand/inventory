<?php

// app/Http/Controllers/ThemeController.php
namespace App\Http\Controllers;

use App\Interfaces\ThemeServiceInterface;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    protected $themeService;

    public function __construct(ThemeServiceInterface $themeService)
    {
        $this->themeService = $themeService;
    }

    public function setTheme(Request $request)
    {
        $theme = $request->input('theme', 'light'); // Default: light mode
        $this->themeService->setTheme($theme);

        return redirect()->back();
    }
}