<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Post</title>
</head>
<body>
<div class="container">
    <h2>Edit Post</h2>
    <form action="<?= base_url('posts/update/' . $post->id) ?>" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" value="<?= $post->title ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" value="<?= $post->description ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" name="content" required><?= $post->content ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
    <br>
    <a href="<?= base_url('posts')?>"><h5>Back</h5></a>
</div>
</body>
</html>
