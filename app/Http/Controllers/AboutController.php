<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LoadsPageContent;
use Illuminate\View\View;

class AboutController extends Controller
{
    use LoadsPageContent;

    public function index(): View
    {
        return $this->pageView('about', 'about.index');
    }
}
