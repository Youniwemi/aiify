<?php

namespace AIIFY;

use Orhanerday\OpenAi\OpenAi;

/**
 * Main AI query action
 */
add_action('wp_ajax_open_ai', function () {
    check_ajax_referer('secure-nonce', 'openai_nonce');
    require_once AIIFY_VENDOR. '/autoload.php';

    $open_ai = new OpenAi(AIIFY_OPEN_AI_KEY);
    // Make sur style and tone are in our list of styles and tones
    $style = isset($_GET['style']) && isset(AIIFY_STYLES[ $_GET['style'] ]) ? $_GET['style'] : AIIFY_WRITING_STYLE;
    $tone = isset($_GET['tone']) && isset(AIIFY_TONES[ $_GET['tone'] ]) ? $_GET['tone'] : AIIFY_WRITING_TONE;
    $words = isset($_GET['maxWords']) ? intval($_GET['maxWords']) : AIIFY_WRITING_MAX_WORDS;


    //$words = intval($maxTokens * AIIFY_TOKEN_WORD_RATIO); //
    // Prepare context for style, tone, formating and length
    $setup = sprintf(AIIFY_EDIT_INSTRUCTION_HEADER, $style, $tone, $words);

    // don't need slashes, sani
    $prompt = isset($_GET['prompt']) ? wp_kses_post(wp_unslash($_GET['prompt'])) : null;
    if (isset($_GET['edit'])) {
        $edit = wp_kses_post(wp_unslash($_GET['edit'])) ;
        $commads = array_merge(AIIFY_EDIT_PROMPTS, AIIFY_GENERATE_AFTER_PROMPTS, AIIFY_GENERATE_BEFORE_PROMPTS);
        $setup .= " Use the same Language as the text to edit. And consider it formated in Markdown or HTML.";

        $command = "Now, ";
        $command .= isset($commads[ $prompt ]) ? $commads[$prompt] : $prompt ;
        if (isset(AIIFY_EDIT_PROMPTS[$prompt])) {
            // Do not change structure
            $command .= " Do not change its structure (if the input text is a paragraph, please respond with a paragraph)." ;
        }
        $command .= " Do not translate to english, respond in the same language variety or dialect as the following text and do your best to respect the expected Markdown formatting (headings, lists, bold, emphasize, bold, quotes) :";
        $prompt = "[$setup]\n\n".AIIFY_EDIT_TO_THE_POINT.$command. "\n\n" .'"""'."\n". $edit."\n".'"""';
    } else {
        $languages = get_languages();
        $language = isset($_GET['language']) && isset($languages[$_GET['language']]) ? $_GET['language'] : AIIFY_WRITING_LANGUAGE;
        $setup .= " Do your best to create unique content free of plagiarism that respects the expected Markdown formatting (headings, lists, bold, emphasize, bold, quotes)";

        $command = "Now, here is the task, respond in '$language' language.: \n\n";
        $prompt = "[$setup]\n\n".$command.'"""'."\n".$prompt."\n".'"""';
    }


    // Total input words
    // $count_words_input = str_word_count(AIIFY_SYSTEM_PROMPT) + str_word_count($prompt);
    // total allowed response
    // $max_response = $words - $count_words_input;

    $isStream = !isset($_GET['nostream']);
    $method =  substr(AIIFY_CHAT_MODEL, 0, 3) == 'gpt' ? 'chat' : 'completion';
    $opts = [
       'model' => AIIFY_CHAT_MODEL ,
       'temperature' => (float) AIIFY_TEMPERATURE,
       //'max_tokens' => $maxTokens + intval($count_words_input/AIIFY_TOKEN_WORD_RATIO) ,
       'frequency_penalty' => (float) AIIFY_FREQUENCY_PENALTY,
       'presence_penalty' => (float) AIIFY_PRESENCE_PENALTY,
    ];
    if ($method == 'chat') {
        $opts['messages'] = [
           [
               "role" => "system",
               "content" => AIIFY_SYSTEM_PROMPT
           ],
           [
               "role" => "system",
               "content" => AIIFY_SYSTEM_PROMPT_FORMATING
           ],
           [
               "role" => "user",
               "content"=> $prompt
           ]
       ];
    } else {
        $opts['prompt'] = AIIFY_SYSTEM_PROMPT. "\n\n".AIIFY_SYSTEM_PROMPT_FORMATING."\n\n" .  $prompt;
    }

    if ($isStream) {
        $opts["stream"] = true;
        header('Content-type: text/event-stream');
        header('Cache-Control: no-cache');
    }





    $complete = $open_ai->$method($opts, function ($curl_info, $data) use ($opts) {
        static $sentDebug;
        // add error
        if ($obj = json_decode($data) and $obj->error->message != "") {
            $opts['error'] = $obj->error;
        }
        if ($sentDebug===null) {
            $debug = json_encode($opts).PHP_EOL.PHP_EOL;
            echo "data: ".wp_kses_post($debug);
            $sentDebug = true;
            ob_flush();
        }

        if (isset($opts['error'])) {
            echo "error: ". wp_kses_post($obj->error->message);
        } else {
            echo wp_kses_post($data);
        }
        echo PHP_EOL;
        ob_flush();
        flush();
        return strlen($data);
    });
});
