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
        $id = (is_array($atts) && array_key_exists('id', $atts)) ? $atts['id'] : '';
        $sku = (is_array($atts) && array_key_exists('sku', $atts)) ? $atts['sku'] : '';
        $target = (is_array($atts) && array_key_exists('target', $atts)) ? $atts['target'] : '';
        $link = (is_array($atts) && array_key_exists('link', $atts)) ? true : false;
        $type = (is_array($atts) && array_key_exists('type', $atts)) ? $atts['type'] : '';
        $limit = (is_array($atts) && array_key_exists('limit', $atts)) ? $atts['limit'] : '';
        $width = (is_array($atts) && array_key_exists('width', $atts)) ? $atts['width'] : '';
        if ($sku) {
            $search = new RecommenderSearch();
            $result = $search->search($sku, $limit, $type);
            ob_start();
            ?>
            <style>
                .wd_recommender .wd_recommender_list ul li {
                    width: <?php echo $width;?> !important;
                }
            </style>
            <div id="<?php echo $id; ?>" class="wd_recommender <?php echo $link ? '' : 'click-active'; ?>"
                 data-target="<?php echo $target; ?>">
                <div class="wd_left_control"><</div>
                <div class="wd_recommender_list woocommerce">
                    <ul class="products">
                        <?php
                        foreach ($result as $item) {
                            $post_object = get_post($item->product_id);
                            setup_postdata($GLOBALS['post'] =& $post_object);
                            wc_get_template_part('content', 'product');
                        }
                        ?>
                    </ul>
                </div>
                <div class="wd_right_control">></div>
            </div>
            <?php
            wp_reset_postdata();
        }
        $body = ob_get_contents();
        ob_end_clean();
        return $body;
    }
}