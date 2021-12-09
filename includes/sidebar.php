<?php if ($categories) : ?>


    <ul>
        <?php foreach ($categories as $category) : ?>
            <li class="sidebar-li" data-action=<?= $_overview ? "filter-overview" : "filter-single-page"; ?> data-filter=<?= $_overview ? $category['id'] : $category['name']; ?>><?= $category['title']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        document.querySelectorAll('[data-action="filter-overview"]').forEach(elm => {
            elm.addEventListener("click", getArticlesID);
        })

        document.querySelectorAll('[data-action="filter-single-page"]').forEach(elm => {
            elm.addEventListener("click", getArticlesCategory);
        })


        function getArticlesID() {
            const id = event.target.dataset.filter;
            getArticles(id);
        }

        function getArticlesCategory() {
            const category = event.target.dataset.filter;
            location.href = "articles-overview.php?category=" + category;
        }

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

            if (articles.length == 0) {

                document.querySelector("#articlesList").textContent = "No articles found";
            } else {

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
        }
    </script>

<?php endif; ?>