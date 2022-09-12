<?php

namespace Shopeo\RecommenderWidget;

use Shopeo\RecommenderWidget\RecommenderSearch;

class RecommenderThePostShortCode
{
    public function __construct()
    {
        add_shortcode('recommender-the-post', array($this, 'render'));
    }

    public function render($atts = [], $content = null)
    {
        $sku = get_post_meta(get_the_ID(), '_sku', true);
        $body = '';
        if ($sku) {
            $search = new RecommenderSearch();
            $result = $search->search($sku);
            $body = '<div class="wd_recommender">';
            $body .= '<div class="wd_left_control"><</div>';
            $body .= '<div class="wd_recommender_list">';
            foreach ($result as $item) {
                $body .= '<a href="' . $item->permalink . '">';
                $body .= '<div class="wd_recommender_item">';
                $body .= '<img src="' . $item->image_src . '"/>';
                $body .= '<span>' . $item->price_html . '</span>';
                $body .= '</div></a>';
                $body .= '</a>';
            }
            $body .= '</div>';
            $body .= '<div class="wd_right_control">></div>';
            $body .= '</div>';
        }
        return $body;
    }
}