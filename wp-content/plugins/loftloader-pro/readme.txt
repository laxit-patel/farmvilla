=== LoftLoader Pro ===
Contributors: loftocean
Tags: customize, loading, loading screen, loader, page preloader, preload, preloader, preloader animation, preloader builder, preloader with image, website preloader, wordpress preloader
Author link: http://www.loftocean.com
Requires at least: 4.3
Tested up to: 5.x

== Copyright ==

LoftLoader bundles the following third-party resources:

WaitforImages
Copyright (c) 2011-2016 Alexander Dickson @alexdickson
Licensed under the MIT licenses.
Source http://alexanderdickson.com

== Changelog ==
= 1.2.4 =
* New: Background Section - 2 new Ending Animations: Slide Left, Slide Right
* Changed: The minimum PHP version requirement changed from PHP 5.4 to PHP 5.3
* Fixed: PHP error message displayed in the dashboard


= 1.2.3 =
* New: Random Message feature - enter multiple messages and display a random one when loading the page
* New: Feature to detect user website configuration and display warning messages if WordPress/PHP is too old
* Improved: Any Page Extension meta boxes redesigned to fit in Gutenberg Sidebar
* Fixed: PHP cache conflicts with some WordPress Themes/Plugins

= 1.2.2 =
* New: Option to adjust Line Height for Message
* Fixed: JS/PHP conflicts with some WordPress Themes/Plugins
* Improved: Message input field supports simple HTML markups
* Improved: Option to use site default font for message text and progress percentage number

= 1.2.1 =
* Fixed: Entire website is down after activating the plugin if the server PHP version is older than 5.4
* Improved: Added notifications when outdated PHP versions detected (older than PHP 5.4)
* New: For developers - after the loading process is completed, trigger a JavaScript event “loftloaderprodone” on DOM object “document”. Then developers can bind their own code to this event.

= 1.2 =
* New: Option to choose entrance animation (None / Fade In / Slide Up) for inner elements such as the loader, progress indicator and message.
* New: Option to choose exit animation (None / Slide Up) for inner elements such as the loader, progress indicator and message.
* Fixed: The issue of inserting HTML code into robots.txt

= 1.1.9 =
* New: Option to change custom loader image max width for responsive design
* Improved: LoftLoader Customizer panel independence
* Fixed: JS conflicts with Smart Slider 3 Pro version
* Fixed: Progress bar CSS issue under Chrome v67.x 

= 1.1.8 =
* New: Option to make the preloader spin counterclockwise with Custom Image Rotating loader
* Fixed: Image moves while loading with Custom Image Loading loader

= 1.1.7 =
* Fixed: Cookies conflict with cache plugins when "Once Per Session" feature is not enabled

= 1.1.6 =
* New: Background Section - Background Image can choose "cover" or "contain" as the full background image size
* New: Option to disable page scrolling while loading
* Improved: Rearranged options in More section
* Improved: Compatibility with WordPress 4.9.6 - added suggesting text for Privacy Policy (GDPR tools introduced in WordPress 4.9.6)
* Improved: Use cookies instead of sessions for "Once Per Session" feature
* Fixed: Added CSS for screen reader text in this plugin

= 1.1.5 =
* New: Background Section - 2 new Ending Animations: Split Diagonally - Vertically, Split Diagonally - Horizontally
* New: Loader Section - 1 new Loader Animation: Incomplete Ring
* New: Loader Section - Custom Image Loading Vertically - Animation can goes from Top to Bottom
* New: More Section - when "Smooth Page Transition" feature is enabled, user can exclude specific links so that the feature will be disabled when clicking on those links
* New: More Section - option to "Show Close Button after x seconds"
* Fixed: The issues of "Once Per Session" features due to WP Engine’s cache system ignores PHP Session 
* Fixed: Issue when saving styles as an external CSS file
* Fixed: Minor CSS issues

= 1.1.4 =
* Fixed: Settings Panel UI compatibility issues with WordPress v4.9

= 1.1.3 =
* New: Any Page Extension - Added an option to display the preloader (created by shortcode) on the page only once during a visitor session
* Fixed: preg_replace php function issue

= 1.1.2 =
* Fixed: Conflict with plugin "Essential Grid" - affected Smooth Page Transition feature
* Fixed: Removed empty <img> tag for loader "Drawing Frame"
* Fixed: Split background image issue on FireFox
* Fixed: Other minor CSS issues
* Improved: Hide LoftLoader when JavaScript is disabled 

= 1.1.1 =
* New: Display On - Selected Post Types
* Fixed: Minimal Load Time - Decimal separator (dot) being converted to comma for some locale settings
* Fixed: Back/forward button issue for Safari when Smooth Page Transition feature enabled

= 1.1.0 =
* Improved: LoftLoader Customizer panel independence (so that it will not be affected by theme or other plugins)
* New: Background Section - 2 new Ending Animations: Split & Reveal Vertically, Split & Reveal Horizontally
* New: Loader Section - 2 new Loader Animations: Beating, Custom Image Fading
* New: Loader Section - A new option for Crossing Circles: Blend Mode None
* New: Progress Section - A new Progress Animation: Bar + Number.
* Fixed: Minor bugs of Page smooth transition for IE11 - a tag with href "#" only
* Fixed: Minor bugs of Page smooth transition with WooCommerce - when "Enable AJAX add to cart buttons on archives"
* Fixed: Other CSS issues

= 1.0.10 =
* Fixed: AJAX keep alive error when switch between login and logout user
* New: Two methods to update session state for once per session and homepage + once per session mode
* New: New customize control for AJAX interval

= 1.0.9 =
* Fixed: Page smooth transition a with href "#" only

= 1.0.8 =
* New: Display On - Homepage only + Once per session

= 1.0.7 =
* New: Background Section - Background Image
* New: Advanced Section - Save customize styles as inline styles in <header> or as an external .css file.
* New: "Default" font option in Google Font dropdown list
* Fixed: Minor bugs of Smooth Page Transition feature in Safari
* Changed: Removed inline JS, changed to HTML5 data attributes

= 1.0.6 =
* New: More Section - Smooth Page Transition
* New: Display On - Once per session
* New: Display On - "Sitewide - Selected types"
* New: Advanced - Enable Any Page Extension: let user export loader shortcodes and add it to any page, so display different loaders on different pages.
* Improved: Add CSS to prevent site content from being hidden by other plugins before their code get fully loaded.
* Fixed: Minor bugs on settings panel for WordPress 4.7.x

= 1.0.5 =
* New: Background Section - A new Ending Animation: Shrink & Fade
* New: Loader Section - A new option for Custom Image Rotating: Speed Curve
* New: Loader Section - More options for Drawing Frame: Frame Size & Border Width
* New: Progress Section - More font options for Percentage: Google Fonts, Font Weight and Letter Spacing.
* Updated: Google Font list

= 1.0.4 =
* New: Message Section - Message Position
* New: Message Section - More font options: Google Fonts, font weight and letter spacing.
* Fixed: Minor bugs of the loader Petals
* Improved: Added prefix to main classes to prevent styles from being affected by theme or other plugins.

= 1.0.3 =
* New: Background Section - Gradient Background
* New: Loader Section - Custom Static Image
* New: More Section - Devices
* Fixed: Backend layout issues with Divi Theme
* Fixed: Minor bugs of the loader Wave/Crossing Circles
* Improved: Load Time code
* Improved: Backend panel code
* Improved: Minified JS and CSS
* Changes: Remove width limitation of custom image (was 200px)
* Changes: Increase the z-index of the loading screen

= 1.0.2 =
* New: More section - Minimum Load Time

= 1.0.1 =
* New: Handpick for Display On section.
* New: Custom Welcome Message
* Fix: Customizer minor bug

= 1.0.0 =
* Initial Public Release