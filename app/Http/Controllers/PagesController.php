<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Page;

class PagesController extends Controller
{
	public function show($slug)
	{
		$page = Page::where('slug', $slug)->first();
		return view('pages.show', ['title' => $page->title, 'page' => $page]);
	}
}
