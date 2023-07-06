<?php

/**
 * Plugin Name: Aiify Blocks - ChatGPT AI Content Editing and Generation Blocks
 * Plugin URI: https://www.wpaiify.com
 * Version: 0.0.9
 * Author: Instareza
 * Author URI: https://www.instareza.com
 * Description: Create and edit content using Chatgpt AI. Improve your content's quality and optimize it for search engines.
 * License: GPL
 * Text Domain: aiify
 * Domain Path: /languages
 * Requires PHP: 7.4
 * Stable tag: 0.0.9
 * @package AIIFY
 */
namespace AIIFY;

define( 'AIIFY_VERSION', '0.0.9' );
define( 'AIIFY_VENDOR', __DIR__ . '/vendor/' );
define( 'AIIFY_ASSETS_DIR', __DIR__ . '/assets/' );
define( 'AIIFY_INCLUDES', __DIR__ . '/includes/' );
define( 'AIIFY_BLOCK', __DIR__ . '/aiify/' );
define( 'AIIFY_URL', plugin_dir_url( __FILE__ ) );
define( 'AIIFY_LANGUAGE_PATH', plugin_dir_path( __FILE__ ) . '/languages' );
// Init freemius integration.
require AIIFY_INCLUDES . 'init_freemius.php';
function register_aiify_block()
{
    
    if ( !defined( 'AIIFY_OPEN_AI_KEY' ) || AIIFY_OPEN_AI_KEY == '' ) {
        // just bail if no key is there and notify
        add_action( 'admin_notices', function () {
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'aiify' ) {
                return;
            }
            ?>
    		<div class="error notice">
		        <p><?php 
            echo  esc_html__( 'To start using AIIFY Blocks, please setup you OpenAi Key', 'aiify' ) ;
            ?><br/>
		        	<a href="<?php 
            echo  esc_url( admin_url( 'admin.php?page=aiify&welcome-message=true' ) ) ;
            ?>"  ><?php 
            echo  esc_html__( 'Go to Aiify Blocks settings', 'aiify' ) ;
            ?></a>
		        </p>
		    </div>
    	<?php 
        } );
        return;
    }
    
    
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
        require AIIFY_INCLUDES . 'ai.php';
    } else {
        // No need to register block in ajax mode
        register_block_type( AIIFY_BLOCK );
        wp_set_script_translations( 'aiify-aiify-editor-script', 'aiify', AIIFY_LANGUAGE_PATH );
        function array_to_options( $array )
        {
            $options = [];
            foreach ( $array as $key => $value ) {
                $options[] = [
                    'label' => $value,
                    'value' => $key,
                ];
            }
            return $options;
        }
        
        wp_localize_script( 'aiify-aiify-editor-script', 'aiify', [
            'prompts'         => AIIFY_WRITER_PROMPTS,
            'edits'           => array_keys( AIIFY_EDIT_PROMPTS ),
            'after'           => array_keys( AIIFY_GENERATE_AFTER_PROMPTS ),
            'before'          => array_keys( AIIFY_GENERATE_BEFORE_PROMPTS ),
            'styles'          => array_to_options( AIIFY_STYLES ),
            'style'           => AIIFY_WRITING_STYLE,
            'tones'           => array_to_options( AIIFY_TONES ),
            'tone'            => AIIFY_WRITING_TONE,
            'maxWords'        => AIIFY_WRITING_MAX_WORDS,
            'nonce'           => wp_create_nonce( "secure-nonce" ),
            'currentPlan'     => aii_fs()->get_plan_name(),
            'paragraphPrompt' => AIIFY_PARAGRAPH_BLOCK_PROMPT,
        ] );
        add_filter(
            'write_your_story',
            function () {
            return AIIFY_PARAGRAPH_BLOCK_PROMPT;
        },
            100,
            0
        );
    }

}


if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
    require AIIFY_INCLUDES . 'settings.php';
    //allow only on admin ( or ajax )
    add_action( 'admin_init', __NAMESPACE__ . '\\register_aiify_block' );
}
