<?php

namespace AIIFY;

require AIIFY_VENDOR . '/autoload.php';

class Settings extends \WP_Settings_Kit
{
    protected $settings_name = 'aiify';
    public function admin_menu()
    {
        add_menu_page('Aiify', __('Aiify Blocks', 'aiify'), 'manage_options', 'aiify', array( $this, 'plugin_page' ), 'data:image/svg+xml;base64,'.base64_encode(file_get_contents(AIIFY_ASSETS_DIR.'img/icon.svg')));
    }

    public function plugin_page()
    {
        if (isset($_GET['welcome-message']) && $_GET['welcome-message'] =='true') {
            echo '<div class="notice notice-success is-dismissible"><p>'.
            sprintf(__('Welcome to Aiify Blocks, feel to <a href="%s" >contact us</a> if you have any question.', 'aiify'), aii_fs()->contact_url()).
            '</p></div>';
        }
        echo '<div class="wrap">';
        echo '<h1>'.esc_html__('Aiify Blocks Settings', 'aiify').'</h1>';
        $this->show_navigation();
        $this->show_forms();
        echo '</div>';
    }

    public function default_sanitization_error_message($field_config)
    {
        return sprintf(__('Please insert a valid %s', 'aiify'), $field_config['type']);
    }
}

function get_languages()
{
    // get language list form wordpress available translations, that's an exhaustive list
    require_once ABSPATH . 'wp-admin/includes/translation-install.php';
    $translations = wp_get_available_translations();
    $languages = [ 'en_US' =>  'English (United States)' ];
    $languages  += array_map(function ($t) {
        return $t['native_name'];
    }, $translations);
    $return = [];
    foreach ($languages as $locale => $language) {
        $return[$language] = $language;
    }
    return $return;
}





function settings()
{
    $openai_settings = [
        'name' => 'AIIFY',
        'title' => __('Open AI Settings', 'aiify'),
        'fields' => [
            [
                'id' => 'OPEN_AI_KEY',
                'type' => 'text',
                'title' => __('Your Open AI Key', 'aiify') ,
                'default' => '' ,
                'placeholder' => 'sk-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
                'description'=> sprintf(esc_html__("You can get your key here : %s", 'aiify'), '<a href="https://platform.openai.com/" target="_blank"> https://platform.openai.com/</a>')

            ] ,
            [
                'id' => 'CHAT_MODEL',
                'type' => 'select',
                'default' => 'gpt-3.5-turbo' ,
                'title' => __('Chat Model', 'aiify') ,
                'options' => AIIFY_CHAT_MODELS,
                'description' =>  sprintf(__("GPT-4 is currently in a limited beta and only accessible to those who have been granted access. Please join the <a target='_blank' href='%s'>waitlist</a> to get access when capacity is available.", 'aiify'), 'https://openai.com/waitlist/gpt-4-api')
            ] ,
            [
                'id' => 'TEMPERATURE',
                'type' => 'range',
                'title' => __('Temparature', 'aiify') ,
                'default' => 0.2 ,
                'attributes' => [
                    'min' => 0,
                    'max' => 1 ,
                    'step' => 0.1
                ],
                'description'=> __("Lower temperature means model generates repetitive text like training data. Higher temperature leads to more varied and creative text.", 'aiify')

            ] ,
            [
                'id' => 'FREQUENCY_PENALTY',
                'type' => 'range',
                'title' => __('Frequency penalty', 'aiify') ,
                'default' => 0 ,
                'attributes' => [
                    'min' => 0,
                    'max' => 1 ,
                    'step' => 0.1
                ],
                'description'=> __("A frequency penalty of 0.5 reduces the likelihood of the model using frequently seen words or phrases by 50%. A penalty of 1 will eliminate them completely.", 'aiify')
            ] ,
            [
                'id' => 'PRESENCE_PENALTY',
                'type' => 'range',
                'title' => __('Presence penalty', 'aiify') ,
                'default' => 0 ,
                'attributes' => [
                    'min' => 0,
                    'max' => 1 ,
                    'step' => 0.1
                ],
                'description'=> __("With a presence penalty of 0.5, the model reduces the chance of generating words or phrases not in the training data by 50%. A penalty of 1 avoids all new words or phrases.", 'aiify')

            ] ,

        ],
    ];


    $writing_settings = [
        'name' => 'AIIFY_WRITING',
        'title' => __('Writing Settings', 'aiify'),
        'fields' => [
            [
                'id' => 'LANGUAGE',
                'type' => 'select',
                'default' => AIIFY_WRITING_DEFAULT_LANGUAGE ,
                'title' => __('Output Language', 'aiify') ,
                'options' => get_languages()
            ] ,
            [
                'id' => 'STYLE',
                'type' => 'select',
                'default' => 'Journalistic' ,
                'title' => __('Writing Style', 'aiify') ,
                'options' => AIIFY_STYLES
            ] ,

            [
                'id' => 'TONE',
                'type' => 'select',
                'title' => __('Writing Tone', 'aiify') ,
                'default' => 'Professional' ,
                'options' => AIIFY_TONES
            ] ,
            [
                'id' => 'MAX_WORDS',
                'type' => 'range',
                'title' => __('Maximum words', 'aiify') ,
                'default' => 1000 ,
                'attributes' => [
                    'min' => 300,
                    'max' => 2000 ,
                    'step' => 10
                ],
            ]

        ],
    ];

    return [
        'AIIFY_OPEN_AI' => $openai_settings ,
        'AIIFY_WRITING' => $writing_settings
    ];
}

add_action('plugins_loaded', function () {
    load_plugin_textdomain('aiify', false, dirname(plugin_basename(__FILE__)) . '/languages');
    // init consts, need translation to be loaded
    require AIIFY_INCLUDES. 'constants.php';
    new Settings(apply_filters('aiify_settings', settings()));
});
