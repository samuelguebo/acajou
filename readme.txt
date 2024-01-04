=== Acajou ===
Contributors: Samuel Guebo
Tags: two-columns, right-sidebar, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, sticky-post, threaded-comments, translation-ready, blog, slider

Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
A minimalist woodstyle theme called Acajou

== Description ==

Acajou is a clean, simple, and fully responsive WordPress theme that feels like wood and looks awesome on any devices. Its name, refers to a tree from tropical forests.
It adjusts automatically to any screen size including tablets and smartphones as well as Retina displays. Acajou is built using [Zurb Foundation](https://github.com/zurb/foundation-sites), a  framework for HTML5 / CSS3 which is SEO friendly. This WordPress theme was built with blogs and creative portfolios in mind but be creative and unleash its full potential in eCommerce, business and other projects. Acajou is available in English, French, and Spanish for now.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Do I need to regenerate my thumbnails? =
While the theme supports thumbnails out-of-the box, it's advisable to regenerate the thumbnails for the most recent articles as well as those showing up in the homepage's slider.
To do that you can install [Regenerate Thumbnails](http://wordpress.org/plugins/regenerate-thumbnails/) plugin.
If you didn't use featured images you can install the [Easy Add Thumbnail](http://wordpress.org/plugins/easy-add-thumbnail/) plugin to dinamically set featured images for old published posts.

= How do I add social icons in the menu? =
You need to add the links to your social pages in the Social menu, throug the theme customizer panel.
Icons are automatically detected based on the URL of your social page.

== Changelog ==

# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

= [1.2.1] - 2024-01-04 =
* Handle edge cases: missing thumbnails and lenghty titles

= [1.2.0] - 2024-01-04 =
* Replace Typed animation with slider on homepage
* Improve Hamburger menu
* Fix menu fallback causing fatal error
* Replace purple with Dark theme

= [1.0.7] - 2017-09-30 =
* fix php error in content-single.php

= [1.0.6] - 2017-06-13 =
* fix missing Alt attributes in Single, Page, Archive, and acajou_modify_post_thumbnail_html()

= [1.0.5] - 2017-06-13 =
* fixing sanitizing bug notified by [Smarciz](https://github.com/samuelguebo/acajou/issues/1)

= [1.0.4] - 2017-06-04 =
* updating tags: adding Abidjan, Côte d'Ivoire, Ivory coast, etc

= [1.0.3] - 2017-05-26 =
* fixing breadcrumbs line-height
* fixing page.php and single.php not displaying due to php compilation error
* fixing translation issue, update .pot files

= [1.0.2] - 2017-04-12 =
* adding missing licenses

= [1.0.1] - 2017-04-12 =
* Cross-check Licenses
* Use the_posts_pagination(); for multiple-post pages and the_post_navigation(); for single - Themes now supports the default of 3 columns as well as various column styles.
* Fixing captioned image alignement.
* Adding custom social menu

= [1.0.0] - 2016-12-30 =
* Custom header image(s)
* Set social links in Customizer
* Six flavors: chocolate, blue, green, red, dark, and yellow. You might switch between these colors in using the Customizer.
* Add Fading effects to block using [Scroll Reveal](https://github.com/jlmakes/scrollreveal) library

== Credits ==

- normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
- FontAwesome and Arvo fonts under the SIL Open Font License.
-  Zurb Foundation](https://github.com/zurb/foundation-sites), under MIT License.
- [Commons images](https:commons.wikimedia.org), under Creative Commons By SA 4.0 License