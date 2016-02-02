<?php
namespace AFG\Composers;

use AFG\Category;
use Illuminate\Contracts\View\View;


class CategoryComposer {

    protected $category;

    public function __construct (Category $category)
    {

        $this->category = $category;

    }

    public function compose($view)
    {
        $view->with('categories', $this->category->listCategories());
    }

}