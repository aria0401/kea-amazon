<div class="container">
    <?php if (!empty($article->errors)) : ?>
        <ul>
            <?php foreach ($article->errors as $error) : ?>
                <li class="error"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" id="formArticle">
        <div class="form-group">
            <label for="title">
                <h4>Title</h4>
            </label>
            <input class="form-control" name="title" type="text" id="title" placeholder="article title" value="<?= htmlspecialchars($article->title); ?>">
        </div>
        <div class="form-group">
            <label for="description">
                <h4>Description</h4>
            </label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="article description"><?= htmlspecialchars($article->description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">
                <h4>Price</h4>
            </label>
            <input class="form-control" name="price" type="text" id="price" placeholder="article price" value="<?= htmlspecialchars($article->price); ?>">
        </div>
        <fieldset>
            <legend>
                <h4>Categories</h4>
            </legend>
            <?php foreach ($categories as $category) : ?>
                <div>
                    <input type="checkbox" name="category[]" value="<?= $category['id']; ?>" id="category<?= $category['id']; ?>" <?php if (in_array($category['id'], $category_ids)) : ?>checked <?php endif; ?>>
                    <label for="category<?= $category['id']; ?>"><?= htmlspecialchars($category['title']); ?></label>
                </div>
            <?php endforeach; ?>

        </fieldset>

        <button class="btn">Save</button>
    </form>
</div>