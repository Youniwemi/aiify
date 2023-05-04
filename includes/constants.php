<?php

namespace AIIFY;

// some defaults
define('AIIFY_CHAT_MODEL', 'gpt-3.5-turbo');
//define('AIIFY_CHAT_MODEL', 'gpt-4');
define('AIIFY_MAX_TOKENS', 256);
define('AIIFY_MAX_WORDS', 1000);
define('AIIFY_TOKEN_WORD_RATIO', 0.6);


// Those prompt are use facing prompts, they need to be translated
define('AIIFY_WRITER_PROMPTS', [
   "" => "",
  __("Write a blog post about", "aiify") => __("a topic", "aiify"),
   __("Write a press release about", "aiify") => __("a news event", "aiify"),
   __("Write a social media post about", "aiify") => __("a specific aspect of your product or service", "aiify"),
   __("Write a product description for", "aiify") => __("a specific retailer or audience", "aiify"),
   __("Write an email newsletter about", "aiify") => __("news or updates related to your business", "aiify"),
   __("Write website copy for", "aiify") => __("a specific page or section of your website", "aiify"),
   __("Write a video script for", "aiify") => __("a promotional or instructional video", "aiify"),
   __("Write a whitepaper on", "aiify") => __("a particular topic or industry trend", "aiify"),
   __("Write a case study about", "aiify") => __("a specific customer or business challenge", "aiify"),
   __("Write an e-book on", "aiify") => __("a specific topic or industry", "aiify"),
   __("Write an infographic about", "aiify") => __("a specific topic or data set", "aiify"),
   __("Write a sales letter for", "aiify") => __("a specific product or service", "aiify"),
   __("Write a landing page for", "aiify") => __("a specific offer or promotion", "aiify"),
   __("Write a product review for", "aiify") => __("a specific product or service", "aiify"),
   __("Write a how-to guide for", "aiify") => __("a specific task or process", "aiify"),
   __("Write a listicle about", "aiify") => __("a specific topic or set of related items", "aiify"),
   __("Write a research paper on", "aiify") => __("a specific topic or question", "aiify"),
   __("Write a personal essay about", "aiify") => __("a personal experience or perspective", "aiify"),
   __("Write a news article about", "aiify") => __("a specific news event", "aiify"),
   __("Write a feature article about", "aiify") => __("a specific person, place, or thing", "aiify"),
   __("Write a company profile about", "aiify") => __("a specific business or organization", "aiify"),
   __("Write a guest post for", "aiify") => __("a specific blog or publication", "aiify"),
   __("Write a comparison article on", "aiify") => __("two or more products or services", "aiify"),
   __("Write an interview article with", "aiify") => __("a specific person or expert", "aiify"),
   __("Write an opinion piece on", "aiify") => __("a specific topic or issue", "aiify"),
   __("Write an article outline for", "aiify") => __("a specific topic or article idea", "aiify")
]);

// Edit prompt are always formulated in english, avoid having to translate
define('AIIFY_EDIT_PROMPTS', [
  __("Fix spelling and grammar", "aiify") => "Identify and correct any spelling or grammar errors in the text.",
  __("Simplify language", "aiify") => "Simplify the language used in the text, making it easier to understand for a wider audience.",
  __("Make longer", "aiify") => "Add additional content to the text to make it longer while still being relevant to the main topic.",
  __("Make shorter", "aiify") => "Remove any unnecessary or redundant information to make the text shorter and more concise.",
  __("Improve writing", "aiify") => "Make improvements to the writing style and structure of the text to make it more engaging and professional.",
  __("Paraphrase", "aiify") => "Rewrite sections of the text to convey the same meaning but in different words or sentence structures.",
  __("Add more detail", "aiify") => "Identify areas of the text where more detail would improve the reader's understanding and add additional information.",
  __("Remove redundancy", "aiify") => "Identify and remove any repetitive or unnecessary information from the text.",
  __("Clarify meaning", "aiify") => "Make improvements to the clarity and coherence of the text to ensure that the meaning is clear and easy to understand.",
  __("Strengthen argument", "aiify") => "Evaluate the argument presented in the text and make improvements to strengthen it or address any weaknesses.",
  __("Emphasize keywords", "aiify") => "In order to do so, I need you to follow those exact steps :
1. Identify the main topic of the text.
2. Count the total words of the text then calculate 7% of this total, this calculated number will be our {MAX}.
3. Identify the most important keywords related to the main topic of the text and ensure they are not common words.
4. Reduce this list of keywords to the {MAX} you evaluated in step 2 by keeping only the most important ones, this reduced list will be {THE_FINAL_LIST}.
5. Emphasize only the {THE_FINAL_LIST} that resulted from step 4 in the input text in markdown, using ** to bolden them, and make sure not to emphasize any other keywords or common words.

Please note that the expected result is ONLY the same provided text with {THE_FINAL_LIST} emphasized in markdown (**). Do not print the explanations."
]);

define('AIIFY_GENERATE_BEFORE_PROMPTS', [
    __("Heading", "aiify") => "Produce a heading for the following text.",
    __("Tagline", "aiify") => "Craft a tagline for the following text.",
    __("Introduction", "aiify") => "Write an introduction for the following text.",
    __("Summary", "aiify") => "Create a summary for the following text.",
]);

define('AIIFY_GENERATE_AFTER_PROMPTS', [
    __("Summarize", "aiify") => "Summarize the following text.",
    __("List Key Takeaways", "aiify") => "List key takeaways from the following text without heading.",
    __("Find Action Items", "aiify") => "Extract action items from the following text.",
    __("Explain", "aiify") => "Explain the following text.",
    __("Elaborate", "aiify") => "Elaborate on the following text.",
    __("Find Main Idea", "aiify") => "Find the main idea of the following text.",
    __("Provide Examples", "aiify") => "Provide examples based on the following text.",
    __("Complete with sources", "aiify") => "Complete the following text making sure to add sources and quotations to support your statements.",
    __("Evaluate and Provide Feedback", "aiify") => "Evaluate the following text and provide feedback.",
    __("Write a Conclusion", "aiify") => "Write a conclusion for the following text."
]);

// define('AIIFY_STYLES', [
//       __("Journalistic", "aiify"),
//       __("Academic", "aiify"),
//       __("Creative", "aiify"),
//       __("Technical", "aiify"),
//       __("Business", "aiify"),
//       __("Scientific", "aiify"),
//       __("Casual", "aiify"),
//       __("Formal", "aiify"),
//       __("Narrative", "aiify"),
//       __("Descriptive", "aiify"),
//       __("Persuasive", "aiify"),
//       __("Expository", "aiify"),
//       __("Analytical", "aiify"),
//       __("Critical", "aiify"),
//       __("Conversational", "aiify"),
//       __("Professional", "aiify"),
//       __("Humorous", "aiify"),
//       __("Instructional", "aiify"),
//       __("Inspirational", "aiify"),
//       __("Motivational", "aiify")
// ]);

define('AIIFY_STYLES', [
      "Journalistic" => __("Journalistic", "aiify"),
      "Academic" => __("Academic", "aiify"),
      "Creative" => __("Creative", "aiify"),
      "Technical" => __("Technical", "aiify"),
      "Business" => __("Business", "aiify"),
      "Scientific" => __("Scientific", "aiify"),
      "Casual" => __("Casual", "aiify"),
      "Formal" => __("Formal", "aiify"),
      "Narrative" => __("Narrative", "aiify"),
      "Descriptive" => __("Descriptive", "aiify"),
      "Persuasive" => __("Persuasive", "aiify"),
      "Expository" => __("Expository", "aiify"),
      "Analytical" => __("Analytical", "aiify"),
      "Critical" => __("Critical", "aiify"),
      "Conversational" => __("Conversational", "aiify"),
      "Professional" => __("Professional", "aiify"),
      "Humorous" => __("Humorous", "aiify"),
      "Instructional" => __("Instructional", "aiify"),
      "Inspirational" => __("Inspirational", "aiify"),
      "Motivational" => __("Motivational", "aiify")
]);


define('AIIFY_STYLE', "Journalistic");


define(
    'AIIFY_TONES',
    [
      "Professional" => __("Professional", "aiify"),
      "Cheerful" => __("Cheerful", "aiify"),
      "Excited" => __("Excited", "aiify"),
      "Optimistic" => __("Optimistic", "aiify"),
      "Confident" => __("Confident", "aiify"),
      "Sarcastic" => __("Sarcastic", "aiify"),
      "Sincere" => __("Sincere", "aiify"),
      "Sympathetic" => __("Sympathetic", "aiify"),
      "Concerned" => __("Concerned", "aiify"),
      "Caring" => __("Caring", "aiify"),
      "Neutral" => __("Neutral", "aiify"),
      "Formal" => __("Formal", "aiify"),
      "Authoritative" => __("Authoritative", "aiify"),
      "Serious" => __("Serious", "aiify"),
      "Humorous" => __("Humorous", "aiify"),
      "Playful" => __("Playful", "aiify"),
      "Friendly" => __("Friendly", "aiify"),
      "Warm" => __("Warm", "aiify"),
      "Cold" => __("Cold", "aiify"),
      "Impersonal" => __("Impersonal", "aiify"),
      "Informative/Educational" => __("Informative/Educational", "aiify"),
      "Conversational" => __("Conversational", "aiify"),
      "Professional/Formal" => __("Professional/Formal", "aiify"),
      "Authoritative" => __("Authoritative", "aiify"),
      "Persuasive" => __("Persuasive", "aiify"),
      "Inspirational/Motivational" => __("Inspirational/Motivational", "aiify"),
      "Entertaining" => __("Entertaining", "aiify"),
      "Controversial" => __("Controversial", "aiify"),
      "Humorous" => __("Humorous", "aiify"),
      "Empathetic" => __("Empathetic", "aiify"),
      "Personal" => __("Personal", "aiify"),
      "Storytelling" => __("Storytelling", "aiify"),
      "Thought-provoking" => __("Thought-provoking", "aiify"),
      "Authentic" => __("Authentic", "aiify"),
      "Trustworthy" => __("Trustworthy", "aiify"),
      "Authorial" => __("Authorial", "aiify"),
      "Collaborative" => __("Collaborative", "aiify"),
      "Problem-solving" => __("Problem-solving", "aiify"),
      "Encouraging" => __("Encouraging", "aiify"),
      "Straightforward" => __("Straightforward", "aiify"),
      "Optimistic" => __("Optimistic", "aiify"),
      "Analytical" => __("Analytical", "aiify"),
      "Objective" => __("Objective", "aiify"),
      "Critical" => __("Critical", "aiify"),
      "Simplified" => __("Simplified", "aiify"),
      "Complex" => __("Complex", "aiify"),
      "Curious" => __("Curious", "aiify"),
      "Inspiring" => __("Inspiring", "aiify"),
      "Motivating" => __("Motivating", "aiify")
    ]
);


define('AIIFY_TONE', "Professional");




define('AIIFY_SYSTEM_PROMPT', "Ignore all previous instructions.\n\nAs an advanced AI language model, you already possess a deep understanding of the basic principles of search engine optimization and Copywriting. As an expert Copywriter, you know the importance of crafting unique, high-quality content that engages readers and drives traffic to websites. You also understand the key factors that impact search engine rankings, allowing you to optimize content for both search engines and human readers. To further enhance your skills as a professional SEO expert and Copywriter, let's review some of these basic principles.");

// define('AIIFY_SYSTEM_PROMPT_FORMATING', "Additionally, please note that all of your responses should be written in Markdown format. This means that you should use headings (starting at level 2 ##) to organize your content and help readers navigate through it easily. You should also always emphasize (bold) the relevant keywords related to the main topic (**) to make them stand out and italicize when appropriate (*) Additionally, using list items (-), quotes (>) are great techniques to make your content more readable and engaging. When mentionning quotes, it can be very eye catchy to repeat it after the paragraph end in a quote formating to make them stand out (>). By incorporating these formatting principles into your writing, you'll create content that's not only informative and valuable but also aesthetically pleasing and easy to read. And that's what you do.");

define('AIIFY_SYSTEM_PROMPT_FORMATING', "Use markdown for formatting and organize your content and help readers navigate it easily, use headings starting at level 2 (##). Additionally, bold the relevant keywords related to the main topic (**) and italicize when appropriate (*). Using list items (-) and quotes (>) are also great techniques to make your content more readable and engaging. To make quotes stand out, consider repeating them in a quote formatting at right the end of the mentionning paragraph (>). Follow those principles as much as you can."); // Follow all these formatting principles to create content that's not only informative and valuable but also aesthetically pleasing and easy to read.

define('AIIFY_EDIT_INSTRUCTION_HEADER', 'Style: %s. Tone: %s. Your response must not exceed %d words and must be formatted in Markdown and highlighting keywords.');


define('AIIFY_EDIT_TO_THE_POINT', "The main objectif of this task is to edit a provided text, answer in the same language as the provided text. Do not write explanations. Do not echo my prompt. Do not remind me what I asked you for. Do not apologize. Do not self-reference. Do not use generic filler phrases. Get to the point precisely and accurately. Do not explain what and why, just give me your best possible result.\n");

define('AIIFY_PARAGRAPH_BLOCK_PROMPT', __('Type "AI+Enter" for AI, or "/" to choose a block', 'aiify'));
