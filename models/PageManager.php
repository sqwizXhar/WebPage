<?php
    require_once 'Page.php';
    require_once 'BlogPage.php';
    require_once 'StaticPage.php';

    class PageManager extends Page {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function prepareAttributes(Page $page, bool $isUpdate = false): array {
            $attributes = [
              ':user_id' => $page->getUserId(),
              ':title' => $page->getTitle(),
              ':content' => $page->getContent(),
            ];

            if($page instanceof BlogPage) {
                $attributes[':publish_date'] = $page->getPublishDate();
                $sql = $isUpdate
                    ? 'UPDATE pages SET title = :title, content = :content, publish_date = :publish_date WHERE id = :id AND user_id = :user_id'
                    : 'INSERT INTO pages (user_id, title, content, publish_date) VALUES (:user_id, :title, :content, :publish_date)';
            } else {
                $sql = $isUpdate
                    ? 'UPDATE pages SET title = :title, content = :content WHERE id = :id AND user_id = :user_id'
                    : 'INSERT INTO pages (user_id, title, content) VALUES (:user_id, :title, :content)';
            }

            if($isUpdate) {
                $attributes[':id'] = $page->getId();
            }

            return [$sql, $attributes];
        }

        public function addPage(Page $page) {
            list($sql, $attributes) = $this->prepareAttributes($page);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($attributes);
        }

        public function updatePage(Page $page) {
            list($sql, $attributes) = $this->prepareAttributes($page, true);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($attributes);
        }

        public function removePage($id) {
            $stmt = $this->pdo->prepare('DELETE FROM pages WHERE id = :id');
            $stmt->execute([':id' => $id]);
        }

        public function getAllPages($user_id): array {
            $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE user_id = :user_id');
            $stmt->execute([
                ':user_id' => $user_id
            ]);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pages = [];
            foreach ($result as $row) {
                if (isset($row['publish_date'])) {
                    $pages[] = new BlogPage($row['id'], $row['user_id'], $row['title'], $row['content'], $row['publish_date']);
                } else {
                    $pages[] = new StaticPage($row['id'], $row['user_id'], $row['title'], $row['content']);
                }
            }
            return $pages;
        }

        public function getPageById($id) {
            $stmt = $this->pdo->prepare('SELECT * FROM pages WHERE id = :id');
            $stmt->execute([
                ':id' => $id
            ]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                if (isset($row['publish_date'])) {
                    return new BlogPage($row['id'], $row['user_id'], $row['title'], $row['content'], $row['publish_date']);
                } else {
                    return new StaticPage($row['id'], $row['user_id'], $row['title'], $row['content']);
                }
            }
            return null;
        }
    }
?>
