<?php

/**
 * Article
 * 
 */

class Article {

    public $id;
    public $title;
    public $description;

    /** Validate all the data in the $_POST[] super global array */
    public function validate() {
        //in new-article, edit-article

        if (isset($this->title) && $this->title == '') {
            $this->errors[] = 'Title is required';
        }

        if (isset($this->title) && strlen($this->title) > 255) {
            $this->errors[] = 'Title is too long';
        }

        if (isset($this->description) && $this->description == '') {
            $this->errors[] = 'Description is required';
        }

        if (isset($this->price) && $this->price == '') {
            $this->errors[] = 'Price is required';
        }

        if (isset($this->price) && !is_numeric($this->price)) {
            $this->errors[] = 'Price must be numeric';
        }

        return empty($this->errors);
    }

    /** Insert a new article with its current property values */
    public function create($conn) {
        //in new-article

        $sql = "INSERT INTO article (title, description, price)
                    VALUES(:title, :description, :price)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $conn->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    /** Update the article with its current property values */
    public function update($conn) {
        //in edit-article

        $sql = "UPDATE article 
                    SET title = :title,
                        description = :description,
                        price = :price
                    WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /** Delete the current article */
    public function delete($conn) {
        //in delete-article

        $sql = "DELETE FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /** Get all the articles from the db */
    public static function getAll($conn) {
        //in index, admin/index

        $sql = "SELECT * 
        FROM article";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Get the article record based on its ID  */
    public static function getById($conn, $id, $columns = '*') {
        //in article, edit-article

        $sql = "SELECT $columns FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    /** Get the articles by category from the db */
    public static function getByCategory($conn, $category) {
        //in article-overview, sidebar

        $sql = "SELECT a.*, ca.name AS category_name, ca.id as category_id, ca.title as category_title
        FROM article a
        JOIN article_category ac ON a.id = ac.article_id
        JOIN category ca ON ac.category_id = ca.id
        WHERE ca.name = :category";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /** Get the articles by category id from the db */
    public static function getByCategoryID($conn, $category_id) {
        //not using it

        $sql = "SELECT a.*, ca.name AS category_name, ca.id as category_id, ca.title as category_title
            FROM article a
            JOIN article_category ac ON a.id = ac.article_id
            JOIN category ca ON ac.category_id = ca.id
            WHERE ca.id = :category_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /*** Get the article record based on the ID along with associated categories, if any */
    public static function getWithCategories($conn, $id) {
        //in admin/article

        $sql = "SELECT article.*, category.name AS category_name, category.title as category_title
                 FROM article LEFT JOIN article_category
                ON article.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id
                WHERE article.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** * Get the article's categories */
    public function getCategories($conn) {
        //in admin/edit article

        $sql = "SELECT category.* 
        FROM category  
        JOIN article_category
        ON category.id = article_category.category_id
        WHERE article_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Set the articles categories */
    public function setCategories($conn, $ids) {
        //in admin/edit-article

        if ($ids) {
            $sql = "INSERT IGNORE INTO article_category (article_id, category_id)
                    VALUES ";

            $values = [];

            foreach ($ids as $id) {
                $values[] = "({$this->id}, ?)";
            }

            $sql .= implode(", ", $values);

            $stmt = $conn->prepare($sql);

            foreach ($ids as $i => $id) {
                $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
            }
            $stmt->execute();
        }

        $sql = "DELETE FROM article_category WHERE article_id = {$this->id}";

        if ($ids) {

            $placeholders = array_fill(0, count($ids), '?');

            $sql .= " AND category_id NOT IN (" . implode(", ", $placeholders) . ")";
        }

        $stmt = $conn->prepare($sql);
        foreach ($ids as $i => $id) {
            $stmt->bindValue($i + 1, $id, PDO::PARAM_INT);
        }
        $stmt->execute();
    }

    /** Update the image file property */
    public function setImageFile($conn, $filename) {
        //in edit-article-image

        $sql = "UPDATE article 
                SET image_file = :image_file
                WHERE id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        return $stmt->execute();
    }
}
