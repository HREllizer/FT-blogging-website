<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Blog Posts</title>
</head>
<body>
<div class="container">
    <h2>Blog Posts</h2>
    <p>(Limiting 2 per page)</p>
    <a href="<?= base_url('posts/create') ?>" class="btn btn-success">Create New Post</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Content</th>
                <th>Posted By</th>
                <th>Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= $post->title ?></td>
                <td><?= $post->description ?></td>
                <td><?= $post->content ?></td>
                <td><?= ($post->user_id == $this->session->user_id)? 'Me' : $post->username_id; ?></td>
                <td><?= $post->modified_at ?></td>
                <td>
                    <?php if ($post->user_id == $this->session->user_id) {?>
                        <a href="<?= base_url('posts/edit/' . $post->id) ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('posts/delete/' . $post->id) ?>" class="btn btn-danger">Delete</a>
                    <?php }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($current_page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= base_url('posts?page=' . ($current_page - 1)) ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($current_page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('posts?page=' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($current_page == $total_pages) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?= base_url('posts?page=' . ($current_page + 1)) ?>">Next</a>
            </li>
        </ul>
    </nav>

    <a href="<?= base_url('auth/logout')?>"><h5>Logout</h5></a>
</div>
</body>
</html>
