<?php
require_once 'Page.php';

    class StaticPage extends Page
    {
        public function render(): string {
            return '<div class = \"static-page\">' . parent::render() . '</div';
        }
    }
?>