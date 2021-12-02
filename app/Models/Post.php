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
        $path = resource_path("posts/{$slug}.html");
    
        if(! file_exists($path)) {
            throw new ModelNotFoundException();
        }

        return (YamlFrontMatter::parseFile($path));
    }
    
    public static function all() {
        $files = File::files(resource_path("/posts"));

        /**
         * Laravel Collection approach
         *
         */
        $posts = collect($files)
        ->map(function($file) {
            return YamlFrontMatter::parseFile($file);
        })->map(function($document) {
            return new Post(
                $document->title,
                $document->slug,
                $document->excerpt,
                $document->date,
                $document->body()
            );
        });

        return $posts;

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