<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use View;

use App\Models\Info;
use App\Models\Page;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $info;
    protected $pages;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->info = Info::first();
            $this->pages = Page::where('status', 1)->get();
            View::share(['info' => $this->info, 'pages' => $this->pages]);
            return $next($request);
        });
    }
}
