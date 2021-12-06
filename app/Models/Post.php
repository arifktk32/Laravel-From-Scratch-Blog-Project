<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {
    public $title;
    public $slug;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title, $slug, $excerpt, $date, $body)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function find($slug) {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug) {
        $post = static::find($slug);
        
        if(! $post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
    
    public static function all() {
        /**
         * Laravel Collection approach
         *
         */
        return cache()->rememberForever('posts.all', function() {
            return collect(File::files(resource_path("posts")))
                ->map( fn($file) => YamlFrontMatter::parseFile($file))
                ->map( fn($document) => new Post(
                        $document->title,
                        $document->slug,
                        $document->excerpt,
                        $document->date,
                        $document->body()
                    )
                )->sortByDesc('date');
        });

        //$posts = [];
        
        /**
         * array_map() approach
         *
         */
        // $posts = array_map(function($file) {
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post($document->title, $document->slug, $document->excerpt, $document->date, $document->body());
        // }, $files);
        
        /**
         * Foreach approach
         *
         */
        // foreach($files as $file) {
        //     $document = YamlFrontMatter::parseFile($file);
        //     $posts[] = new Post($document->title, $document->slug, $document->excerpt, $document->date, $document->body());
        // }
    }
}