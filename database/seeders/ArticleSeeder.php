<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $articles = Article::factory(10)->create();
        $numberCategories = $categories->count();
        foreach ($articles as $article) {
            $numberRandom = rand(1, $numberCategories);
            $tempCategories = $categories->random($numberRandom);
            $article->categories()->sync($tempCategories->pluck('id')->toArray());
        }
    }
}
