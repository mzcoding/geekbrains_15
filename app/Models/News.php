<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

	protected $table = "news";

	public function getNews(): array
	{
		return \DB::table($this->table)
			->join('categories', 'news.category_id',
			'=', 'categories.id')
			->select('news.*', 'categories.title as categoryTitle')
			->where([
				['news.status', '=', 'ACTIVE'],
				['news.id', '>', 4]
			])
			->orWhere('news.title', 'like', '%'. request()->get('q').'%')
			->orderBy('news.id', 'desc')
			->get()
			->toArray();
	}
}
