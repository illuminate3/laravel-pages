<?php

use Illuminate\Database\Migrations\Migration;
use JeroenNoten\LaravelPages\Models\Page;
use JeroenNoten\LaravelPages\Models\View;

class CopyPagesToViews extends Migration {

    public function up()
    {
        /** @var Page $page */
        foreach(Page::all() as $page) {
            $page->view()->associate(View::create([
                'layout' => $page->layout
            ]));
            $page->save();
        }
    }
    
    public function down()
    {
        /** @var Page $page */
        foreach(Page::all() as $page) {
            $page->view->delete();
            $page->view()->dissociate();
            $page->save();
        }
    }

}