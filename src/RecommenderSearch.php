<?php

namespace Shopeo\RecommenderWidget;

class RecommenderSearch
{
    public function search($sku)
    {
        $url = isset(get_option('recommender_widget_option_group')['url']) ? esc_attr(get_option('recommender_widget_option_group')['url']) : 'https://vs.warp-driven.com/img/vs_search';
        $url .= '?' . http_build_query(array('sku' => $sku, 'table_name' => 'woolworlds_products'));
        $response = wp_remote_post($url);
        error_log(print_r($response, true));
        if (!is_wp_error($response)) {
            return json_decode($response['body']);
        } else {
            return array();
        }
    }
}