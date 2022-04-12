<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
	{
		return view('news.index', [
			'newsList' => News::paginate(10)
		]);
	}

	public function show(News $news)
	{
		return view('news.show', [
			'news' => $news
		]);
	}
}
