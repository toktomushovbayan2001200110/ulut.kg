=== WooCommerce Color or Image Variation Swatches ===
Contributors: phppoet

License URI: https://www.gnu.org/licenses/gpl-3.0.html







== Changelog ==

Version 3.9.26 - 13 December 2023

Version 3.9.26 - 13 December 2023
- Version 3.9.26 (13 December 2023)      - Fix- Issue with plugin update.
- Version 3.9.25 (13 December 2023)      - Enhancement - Backend Ui Improvement.
- Version 3.9.24 (10 December 2023)      - Enhancement - UI improvements in backend. 
- Version 3.9.23 (03 December 2023)      - Enhancement - UI improvements in backend. 

- Version 3.9.22 - 02 December 2023 -  - Enhancement - Added interval check to auto update to improve perfomance. 
                                        - Enhancement - Updated Get domain validation url.
- Version 3.9.21 - 01 December 2023 - Fix - Debug errors.
- Version 3.9.20 - 01 December 2023 - Enhancement - Added update check interval.
- Version 3.9.19 (30 December 2023) - Fix - Debug errors.
- Version 3.9.18 (30 November 2023) - Fix - Debug errors.
- Version 3.9.17 (30 November 2023) - Fix - Added readme.txt for changelog with autoupdate.
- Version 3.9.16 (30 November 2023) - Fix - debug errors.
- Version 3.9.15 (30 November 2023) - Fix - domain mismatch issue.
- Version 3.9.14 (25 November 2023) - Fix - bug that breaks outofstock crossing.
- Version 3.9.13 (24 November 2023) - Enhancement - Improvement in backend admin menu styling.
- Version 3.9.11 (22 November 2023) - Fix - Debug errors on license activation tab.
- Version 3.9.10 (19 November 2023) - Fix - Some UI improvements.
- Version 3.9.9 (18 November 2023) - Fix - Github token issues causing automatic update fail.
- Version 3.9.8 (17 November 2023) - Fix - Some Debug errors.
- Version 3.9.7 (15 November 2023) - Fix - Added inbuilt auto update feature.
- Enhancement - Added HPOS Compatibility. 
Version 3.8.0 - 15 August 2023

* Fix - debug errors with php 8.3

Version 3.7.3 - 17 March 2023
* Version 3.7.3 - 17 March 2023 - Fix - Compatibility issue with previous release.
* Version 3.7.2 - 17 March 2023 - Fix - Compatibility issues with Flatsome quick view feature
* Fix - Compatibility issues with YITH Quick View Mode Plugin
Version 3.6.6 - 17 February 2023
* Version 3.6.6 - Fix-issue with plugin setting not getting saved.
* Version 3.6.5 - Fixed php 8 related error. 
* Version 3.6.4 - Added support for HTML5 <picture> tags.
* Version 3.6.3 - Optionally you can show attribute description in tooltip.
* Version 3.6.2 - Option to show price along with text swatches.
* Version 3.6.1 - Fix - styling issue with admin menu.
* Fix         - Styling issues of textblock on shop page.
* Enhancement - Compatibility with webp images on shop page.
* Enhancement - Moved settings from WooCommerce Settings to WooMatrix/Wooswatches Menu.
Version 3.5.1 - 10 november 2022
* Version 3.5.1 (10 november 2022) - Fix javascript console error which breaks crossing of outofstock options.
* Enhancement - Verified compatibility with WooCommerce 7.0
* Fix         - Prevent crossing out of option when not opted for in case of single attribute.
* Enhancement - Added textdomain to missing strings in settings tab.
* Enhancement - Supports custom texonomy for shop swatches.
Version 3.4.12   - 04 October 2022
* Version 3.4.12   - 04 October 2022  Fix - fatal error on page edit with php 8.0 when direct variation link is activated.
* Version 3.4.11  - 30 September 2022 Fix - fatal error with php 7.4.30 when direct variation link is activated.
* Version 3.4.10  - 19 August 2022 Fix - Shop hover not working with avada theme.
* Version 3.4.9   - 19 August 2022 Enhancement - Added options to just disable outofstock options.
* Version 3.4.8 - 15 July 2022  Fix - replaced two instances of jquery.fn.load with .on("jquery" .
* Version 3.4.6 - 03 March 2022 Fix - crossing of out of stock options not working on single attribute products.
* Version 3.4.5 - 17 February 2022 Enhancement - Added support for is_tax("product-collection") for shop swatches.
* Version 3.4.4 - 10 February 2022 Enhancement - restore original image on mouseleave.
* Versopm 3.4.3 - 22 January 2022 * Enhancement - Added support for is_tax("collections") for shop swatches.
* Versopm 3.4.2 - 20 January 2022 * Fix - textswatches not working by default with global values.
* Version 3.4.1 - 08 January 2022 * Enhancement - added wcva_disable_unselect_on_click hook. 
* Enhancement - Show textswatches by default on global values. 
* Enhancement - Textblock are prefered as default option for custom swatches. 
Version 3.3.12  - 03 January 2022
* Version 3.3.12 - Fix - Debugg error when variation image are used as swatches.
* Version 3.3.11 - Enhancement - Added hook to override default shop swatches shape.
* Version 3.3.10 - Enhancement - crossout only last row when attribute number is greater than 2.
* Version 3.3.9 - Fix - bug with crossing out of stock options. 
* Version 3.3.7 - Fix - crossing of out of stock options not working properly when attribute         number is more than two.
                - Fix - full size images used for shop swatches when variation images are used as swatch image.
                - Fix - bug with shop swatches not getting disabled when variation images are used as swatch image.
                - Enhancement - Made cross out image more opaque.
* 3.3.6 - Fix - issue arised after update 3.3.5.
* 3.3.5 - Fix - issue arised with older php version (below 8.0) after 3.3.4 update.
* 3.3.4 - Fix - fix for debug error on shop page. 
* 3.3.3 - Fix - issue with crossing outofstock option when attribute number is greater than two.
* 3.3.2 - 08 June 2021 - Fix - Shop swatches not working with finnish text. 
                       - Fix - debug errors on shop page when main image was not set.
* 3.3.1 - 07 June 2021 - Fix - Variation image not working with finnish attribute text. 
* Enhancement - Cross Out of stock options. 
* Enhancement - Updated iris,slick and powerTip library to latest. 
* Enhancement - all jquery code wrapped into noconflict mode. 
* Enhancement - all instances of __() & _e() replaced with escaping functions.

Version 3.2  - 19 may 2021
* Enhancement - Added option to chose custom height and width for each attribute swatches.
* Fix - Outline not perfectly visible on ios safari.
* Fix - text below swatches visible when outofstock options are made hidden via CSS. 
Version 3.1.5 - 26 march 2021
* 3.1.5 - 26 march 2021 - Shop swatches height option gets hidden on admin page load.
* 3.1.4 - 24 february 2021 - Shop swatches now works when display type is set as "use variation images".
* 3.1.3 - 24 february 2021 - updated tested upto attributes for WP and WC.
* 3.1.2 - 22 december 2020 - fix - Fix - first image not changing when avada WooCommerce Product Images Layout is enabled.
* 3.1.1 - fix - pricing template duplication with avada.
* Fix - compatibility issue with php 8.0
* Fix - debug issue arised after wordpress 5.6
* Enhancement - Updated add-to-cart-variation.js according to latest WooCommerce release.

WooCommerce Color or Image Variation Swatches Version 3.0.20 - 29 November 2020
* Version 3.0.20 - 29 November 2020 - Fix - remove enabled attribute while detecting disabled options.
* Version 3.0.19 - 27 November 2020 - Fix - disables options based on enabled attribute only.
* Version 3.0.18 - 27 November 2020 - Fix - pricing issue with avada theme.
* Version 3.0.17 - 20 November 2020 - Enhancement - option to enable click on disabled options.
* Version 3.0.16 - 04 November 2020 - Fix compatibility issue with perfect brands plugin.
* Version 3.0.15 - 14 October 2020 - Added two hooks wcva_before_shop_swatches and wcva_after_shop_swatches
* Version 3.0.14(12 October 2020) - Fix-Limiting crossout to one attribute for sometime. 
* Version 3.0.13(08 October 2020) - Fix-issue with previous update.  
* Version 3.0.12(08 October 2020) - Added hook to crossout out of stock options on single product page.  
* Version 3.0.11(07 October 2020) - Enhancement -  added wcva_shop_outofstock_output hook to optionally show outofstock options on shop page. 
* Version 3.0.10(06 October 2020) - Fix - "use variation images" not working when space is used in custom attribute text. 
* Version 3.0.9(24 September 2020) - Fix - Wrong direct variation link url when used with global settings. 
* Version 3.0.8(04 September 2020) - Enhancement- Show live preview of color,image,textblock on backend. 
                                   - Fix        - Wrong enqueue of script on shop/archive page. 
* Version 3.0.7(03 September 2020) - Enhancement- Backend metabox tab design improved.
* Version 3.0.6(29 august 2020) - Added textdomain in plugin info.
* Version 3.0.5(28 august 2020) - fix- remove duplication with multiple variation images plugin.
* Version 3.0.4 - Fix- plugin activation notice not dismissible.
* Version 3.0.3 - Added plugin info link.
* Version 3.0.1 - Added notice on how to enable dashboard updates after plugin activation. 
                - Added plugin settings link.
* Fix - Jquery conflict on product edit page. 
* Fix - Jquery conflict on wooswatches settings page.
* Enhancement - Replaced background-image with --bg-image on swatch output.
WooCommerce Color or Image Variation Swatches Version 2.8 - 22 november 2019
* Version 2.8.7 (22 november 2019) - Fix- debug error on attribute edit page.
* Version 2.8.6 (19 september 2019) - Fix- update_woocommerce_term_meta replaced with update_term_meta.
* Version 2.8.5 (23 july 2019) - Fix- slick slider js conflict in shop-frontend.js.
* Version 2.8.4 (17 july 2019) - Fix- slick slider css conflict with elementor.
* Version 2.8.3 (15 july 2019) - Added hook-wcva_restore_product_image_on_mouseleave.
* Version 2.8.2 (13 july 2019) - Fix-issue with flatsome theme sliders.
* Version 2.8.1 (12 july 2019) - Fix-Tooltip not working.
* Added - Show more link if swatches number are greater than defined.
* Fix   - Hide out of stock options on shop page.
* Added - Slider for shop swatches if swatches number is higher than set value.
* Fix   - Styling issues on term pages.  
Version 2.7 - 16 june 2019
* Version 2.7.11(16 june 2019)     Fix - Bug with admin options.
* Version 2.7.10(17 may 2019)      Fix - Bug with direct variation link.
                                   Add - Hooks to change custom size and shape.
* Version 2.7.09(15 may 2019)      Fix - Bug with disable unavailable options.
* Version 2.7.08(13 may 2019)      Add - attribute_name parameter to wcva_attribute_display_type hook.
                                   Add - Hook to add extra <option></option> for global display type.
* Version 2.7.07(21 april 2019)    Fix - Bug with colorpicker for hex typing. 
* Version 2.7.06(21 april 2019)    Fix - Bug with global shop swatch attributes. 
                                   Add - Added hooks to globally manage shop swatches.
* Version 2.7.05(11 april 2019)    Add - Added span.wcva_attribute_sep class into variable.php
* Version 2.7.04(21 march 2019)    Fix - Debug error related to direct variation link.
* Version 2.7.03(15 february 2019) Fix - wooswatches filter widget title not changing in backend.
                                   Fix - add class to attribute name on widget frontend.
* Version 2.7.02(06 february 2019) Add - Option to change clear selection text.
* Version 2.7.01 Fix - Issue with rowurlencode while using variation images as swatch images.
* Version 2.7.01 Fix - Close iris color picker when focus is lost.
* Fix - Bug with using variation images as swatch images.
* Fix - Color picker issue with latest wordpress. 
* Fix - Media Upload issue with latest wordpress.
WooCommerce Color or Image Variation Swatches Version 2.6 - 25 october 2018
* version: 2.6.03 - fix - restore available options on clear selection.
* version 2.6.02 - removed woocommerce_after_add_to_cart_button hook from variable.php .
* version 2.6.01 - Added option to hide unavailable options.
Version 2.5 - 10 june 2018
* version 2.5.9 - Fixed disable variation issue on clear selection.
* version 2.5.8 - Fixed issue with previous update.
* version 2.5.7 - Disable unavailable options on page load.
* version 2.5.6 - Removed console log entries on single product page.
* version 2.5.5 - Fixed bug related to hiding unavailable options.
* version 2.5.4 - Fixed js error.
* version 2.5.3 - Updated add-to-cart-variation.js
* version 2.5.2 - Fixed malware warning.
* version 2.5.1 - Removed //do_action( ‘woocommerce_before_add_to_cart_button’ );  from variable.php .

Variation Swatches for WooCommerce Version 2.4 - 5 June 2018
* version 2.4.12 - Fix-extra space between swatches and clear selection link.
* version 2.4.11 - Fix-use of slug when default option is chosen.
* version 2.4.10 - Fix-use of label as selected option instead of slug.
* version 2.4.9 - Added version check tags for woocommerce 3.2+.
* version 2.4.8 - Added option to use variation image as swatch image in case of single attribute.
* version 2.4.7 - fix- Removed default dark color for attribute label.
* version 2.4.6 - fix- clear selected attribute upon swatch deselect.
* version 2.4.5 - fix- clear selection link appears before swatches.
* version 2.4.4 - Show selected attribute name on single product page.
* version 2.4.3 - fix for avada pricing issue with update 2.4.1.
* version 2.4.2 - added support for category shortcodes.
* version 2.4.1 - fixed pricing issue with avada theme.
* Fix - Removed display:none; property on single_variation_wrap into variable.php template.
* Fix - Direct variation link issue arised after 2.3.9
Variation Swatches for WooCommerce Version 2.3 - 08 April 2017
* version 2.3.9 - fixed debug error on wooswatches tab.
* version 2.3.8 - fixed bug with direct variation link.
* version 2.3.7 - fixed debug error.
                - fixed debug error on [product_page ] shortcode.
                - fixed direct variation link incompatibility issue with WC 3.0 .
* version 2.3.6 - Removed plugin update library. Use http://envato.github.io/wp-envato-market/ instead.
                - Fixed Js output bug on simple products. 
                - Fixed debug errors on single product page. 
* version 2.3.5 - Bug fixed with previous release.
* version 2.3.2 - Fixed debug erros.
* version 2.3.1 - Fixed bug related to previous release.
* Fixed WooCommerce 3.0 Compatiblity Issue
Variation Swatches for WooCommerce Version 2.2 - 04 Octomber 2016
* version 2.2.9 - Fixed debug errors on my account page.
* version 2.2.8 - Added- rel="nofollow" to filter widget links.
                 
* version 2.2.7 - Added- wcva_after_attribute_swatches hook
                  Tweak- Change in textblock CSS
* version 2.2.6 - Fix- Filter widget swatches showing css output. 
* version 2.2.5 - Fix- hover image not getting removed under product/attributes. 
* version 2.2.4 - Fixed bug with previous update. 
* version 2.2.3 - Removes unavailable options in default dropdowns and disables unavailable option swatches.
* version 2.2.2 - Replaced smallipop with powerTip, Show shop swatches in related products and you may also like.
* version 2.2.1 - Replaced minitip with smallipop,Fixed bug with previous version.
* Fix   - Swatches not showing under private mode.
* Added - Inbuilt swatches product filter.
* Added - Shop swatches now works with global values as display type.
* Added - wcva_show_hidden_dropdown hook to show dropdowns along with swatches.
* Added - Option to change hover image size.

Variation Swatches for WooCommerce Version 2.1 - 07 September 2016
* version 2.1.8 - Fixed minor css bug. 
* version 2.1.7 - Disables unavailable options.
* version 2.1.5 - removed disabled="disabled" attrabute on add to cart button. 
                - Fix for debug errors related to shop swatches.
                - CSS tweak for round swatches.
* version 2.1.4 - Fixed shop hover swatch border issue.
                - Fixed shop swatches wrong order issue.
* version 2.1.3 - Added border on hover on shop swatches.
                - Fixed bug with direct variation link.
                - Fixed below name CSS issue.
                 - Fixed shop hover image dimension issue.
* version 2.1.2 - some CSS tweak,fixed fatal error due to class conflict.
* version 2.1.1 - added class to hidden select element,option to replace hover with click on shop swatches.
* Added option to disable tooltip on iOS devices to avoide double click.
* Added wcva_attribute_swatch_display_type and wcva_attribute_swatch_image hook.
* Added inbuilt direct variation link feature.
* Added textblock option as attribute display type.

Version 2.0 - 28 june 2016

* Version 2.0.4- Fixed debug errors. 
* Version 2.0.3- Fixed debug errors, remove "disable [product_page ] shortcode support checkbox" from plugin settings page. 
* Version 2.0.2- Added wcva_attribute_display_type hook. 
* Version 2.0.1- Added wcva_swatch_image_url and wcva_hover_image_url hook. 
* Improvement in page loading speed. 
* Fixed bug with global display type. 

Version 1.9 – 29 february 2016

* Added feature to manage attribute options globally.

Version 1.8   - 25 february 2016

* Added possiblity to manage attribute options globally. 

Version 1.8   - 30 january 2016

* 1.8.1- fixed attribute label translation issue with WPML,removed custom label option.
* Fixed CSS issue related to "attribute name below swatch".
* Fixed compatibility issues with Woocommerce 2.5.

Version 1.7   - 10 december 2015

* Fixed compatiblity issues with WP 4.4.
* Improvement in frontend single product page css.
* Fixed shop hover image change issue with virtue,pinnacle theme.
* Moved plugin settings to Woocommerce/settings/swatches tab from Woocommerce/settings/products/display

Version 1.6   - 10 october 2015

* 1.6.8 - added optional tooltip on swatches.
* 1.6.7 - made button classes unique to avoid conflict on attribute edit page,fixed one debug error.
* 1.6.6 - fixed bug that makes attribute label selected on click,fixed bug related to default options.
* 1.6.5 - fixed bug related to different term slug and term name,some changes in automatic plugin update related
          code to improve performance.
* 1.6.4 - fixed custom label text bug,added option to use custom product page swatches height/width.
* 1.6.3 - fixed wp_debug error,fixed bug related to global attributes.
* 1.6.2 - Change in purchase code verification code, added [product_page] shortcode support,
          fixed conflict issue due to space,rowurldecode,minor changes in product-frontend.js file.
* 1.6.1 - Fixed bug related to previous release.
* Fixed compatibility issues related to woocommerce 2.4.X
* Fixed variation description related issue.
* Fixed issue related to special characters. 
* Added automatic update feature.

Version 1.5   - 23 august 2015

* Verified compatibility with latest wordpress 4.3 and woocommerce 2.4.5
 
Version 1.4   - 17 January 15 

* Added Direct Variation link Support on Shop Swatches.
* Added Option to change the location of Shop Swatches.
* Moved Shop swatches settings from general to products tab.

Version 1.3   - 30 December 14 


* Version 1.3.1 - Added rowurlencode to backend lable test.
* Displays Swatches below each product on shop/category/tag pages.
* Changes product image on swatch hover.


Version 1.2   - 20 December 14 

* version 1.2.1 - Fixed Small Issue with Greek Language.
* Fixed Compatibility Issue with YITH WooCommerce Zoom Magnifier.
* Fixed Compatibility Issue with Multiple Images Per variation Plugin.
* Fixed Image Zoom Compatibility Issue with IDSTORE,LEGENDAV,AVADA Theme.



Version 1.1   - 11 november 14

* version 1.1.5 - Some changes in plugin code , no change in features.
* version 1.1.4 - Fixed issue with decimal values , Removed Admin attribute header preview.
* version 1.1.3 - Fixed bug related to global color or image.
* version 1.1.2 - Support attribute name to be displayed under swatch.
* version 1.1.1 - added title hover to swaatches.
* Fixed compatibility issue with IE 11.
* Improved Front-end Compatibility with Major themes.
* Little tweak in admin side code.
* Improved CSS.
* Verified Compatibility with wordpress 4.0 and woocommerce 2.2.8.
* Verified functionality with All major browsers including IE 9,10,11.


Version 1.0.8 -12 July 14
* Improvement in global Color or image per attribute.
* 1.0.8.1 - fixed bug related to woocommerce older versions.

Version 1.0.7 -3 June 14

* replaced green border with black border on checked for image or color.
* fixed issue with default option selected on product load.
* Loads default select for IE11.

Version 1.0.6 -24 May 14

* Fixed Compatibility issue with IE. 


Version 1.0.5 -18 May 14

* Replaced Common display type selection with Per attribute selection.
* Improved Frontend CSS.

Version 1.0.4 -17 April 14

* added color or image settings on attribute edit pages.

Version 1.0.3 -15 April 14

* added radio button support .

* many minor improvements

Version 1.0.3 -16 April 14

* Improved theme compatibility.

* Improved CSS

* Removed custom label text option .

Version 1.0.1 -14 April 14

* fixed bug related to variable add to cart button.