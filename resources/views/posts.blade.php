<!DOCTYPE html>
<html>
    <head>
        <title>Blog</title>
        <link href="/app.css" rel="stylesheet" />
    </head>
    <body>
        @foreach($posts as $post)
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>    
            </h1>
            <p>{{ $post->excerpt }}</p>
        </article>
        @endforeach
    </body>
</html>
