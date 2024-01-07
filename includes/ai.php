<?php

namespace AIIFY;

use Orhanerday\OpenAi\OpenAi;
use Youniwemi\StringTemplate\Engine;


function render( string $template, $values = array() ) {
	static $tpl;
	if ( $tpl === null ) {
		$tpl = new Engine();
	}
	return $tpl->render( $template, $values );
}

function get_system_prompt( $is_edit = false ) {
	if ( $is_edit ) {
		return AIIFY_SYSTEM_EDIT_PROMPT . "\n\n" . AIIFY_SYSTEM_EDIT_PROMPT_FORMATING;
	} else {
		return AIIFY_SYSTEM_PROMPT . "\n\n" . AIIFY_SYSTEM_PROMPT_FORMATING;
	}
}

/**
 * Prepares the options for OpenAi call
 *
 * @param      string $prompt  The prompt
 */
function prepare_options_openai( string $prompt, $is_stream = true, $is_edit = false ) {
	return array(
		'model'             => AIIFY_OPEN_AI_MODEL,
		'temperature'       => (float) AIIFY_TEMPERATURE,
		'frequency_penalty' => (float) AIIFY_FREQUENCY_PENALTY,
		'presence_penalty'  => (float) AIIFY_PRESENCE_PENALTY,
		'messages'          => array(
			// array(
			// 'role'    => 'system',
			// 'content' => AIIFY_SYSTEM_PROMPT,
			// ),
			array(
				'role'    => 'system',
				'content' => get_system_prompt( $is_edit ),
			),
			array(
				'role'    => 'user',
				'content' => $prompt,
			),
		),
		'stream'            => $is_stream,
	);
}

/**
 * Prepares the options for Ollama call
 *
 * @param      string $prompt  The prompt
 */
function prepare_options_ollama( string $prompt, $is_stream = true, $is_edit = false ) {
	$options = array(
		'model'   => AIIFY_OLLAMA_MODEL,
		'stream'  => $is_stream,
		'options' => array(
			'temperature' => (float) AIIFY_TEMPERATURE,
		),
	);
	if ( true ) {
		$options['messages'] = array(
			// array(
			// 'role'    => 'system',
			// 'content' => AIIFY_SYSTEM_PROMPT,
			// ),
			// array(
			// 'role'    => 'system',
			// 'content' => AIIFY_SYSTEM_PROMPT_FORMATING,
			// ),
			array(
				'role'    => 'system',
				'content' => get_system_prompt( $is_edit ),
			),
			array(
				'role'    => 'user',
				'content' => $prompt,
			),
		);
	} else {
		$options['prompt'] = $prompt;
		$options['system'] = get_system_prompt( $is_edit );
	}
	return $options;
}

function ollama_to_openai( $ollama ) {
	if ( $ollama->done ) {
		return '[DONE]';
	}

	return json_encode(
		array(
			'choices' => array(
				array(
					'delta' => array(
						'content' => isset( $ollama->message->content ) ? $ollama->message->content : $ollama->response,
					),

				),
			),
		)
	);

}


/**
 * Main AI query action
 */
add_action(
	'wp_ajax_open_ai',
	function () {
		error_reporting( E_ALL );
		ini_set( 'display_errors', 1 );

		check_ajax_referer( 'secure-nonce', 'openai_nonce' );

		if ( AIIFY_AI_ENGINE == 'openai' ) {
			$engine = new OpenAi( AIIFY_OPEN_AI_KEY );
		} else {
			$engine = new Ollama( AIIFY_OLLAMA_URL );
		}

		// Make sur style and tone are in our list of styles and tones
    // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$style = isset( $_GET['style'] ) && isset( AIIFY_STYLES[ $_GET['style'] ] ) ? $_GET['style'] : AIIFY_WRITING_STYLE;
    // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$tone = isset( $_GET['tone'] ) && isset( AIIFY_TONES[ $_GET['tone'] ] ) ? $_GET['tone'] : AIIFY_WRITING_TONE;
		// keep words for compatibility
		$maxWords = $words = isset( $_GET['maxWords'] ) ? intval( $_GET['maxWords'] ) : AIIFY_WRITING_MAX_WORDS;

		$tpl = new Engine();

		// Prepare context for style, tone, formating and length
		$languages = get_languages();
    	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
		$language = isset( $_GET['language'] ) && isset( $languages[ $_GET['language'] ] ) ? $_GET['language'] : AIIFY_WRITING_LANGUAGE;

		// don't need slashes, sani
		$prompt = isset( $_GET['prompt'] ) ? wp_kses_post( wp_unslash( $_GET['prompt'] ) ) : null;

		$is_edit = isset( $_GET['edit'] );
		if ( $is_edit ) {
			$edit    = trim( wp_kses_post( wp_unslash( $_GET['edit'] ) ), "\n" );
			$commads = array_merge( AIIFY_EDIT_PROMPTS, AIIFY_GENERATE_AFTER_PROMPTS, AIIFY_GENERATE_BEFORE_PROMPTS );

			$command = isset( $commads[ $prompt ] ) ? $commads[ $prompt ] : $prompt;
			// if ( isset( AIIFY_EDIT_PROMPTS[ $prompt ] ) ) {
			// Do not change structure
			// $command .= 'Please avoid adding any additional headings if the provided text has a paragraph structure.';
			// }
			$header = '';
			$prompt = render( AIIFY_SYSTEM_EDIT_STRUCTURE, compact( 'header', 'command', 'edit', 'language', 'maxWords', 'words' ) );
		} else {

			$header   = render( AIIFY_SYSTEM_INSTRUCTION_HEADER, compact( 'style', 'tone', 'words', 'maxWords', 'language' ) );
			$context  = isset( $_GET['context'] ) ? wp_kses_post( wp_unslash( $_GET['context'] ) ) : null;
			$keywords = isset( $_GET['keywords'] ) ? wp_kses_post( wp_unslash( $_GET['keywords'] ) ) : null;
			$prompt   = rtrim( $prompt, '.' );

			$prompt = render( AIIFY_SYSTEM_PROMPT_STRUCTURE, compact( 'header', 'language', 'prompt', 'context', 'keywords', 'maxWords', 'words' ) );

		}

		$isStream = ! isset( $_GET['nostream'] );

		if ( AIIFY_AI_ENGINE == 'openai' ) {
			$opts = prepare_options_openai( $prompt, $isStream, $is_edit );
		} elseif ( AIIFY_AI_ENGINE == 'ollama' ) {
			$opts = prepare_options_ollama( $prompt, $isStream, $is_edit );
		}

		if ( $isStream ) {
			header( 'Content-type: text/event-stream' );
			header( 'Cache-Control: no-cache' );
		}

		function get_stream_error( string $buffer ) {
			// Avoid parsing...
			if ( false === strpos( $buffer, 'error' ) ) {
				return;
			}

			if ( 0 === strpos( $buffer, 'data: ' ) ) {
				$maybe_json = substr( $buffer, 6 );
			} else {
				$maybe_json = $buffer;
			}
			// if it is a valid json
			$obj = json_decode( $maybe_json );
			if ( JSON_ERROR_NONE === json_last_error() ) {
				if ( isset( $obj->error ) && $obj->error->message != '' ) {
					return $obj->error;
				}
			}

		}

		$complete = $engine->chat(
			$opts,
			function ( $curl_info, $data ) use ( $opts ) {
				static $sentDebug;
				static $buffer = ''; // Initialize a static buffer to store partial JSON.

				$length = strlen( $data );
				// Append the new data to the buffer.
				$buffer .= $data;

				// Do we have an error here?
				$error = get_stream_error( $buffer );

				// Send debug/error as data, EventSource does not allow to extract the error.
				if ( $sentDebug === null ) {
					if ( $error ) {
						$opts['error'] = $error;
					}
					$debug = json_encode( $opts ) . PHP_EOL . PHP_EOL;
					echo 'data: ' . wp_kses_post( $debug );
					$sentDebug = true;
					ob_flush();
				} else {
					if ( $error ) {
						echo 'data: ' . wp_kses_post( json_encode( array( 'error' => $obj ) ) ) . PHP_EOL . PHP_EOL;
					}
				}

				// Now the buffer can be multiple lines, so we split and analyse them.
				$parts = explode( "\n", $buffer );
				// If the last part is not complete (does not end with \n), we keep it as our buffer, else, fresh buffer.
				$buffer = ( $buffer[-1] !== "\n" ) ? array_pop( $parts ) : '';

				foreach ( $parts as $part ) {
					if ( '' === $part ) {
						continue;
					}

					if ( 0 === strpos( $part, 'data: ' ) ) {
						$maybe_json = substr( $part, 6 );
					} else {
						$maybe_json = $part;
					}
					$obj = json_decode( $maybe_json );
					if ( json_last_error() === JSON_ERROR_NONE ) {
						$response = ( AIIFY_AI_ENGINE === 'openai' ) ? $maybe_json : ollama_to_openai( $obj );
						echo 'data: ' . wp_kses_post( $response ) . PHP_EOL . PHP_EOL;
					} else {
						$buffer .= $part;
					}
				}

				// Open AI : We are done here.
				if ( $buffer === 'data: [DONE]' ) {
					echo 'data: [DONE]' . PHP_EOL . PHP_EOL;
				}

				// echo PHP_EOL;
				ob_flush();
				flush();

				return $length;
			}
		);

	}
);

