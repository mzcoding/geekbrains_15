<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_create_news()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.news.create'))
				->select('category_id', mt_rand(1, 10))
				->type('title', 'Some title')
				->type('author', 'Some author')
				->select('status', 'DRAFT')
				->type('text', 'Some text')
				->press('Сохранить')
                ->assertPathIs(route('admin.news.index'));
        });
    }
}
