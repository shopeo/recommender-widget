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
        $id = $atts['id'];
        $sku = get_post_meta(get_the_ID(), '_sku', true);
        $target = $atts['target'];
        $link = empty($atts['link']) ? true : false;
        $body = '';
        if ($sku) {
            $search = new RecommenderSearch();
            $result = $search->search($sku);
            $body = '<div id="' . $id . '" class="wd_recommender" data-link="' . $link . '" data-target="' . $target . '">';
            $body .= '<div class="wd_left_control"><</div>';
            $body .= '<div class="wd_recommender_list">';
            foreach ($result as $item) {
                if ($link) {
                    $body .= '<a href="' . $item->permalink . '">';
                } else {
                    $body .= '<div class="wd_recommender_item_box" data-product-id="' . $item->product_id . '">';
                }
                $body .= '<div class="wd_recommender_item">';
                $body .= '<img src="' . $item->image_src . '"/>';
                $body .= '<span>' . $item->price_html . '</span>';
                $body .= '</div>';
                if ($link) {
                    $body .= '</a>';
                } else {
                    $body .= '</div>';
                }
            }
            $body .= '</div>';
            $body .= '<div class="wd_right_control">></div>';
            $body .= '</div>';
        }
        return $body;
    }
}