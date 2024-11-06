<?php
    require_once __DIR__ . '/../interfaces/IRenderable.php';

    class Page implements IRenderable
    {
        private $id;
        private $user_id;
        private $title;
        private $content;

        public function __construct($id, $user_id, $title, $content) {
            $this->id = $id;
            $this->user_id = $user_id;
            $this->title = $title;
            $this->content = $content;
        }

        public function getId() {
            return $this->id;
        }
        public function getUserId() {
            return $this->user_id;
        }
        public function getTitle() {
            return $this->title;
        }
        public function getContent() {
            return $this->content;
        }

        public function render(): string {
            return
                '<h1>' . $this->title . '</h1>' .
                '<p>' . $this->content . '</p>';
        }

    }
?>