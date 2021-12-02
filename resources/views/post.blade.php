<!DOCTYPE html>
<html>
    <head>
        <title>Blog</title>
        <link href="/app.css" rel="stylesheet" />
    </head>
    <body>
        <article>
            <h1><?= $post->title; ?></h1>

            <div>
                <?php echo $post->body(); ?>
            </div>
        </article>
        <a href="/">Go Back</a>
    </body>
</html>
