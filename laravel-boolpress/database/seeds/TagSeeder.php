<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Front End Dev', 'Backend', 'MVC', 'Models', 'Seeders'];

        for ($i = 0; $i < count($tags); $i++) {
            $new_tag = new tag();
            $new_tag->name = $tags[$i];
            $new_tag->slug = Str::slug($tags[$i], '-');
            $new_tag->save();
        }
    }
}
