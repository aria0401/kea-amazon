<?php if ($categories) : ?>


    <ul class="mt-5">
        <li> <a href="javascript:void(0)" class="closebtn d-none-desktop " onclick="closeNav()">×</a></li>
        <?php foreach ($categories as $category) : ?>
            <li class="sidebar-li mb-1" data-action=<?= $_overview ?? "filter-single-page"; ?> data-filter=<?= $_overview ? $category['id'] : $category['name']; ?> data-device=<?= $_sidebar; ?>><?= $category['title']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        document.querySelectorAll('[data-action="filter-overview"]').forEach(elm => {
            elm.addEventListener("click", () => {

                getArticlesID();

                if (window.innerWidth < 700) {
                    closeNav();
                }
            });
        })

        document.querySelectorAll('[data-action="filter-single-page"]').forEach(elm => {
            elm.addEventListener("click", getArticlesCategory);
        })

        function getArticlesID() {

            const categoryTitle = event.target.textContent;
            const id = event.target.dataset.filter;
            getArticles(id, categoryTitle);
        }

        function getArticlesCategory() {
            const category = event.target.dataset.filter;
            location.href = "articles-overview.php?category=" + category;
        }

        async function getArticles(id, categoryTitle) {

            const formData = new FormData();
            formData.set('category_id', id);
            const conn = await fetch('apis/api-category-article-list.php', {
                method: "POST",
                body: formData
            });
            const result = await conn.text();
            const articles = JSON.parse(result);

            displayArticles(articles, categoryTitle);

        }

        function displayArticles(articles, categoryTitle) {

            document.querySelector(".category-title").textContent = categoryTitle;

            const contentWrapper = document.querySelector("#articlesList");
            contentWrapper.innerHTML = '';
            const template = document.querySelector("template.article-template");

            if (articles.length == 0) {
                document.querySelector(".not-found").textContent = "No articles found";
            } else {

                document.querySelector(".not-found").textContent = "";
                articles.forEach(elm => {

                    const clone = template.cloneNode(true).content;
                    clone.querySelector("p.article_name").textContent = elm.title;
                    clone.querySelector("strong.article_price").textContent = "$" + elm.price;
                    clone.querySelector("img.article_img").src = "/uploads/" + elm.image_file;
                    clone.querySelector("a.article_a").setAttribute("href", `article.php?id=${elm.id}`);

                    contentWrapper.appendChild(clone);

                });
            }
        }


        //COLLAPSIBLE SIDEBAR
        function openNav() {
            document.querySelector("#mySidebar").style.width = "275px";
            document.querySelector("#main-sidebar").style.marginLeft = "275px";
        }

        function closeNav() {
            document.querySelector("#mySidebar").style.width = "0";
            document.querySelector("#main-sidebar").style.marginLeft = "0";
        }
    </script>

<?php endif; ?>