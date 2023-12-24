===  Aiify Blocks - ChatGPT AI Copywriting, Content Writing, Rewriting and Editing ===
Contributors: rahal.aboulfeth
Tags: chatgpt, ai, block, seo, openai, content, copywriting
Requires at least: 5.0
Tested up to: 6.4.2
Requires PHP: 7.4
License: GPL
Stable tag: 0.1.4

Create high-quality content quickly with AI-powered copywriting, and optimize your existing content with advanced editing capabilities. Aiify Blocks uses ChatGPT AI technology within the WordPress block editor to help you generate new content and enhance your existing text for SEO and conversions.

== Description ==


Simplify your content creation process with **Aiify Blocks**, the AI-powered **WordPress plugin** that allows you to **generate new content** and **enhance existing text** using the power of **ChatGPT 3 & 4 models**. With **ultra-customizable** generation and **seamless integration** with the WordPress **block editor**, you can easily insert AI-generated content directly into your **pages** and **articles**, complete with structured **headings**, **lists**, **bold keywords**, and more. Aiify Blocks is perfect for **bloggers**, **writers**, and anyone looking to elevate their content game.

Effortlessly create **compelling** and **SEO-optimized content** with **Aiify Blocks**. Our AI-powered plugin for **WordPress** simplifies the **content generation** and **editing process**, with the ability to **highlight keywords**, **insert lists**, and more. Aiify Blocks is compatible with the block editor and can be used directly from the **WordPress customizer** or the FSE (full site editor), streamlining your content creation process and enhancing the quality of your website's copy.

Moreover, Aiify is not only Block Compatible; it extends its functionality to every TinyMCE content editor thanks to the Tinymce plugin button.


== OPEN AI ==

Aiify Blocks utilizes the API from  [OpenAI](https://platform.openai.com/) . This plugin does not gather any information from your OpenAI account. The data transmitted to the OpenAI servers primarily consists of the AI prompt composed using our models as well as the context you specify. 
It is important to check your usage on the [OpenAI website](https://platform.openai.com/account/usage) for accurate information. Please also review their [Privacy Policy](https://openai.com/policies/privacy-policy) and [Terms of Service](https://openai.com/policies/terms-of-use) for further information.

== Features ==

= AI-Generated Blocks =
Generate AI content Blocks using the "Aiify Block".

= Enhanced Toolbars (Aiify Enhanced Blocks) =
Aiify Blocks enhances the following block types with an "Aiify Me" button: Paragraph, Heading, Code, Quote, Pull Quote, Verse, List Item, and Groups. This button allows for quick edits and the ability to prepend or append generated content based on the block content.

= Full Site Editor (FSE) compatible  =
Seamlessly integrates with WordPress Block Editor, Site Editor, and Customizer

= Customizable AI =
Customize the style and tone of your content for maximum flexibility.

= Optimized Formatting =
AI-generated content is already formatted using Blocks such as Headings, Lists, Paragraphs, and Quotes as well as inline styles such as bolding and italic.

= Preconfigured and Customizable Prompts for SEO-Optimized Content =
Explore our preconfigured prompts designed to help you create SEO-optimized and engaging content. Tailor these prompts to your specific needs and enjoy the flexibility of customizable content generation.

= High-Quality Content =
Create high-quality content that engages and converts your audience

== Frequently Asked Questions ==

= What is content copywriting? =

Copywriting involves crafting persuasive written content with the goal of driving a specific action or response from the reader. It typically focuses on marketing or advertising purposes and requires an understanding of the target audience, as well as clear and engaging language. 

= What is rewriting, editing and the difference between them ? =

Editing involves reviewing and making changes to an existing piece of writing in order to improve its clarity, accuracy, and effectiveness. This can involve correcting grammar and spelling errors, reorganizing sentences or paragraphs for better flow, and polishing the language to make it more engaging for the reader.

Rewriting, on the other hand, involves revising the content of a piece of writing more extensively. This can include making substantial changes to the structure, tone, or focus of the piece in order to improve its overall quality and effectiveness.

While editing may involve some rewriting, the two processes are not necessarily interchangeable. Editing may focus more on fine-tuning and polishing an already-existing piece of writing, while rewriting involves making more substantive changes to the content itself.

= How do I get an OpenAI API key? =

You can retrieve an OpenAI API key by signing up on the OpenAI website at https://platform.openai.com/signup.

= Is OpenAI free? =

OpenAI offers a simple and flexible pricing model. You only pay for what you use. For more information on OpenAI's pricing, please visit https://openai.com/pricing.

= How do I generate AI content? =

To create new content with Aiify Blocks, simply add Aiify Block to your page, post, or any Block editor active post type. You can then use our preconfigured prompts or write your own perfect prompt, and then click the "write" button.

= How can I customize the generated content? =

When selecting the Aiify Block or any Aiify Enhanced Block, you'll see customization options in the editor's side panel. From there, you can adjust the maximum words, tone, and style.

= How can I customize the prompts content? =

You can customize the system prompts in the setting section

= Is this plugin compatible with the classic editor =

Yes, Exciting, right? We've just introduced a new plugin for TinyMCE that seamlessly integrates aiify, your AI-powered content assistant. This plugin adds a convenient button to your TinyMCE editor's toolbar, allowing you to effortlessly access the aiify prompter. Currently, our support enables you to create fresh, high-quality content with AI assistance. But stay tuned because in the near future, you'll also be able to utilize aiify to enhance and edit your existing content.

= Is this plugin compatible with WooCommerce =

Yes, you'll be able to use Aiify Blocks with WooCommerce. You can utilize it to enhance your product descriptions effortlessly, leveraging its capabilities to craft captivating and compelling product descriptions.

= Aiify plugin is great, how can I show my appreciation? =

We're glad you love our plugin! You can show your support by subscribing to the pro version, which allows you to:
- Do custom edits
- Request new features

== Installation ==
1. Upload the plugin to your plugins folder: 'wp-content/plugins/'
2. Activate the 'Aiify Blocks' plugin from the Plugins admin panel.
3. Customize your installation in the "Settings" Page ( setup Open AI API key )
4. Enjoy


== Screenshots ==
1. Create new content with ChatGpt
2. Edit and enhance existing blocks
3. Aiify blocks Open API setting 
4. Aiify blocks writing setting

== Credits ==
Big Thanks to : 
- [orhanerday](https://github.com/orhanerday/open-ai) for great library "OpenAI GPT-3 Api Client in PHP"
- [SamHerbert](https://github.com/SamHerbert/SVG-Loaders) for the smooth svg animation
- [Freemius](https://github.com/SamHerbert/SVG-Loaders) for plugin freemium experience
- [Youniwemi](https://packagist.org/packages/youniwemi/wp-settings-kit) for wp-settings-kit - the lightweight library for easily creating WordPress settings pages and Post metaboxes 


== Changelog ==
= 0.1.4 : TinyMCE AI Content Generation and WooCommerce Compatibility
- Introducing a new Tinymce plugin: a convenient button to access the Aiify Prompter.
- Added the option to reset default prompts
- Enhanced prompting mechanisms to ensure content stays within specified word limits.
- Updated dependencies to latest versions
= 0.1.3 : Configurable system prompts and templates
- System prompts can be configured now in settings
- Fix bug : sometimes, ai answers in a random langage while editing. Now, aiify will consistently use the language specified in the configuration or sidebar settings.
- Sidebar : Added a textarea showing the latest prompt (to help debug, inderstand, then improve the prompts)
= 0.1.2 : Fix bug corrupted install
- For some reason, a directory is missing after an install via wordpress plugin installer, this version is an attempt ti fix this by renaming the directory that was missing from the plugin
= 0.1.1 : Extra context and keywords
- Added possibility to add context to improve answer and keywords for SEO
= 0.1.0 : Choose output language
- Added possibility to select an output language
= 0.0.9 : Updated dependencies =
- Updated freemius to latest version
- Updated orhanerday/open-ai
= 0.0.8 : Added credits and updated translations and dependencies =
- Thanks to orhanerday, SamHerbert, Freemius
= 0.0.7 : Added support to ChatGpt4 model =
- Possibility select chatgpt4 model (if access is granted)
- Better edit prompts
= 0.0.6 : Added settings page =
- Possibility to setup API key
- Fine tune API settings ( temparature, frequency penalty, presence penalty )
- Setup default writing style and tone, as well as max words
= 0.0.5 : Show API error messages =
- Show snackbar error if API response has error
= 0.0.4 : Open AI Disclaimer =
- Added informations about external service use (OpenAi Api)
- Fix sanitization and escaping
= 0.0.3 : Block tranformation =
- Aiify Block can now be transformed to a simple group, leaving just the content blocks
- Type AI+Enter in paragraph will create an Aiify Block
= 0.0.2 : Aesthetic and eye-catching content. =
- Aiify Blocks can now generate Pull Quote Blocks.
= 0.0.1 : Meet Aiify Blocks, You new AI Power Content Editing and Generation Block =
* Initial release