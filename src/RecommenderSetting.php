<?php

namespace Shopeo\RecommenderWidget;

class RecommenderSetting
{
    public function __construct()
    {
        add_action('admin_init', array($this, 'page_init'));
        add_action('admin_menu', array($this, 'add_menu'));
    }

    function sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['search'])) {
            $sanitary_values['search'] = sanitize_text_field($input['search']);
        }

        if (isset($input['url'])) {
            $sanitary_values['url'] = sanitize_text_field($input['url']);
        }
        return $sanitary_values;
    }

    function section_info()
    {
        printf(__('Section info', 'recommender-widget'));
    }

    function search_callback()
    {
        $options = '';
        $arr = array(
            array(
                'value' => 'visually_similar_search',
                'name' => __('Visually Similar Search', 'recommender-widget')
            ),
            array(
                'value' => 'visually_similar_recommendation',
                'name' => __('Visually Similar Recommendation', 'recommender-widget')
            ),
            array(
                'value' => 'combined_recommendations',
                'name' => __('Combined Recommendations', 'recommender-widget')
            )
        );
        foreach ($arr as $item) {
            $select = '';
            if (isset(get_option('recommender_widget_option_group')['search']) && esc_attr(get_option('recommender_widget_option_group')['search']) == $item['value']) {
                $select = 'selected';
            }
            $options .= sprintf('<option value="%1$s" %2$s>%3$s</option>', $item['value'], $select, $item['name']);
        }
        printf('<select name="recommender_widget_option_group[search]" id="recommender_widget_search">%s</select>', $options);
    }

    function url_callback()
    {
        printf('<input class="regular-text" type="url" name="recommender_widget_option_group[url]" id="recommender_widget_url" value="%s">', isset(get_option('recommender_widget_option_group')['url']) ? esc_attr(get_option('recommender_widget_option_group')['url']) : '');
    }

    function page_init()
    {
        register_setting('recommender_widget_option_group', 'recommender_widget_option_group', array($this, 'sanitize'));
        add_settings_section('recommender_widget_setting_section', __('Settings', 'recommender-widget'), array($this, 'section_info'), 'options-wd-recommender');
        add_settings_field('recommender_widget_search', __('Search', 'recommender-widget'), array($this, 'search_callback'), 'options-wd-recommender', 'recommender_widget_setting_section');
        add_settings_field('recommender_widget_url', __('URL', 'recommender-widget'), array($this, 'url_callback'), 'options-wd-recommender', 'recommender_widget_setting_section');
    }

    function page()
    {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('recommender_widget_option_group');
                do_settings_sections('options-wd-recommender');
                submit_button(__('Save Settings', 'recommender-widget'));
                ?>
            </form>
        </div>
    <?php }

    function add_menu()
    {
        add_options_page(__('WD Recommender', 'recommender-widget'), __('WD Recommender', 'recommender-widget'), 'manage_options', 'options-wd-recommender', array($this, 'page'), 10);
    }
}