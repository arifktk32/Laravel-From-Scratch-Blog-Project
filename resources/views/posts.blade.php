<!DOCTYPE html>
<html>
    <head>
        <title>Blog</title>
        <link href="/app.css" rel="stylesheet" />
    </head>
    <body>
        <?php foreach($posts as $post): ?>
        <article>
            <?= $post ?>
        </article>
        <?php endforeach; ?>
    </body>
</html>
