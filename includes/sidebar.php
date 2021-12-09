<?php if ($categories) : ?>


    <ul>
        <?php foreach ($categories as $category) : ?>
            <li class="sidebar-li" onclick="getArticles(<?= $category['id']; ?>);"><?= $category['title']; ?></li>
        <?php endforeach; ?>
    </ul>

    <script>
        async function getArticles(id) {

            const formData = new FormData();
            formData.set('category_id', id);
            const conn = await fetch('apis/api-category-article-list.php', {
                method: "POST",
                body: formData
            });
            const result = await conn.text();
            const articles = JSON.parse(result);

            displayArticles(articles);

        }


        function displayArticles(articles) {

            const contentWrapper = document.querySelector("#articlesList");
            contentWrapper.innerHTML = '';
            const template = document.querySelector("template");

            articles.forEach(elm => {

                const clone = template.cloneNode(true).content;
                clone.querySelector("p.article_name").textContent = elm.title;
                clone.querySelector("img").src = "/uploads/" + elm.image_file;
                clone.querySelector("a").setAttribute("href", `article.php?id=${elm.id}`);

                contentWrapper.appendChild(clone);

            });
        }
    </script>

<?php endif; ?>