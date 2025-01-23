<?php
// app/Services/ThemeService.php
namespace App\Services;

use App\Interfaces\ThemeServiceInterface;

class ThemeService implements ThemeServiceInterface
{
    public function setTheme($theme)
    {
        // Simpan tema di session atau cookie
        session(['theme' => $theme]);
    }

    public function getTheme()
    {
        // Ambil tema dari session atau cookie
        return session('theme', 'light'); // Default: light mode
    }
}