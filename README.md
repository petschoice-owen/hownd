# Hownd Boilerplate

### Text Domain

- Change text domain and theme name on `style.css`. Make sure to rename this folder to the theme name.
- All function names must start with the text domain. example: `function text-domain_enqueue_scripts() {}`
- Always use `__( '', 'text-domain' );` for static strings.
- Use `get_template_directory_uri()` since this is a parent theme.

### Images

- Make sure to compress the image before uploading it to the library or adding it on the theme itself. https://tinypng.com/
- For sliders, we’ll be using https://swiperjs.com
- Make use of lazyload
- Responsive Images -> make use of srcset

### Blocks

- Change the block category on `inc/blocks.php`: line 48, 58, and 59
- Reference: https://www.advancedcustomfields.com/resources/whats-new-with-acf-blocks-in-acf-6/
- Title: use `Text Domain - *Name of Block*`
- Icon/s: https://developer.wordpress.org/resource/dashicons
- Category naming: `*text-domain*-blocks`
- We will enqueue scripts and styles specifically for the block.

#### We will have a different directory for each block. We have /blocks directory to hold them all.

For each block, we will have the following:
- block.json
- name_of_block.php
- style.scss
- script.js (if needed)

preview images path:  `/assets/images/blocks-preview/`

Because we're registering blocks via block.json, we can now add native block editor controls to our blocks.Here are the list of block supports that we can use: https://gutenberg.10up.com/reference/Blocks/block-supports/

### ACF Field Groups
- Title: `Theme Name/Text Domain - *Name of block*`
- Field Name: let’s use this format -> `*text_domain*_*name_of_block*_*field_name*`
    e.g `hownd_accordion_heading`

