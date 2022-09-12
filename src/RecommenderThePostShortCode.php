<?php

namespace Shopeo\RecommenderWidget;
class RecommenderThePostShortCode
{
    public function __construct()
    {
        add_shortcode('recommender-the-post', array($this, 'render'));
    }

    public function render($atts = [], $content = null)
    {
        $body = '';

        return $body;
    }
}