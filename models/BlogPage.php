<?php
    require_once 'Page.php';

    class BlogPage extends Page {
        private $publishDate;

        public function __construct($id, $userId, $title, $content, $publishDate) {
            parent::__construct($id, $userId, $title, $content);
            $this->publishDate = $publishDate;
        }

        public function getPublishDate() {
            return $this->publishDate;
        }

        public function render(): string {
            return "<div class='blog-page'><h3>Published on: $this->publishDate </h3>" . parent::render() . "</div>";
        }
    }
?>
