<div class="container">
    <?php if (!empty($article->errors)) : ?>
        <ul>
            <?php foreach ($article->errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST">
        <div>
            <label for="title">Title</label>
            <input name="title" type="text" id="title" placeholder="article title" value="<?= htmlspecialchars($article->title); ?>">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10" placeholder="article description"><?= htmlspecialchars($article->description); ?></textarea>
        </div>
        <div>
            <label for="price">Price</label>
            <input name="price" type="text" id="price" placeholder="article price" value="<?= htmlspecialchars($article->price); ?>">
        </div>
        <fieldset>
            <legend>Categories</legend>
            <?php foreach ($categories as $category) : ?>
                <div>
                    <input type="checkbox" name="category[]" value="<?= $category['id']; ?>" id="category<?= $category['id']; ?>" <?php if (in_array($category['id'], $category_ids)) : ?>checked <?php endif; ?>>
                    <label for="category<?= $category['id']; ?>"><?= htmlspecialchars($category['title']); ?></label>
                </div>
            <?php endforeach; ?>

        </fieldset>

        <button>Save</button>
    </form>
</div>