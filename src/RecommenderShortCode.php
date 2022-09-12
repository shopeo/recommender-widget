<?php

namespace Shopeo\RecommenderWidget;
class RecommenderShortCode
{
    public function __construct()
    {
        add_shortcode('recommender', array($this, 'render'));
    }

    public function render($atts = [], $content = null)
    {
        $body = '';

        return $body;
    }
}