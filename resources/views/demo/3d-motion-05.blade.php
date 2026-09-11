@php
    $coverPhotoUrl = $data['cover_image'] ?? $data['groom']['photo'] ?? $data['bride']['photo'] ?? '{{ $coverPhotoUrl }}';
    $bridePhotoUrl = $data['bride']['photo'] ?? $data['cover_image'] ?? '/themes/3d-motion-05/uploads/jet-form-builder/291ebc13dd6538bae3ec7959b8d770dc/2024/10/img-sample-01-5.jpeg';
    $groomPhotoUrl = $data['groom']['photo'] ?? $data['cover_image'] ?? '/themes/3d-motion-05/uploads/jet-form-builder/291ebc13dd6538bae3ec7959b8d770dc/2024/10/img-sample-01-6.jpeg';
    $saveTheDateUrl = (!empty($data['galleries']) && count($data['galleries']) > 0) ? $data['galleries'][0] : ($data['cover_image'] ?? '/themes/3d-motion-05/uploads/jet-form-builder/291ebc13dd6538bae3ec7959b8d770dc/2024/10/img-sample-01-10.jpeg');
    $closingPhotoUrl = (!empty($data['galleries']) && count($data['galleries']) > 1) ? $data['galleries'][1] : ($saveTheDateUrl ?? '/themes/3d-motion-05/uploads/jet-form-builder/291ebc13dd6538bae3ec7959b8d770dc/2024/10/img-sample-01-7.jpeg');
@endphp
<!doctype html>
<html lang="id" prefix="og: https://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
<meta name="robots" content="noindex,nofollow,noarchive,nosnippet,noimageindex" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playball&family=Playfair+Display:ital,wght@0,400..800;1,400..800&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style id="wp-img-auto-sizes-contain-inline-css">
img:is([sizes=auto i],[sizes^="auto," i]){contain-intrinsic-size:3000px 1500px}
/*# sourceURL=wp-img-auto-sizes-contain-inline-css */
</style>
<link rel='stylesheet' id='dce-animations-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/animations.css' media='all' />

<style id="wp-emoji-styles-inline-css">

	img.wp-smiley, img.emoji {
		display: inline !important;
		border: none !important;
		box-shadow: none !important;
		height: 1em !important;
		width: 1em !important;
		margin: 0 0.07em !important;
		vertical-align: -0.1em !important;
		background: none !important;
		padding: 0 !important;
	}
/*# sourceURL=wp-emoji-styles-inline-css */
</style>
<style id="wp-block-library-inline-css">
/**
 * Colors
 */
/**
 * Typography
 */
/**
 * SCSS Variables.
 *
 * Please use variables from this sheet to ensure consistency across the UI.
 * Don't add to this sheet unless you're pretty sure the value will be reused in many places.
 * For example, don't add rules to this sheet that affect block visuals. It's purely for UI.
 */
/**
 * Fonts & basic variables.
 */
/**
 * Typography
 */
/**
 * Grid System.
 * https://make.wordpress.org/design/2019/10/31/proposal-a-consistent-spacing-system-for-wordpress/
 */
/**
 * Radius scale.
 */
/**
 * Elevation scale.
 */
/**
 * Dimensions.
 */
/**
 * Mobile specific styles
 */
/**
 * Editor styles.
 */
/**
 * Block & Editor UI.
 */
/**
 * Block paddings.
 */
/**
 * React Native specific.
 * These variables do not appear to be used anywhere else.
 */
/**
 * Breakpoints & Media Queries
 */
/**
*  Converts a hex value into the rgb equivalent.
*
* @param {string} hex - the hexadecimal value to convert
* @return {string} comma separated rgb values
*/
/**
 * Long content fade mixin
 *
 * Creates a fading overlay to signify that the content is longer
 * than the space allows.
 */
/**
 * Breakpoint mixins
 */
/**
 * Focus styles.
 */
/**
 * Applies editor left position to the selector passed as argument
 */
/**
 * Styles that are reused verbatim in a few places
 */
/**
 * Allows users to opt-out of animations via OS-level preferences.
 */
/**
 * Reset default styles for JavaScript UI based pages.
 * This is a WP-admin agnostic reset
 */
/**
 * Reset the WP Admin page styles for Gutenberg-like pages.
 */
/**
 * Creates a checkerboard pattern background to indicate transparency.
 * @param {String} $size - The size of the squares in the checkerboard pattern. Default is 12px.
 */
:root {
  --wp-block-synced-color: #7a00df;
  --wp-block-synced-color--rgb: 122, 0, 223;
  --wp-bound-block-color: var(--wp-block-synced-color);
  --wp-editor-canvas-background: #ddd;
  --wp-admin-theme-color: #007cba;
  --wp-admin-theme-color--rgb: 0, 124, 186;
  --wp-admin-theme-color-darker-10: rgb(0, 107, 160.5);
  --wp-admin-theme-color-darker-10--rgb: 0, 107, 160.5;
  --wp-admin-theme-color-darker-20: #005a87;
  --wp-admin-theme-color-darker-20--rgb: 0, 90, 135;
  --wp-admin-border-width-focus: 2px;
}
@media (min-resolution: 192dpi) {
  :root {
    --wp-admin-border-width-focus: 1.5px;
  }
}

/**
 * Element styles.
 */
.wp-element-button {
  cursor: pointer;
}

:root .has-very-light-gray-background-color {
  background-color: #eee;
}
:root .has-very-dark-gray-background-color {
  background-color: #313131;
}
:root .has-very-light-gray-color {
  color: #eee;
}
:root .has-very-dark-gray-color {
  color: #313131;
}
:root {
  /* stylelint-disable @stylistic/function-comma-space-after -- We can not use spacing because of WP multi site kses rule. */
}
:root .has-vivid-green-cyan-to-vivid-cyan-blue-gradient-background {
  background: linear-gradient(135deg, rgb(0, 208, 132) 0%, rgb(6, 147, 227) 100%);
}
:root .has-purple-crush-gradient-background {
  background: linear-gradient(135deg, rgb(52, 226, 228) 0%, rgb(71, 33, 251) 50%, rgb(171, 29, 254) 100%);
}
:root .has-hazy-dawn-gradient-background {
  background: linear-gradient(135deg, rgb(250, 172, 168) 0%, rgb(218, 208, 236) 100%);
}
:root .has-subdued-olive-gradient-background {
  background: linear-gradient(135deg, rgb(250, 250, 225) 0%, rgb(103, 166, 113) 100%);
}
:root .has-atomic-cream-gradient-background {
  background: linear-gradient(135deg, rgb(253, 215, 154) 0%, rgb(0, 74, 89) 100%);
}
:root .has-nightshade-gradient-background {
  background: linear-gradient(135deg, rgb(51, 9, 104) 0%, rgb(49, 205, 207) 100%);
}
:root .has-midnight-gradient-background {
  background: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
}
:root {
  /* stylelint-enable @stylistic/function-comma-space-after */
  --wp--preset--font-size--normal: 16px;
  --wp--preset--font-size--huge: 42px;
}

.has-regular-font-size {
  font-size: 1em;
}

.has-larger-font-size {
  font-size: 2.625em;
}

.has-normal-font-size {
  font-size: var(--wp--preset--font-size--normal);
}

.has-huge-font-size {
  font-size: var(--wp--preset--font-size--huge);
}

:root .has-text-align-center {
  text-align: center;
}

:root .has-text-align-left {
  /*rtl:ignore*/
  text-align: left;
}

:root .has-text-align-right {
  /*rtl:ignore*/
  text-align: right;
}

.has-fit-text {
  white-space: nowrap !important;
}

#end-resizable-editor-section {
  display: none;
}

.aligncenter {
  clear: both;
}

.items-justified-left {
  justify-content: flex-start;
}

.items-justified-center {
  justify-content: center;
}

.items-justified-right {
  justify-content: flex-end;
}

.items-justified-space-between {
  justify-content: space-between;
}

.screen-reader-text {
  border: 0;
  clip-path: inset(50%);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
  word-wrap: normal !important;
}

.screen-reader-text:focus {
  background-color: #ddd;
  clip-path: none;
  color: #444;
  display: block;
  font-size: 1em;
  height: auto;
  left: 5px;
  line-height: normal;
  padding: 15px 23px 14px;
  text-decoration: none;
  top: 5px;
  width: auto;
  z-index: 100000;
}

/**
 * The following provide a simple means of applying a default border style when
 * a user first makes a selection in the border block support panel.
 * This prevents issues such as where the user could set a border width
 * and see no border due there being no border style set.
 *
 * This is intended to be removed once intelligent defaults can be set while
 * making border selections via the block support.
 *
 * See: https://github.com/WordPress/gutenberg/pull/33743
 */
html :where(.has-border-color) {
  border-style: solid;
}

html :where([style*=border-color]) {
  border-style: solid;
}

html :where([style*=border-top-color]) {
  border-top-style: solid;
}

html :where([style*=border-right-color]) {
  /*rtl:ignore*/
  border-right-style: solid;
}

html :where([style*=border-bottom-color]) {
  border-bottom-style: solid;
}

html :where([style*=border-left-color]) {
  /*rtl:ignore*/
  border-left-style: solid;
}

html :where([style*=border-width]) {
  border-style: solid;
}

html :where([style*=border-top-width]) {
  border-top-style: solid;
}

html :where([style*=border-right-width]) {
  /*rtl:ignore*/
  border-right-style: solid;
}

html :where([style*=border-bottom-width]) {
  border-bottom-style: solid;
}

html :where([style*=border-left-width]) {
  /*rtl:ignore*/
  border-left-style: solid;
}

/**
 * Provide baseline responsiveness for images.
 */
html :where(img[class*=wp-image-]) {
  height: auto;
  max-width: 100%;
}

/**
 * Reset user agent styles for figure element margins.
 */
:where(figure) {
  margin: 0 0 1em 0;
}

html :where(.is-position-sticky) {
  /* stylelint-disable length-zero-no-unit -- 0px is set explicitly so that it can be used in a calc value. */
  --wp-admin--admin-bar--position-offset: var(--wp-admin--admin-bar--height, 0px);
  /* stylelint-enable length-zero-no-unit */
}

@media screen and (max-width: 600px) {
  html :where(.is-position-sticky) {
    /* stylelint-disable length-zero-no-unit -- 0px is set explicitly so that it can be used in a calc value. */
    --wp-admin--admin-bar--position-offset: 0px;
    /* stylelint-enable length-zero-no-unit */
  }
}
/*# sourceURL=/wp-includes/css/dist/block-library/common.css */
</style>
<style id="classic-theme-styles-inline-css">
/**
 * These rules are needed for backwards compatibility.
 * They should match the button element rules in the base theme.json file.
 */
.wp-block-button__link {
	color: #ffffff;
	background-color: #32373c;
	border-radius: 9999px; /* 100% causes an oval, but any explicit but really high value retains the pill shape. */

	/* This needs a low specificity so it won't override the rules from the button element if defined in theme.json. */
	box-shadow: none;
	text-decoration: none;

	/* The extra 2px are added to size solids the same as the outline versions.*/
	padding: calc(0.667em + 2px) calc(1.333em + 2px);

	font-size: 1.125em;
}

.wp-block-file__button {
	background: #32373c;
	color: #ffffff;
	text-decoration: none;
}

/*# sourceURL=/wp-includes/css/classic-themes.css */
</style>
<style id="wp-block-styles-placeholder-inline-css">
:root { --wp-internal-comment: "Placeholder for wp_hoist_late_printed_styles() to replace with the block styles printed at wp_footer." }
/*# sourceURL=wp-block-styles-placeholder-inline-css */
</style>
<link rel='stylesheet' id='dashicons-css' href='/themes/3d-motion-05/wp-includes/css/dashicons.css' media='all' />
<link rel='stylesheet' id='jet-engine-frontend-css' href='/themes/3d-motion-05/plugins/jet-engine/assets/css/frontend.css' media='all' />
<style id="wp-global-styles-placeholder-inline-css">
:root { --wp-internal-comment: "Placeholder for wp_hoist_late_printed_styles() to replace with the global-styles printed at wp_footer." }
/*# sourceURL=wp-global-styles-placeholder-inline-css */
</style>
<link rel='stylesheet' id='uaf_client_css-css' href='/themes/3d-motion-05/uploads/useanyfont/uaf.css' media='all' />
<link rel='stylesheet' id='wpb-lib-frontend-css' href='/themes/3d-motion-05/plugins/wpbits-addons-for-elementor/assets/css/frontend.min.css' media='all' />
<link rel='stylesheet' id='wds-elementor-css' href='/themes/3d-motion-05/plugins/weddingsaas-pro/assets/css/wds-elementor.css' media='all' />
<link rel='stylesheet' id='saic_style-css' href='/themes/3d-motion-05/plugins/weddingsaas-pro/assets/plugins/custom/commentpress/saic_style.css' media='screen' />
<link rel='stylesheet' id='dce-style-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/style.css' media='all' />
<link rel='stylesheet' id='dce-dynamic-visibility-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/dynamic-visibility.css' media='all' />
<link rel='stylesheet' id='dce-tooltip-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/tooltip.css' media='all' />
<link rel='stylesheet' id='wds-reset-css' href='/themes/3d-motion-05/themes/weddingsaas-wp/assets/css/reset.css' media='all' />
<link rel='stylesheet' id='e-animation-rotateInDownLeft-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/rotateInDownLeft.css' media='all' />
<link rel='stylesheet' id='elementor-frontend-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/frontend.css' media='all' />
<style id="elementor-frontend-inline-css">
@-webkit-keyframes ha_fadeIn{0%{opacity:0}to{opacity:1}}@keyframes ha_fadeIn{0%{opacity:0}to{opacity:1}}@-webkit-keyframes ha_zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@keyframes ha_zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@-webkit-keyframes ha_rollIn{0%{opacity:0;-webkit-transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg);transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg)}to{opacity:1}}@keyframes ha_rollIn{0%{opacity:0;-webkit-transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg);transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg)}to{opacity:1}}@-webkit-keyframes ha_bounce{0%,20%,53%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}40%,43%{-webkit-transform:translate3d(0,-30px,0) scaleY(1.1);transform:translate3d(0,-30px,0) scaleY(1.1);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}70%{-webkit-transform:translate3d(0,-15px,0) scaleY(1.05);transform:translate3d(0,-15px,0) scaleY(1.05);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}80%{-webkit-transition-timing-function:cubic-bezier(.215,.61,.355,1);transition-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translate3d(0,0,0) scaleY(.95);transform:translate3d(0,0,0) scaleY(.95)}90%{-webkit-transform:translate3d(0,-4px,0) scaleY(1.02);transform:translate3d(0,-4px,0) scaleY(1.02)}}@keyframes ha_bounce{0%,20%,53%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}40%,43%{-webkit-transform:translate3d(0,-30px,0) scaleY(1.1);transform:translate3d(0,-30px,0) scaleY(1.1);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}70%{-webkit-transform:translate3d(0,-15px,0) scaleY(1.05);transform:translate3d(0,-15px,0) scaleY(1.05);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}80%{-webkit-transition-timing-function:cubic-bezier(.215,.61,.355,1);transition-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translate3d(0,0,0) scaleY(.95);transform:translate3d(0,0,0) scaleY(.95)}90%{-webkit-transform:translate3d(0,-4px,0) scaleY(1.02);transform:translate3d(0,-4px,0) scaleY(1.02)}}@-webkit-keyframes ha_bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{opacity:1;-webkit-transform:scale3d(1.03,1.03,1.03);transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{opacity:1}}@keyframes ha_bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{opacity:1;-webkit-transform:scale3d(1.03,1.03,1.03);transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{opacity:1}}@-webkit-keyframes ha_flipInX{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(1,0,0,90deg);transform:perspective(400px) rotate3d(1,0,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-20deg);transform:perspective(400px) rotate3d(1,0,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(1,0,0,10deg);transform:perspective(400px) rotate3d(1,0,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-5deg);transform:perspective(400px) rotate3d(1,0,0,-5deg)}}@keyframes ha_flipInX{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(1,0,0,90deg);transform:perspective(400px) rotate3d(1,0,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-20deg);transform:perspective(400px) rotate3d(1,0,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(1,0,0,10deg);transform:perspective(400px) rotate3d(1,0,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-5deg);transform:perspective(400px) rotate3d(1,0,0,-5deg)}}@-webkit-keyframes ha_flipInY{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}}@keyframes ha_flipInY{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}}@-webkit-keyframes ha_swing{20%{-webkit-transform:rotate3d(0,0,1,15deg);transform:rotate3d(0,0,1,15deg)}40%{-webkit-transform:rotate3d(0,0,1,-10deg);transform:rotate3d(0,0,1,-10deg)}60%{-webkit-transform:rotate3d(0,0,1,5deg);transform:rotate3d(0,0,1,5deg)}80%{-webkit-transform:rotate3d(0,0,1,-5deg);transform:rotate3d(0,0,1,-5deg)}}@keyframes ha_swing{20%{-webkit-transform:rotate3d(0,0,1,15deg);transform:rotate3d(0,0,1,15deg)}40%{-webkit-transform:rotate3d(0,0,1,-10deg);transform:rotate3d(0,0,1,-10deg)}60%{-webkit-transform:rotate3d(0,0,1,5deg);transform:rotate3d(0,0,1,5deg)}80%{-webkit-transform:rotate3d(0,0,1,-5deg);transform:rotate3d(0,0,1,-5deg)}}@-webkit-keyframes ha_slideInDown{0%{visibility:visible;-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0)}}@keyframes ha_slideInDown{0%{visibility:visible;-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0)}}@-webkit-keyframes ha_slideInUp{0%{visibility:visible;-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}}@keyframes ha_slideInUp{0%{visibility:visible;-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}}@-webkit-keyframes ha_slideInLeft{0%{visibility:visible;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@keyframes ha_slideInLeft{0%{visibility:visible;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@-webkit-keyframes ha_slideInRight{0%{visibility:visible;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}@keyframes ha_slideInRight{0%{visibility:visible;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}.ha_fadeIn{-webkit-animation-name:ha_fadeIn;animation-name:ha_fadeIn}.ha_zoomIn{-webkit-animation-name:ha_zoomIn;animation-name:ha_zoomIn}.ha_rollIn{-webkit-animation-name:ha_rollIn;animation-name:ha_rollIn}.ha_bounce{-webkit-transform-origin:center bottom;-ms-transform-origin:center bottom;transform-origin:center bottom;-webkit-animation-name:ha_bounce;animation-name:ha_bounce}.ha_bounceIn{-webkit-animation-name:ha_bounceIn;animation-name:ha_bounceIn;-webkit-animation-duration:.75s;-webkit-animation-duration:calc(var(--animate-duration)*.75);animation-duration:.75s;animation-duration:calc(var(--animate-duration)*.75)}.ha_flipInX,.ha_flipInY{-webkit-animation-name:ha_flipInX;animation-name:ha_flipInX;-webkit-backface-visibility:visible!important;backface-visibility:visible!important}.ha_flipInY{-webkit-animation-name:ha_flipInY;animation-name:ha_flipInY}.ha_swing{-webkit-transform-origin:top center;-ms-transform-origin:top center;transform-origin:top center;-webkit-animation-name:ha_swing;animation-name:ha_swing}.ha_slideInDown{-webkit-animation-name:ha_slideInDown;animation-name:ha_slideInDown}.ha_slideInUp{-webkit-animation-name:ha_slideInUp;animation-name:ha_slideInUp}.ha_slideInLeft{-webkit-animation-name:ha_slideInLeft;animation-name:ha_slideInLeft}.ha_slideInRight{-webkit-animation-name:ha_slideInRight;animation-name:ha_slideInRight}.ha-css-transform-yes{-webkit-transition-duration:var(--ha-tfx-transition-duration, .2s);transition-duration:var(--ha-tfx-transition-duration, .2s);-webkit-transition-property:-webkit-transform;transition-property:transform;transition-property:transform,-webkit-transform;-webkit-transform:translate(var(--ha-tfx-translate-x, 0),var(--ha-tfx-translate-y, 0)) scale(var(--ha-tfx-scale-x, 1),var(--ha-tfx-scale-y, 1)) skew(var(--ha-tfx-skew-x, 0),var(--ha-tfx-skew-y, 0)) rotateX(var(--ha-tfx-rotate-x, 0)) rotateY(var(--ha-tfx-rotate-y, 0)) rotateZ(var(--ha-tfx-rotate-z, 0));transform:translate(var(--ha-tfx-translate-x, 0),var(--ha-tfx-translate-y, 0)) scale(var(--ha-tfx-scale-x, 1),var(--ha-tfx-scale-y, 1)) skew(var(--ha-tfx-skew-x, 0),var(--ha-tfx-skew-y, 0)) rotateX(var(--ha-tfx-rotate-x, 0)) rotateY(var(--ha-tfx-rotate-y, 0)) rotateZ(var(--ha-tfx-rotate-z, 0))}.ha-css-transform-yes:hover{-webkit-transform:translate(var(--ha-tfx-translate-x-hover, var(--ha-tfx-translate-x, 0)),var(--ha-tfx-translate-y-hover, var(--ha-tfx-translate-y, 0))) scale(var(--ha-tfx-scale-x-hover, var(--ha-tfx-scale-x, 1)),var(--ha-tfx-scale-y-hover, var(--ha-tfx-scale-y, 1))) skew(var(--ha-tfx-skew-x-hover, var(--ha-tfx-skew-x, 0)),var(--ha-tfx-skew-y-hover, var(--ha-tfx-skew-y, 0))) rotateX(var(--ha-tfx-rotate-x-hover, var(--ha-tfx-rotate-x, 0))) rotateY(var(--ha-tfx-rotate-y-hover, var(--ha-tfx-rotate-y, 0))) rotateZ(var(--ha-tfx-rotate-z-hover, var(--ha-tfx-rotate-z, 0)));transform:translate(var(--ha-tfx-translate-x-hover, var(--ha-tfx-translate-x, 0)),var(--ha-tfx-translate-y-hover, var(--ha-tfx-translate-y, 0))) scale(var(--ha-tfx-scale-x-hover, var(--ha-tfx-scale-x, 1)),var(--ha-tfx-scale-y-hover, var(--ha-tfx-scale-y, 1))) skew(var(--ha-tfx-skew-x-hover, var(--ha-tfx-skew-x, 0)),var(--ha-tfx-skew-y-hover, var(--ha-tfx-skew-y, 0))) rotateX(var(--ha-tfx-rotate-x-hover, var(--ha-tfx-rotate-x, 0))) rotateY(var(--ha-tfx-rotate-y-hover, var(--ha-tfx-rotate-y, 0))) rotateZ(var(--ha-tfx-rotate-z-hover, var(--ha-tfx-rotate-z, 0)))}.happy-addon>.elementor-widget-container{word-wrap:break-word;overflow-wrap:break-word}.happy-addon>.elementor-widget-container,.happy-addon>.elementor-widget-container *{-webkit-box-sizing:border-box;box-sizing:border-box}.happy-addon:not(:has(.elementor-widget-container)),.happy-addon:not(:has(.elementor-widget-container)) *{-webkit-box-sizing:border-box;box-sizing:border-box;word-wrap:break-word;overflow-wrap:break-word}.happy-addon p:empty{display:none}.happy-addon .elementor-inline-editing{min-height:auto!important}.happy-addon-pro img{max-width:100%;height:auto;-o-object-fit:cover;object-fit:cover}.ha-screen-reader-text{position:absolute;overflow:hidden;clip:rect(1px,1px,1px,1px);margin:-1px;padding:0;width:1px;height:1px;border:0;word-wrap:normal!important;-webkit-clip-path:inset(50%);clip-path:inset(50%)}.ha-has-bg-overlay>.elementor-widget-container{position:relative;z-index:1}.ha-has-bg-overlay>.elementor-widget-container:before{position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;content:""}.ha-has-bg-overlay:not(:has(.elementor-widget-container)){position:relative;z-index:1}.ha-has-bg-overlay:not(:has(.elementor-widget-container)):before{position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;content:""}.ha-popup--is-enabled .ha-js-popup,.ha-popup--is-enabled .ha-js-popup img{cursor:-webkit-zoom-in!important;cursor:zoom-in!important}.mfp-wrap .mfp-arrow,.mfp-wrap .mfp-close{background-color:transparent}.mfp-wrap .mfp-arrow:focus,.mfp-wrap .mfp-close:focus{outline-width:thin}.ha-advanced-tooltip-enable{position:relative;cursor:pointer;--ha-tooltip-arrow-color:black;--ha-tooltip-arrow-distance:0}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content{position:absolute;z-index:999;display:none;padding:5px 0;width:120px;height:auto;border-radius:6px;background-color:#000;color:#fff;text-align:center;opacity:0}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content::after{position:absolute;border-width:5px;border-style:solid;content:""}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content.no-arrow::after{visibility:hidden}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content.show{display:inline-block;opacity:1}.ha-advanced-tooltip-enable.ha-advanced-tooltip-top .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-top .ha-advanced-tooltip-content{top:unset;right:0;bottom:calc(101% + var(--ha-tooltip-arrow-distance));left:0;margin:0 auto}.ha-advanced-tooltip-enable.ha-advanced-tooltip-top .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-top .ha-advanced-tooltip-content::after{top:100%;right:unset;bottom:unset;left:50%;border-color:var(--ha-tooltip-arrow-color) transparent transparent transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-bottom .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-bottom .ha-advanced-tooltip-content{top:calc(101% + var(--ha-tooltip-arrow-distance));right:0;bottom:unset;left:0;margin:0 auto}.ha-advanced-tooltip-enable.ha-advanced-tooltip-bottom .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-bottom .ha-advanced-tooltip-content::after{top:unset;right:unset;bottom:100%;left:50%;border-color:transparent transparent var(--ha-tooltip-arrow-color) transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-left .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-left .ha-advanced-tooltip-content{top:50%;right:calc(101% + var(--ha-tooltip-arrow-distance));bottom:unset;left:unset;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-left .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-left .ha-advanced-tooltip-content::after{top:50%;right:unset;bottom:unset;left:100%;border-color:transparent transparent transparent var(--ha-tooltip-arrow-color);-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-right .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-right .ha-advanced-tooltip-content{top:50%;right:unset;bottom:unset;left:calc(101% + var(--ha-tooltip-arrow-distance));-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-right .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-right .ha-advanced-tooltip-content::after{top:50%;right:100%;bottom:unset;left:unset;border-color:transparent var(--ha-tooltip-arrow-color) transparent transparent;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-top .ha-advanced-tooltip-content{top:unset;right:0;bottom:calc(101% + var(--ha-tooltip-arrow-distance));left:0;margin:0 auto}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-top .ha-advanced-tooltip-content::after{top:100%;right:unset;bottom:unset;left:50%;border-color:var(--ha-tooltip-arrow-color) transparent transparent transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-bottom .ha-advanced-tooltip-content{top:calc(101% + var(--ha-tooltip-arrow-distance));right:0;bottom:unset;left:0;margin:0 auto}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-bottom .ha-advanced-tooltip-content::after{top:unset;right:unset;bottom:100%;left:50%;border-color:transparent transparent var(--ha-tooltip-arrow-color) transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-left .ha-advanced-tooltip-content{top:50%;right:calc(101% + var(--ha-tooltip-arrow-distance));bottom:unset;left:unset;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-left .ha-advanced-tooltip-content::after{top:50%;right:unset;bottom:unset;left:100%;border-color:transparent transparent transparent var(--ha-tooltip-arrow-color);-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-right .ha-advanced-tooltip-content{top:50%;right:unset;bottom:unset;left:calc(101% + var(--ha-tooltip-arrow-distance));-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-right .ha-advanced-tooltip-content::after{top:50%;right:100%;bottom:unset;left:unset;border-color:transparent var(--ha-tooltip-arrow-color) transparent transparent;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body.elementor-editor-active .happy-addon.ha-gravityforms .gform_wrapper{display:block!important}.ha-scroll-to-top-wrap.ha-scroll-to-top-hide{display:none}.ha-scroll-to-top-wrap.edit-mode,.ha-scroll-to-top-wrap.single-page-off{display:none!important}.ha-scroll-to-top-button{position:fixed;right:15px;bottom:15px;z-index:9999;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-ms-flex-align:center;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;width:50px;height:50px;border-radius:50px;background-color:#5636d1;color:#fff;text-align:center;opacity:1;cursor:pointer;-webkit-transition:all .3s;transition:all .3s}.ha-scroll-to-top-button i{color:#fff;font-size:16px}.ha-scroll-to-top-button:hover{background-color:#e2498a}
.elementor-8021 .elementor-element.elementor-element-f864b3a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor-8021 .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image:url("{{ $coverPhotoUrl }}");}.elementor-8021 .elementor-element.elementor-element-62d8811 .elementor-heading-title{font-size:34px;}.elementor-8021 .elementor-element.elementor-element-7bde821 .elementor-heading-title{font-size:34px;}.elementor-8021 .elementor-element.elementor-element-1df9f90 .elementor-heading-title{font-size:55px;}.elementor-8021 .elementor-element.elementor-element-7d61f84 .elementor-heading-title{font-size:55px;}.elementor-8021 .elementor-element.elementor-element-8211d57:not(.elementor-motion-effects-element-type-background), .elementor-8021 .elementor-element.elementor-element-8211d57 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image:url("{{ $coverPhotoUrl }}");}.elementor-8021 .elementor-element.elementor-element-7868560 .elementor-heading-title{font-size:34px;}.elementor-8021 .elementor-element.elementor-element-d8ad50b .elementor-heading-title{font-size:34px;}.elementor-8021 .elementor-element.elementor-element-1e2198b .elementor-heading-title{font-size:42px;}.elementor-8021 .elementor-element.elementor-element-c91c196 .elementor-heading-title{font-size:42px;}.elementor-8021 .elementor-element.elementor-element-f8c31f8 .elementor-heading-title{font-size:26px;}.elementor-8021 .elementor-element.elementor-element-98d7e88 .elementor-heading-title{font-size:26px;}.elementor-8021 .elementor-element.elementor-element-793af63 .elementor-heading-title{font-size:26px;}.elementor-8021 .elementor-element.elementor-element-493fd0f .elementor-heading-title{font-size:26px;}.elementor-8021 .elementor-element.elementor-element-ace10ab.elementor-view-stacked .elementor-icon{background-color:#7f96a8;}.elementor-8021 .elementor-element.elementor-element-ace10ab.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-ace10ab.elementor-view-default .elementor-icon{color:#7f96a8;border-color:#7f96a8;}.elementor-8021 .elementor-element.elementor-element-ace10ab.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-ace10ab.elementor-view-default .elementor-icon svg{fill:#7f96a8;}.elementor-8021 .elementor-element.elementor-element-7c6f2d3.elementor-view-stacked .elementor-icon{background-color:#ffffff;}.elementor-8021 .elementor-element.elementor-element-7c6f2d3.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-7c6f2d3.elementor-view-default .elementor-icon{color:#ffffff;border-color:#ffffff;}.elementor-8021 .elementor-element.elementor-element-7c6f2d3.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-7c6f2d3.elementor-view-default .elementor-icon svg{fill:#ffffff;}.elementor-8021 .elementor-element.elementor-element-17be9d8.elementor-view-stacked .elementor-icon{background-color:#000000;}.elementor-8021 .elementor-element.elementor-element-17be9d8.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-17be9d8.elementor-view-default .elementor-icon{color:#000000;border-color:#000000;}.elementor-8021 .elementor-element.elementor-element-17be9d8.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-17be9d8.elementor-view-default .elementor-icon svg{fill:#000000;}.elementor-8021 .elementor-element.elementor-element-404c5a5.elementor-view-stacked .elementor-icon{background-color:#000000;}.elementor-8021 .elementor-element.elementor-element-404c5a5.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-404c5a5.elementor-view-default .elementor-icon{color:#000000;border-color:#000000;}.elementor-8021 .elementor-element.elementor-element-404c5a5.elementor-view-framed .elementor-icon, .elementor-8021 .elementor-element.elementor-element-404c5a5.elementor-view-default .elementor-icon svg{fill:#000000;}
/*# sourceURL=elementor-frontend-inline-css */
</style>
<link rel='stylesheet' id='widget-image-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-image.min.css' media='all' />
<link rel='stylesheet' id='e-animation-rotateInDownRight-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/rotateInDownRight.css' media='all' />
<link rel='stylesheet' id='e-animation-zoomIn-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/zoomIn.css' media='all' />
<link rel='stylesheet' id='widget-heading-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-heading.min.css' media='all' />
<link rel='stylesheet' id='e-animation-fadeInUp-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInUp.css' media='all' />
<link rel='stylesheet' id='e-animation-shrink-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/e-animation-shrink.css' media='all' />
<link rel='stylesheet' id='swiper-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/swiper/v8/css/swiper.css' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/conditionals/e-swiper.css' media='all' />
<link rel='stylesheet' id='e-animation-fadeInDown-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInDown.css' media='all' />
<link rel='stylesheet' id='widget-spacer-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-spacer.min.css' media='all' />
<link rel='stylesheet' id='e-animation-rotateInUpLeft-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/rotateInUpLeft.css' media='all' />
<link rel='stylesheet' id='widget-countdown-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/widget-countdown.min.css' media='all' />
<link rel='stylesheet' id='widget-divider-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-divider.min.css' media='all' />
<link rel='stylesheet' id='widget-icon-list-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-icon-list.min.css' media='all' />
<link rel='stylesheet' id='jet-elements-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/jet-elements.css' media='all' />
<link rel='stylesheet' id='jet-timeline-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/addons/jet-timeline.css' media='all' />
<link rel='stylesheet' id='jet-timeline-skin-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/skin/jet-timeline.css' media='all' />
<link rel='stylesheet' id='e-animation-fadeIn-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeIn.css' media='all' />
<link rel='stylesheet' id='widget-gallery-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/widget-gallery.min.css' media='all' />
<link rel='stylesheet' id='elementor-gallery-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/e-gallery/css/e-gallery.css' media='all' />
<link rel='stylesheet' id='e-transitions-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/conditionals/transitions.min.css' media='all' />
<link rel='stylesheet' id='dce-copy-to-clipboard-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/copy-to-clipboard.css' media='all' />
<link rel='stylesheet' id='dce-prism-css-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism.min.css' media='all' />
<link rel='stylesheet' id='dce-prism-line-numbers-css-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-line-numbers.min.css' media='all' />
<link rel='stylesheet' id='e-animation-grow-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/e-animation-grow.css' media='all' />
<link rel='stylesheet' id='elementor-icons-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/eicons/css/elementor-icons.css' media='all' />
<link rel='stylesheet' id='elementor-post-7-css' href='/themes/3d-motion-05/uploads/elementor/css/post-7.css' media='all' />
<link rel='stylesheet' id='font-awesome-5-all-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/all.css' media='all' />
<link rel='stylesheet' id='font-awesome-4-shim-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/v4-shims.css' media='all' />
<link rel='stylesheet' id='elementor-post-8021-css' href='/themes/3d-motion-05/uploads/elementor/css/post-8021.css' media='all' />
<link rel='stylesheet' id='happy-icons-css' href='/themes/3d-motion-05/plugins/happy-elementor-addons/assets/fonts/style.min.css' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/font-awesome.css' media='all' />
<style id="jet-form-builder-honeypot-inline-css">

		.jfb-user-info,
		.jfb-user-info input {
			position: absolute !important;
			top: 0 !important;
			left: 0 !important;
			width: 1px !important;
			height: 1px !important;
			overflow: hidden !important;
			clip-path: inset(50%) !important;
			white-space: nowrap !important;
			user-select: none !important;
			-webkit-user-select: none !important;
			pointer-events: none !important;
		}
		
/*# sourceURL=jet-form-builder-honeypot-inline-css */
</style>
<link rel='stylesheet' id='elementor-gf-robotoslab-css' href='https://fonts.googleapis.com/css?family=Roboto+Slab:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-roboto-css' href='https://fonts.googleapis.com/css?family=Roboto:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-lexend-css' href='https://fonts.googleapis.com/css?family=Lexend:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-pinyonscript-css' href='https://fonts.googleapis.com/css?family=Pinyon+Script:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-cormorantinfant-css' href='https://fonts.googleapis.com/css?family=Cormorant+Infant:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-arefruqaa-css' href='https://fonts.googleapis.com/css?family=Aref+Ruqaa:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-notosanssorasompeng-css' href='https://fonts.googleapis.com/css?family=Noto+Sans+Sora+Sompeng:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-sora-css' href='https://fonts.googleapis.com/css?family=Sora:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-nunitosans-css' href='https://fonts.googleapis.com/css?family=Nunito+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/fontawesome.css' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-regular-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/regular.css' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-brands-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/brands.css' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-solid-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/solid.css' media='all' />
<script id="jquery-core-js-extra">
var aagb_local_object = {"ajax_url":"/themes/3d-motion-05/wp-admin/admin-ajax.php","nonce":"2f8960a399","licensing":"","assets":"/themes/3d-motion-05/plugins/advanced-accordion-block/assets/"};
//# sourceURL=jquery-core-js-extra
</script>
<script id="jquery-core-js" src="/themes/3d-motion-05/wp-includes/js/jquery/jquery.js"></script>
<script id="jquery-migrate-js" src="/themes/3d-motion-05/wp-includes/js/jquery/jquery-migrate.js"></script>
<script id="font-awesome-4-shim-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/js/v4-shims.js"></script>
<script id="dom-purify-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/vendor/dom-purify/purify.min.js"></script>
<meta name="generator" content="WordPress 7.0.4" />
	<meta name="color-scheme" content="light dark">
	<meta name="google" content="notranslate" />
	<script>
		jQuery(function($) {
			$("[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
		});
	</script>
<meta name="generator" content="Elementor 4.1.4; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
<script type="text/javascript">
        function hardReload() {
            localStorage.removeItem('hardReload');
            window.location.reload(true);
        }
        window.addEventListener('beforeunload', function (event) {
            localStorage.setItem('hardReload', 'true');
        });
        if (localStorage.getItem('hardReload') === 'true') {
            hardReload();
        }
        window.onbeforeunload = function () {
            window.scrollTo(0, 0);
        };
</script>
			<style>
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
				.e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
					background-image: none !important;
				}
				@media screen and (max-height: 1024px) {
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
				@media screen and (max-height: 640px) {
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
					.e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
						background-image: none !important;
					}
				}
			</style>
			<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T4B3LZ2');</script>
<!-- End Google Tag Manager --><link rel="icon" href="/themes/3d-motion-05/uploads/2024/10/cropped-cropped-icon-invisimple-32x32.png" sizes="32x32" />
<link rel="icon" href="/themes/3d-motion-05/uploads/2024/10/cropped-cropped-icon-invisimple-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="/themes/3d-motion-05/uploads/2024/10/cropped-cropped-icon-invisimple-180x180.png" />
<meta name="msapplication-TileImage" content="/themes/3d-motion-05/uploads/2024/10/cropped-cropped-icon-invisimple-270x270.png" />
<style id="wp-custom-css">
body{
	margin: 0 auto;
}

.elementor-widget-button{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

.elementor-widget-image img{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

img{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

a{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

svg{
	-webkit-tap-highlight-color: rgba(0,0,0,0);
}

p{
	margin-block-start: 0;
	margin-block-end: 0;
}

input[type="datetime-local"] {
  color-scheme: light;
}

textarea.form-control {
    min-height: 125px !important;
}

.btn-menu-mobile{
	color: #FFF !important
}

.child{
background-color: red !important
}

button.jet-form-builder__submit{
	justify-content: center !important;
	width: 100%;
}

.jet-form-builder-repeater__remove {
    margin: 0 0 0 10px;
    text-decoration: none !important;
    font-size: 14px;
    color: #FFFFFF;
    background: #EE1E1E;
    border: 2px solid #EE1E1E;
	border-radius: 8px;
}

.jet-form-builder-repeater__remove:hover {
		scale: 0.85;
    color: #FFF;
    background: #9E1414;
    border: 2px solid #9E1414;
		
}

.jet-form-builder__field-label.for-checkbox :checked+span::before{
font-size: 20px;
background-color: #0da88c !important;
}

.jet-form-builder__field-label>span::before{
font-size: 20px !important;
border-style: solid;
border-width: 2px 2px 2px 2px !important;
border-color: #0da88c !important;
}

.field-type-radio-field{
	text-align: center;
	align-items: center;
}

.jet-form-builder__field-wrap.checkradio-wrap{
margin-right: 15px;
    margin-left: 15px;
}

.checkradio-wrap{
	display: flex;
	flex-direction: row;
	flex-wrap: nowrap;
	width: auto !important
}

.jet-form-builder__field-label.for-radio :checked+span::before{
	background-color: #0da88c !important;
}

.jet-form-builder__fields-group{
	display: flex !important;
    flex-direction: row !important;
}

.jet-form-builder-file-upload__file-remove svg {
    display: none;
}

.jet-form-builder-file-upload__file-remove::after {
	  content: "\f14e" !important;
    font-family: "bootstrap-icons";
    font-size: 12px;
    color: white;
    padding: 2px 4px;
    border-radius: 4px;
}

.jet-form-builder-file-upload__file-invalid-marker{
		top: auto !important;
    right: auto !important;
    background-color: rgb(255 0 0 / 100%) !important;
    bottom: 0 !important;
    width: 100% !important;
    border-radius: 0 0 4px 4px !important;
    height: 20px !important;
	font-family: Inter, Helvetica, sans-serif !important;
}

.jet-form-builder-file-upload__file-invalid-marker svg{
    display:none;
}

.jet-form-builder-file-upload__file-invalid-marker::before{
    content:"File tidak sesuai!";
    color:#FFF;
    font-size:10px;
    font-weight:600;
}

/* DESKTOP + TABLET = 4 KOLOM */
.wds-jfb-image-field.is-gallery .wds-jfb-image-field__items {
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
}


/* HP = 2 KOLOM */
@media (max-width: 767px) {
    .wds-jfb-image-field.is-gallery .wds-jfb-image-field__items {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
			padding: 0em 1.5em !important;
    }
}

.wds-jfb-image-field__overlay-action.is-remove{
	right: 7px;
    background: red !important;
    color: white !important;
}

.wds-jfb-image-field__overlay-action.is-remove:hover{
	scale: 0.97 !important;
	color: white !important;
}

.wds-jfb-image-crop__ratio-preview{
	display: block !important
}

#kt_scrolltop{
	display: none !important;
}
</style>

<style id="custom-theme-photo-overrides">
/* ==================================================== */
/* 1. COVER HERO ARCH FRAME (TERCROP DENGAN BINGKAI)     */
/* ==================================================== */
.elementor-element-bd19d27,
.elementor-element-3b92468,
.elementor-element-2d5c7db {
    width: 210px !important;
    height: 280px !important;
    max-width: 210px !important;
    max-height: 280px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    border-radius: 125px 125px 125px 125px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    z-index: 1 !important;
}

.elementor-element-f864b3a,
.elementor-element-f864b3a > .elementor-widget-wrap,
.elementor-element-f864b3a > .elementor-element-populated,
.elementor-element-f864b3a .elementor-motion-effects-layer,
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap,
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer,
.elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap,
.elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer {
    width: 210px !important;
    height: 280px !important;
    max-width: 210px !important;
    max-height: 280px !important;
    border-radius: 125px 125px 125px 125px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    background-image: url("{{ $coverPhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $coverPhotoUrl }}") !important;
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
    z-index: 1 !important;
}

.elementor-element-f864b3a > .elementor-widget-wrap,
.elementor-element-f864b3a > .elementor-element-populated {
    border: 4px double #FFFCF3 !important;
    box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.18) !important;
    box-sizing: border-box !important;
}

/* ==================================================== */
/* 2. INTRO COUPLE FRAME (BINGKAI PASANGAN INTRO)        */
/* ==================================================== */
.elementor-element-3f3f28c,
.elementor-element-3f3f28c > .elementor-widget-wrap,
.elementor-element-3f3f28c > .elementor-element-populated,
.elementor-element-3f3f28c .elementor-background-slideshow,
.elementor-element-3f3f28c .elementor-background-slideshow__slide,
.elementor-element-3f3f28c .elementor-background-slideshow__slide__image {
    border-radius: 24px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    background-image: url("{{ $coverPhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $coverPhotoUrl }}") !important;
    background-size: cover !important;
    background-position: center center !important;
    z-index: 1 !important;
}

/* ==================================================== */
/* 3. BRIDE & GROOM PROFILE FRAMES                       */
/* ==================================================== */
.elementor-element-9fbe232,
.elementor-element-7271310 {
    width: 210px !important;
    height: 280px !important;
    max-width: 210px !important;
    max-height: 280px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    border-radius: 125px 125px 125px 125px !important;
}

.elementor-element-6c9a0c8,
.elementor-element-2e841c6 {
    width: 210px !important;
    height: 280px !important;
    max-width: 210px !important;
    max-height: 280px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    border-radius: 125px 125px 125px 125px !important;
    background-size: cover !important;
    background-position: center center !important;
    overflow: visible !important;
    z-index: 2 !important;
}

.elementor-element-6c9a0c8 {
    background-image: url("{{ $bridePhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $bridePhotoUrl }}") !important;
}

.elementor-element-2e841c6 {
    background-image: url("{{ $groomPhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $groomPhotoUrl }}") !important;
}

.elementor-element-6c9a0c8 > .elementor-widget-wrap,
.elementor-element-6c9a0c8 > .elementor-element-populated,
.elementor-element-2e841c6 > .elementor-widget-wrap,
.elementor-element-2e841c6 > .elementor-element-populated {
    border-radius: 125px 125px 125px 125px !important;
    overflow: visible !important;
}

.elementor-element-164087a > .elementor-widget-wrap,
.elementor-element-680875c > .elementor-widget-wrap,
.elementor-element-89ab320 > .elementor-widget-wrap {
    overflow: visible !important;
}

.elementor-element-6c9a0c8 .elementor-background-slideshow,
.elementor-element-6c9a0c8 .elementor-background-slideshow__slide,
.elementor-element-6c9a0c8 .elementor-background-slideshow__slide__image,
.elementor-element-2e841c6 .elementor-background-slideshow,
.elementor-element-2e841c6 .elementor-background-slideshow__slide,
.elementor-element-2e841c6 .elementor-background-slideshow__slide__image {
    width: 210px !important;
    height: 280px !important;
    border-radius: 125px 125px 125px 125px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    background-size: cover !important;
    background-position: center center !important;
}

/* ==================================================== */
/* 4. SAVE THE DATE & CLOSING FRAMES                     */
/* ==================================================== */
.elementor-element-7ce6984,
.elementor-element-7ce6984 > .elementor-widget-wrap,
.elementor-element-7ce6984 > .elementor-element-populated,
.elementor-element-7ce6984 .elementor-background-slideshow,
.elementor-element-7ce6984 .elementor-background-slideshow__slide,
.elementor-element-7ce6984 .elementor-background-slideshow__slide__image {
    border-radius: 24px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    background-image: url("{{ $saveTheDateUrl }}") !important;
    --e-bg-lazyload: url("{{ $saveTheDateUrl }}") !important;
    background-size: cover !important;
    background-position: center center !important;
    z-index: 1 !important;
}

.elementor-element-8734b90,
.elementor-element-8734b90 > .elementor-widget-wrap,
.elementor-element-8734b90 > .elementor-element-populated,
.elementor-element-8734b90 .elementor-background-slideshow,
.elementor-element-8734b90 .elementor-background-slideshow__slide,
.elementor-element-8734b90 .elementor-background-slideshow__slide__image {
    border-radius: 24px !important;
    overflow: hidden !important;
    -webkit-mask-image: -webkit-radial-gradient(white, black) !important;
    background-image: url("{{ $closingPhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $closingPhotoUrl }}") !important;
    background-size: cover !important;
    background-position: center center !important;
    z-index: 1 !important;
}
.elementor-element-555937f,
.elementor-element-555937f > .elementor-widget-wrap,
.elementor-element-555937f .elementor-background-slideshow__slide__image {
    background-image: url("{{ $coverPhotoUrl }}") !important;
    --e-bg-lazyload: url("{{ $coverPhotoUrl }}") !important;
    background-size: cover !important;
    background-position: center center !important;
}

/* ==================================================== */
/* 5. DECORATIVE FLOWER ELEMENTS (ALWAYS IN FRONT)      */
/* ==================================================== */
.elementor-element-e762753,
.elementor-element-1df4ace,
.elementor-element-45fb361,
.elementor-element-36c53cf,
.elementor-element-d55bcc8,
.elementor-element-40baf10,
.elementor-element-625c7f7,
.elementor-element-c52a3ca,
.elementor-element-912ff38,
.elementor-element-3527a19,
.elementor-element-43feb16,
.elementor-element-ff63a9d,
.elementor-element-184a798,
.elementor-widget-image.elementor-absolute {
    z-index: 25 !important;
}

.elementor-element-e762753 img,
.elementor-element-1df4ace img,
.elementor-element-45fb361 img,
.elementor-element-36c53cf img,
.elementor-element-d55bcc8 img,
.elementor-element-40baf10 img,
.elementor-element-625c7f7 img,
.elementor-element-c52a3ca img,
.elementor-element-912ff38 img,
.elementor-element-3527a19 img,
.elementor-element-43feb16 img,
.elementor-element-ff63a9d img,
.elementor-element-184a798 img,
img[src*="Garden-05-Couple"],
img[src*="Garden-05-Bouquet"],
.wp-image-8036,
.wp-image-8037 {
    position: relative !important;
    z-index: 25 !important;
    pointer-events: none !important;
}
</style>

</head>
<body class="wp-singular post-template-default single single-post postid-8019 single-format-standard wp-custom-logo wp-embed-responsive wp-theme-weddingsaas-wp wp-child-theme-weddingsaas-wp-child elementor-default elementor-template-full-width elementor-kit-7 elementor-page-8021 elementor-page-916707 elementor-page-843619 elementor-page-843600 elementor-page-805683">

	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4B3LZ2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->		<div data-elementor-type="single-post" data-post-id="8019" data-obj-id="8019" data-elementor-id="8021" class="elementor elementor-8021 e-post-8019 elementor-location-single post-8019 post type-post status-publish format-standard has-post-thumbnail hentry category-pernikahan template-pernikahan-3d-motion-05" data-elementor-settings="{&quot;ha_cmc_init_switcher&quot;:&quot;no&quot;}" data-elementor-post-type="elementor_library">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-5652679 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="5652679" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-156ac58 elementor-hidden-mobile" data-id="156ac58" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-c8cb692" data-id="c8cb692" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section data-dce-background-overlay-color="#FFFFFF00" class="elementor-section elementor-inner-section elementor-element elementor-element-f32cf06 elementor-section-full_width elementor-section-height-min-height elementor-section-content-middle wdsdv-enabled--yes elementor-section-height-default" data-id="f32cf06" data-element_type="section" data-e-type="section" id="cover" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:8034,&quot;url&quot;:&quot;\/themes\/3d-motion-05\/uploads\/2024\/10\/Garden-05-Ayat.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-89ab320" data-id="89ab320" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-e762753 elementor-widget__width-auto elementor-absolute animated-slow elementor-invisible elementor-widget elementor-widget-image" data-id="e762753" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownLeft&quot;,&quot;_animation_delay&quot;:600}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
				<div class="elementor-element elementor-element-1df4ace elementor-widget__width-auto elementor-absolute animated-slow e-transform elementor-invisible elementor-widget elementor-widget-image" data-id="1df4ace" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownRight&quot;,&quot;_animation_delay&quot;:1400,&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-153f83d elementor-invisible elementor-widget elementor-widget-heading" data-id="153f83d" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-4206b69 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4206b69" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-c4a6832" data-id="c4a6832" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-bd19d27 elementor-section-full_width animated-slow elementor-section-height-default elementor-section-height-default elementor-invisible" data-id="bd19d27" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;zoomIn&quot;,&quot;animation_delay&quot;:400}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3b92468" data-id="3b92468" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-f606bee elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="f606bee" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-05e36f9" data-id="05e36f9" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-2d5c7db elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="2d5c7db" data-element_type="section" data-e-type="section" style="width: 210px !important; height: 280px !important; margin: 0 auto !important; border-radius: 125px !important; overflow: hidden !important;" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default" style="width: 100% !important; height: 100% !important;">
					<div data-dce-background-image-url="{{ $coverPhotoUrl }}" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-f864b3a" style="background-image: url('{{ $coverPhotoUrl }}') !important; background-size: cover !important; background-position: center center !important; border-radius: 125px !important; overflow: hidden !important; width: 210px !important; height: 280px !important; margin: 0 auto !important;" data-id="f864b3a" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated" style="border-radius: 125px !important; overflow: hidden !important; border: 4px double #FFFCF3 !important; width: 100% !important; height: 100% !important; box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important; box-sizing: border-box !important;">
							</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-62d8811 wdsdv-enabled--yes playball elementor-invisible elementor-widget elementor-widget-heading" data-id="62d8811" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-c976d75 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="c976d75" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Kepada Yth.<br>Bapak/Ibu/Saudara/i</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-f558323 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="f558323" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:1400}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $guestName ?? ($to ?? 'Tamu Undangan') }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-e754120 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="e754120" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:1800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">*Mohon maaf jika ada kesalahan dalam penulisan nama / gelar.</h2>				</div>
				</div>
				<div data-dce-background-color="#7F96A8" class="elementor-element elementor-element-686eff4 elementor-align-center elementor-mobile-align-center animated-slow elementor-invisible elementor-widget elementor-widget-button" data-id="686eff4" data-element_type="widget" data-e-type="widget" id="btn_open" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:2200}" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-size-sm elementor-animation-shrink" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="far fa-envelope-open"></i>			</span>
									<span class="elementor-button-text">Buka Undangan</span>
					</span>
					</a>
				</div>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-3333be1 elementor-section-height-min-height elementor-section-full_width elementor-section-content-middle elementor-section-height-default" data-id="3333be1" data-element_type="section" data-e-type="section" id="slideAwal" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e642c2a" data-id="e642c2a" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-5f8f911 elementor-section-full_width elementor-section-height-min-height elementor-section-content-middle motionSection elementor-section-height-default" data-id="5f8f911" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;video&quot;,&quot;background_video_link&quot;:&quot;\/themes\/3d-motion-05\/uploads\/2025\/10\/05.-FOUNTAIN-GARDEN-15S.mp4&quot;,&quot;background_play_once&quot;:&quot;yes&quot;,&quot;background_play_on_mobile&quot;:&quot;yes&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
								<div class="elementor-background-video-container">
													<video class="elementor-background-video-hosted" role="presentation" autoplay muted playsinline></video>
											</div>
								<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-f851d08" data-id="f851d08" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-01fb214 elementor-section-full_width elementor-section-content-top elementor-section-height-default elementor-section-height-default" data-id="01fb214" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;video&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-4e75036 kolomPertama" data-id="4e75036" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#333333" class="elementor-element elementor-element-13c46f6 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="13c46f6" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-21b2c51 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="21b2c51" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-656cc9a" data-id="656cc9a" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-1e2198b wdsdv-enabled--yes animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="1e2198b" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }}<br><span style="font-family:aston-script;font-size:24px;font-weight:normal;color:#333">&amp;</span><br>{{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-0537883 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="0537883" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['date'] ?? 'Minggu, 28 Desember 2027' }}</p>				</div>
				</div>
				<div class="elementor-element elementor-element-4705908 elementor-widget__width-auto elementor-widget-mobile__width-auto animated-slow elementor-invisible elementor-widget elementor-widget-html" data-id="4705908" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;_animation_delay&quot;:1200}" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script src="https://unpkg.com/@@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

    <dotlottie-player src="/themes/3d-motion-05/uploads/2025/12/LOTTIE-MOUSE-HITAM.json" background="transparent" speed="1" style="width: 40px; height: 40px;" loop autoplay></dotlottie-player>
<script>
    document.querySelector('.kolomPertama').setAttribute("data-delay-time", 10500);
</script>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-d1acbe0 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="d1acbe0" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-image-url="{{ $data['cover_image'] ?? '/themes/3d-motion-05/uploads/2024/10/Garden-05-Ayat.jpg' }}" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8c54868" data-id="8c54868" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div class="elementor-element elementor-element-45fb361 elementor-widget__width-auto elementor-absolute animated-slow inv-kiri elementor-invisible elementor-widget elementor-widget-image" data-id="45fb361" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownLeft&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
				<div class="elementor-element elementor-element-36c53cf elementor-widget__width-auto elementor-absolute animated-slow inv-kanan elementor-invisible elementor-widget elementor-widget-image" data-id="36c53cf" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownRight&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-d1eab11 elementor-section-full_width elementor-section-height-min-height wdsdv-enabled--yes inv-zoom-in elementor-section-height-default" data-id="d1eab11" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3f3f28c reveal" style="background-image: url('{{ $coverPhotoUrl }}') !important; background-size: cover !important; background-position: center !important;" data-id="3f3f28c" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:7661,&quot;url&quot;:&quot;{{ $coverPhotoUrl }}&quot;},{&quot;id&quot;:7662,&quot;url&quot;:&quot;{{ $saveTheDateUrl }}&quot;},{&quot;id&quot;:7663,&quot;url&quot;:&quot;{{ $closingPhotoUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-e1eda62 elementor-widget elementor-widget-spacer" data-id="e1eda62" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-ee48c72 elementor-section-full_width inv-atas elementor-section-height-default elementor-section-height-default" data-id="ee48c72" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-color="#F5F7F8" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-68f7698 reveal" data-id="68f7698" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-36f21b0 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="36f21b0" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-b562819" data-id="b562819" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-d94709f elementor-widget__width-auto elementor-widget-mobile__width-auto elementor-widget elementor-widget-heading" data-id="d94709f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">P</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-a63425f elementor-widget__width-auto elementor-widget elementor-widget-image" data-id="a63425f" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="272" height="300" src="/themes/3d-motion-05/uploads/2024/10/05.png" class="attachment-full size-full wp-image-8070" alt="" />															</div>
				</div>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-347cdf7 elementor-widget__width-auto elementor-widget-mobile__width-auto elementor-widget elementor-widget-heading" data-id="347cdf7" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">A</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-6d8ceb9 elementor-widget elementor-widget-spacer" data-id="6d8ceb9" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-a8508d0 elementor-widget elementor-widget-heading" data-id="a8508d0" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">"{{ $data['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.' }}"</p>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-a889795 elementor-widget elementor-widget-heading" data-id="a889795" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ $data['quote_source'] ?? 'Q.S Ar-Rum : 21' }}</p>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-9751aa3 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="9751aa3" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-color="#F5F7F8" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-412717f" data-id="412717f" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-6abf555 inv-bawah wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6abf555" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-70ca1ce" data-id="70ca1ce" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#333333" class="elementor-element elementor-element-0c3e8c2 wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="0c3e8c2" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Bride &amp; Groom</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-028a68a inv-atas elementor-widget elementor-widget-heading" data-id="028a68a" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default"><b>Assalamu’alaikum Warahmatullahi Wabarakatuh</b><br />
<br />
Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah semoga ridho-Mu tercurah mengiringi pernikahan kami.</p>				</div>
				</div>
				<div class="elementor-element elementor-element-d51a091 elementor-widget elementor-widget-spacer" data-id="d51a091" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-6f75920 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6f75920" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-652bb70" data-id="652bb70" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9a76218 elementor-section-full_width wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="9a76218" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-9cdd4ed inv-zoom-in" data-id="9cdd4ed" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-bb83457 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="bb83457" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-b3a84d2" data-id="b3a84d2" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-d55bcc8 elementor-widget__width-auto elementor-absolute animated-slow elementor-invisible elementor-widget elementor-widget-image" data-id="d55bcc8" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-9fbe232 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="9fbe232" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6c9a0c8" style="background-image: url('{{ $bridePhotoUrl }}') !important; background-size: cover !important; background-position: center !important; border-radius: 125px !important;" data-id="6c9a0c8" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:7664,&quot;url&quot;:&quot;{{ $bridePhotoUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-40baf10 elementor-widget__width-auto elementor-absolute animated-slow elementor-invisible elementor-widget elementor-widget-image" data-id="40baf10" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownRight&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-328f28e inv-atas elementor-widget elementor-widget-heading" data-id="328f28e" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-f8c31f8 inv-atas elementor-widget elementor-widget-heading" data-id="f8c31f8" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['name'] ?? 'Putri Cantika Sari' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-e38c59e inv-atas elementor-widget elementor-widget-heading" data-id="e38c59e" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putri {{ $data['bride']['child_order'] ?? 'Pertama' }} dari</p>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-71adc5e inv-atas elementor-widget elementor-widget-heading" data-id="71adc5e" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ (!empty($data['bride']['father']) || !empty($data['bride']['mother'])) ? (($data['bride']['father'] ? 'Bapak ' . $data['bride']['father'] : '') . ($data['bride']['father'] && $data['bride']['mother'] ? ' dan ' : '') . ($data['bride']['mother'] ? 'Ibu ' . $data['bride']['mother'] : '')) : 'Bapak Abdul Rozak dan Ibu Adelia Marni' }}</p>				</div>
				</div>
				<div data-dce-background-color="#7F96A8" class="elementor-element elementor-element-7172afa wdsdv-enabled--yes elementor-align-center elementor-mobile-align-center inv-zoom-in elementor-widget elementor-widget-button" data-id="7172afa" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="https://www.instagram.com/{{ ltrim($data['bride']['instagram'] ?? 'user_ig_wanita', '@') }}/" target="_blank" rel="nofollow">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fab fa-instagram"></i>			</span>
									<span class="elementor-button-text">{{ ltrim($data['bride']['instagram'] ?? 'user_ig_wanita', '@') }}</span>
					</span>
					</a>
				</div>
								</div>
				</div>
				<div class="elementor-element elementor-element-ea27043 elementor-widget__width-inherit inv-zoom-in elementor-widget elementor-widget-image" data-id="ea27043" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="272" height="300" src="/themes/3d-motion-05/uploads/2024/10/05.png" class="attachment-full size-full wp-image-8070" alt="" />															</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-57a3914 elementor-section-full_width wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="57a3914" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-164087a inv-zoom-in" data-id="164087a" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9de7d5b elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="9de7d5b" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-680875c" data-id="680875c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-625c7f7 elementor-widget__width-auto elementor-absolute animated-slow elementor-invisible elementor-widget elementor-widget-image" data-id="625c7f7" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-7271310 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="7271310" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2e841c6 wdsdv-enabled--yes" style="background-image: url('{{ $groomPhotoUrl }}') !important; background-size: cover !important; background-position: center !important; border-radius: 125px !important;" data-id="2e841c6" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:7666,&quot;url&quot;:&quot;{{ $groomPhotoUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-c52a3ca elementor-widget__width-auto elementor-absolute animated-slow elementor-invisible elementor-widget elementor-widget-image" data-id="c52a3ca" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInUpLeft&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-3f814ac inv-atas elementor-widget elementor-widget-heading" data-id="3f814ac" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-98d7e88 inv-atas elementor-widget elementor-widget-heading" data-id="98d7e88" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['groom']['name'] ?? 'Putra Andika Pratama' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-8c62d5f inv-atas elementor-widget elementor-widget-heading" data-id="8c62d5f" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putra {{ $data['groom']['child_order'] ?? 'Pertama' }} dari</p>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-8856193 inv-atas elementor-widget elementor-widget-heading" data-id="8856193" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ (!empty($data['groom']['father']) || !empty($data['groom']['mother'])) ? (($data['groom']['father'] ? 'Bapak ' . $data['groom']['father'] : '') . ($data['groom']['father'] && $data['groom']['mother'] ? ' dan ' : '') . ($data['groom']['mother'] ? 'Ibu ' . $data['groom']['mother'] : '')) : 'Bapak Deni Bastian dan Ibu Aisha Dania' }}</p>				</div>
				</div>
				<div data-dce-background-color="#7F96A8" class="elementor-element elementor-element-99d4e30 wdsdv-enabled--yes elementor-align-center elementor-mobile-align-center inv-zoom-in elementor-widget elementor-widget-button" data-id="99d4e30" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="https://www.instagram.com/{{ ltrim($data['groom']['instagram'] ?? 'user_ig_pria', '@') }}/" target="_blank" rel="nofollow">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fab fa-instagram"></i>			</span>
									<span class="elementor-button-text">{{ ltrim($data['groom']['instagram'] ?? 'user_ig_pria', '@') }}</span>
					</span>
					</a>
				</div>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-overlay-color="#7F96A8" class="elementor-section elementor-inner-section elementor-element elementor-element-28eadb5 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="28eadb5" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6c87e46" data-id="6c87e46" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-43278da elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="43278da" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7ce6984 inv-zoom-in" style="background-image: url('{{ $saveTheDateUrl }}') !important; background-size: cover !important; background-position: center !important;" data-id="7ce6984" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:7668,&quot;url&quot;:&quot;{{ $saveTheDateUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-ac89744 elementor-widget elementor-widget-spacer" data-id="ac89744" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-6c4d235 inv-atas elementor-widget elementor-widget-heading" data-id="6c4d235" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Save The Date</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-3a9ab45 inv-atas elementor-countdown--label-block elementor-widget elementor-widget-countdown" data-id="3a9ab45" data-element_type="widget" data-e-type="widget" data-widget_type="countdown.default">
				<div class="elementor-widget-container">
							<div class="elementor-countdown-wrapper" data-date="{{ strtotime($data['countdown_target'] ?? '2026-10-24 08:00:00') }}" >
			<div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-days"></span> <span class="elementor-countdown-label">Hari</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-hours"></span> <span class="elementor-countdown-label">Jam</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-minutes"></span> <span class="elementor-countdown-label">Menit</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-seconds"></span> <span class="elementor-countdown-label">Detik</span></div>		</div>
						</div>
				</div>
				<div data-dce-background-color="#FFFFFFED" class="elementor-element elementor-element-bcb8781 inv-atas elementor-align-center elementor-widget elementor-widget-wds_calendar" data-id="bcb8781" data-element_type="widget" data-e-type="widget" data-widget_type="wds_calendar.default">
				<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">

			<a href="{{ $data['google_calendar_url'] ?? '#' }}"  class="elementor-button-link elementor-button elementor-size-sm elementor-animation-shrink" target="_blank" rel="nofollow" role="button">		<span class="elementor-button-content-wrapper wds-flexbox">
							<span class="elementor-button-icon elementor-align-icon-row">
					<i aria-hidden="true" class="fas fa-calendar-check"></i>				</span>
						<span class="elementor-button-text">Simpan Tanggal</span>
		</span>
		</a>
			
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-912ff38 elementor-widget__width-auto elementor-absolute animated-slow inv-kiri elementor-invisible elementor-widget elementor-widget-image" data-id="912ff38" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownLeft&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
				<div class="elementor-element elementor-element-3527a19 elementor-widget__width-auto elementor-absolute animated-slow inv-kanan elementor-invisible elementor-widget elementor-widget-image" data-id="3527a19" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;rotateInDownRight&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-overlay-color="#7F96A8" class="elementor-section elementor-inner-section elementor-element elementor-element-c5dee11 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="c5dee11" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-849b242" data-id="849b242" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-43feb16 inv-zoom-in elementor-widget elementor-widget-image" data-id="43feb16" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img loading="lazy" width="1000" height="1000" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Bouquet.png" class="attachment-full size-full wp-image-8041" alt="" srcset="/themes/3d-motion-05/uploads/2024/10/Garden-05-Bouquet.png 1000w, /themes/3d-motion-05/uploads/2024/10/Garden-05-Bouquet-150x150.png 150w" sizes="(max-width: 1000px) 100vw, 1000px" />															</div>
				</div>
				<div class="elementor-element elementor-element-22bba19 elementor-widget elementor-widget-spacer" data-id="22bba19" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-989440a elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="989440a" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-color="#F5F7F8" data-dce-background-image-url="/themes/3d-motion-05/uploads/2024/10/Garden-05-Overlay.jpg" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-70a61fd inv-atas" data-id="70a61fd" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-479f0f5 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="479f0f5" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-overlay-color="#F5F7F8" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2e901c3" data-id="2e901c3" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div data-dce-title-color="#333333" class="elementor-element elementor-element-5deab6d playball elementor-widget elementor-widget-heading" data-id="5deab6d" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Akad Nikah</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-c148545 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="c148545" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#000000" class="elementor-element elementor-element-b17d2c6 playball elementor-widget elementor-widget-heading" data-id="b17d2c6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Minggu</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-6c857a7 elementor-widget elementor-widget-heading" data-id="6c857a7" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">28</h2>				</div>
				</div>
				<div data-dce-text-color="#333333" class="elementor-element elementor-element-4cf0710 elementor-align-center wdsdv-enabled--yes elementor-icon-list--layout-inline elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="4cf0710" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
										<span class="elementor-icon-list-text">Desember</span>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
										<span class="elementor-icon-list-text">2027</span>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-text-color="#333333" class="elementor-element elementor-element-839c710 elementor-align-center wdsdv-enabled--yes elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="839c710" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-clock"></i>						</span>
										<span class="elementor-icon-list-text">08:00 WIB</span>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-01d33be wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="01d33be" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Lokasi Acara</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-77c884f elementor-widget elementor-widget-heading" data-id="77c884f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default"><b>{{ $data['events']['akad']['venue'] ?? 'Menara 165' }}</b><br />{{ $data['events']['akad']['address'] ?? 'Jl. TB Simatupang Jakarta Selatan' }}</p>				</div>
				</div>
				<div data-dce-background-color="#7F96A8" class="elementor-element elementor-element-c75cc47 elementor-align-center wdsdv-enabled--yes elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="c75cc47" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="https://maps.app.goo.gl/TsZCeupoF4p6bksT6" target="_blank" rel="nofollow">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fas fa-map-marker-alt"></i>			</span>
									<span class="elementor-button-text">Google Maps</span>
					</span>
					</a>
				</div>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-8479d19 elementor-section-full_width wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="8479d19" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-color="#F5F7F8" data-dce-background-image-url="/themes/3d-motion-05/uploads/2024/10/Garden-05-Overlay.jpg" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ae5883f inv-atas" data-id="ae5883f" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-fc01eda elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="fc01eda" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-overlay-color="#F5F7F8" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e3da8d6" data-id="e3da8d6" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div data-dce-title-color="#333333" class="elementor-element elementor-element-6c2298e playball elementor-widget elementor-widget-heading" data-id="6c2298e" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Resepsi</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-a6a7245 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="a6a7245" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#000000" class="elementor-element elementor-element-750b47d elementor-widget elementor-widget-heading" data-id="750b47d" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Minggu</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-837124c elementor-widget elementor-widget-heading" data-id="837124c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">28</h2>				</div>
				</div>
				<div data-dce-text-color="#333333" class="elementor-element elementor-element-a9077c0 elementor-align-center wdsdv-enabled--yes elementor-icon-list--layout-inline elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="a9077c0" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
										<span class="elementor-icon-list-text">Desember</span>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
										<span class="elementor-icon-list-text">2027</span>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-text-color="#333333" class="elementor-element elementor-element-28d7359 elementor-align-center wdsdv-enabled--yes elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="28d7359" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-clock"></i>						</span>
										<span class="elementor-icon-list-text">09:00 - 13:00 WIB</span>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-76a0f9f wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="76a0f9f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Lokasi Acara</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-dd918d3 elementor-widget elementor-widget-heading" data-id="dd918d3" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default"><b>{{ $data['events']['akad']['venue'] ?? 'Menara 165' }}</b><br />{{ $data['events']['akad']['address'] ?? 'Jl. TB Simatupang Jakarta Selatan' }}</p>				</div>
				</div>
				<div data-dce-background-color="#7F96A8" class="elementor-element elementor-element-27179d2 elementor-align-center wdsdv-enabled--yes elementor-mobile-align-center elementor-widget elementor-widget-button" data-id="27179d2" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="https://maps.app.goo.gl/TsZCeupoF4p6bksT6" target="_blank" rel="nofollow">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fas fa-map-marker-alt"></i>			</span>
									<span class="elementor-button-text">Google Maps</span>
					</span>
					</a>
				</div>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				@if (!empty($data['stories']) && count($data['stories']) > 0)
				<section data-dce-background-color="#7F96A8" class="elementor-section elementor-inner-section elementor-element elementor-element-83dc9fe elementor-section-full_width elementor-section-content-middle wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="83dc9fe" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-b045cd2 reveal" data-id="b045cd2" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-3a7cc1c inv-atas elementor-widget elementor-widget-heading" data-id="3a7cc1c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Love Story</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-0994e59 inv-zoom-in elementor-widget elementor-widget-jet-timeline" data-id="0994e59" data-element_type="widget" data-e-type="widget" data-widget_type="jet-timeline.default">
				<div class="elementor-widget-container">
					<div class="elementor-jet-timeline jet-elements"><div class="jet-timeline jet-timeline--align-left jet-timeline--align-top">
	<div class="jet-timeline__line"><div class="jet-timeline__line-progress"></div></div>
	<div class="jet-timeline-list">
@foreach ($data['stories'] as $index => $story)
	<div class="jet-timeline-item jet-timeline-item--animated elementor-repeater-item-0363b0b-{{ $index }} jet-timeline-item--image-inside">
	<div class="timeline-item__card">
		<div class="timeline-item__card-inner">
				@php
					$storyImg = $story['image_url'] ?? $story['image'] ?? null;
				@endphp
				@if (!empty($storyImg))
				<div class="timeline-item__card-img"><img loading="lazy" width="1000" height="667" src="{{ $storyImg }}" class="attachment-full size-full" alt="{{ $story['title'] ?? 'Love Story' }}" decoding="async" /></div>
				@endif
				<div class="timeline-item__card-content">
					<div class="timeline-item__meta"></div>
					<h5 class="timeline-item__card-title">{{ strtoupper($story['date'] ?? $story['year'] ?? ($story['title'] ?? '')) }}</h5>
					@if (!empty($story['title']) && !empty($story['date'] ?? $story['year']))
					<div style="font-weight: 600; font-size: 13px; margin-bottom: 4px; color: #333333;">{{ $story['title'] }}</div>
					@endif
					<div class="timeline-item__card-desc">{{ $story['story'] ?? $story['desc'] ?? '' }}</div>
				</div>
		</div>
		<div class="timeline-item__card-arrow"></div>
	</div>
	<div class="timeline-item__point"><div class="timeline-item__point-content timeline-item__point-content--icon"><span class="jet-elements-icon"><i aria-hidden="true" class="fas fa-heart"></i></span></div></div><div class="timeline-item__meta"></div>
	</div>
@endforeach
	</div></div></div>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
@endif
				@if (!empty($data['galleries']) && count($data['galleries']) > 0)
				<section data-dce-background-overlay-color="#7F96A8" class="elementor-section elementor-inner-section elementor-element elementor-element-c76bd69 elementor-section-full_width elementor-section-content-middle jedv-enabled--yes wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="c76bd69" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-0f545c7" data-id="0f545c7" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-1dceb05 inv-atas elementor-widget elementor-widget-heading" data-id="1dceb05" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" style="font-family: 'Playball', cursive; font-size: 38px; color: #FFFFFF; text-align: center; margin: 0 0 20px; font-weight: normal; text-shadow: 0 2px 10px rgba(0,0,0,0.15); letter-spacing: 0.5px;">Our Moments</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-17f5026 wdsdv-enabled--yes inv-zoom-in elementor-widget elementor-widget-gallery" data-id="17f5026" data-element_type="widget" data-e-type="widget">
				<div class="elementor-widget-container">
					<div class="custom-mosaic-gallery" style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; padding: 0 10px 24px 10px; max-width: 440px; margin: 0 auto; box-sizing: border-box;">
						@php
							$totalPhotos = count($data['galleries']);
							$galleriesList = array_values($data['galleries']);
						@endphp

						@foreach ($galleriesList as $gIdx => $gPhoto)
							@php
								$cycle = $gIdx % 8;
								$remaining = $totalPhotos - $gIdx;

								if ($cycle === 0) {
									// Row 1 Left: narrower portrait (~33.3%)
									$colSpan = ($remaining === 1) ? 6 : 2;
									$cardHeight = ($remaining === 1) ? '240px' : '185px';
								} elseif ($cycle === 1) {
									// Row 1 Right: wider landscape (~66.7%)
									$colSpan = 4;
									$cardHeight = '185px';
								} elseif ($cycle === 2) {
									// Row 2: Col 1 of 3 (~33.3%)
									if ($remaining === 1) {
										$colSpan = 6;
										$cardHeight = '240px';
									} elseif ($remaining === 2) {
										$colSpan = 3;
										$cardHeight = '185px';
									} else {
										$colSpan = 2;
										$cardHeight = '185px';
									}
								} elseif ($cycle === 3) {
									// Row 2: Col 2 of 3 (~33.3%)
									if ($remaining === 1) {
										$colSpan = 4;
										$cardHeight = '185px';
									} else {
										$colSpan = 2;
										$cardHeight = '185px';
									}
								} elseif ($cycle === 4) {
									// Row 2: Col 3 of 3 (~33.3%)
									$colSpan = 2;
									$cardHeight = '185px';
								} elseif ($cycle === 5) {
									// Row 3: Full width landscape (100%)
									$colSpan = 6;
									$cardHeight = '240px';
								} elseif ($cycle === 6) {
									// Row 4: Col 1 of 2 (~50%)
									if ($remaining === 1) {
										$colSpan = 6;
										$cardHeight = '240px';
									} else {
										$colSpan = 3;
										$cardHeight = '185px';
									}
								} else { // $cycle === 7
									// Row 4: Col 2 of 2 (~50%)
									$colSpan = 3;
									$cardHeight = '185px';
								}
							@endphp
							<div
								class="mosaic-gallery-item"
								onclick="openGalleryModal({{ $gIdx }})"
								style="grid-column: span {{ $colSpan }}; height: {{ $cardHeight }}; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.14); position: relative; cursor: pointer; transition: transform 0.25s ease, box-shadow 0.25s ease; background-color: #CBD5E1;"
								onmouseover="this.style.transform='scale(1.02) translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.22)';"
								onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='0 4px 14px rgba(0,0,0,0.14)';"
							>
								<div
									style="width: 100%; height: 100%; background-image: url('{{ $gPhoto }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; transition: transform 0.4s ease;"
									onmouseover="this.style.transform='scale(1.05)';"
									onmouseout="this.style.transform='scale(1)';"
								></div>
								<div style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0) 65%, rgba(0,0,0,0.28) 100%); pointer-events: none;"></div>
							</div>
						@endforeach
					</div>
				</div>
				</div>
					</div>
		</div>
					</div>
		</section>

		<!-- GALLERY LIGHTBOX MODAL -->
		<div id="gallery_lightbox_modal" style="display: none; position: fixed; inset: 0; z-index: 999999; background: rgba(10, 15, 25, 0.94); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); align-items: center; justify-content: center; flex-direction: column; padding: 20px; box-sizing: border-box;" onclick="closeGalleryModal(event)">
			<button onclick="closeGalleryModal(event, true)" style="position: absolute; top: 18px; right: 18px; background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.3); color: #FFF; width: 42px; height: 42px; border-radius: 50%; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;">
				<i class="fas fa-times"></i>
			</button>
			<button id="modal_prev_btn" onclick="prevGalleryModal(event)" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.3); color: #FFF; width: 44px; height: 44px; border-radius: 50%; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;">
				<i class="fas fa-chevron-left"></i>
			</button>
			<button id="modal_next_btn" onclick="nextGalleryModal(event)" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.3); color: #FFF; width: 44px; height: 44px; border-radius: 50%; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: background 0.2s;">
				<i class="fas fa-chevron-right"></i>
			</button>
			<div style="max-width: 92vw; max-height: 82vh; display: flex; align-items: center; justify-content: center; position: relative;">
				<img id="gallery_lightbox_img" src="" style="max-width: 100%; max-height: 82vh; object-fit: contain; border-radius: 14px; box-shadow: 0 15px 50px rgba(0,0,0,0.6);" alt="Gallery view" />
			</div>
			<div id="gallery_lightbox_counter" style="margin-top: 14px; color: rgba(255,255,255,0.75); font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 500;"></div>
		</div>
@endif
				<section data-dce-background-overlay-color="#FAFDF9" class="elementor-section elementor-inner-section elementor-element elementor-element-c001933 elementor-section-full_width elementor-section-content-middle wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="c001933" data-element_type="section" data-e-type="section" style="background-color: #FAFDF9 !important; background: #FAFDF9 !important; padding: 48px 16px 40px; position: relative; z-index: 2;">
	<div class="elementor-background-overlay"></div>
	<div class="elementor-container elementor-column-gap-no">
		<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3158c5c" data-id="3158c5c" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated" style="max-width: 440px; margin: 0 auto; width: 100%;">
				<div class="elementor-background-overlay"></div>
				
				<!-- Heading -->
				<div class="elementor-element inv-atas elementor-widget elementor-widget-heading" style="text-align: center; margin-bottom: 8px;">
					<div class="elementor-widget-container">
						<h2 style="font-family: 'Playball', cursive; font-size: 42px; color: #1E293B; margin: 0; font-weight: 700; line-height: 1.2;">Wedding Gift</h2>
					</div>
				</div>

				<!-- Subtitle -->
				<div class="elementor-element inv-atas elementor-widget elementor-widget-heading" style="text-align: center; margin-bottom: 24px;">
					<div class="elementor-widget-container">
						<p style="font-family: 'Sora', sans-serif; font-size: 13px; color: #4B5563; font-weight: 500; line-height: 1.65; max-width: 400px; margin: 0 auto;">
							Doa Restu Anda merupakan karunia yang sangat berarti bagi kami. Dan jika memberi adalah ungkapan tanda kasih, Anda dapat memberi melalui rekening di bawah ini.
						</p>
					</div>
				</div>

				<!-- Bank Accounts & Gift Address Cards -->
				<div style="display: flex; flex-direction: column; gap: 16px; width: 100%;">
					@php
						$bankAccounts = $data['bank_accounts'] ?? [
							[
								'bank' => 'Bank Central Asia (BCA)',
								'account_number' => '8801 2345 67',
								'account_name' => $data['bride']['name'] ?? 'Putri Cantika Sari',
							],
							[
								'bank' => 'Bank Mandiri',
								'account_number' => '1370 0192 8374 1',
								'account_name' => $data['groom']['name'] ?? 'Putra Andika Pratama',
							]
						];
					@endphp

					@foreach($bankAccounts as $bank)
						<div style="background: linear-gradient(135deg, #7F96A8 0%, #4D6475 100%); border-radius: 20px; padding: 22px 20px; color: #FFFFFF; box-shadow: 0 10px 25px rgba(77, 100, 117, 0.25); text-align: left; position: relative; overflow: hidden; border: 1px solid rgba(255,255,255,0.25);">
							<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
								<span style="font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;">{{ $bank['bank'] ?? 'Rekening Bank' }}</span>
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
							</div>
							<div style="margin-bottom: 16px;">
								<span style="font-size: 10.5px; text-transform: uppercase; letter-spacing: 0.1em; opacity: 0.75; display: block; margin-bottom: 4px; font-family: 'Sora', sans-serif;">Nomor Rekening</span>
								<div style="font-family: 'Courier New', monospace; font-size: 18px; font-weight: bold; letter-spacing: 0.12em;">
									{{ $bank['account_number'] ?? '123456789' }}
								</div>
								<span style="font-size: 12px; opacity: 0.9; margin-top: 4px; display: block; font-family: 'Sora', sans-serif;">a.n {{ $bank['account_name'] ?? 'Mempelai' }}</span>
							</div>
							<button 
								type="button" 
								onclick="copyGiftText('{{ str_replace(' ', '', $bank['account_number'] ?? '') }}', 'Nomor Rekening {{ $bank['bank'] ?? '' }}')"
								style="display: inline-flex; align-items: center; gap: 7px; padding: 7px 14px; border-radius: 10px; background: rgba(255,255,255,0.18); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.3); color: #FFFFFF; font-size: 11.5px; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: 'Sora', sans-serif;"
								onmouseover="this.style.background='rgba(255,255,255,0.28)'"
								onmouseout="this.style.background='rgba(255,255,255,0.18)'"
							>
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
								<span>Salin No. Rekening</span>
							</button>
						</div>
					@endforeach

					@if(!empty($data['gift_address']))
						<div style="background: #FFFFFF; border-radius: 20px; padding: 22px 20px; color: #1E293B; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05); border: 1px solid rgba(127, 150, 168, 0.3); text-align: left;">
							<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
								<span style="font-family: 'Sora', sans-serif; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #5B7285;">Kirim Kado Fisik</span>
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5B7285" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
							</div>
							<p style="font-size: 12.5px; line-height: 1.6; color: #4B5563; margin: 0 0 12px; font-family: 'Sora', sans-serif;">
								{{ $data['gift_address'] }}
							</p>
							<button 
								type="button" 
								onclick="copyGiftText('{{ $data['gift_address'] }}', 'Alamat Pengiriman Kado')"
								style="display: inline-flex; align-items: center; gap: 7px; padding: 7px 14px; border-radius: 10px; background: #FAFDF9; border: 1px solid rgba(127, 150, 168, 0.4); color: #2C3E50; font-size: 11.5px; font-weight: 700; cursor: pointer; transition: all 0.2s; font-family: 'Sora', sans-serif;"
								onmouseover="this.style.background='#EEF4F8'"
								onmouseout="this.style.background='#FAFDF9'"
							>
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
								<span>Salin Alamat Lengkap</span>
							</button>
						</div>
					@endif
				</div>

			</div>
		</div>
	</div>
</section>
<section data-dce-background-overlay-color="#F5F7F8" class="elementor-section elementor-inner-section elementor-element elementor-element-731caf7 elementor-section-full_width elementor-section-content-middle wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="731caf7" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
	<div class="elementor-background-overlay"></div>
	<div class="elementor-container elementor-column-gap-no">
		<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ae2dba2" data-id="ae2dba2" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-background-overlay"></div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-5963b2e inv-atas elementor-widget elementor-widget-heading" data-id="5963b2e" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<div class="elementor-widget-container">
						<h2 class="elementor-heading-title elementor-size-default">Wishes</h2>
					</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-317081d inv-atas elementor-widget elementor-widget-heading" data-id="317081d" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<div class="elementor-widget-container">
						<p class="elementor-heading-title elementor-size-default">Berikan doa dan ucapan terbaik untuk kami.</p>
					</div>
				</div>
				<div class="elementor-element elementor-element-9a74557 inv-zoom-in elementor-widget" data-id="9a74557" data-element_type="widget" data-widget_type="html.default" style="max-width: 440px; margin: 0 auto; padding: 0 16px;">
					<div class="elementor-widget-container">
						<!-- WISH CARD FORM -->
						<div style="background: #FFFFFF; border-radius: 20px; padding: 22px 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid rgba(127, 150, 168, 0.25); text-align: left; margin-bottom: 24px;">
							<form id="klikmomen_wish_form" onsubmit="event.preventDefault(); return handleWishSubmit(event);">
								<div style="margin-bottom: 14px;">
									<label style="font-family: 'Sora', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Nama Lengkap</label>
									<input 
										type="text" 
										id="wish_name" 
										name="name" 
										required 
										value="{{ $guestName ?? ($to ?? '') }}" 
										placeholder="Nama Anda"
										style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Sora', sans-serif; outline: none; transition: border-color 0.2s;"
										onfocus="this.style.borderColor='#7F96A8'; this.style.boxShadow='0 0 0 3px rgba(127,150,168,0.2)';"
										onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';"
									>
								</div>

								<div style="margin-bottom: 14px;">
									<label style="font-family: 'Sora', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Konfirmasi Kehadiran</label>
									<select 
										id="wish_attendance" 
										name="attendance"
										style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Sora', sans-serif; outline: none; transition: border-color 0.2s; cursor: pointer;"
										onfocus="this.style.borderColor='#7F96A8'; this.style.boxShadow='0 0 0 3px rgba(127,150,168,0.2)';"
										onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';"
									>
										<option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
										<option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
										<option value="Masih Ragu">Masih Ragu</option>
										<option value="Tidak Hadir">Mohon Maaf, Tidak Bisa Hadir</option>
									</select>
								</div>

								<div style="margin-bottom: 18px;">
									<label style="font-family: 'Sora', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Pesan &amp; Doa Restu</label>
									<textarea 
										id="wish_message" 
										name="message" 
										rows="3" 
										required 
										placeholder="Tuliskan ucapan selamat &amp; doa restu Anda..."
										style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Sora', sans-serif; outline: none; resize: vertical; min-height: 80px; transition: border-color 0.2s;"
										onfocus="this.style.borderColor='#7F96A8'; this.style.boxShadow='0 0 0 3px rgba(127,150,168,0.2)';"
										onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none';"
									></textarea>
								</div>

								<button 
									type="button" 
									onclick="handleWishSubmit(event)"
									id="wish_btn_submit"
									style="width: 100%; padding: 13px 18px; border-radius: 14px; background: #7F96A8; color: #FFFFFF; font-family: 'Sora', sans-serif; font-weight: 700; font-size: 13px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(127,150,168,0.35); transition: all 0.2s;"
									onmouseover="this.style.opacity='0.92'; this.style.transform='translateY(-1px)';"
									onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)';"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(45deg); margin-top: -2px;"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
									<span>Kirim Ucapan &amp; Konfirmasi</span>
								</button>
							</form>
						</div>

						<!-- WISHES LIST STREAM -->
						<div id="wishes_stream_container" style="max-height: 380px; overflow-y: auto; padding-right: 2px; display: flex; flex-direction: column; gap: 12px;">
							@php
								$sampleWishes = $data['sample_wishes'] ?? [
									[
										'name' => 'Dimas & Anisa',
										'attendance' => 'Hadir (2 Orang)',
										'message' => "Selamat menempuh hidup baru " . ($data['bride']['nickname'] ?? 'Putri') . " & " . ($data['groom']['nickname'] ?? 'Andika') . "! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Bahagia selamanya!",
										'time' => '10 menit yang lalu'
									],
									[
										'name' => 'Keluarga Bpk. Hendrawan',
										'attendance' => 'Hadir (2 Orang)',
										'message' => "Barakallahu lakuma wa baraka 'alaikuma wa jama'a bainakuma fii khair. Selamat berbahagia!",
										'time' => '30 menit yang lalu'
									],
									[
										'name' => 'Sarah & Rekan Kerja',
										'attendance' => 'Hadir (1 Orang)',
										'message' => 'Happy wedding! Lancar sampai hari H yaa.',
										'time' => '1 jam yang lalu'
									]
								];
							@endphp

							@foreach($sampleWishes as $w)
								<div class="wish-item-card" style="background: #FFFFFF; border-radius: 16px; border: 1px solid #E2E8F0; padding: 14px 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); text-align: left;">
									<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">
										<span style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 13.5px; color: #1E293B;">{{ $w['name'] ?? 'Tamu' }}</span>
										<span style="background: #EEF4F8; color: #34495E; font-size: 9.5px; font-weight: 600; padding: 2px 8px; border-radius: 9999px; font-family: 'Sora', sans-serif; white-space: nowrap;">{{ $w['attendance'] ?? $w['status'] ?? 'Hadir' }}</span>
									</div>
									<p style="font-size: 12px; color: #4B5563; font-style: italic; line-height: 1.55; margin: 0 0 6px; font-family: 'Sora', sans-serif;">
										{{ $w['message'] ?? $w['msg'] ?? '' }}
									</p>
									<span style="font-size: 10px; color: #9CA3AF; display: block; text-align: right; font-family: 'Sora', sans-serif;">{{ $w['time'] ?? 'Baru saja' }}</span>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section data-dce-background-overlay-color="#F5F7F8" class="elementor-section elementor-inner-section elementor-element elementor-element-0445f91 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0445f91" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-86f959e" data-id="86f959e" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9cc1bdb elementor-section-full_width wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="9cc1bdb" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-906fcf5" data-id="906fcf5" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-10227c0 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default" data-id="10227c0" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3acc1a9" data-id="3acc1a9" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-ff63a9d elementor-widget__width-auto elementor-absolute animated-slow inv-atas elementor-invisible elementor-widget elementor-widget-image" data-id="ff63a9d" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-1.png" class="attachment-full size-full wp-image-8036" alt="" />															</div>
				</div>
				<div class="elementor-element elementor-element-184a798 elementor-widget__width-auto elementor-absolute animated-slow inv-atas elementor-invisible elementor-widget elementor-widget-image" data-id="184a798" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:1000}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img fetchpriority="high" width="500" height="600" src="/themes/3d-motion-05/uploads/2024/10/Garden-05-Couple-2.png" class="attachment-full size-full wp-image-8037" alt="" />															</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-33f718e elementor-section-full_width elementor-section-height-min-height elementor-section-height-default" data-id="33f718e" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8734b90 inv-zoom-out" style="background-image: url('{{ $closingPhotoUrl }}') !important; background-size: cover !important; background-position: center !important;" data-id="8734b90" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:7671,&quot;url&quot;:&quot;{{ $closingPhotoUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a1483fb elementor-widget elementor-widget-spacer" data-id="a1483fb" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-b214edc inv-atas elementor-widget elementor-widget-heading" data-id="b214edc" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Terima Kasih</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-07f424c inv-atas elementor-widget elementor-widget-heading" data-id="07f424c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Merupakan suatu kebahagiaan dan kehormatan bagi kami, apabila Bapak/Ibu/Saudara/i, berkenan hadir dan memberikan do’a restu kepada kami.<br />
<br />
<b>Wassalamu’alaikum warahmatullahi wabarakatuh</b></p>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-010a456 inv-atas elementor-widget elementor-widget-heading" data-id="010a456" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Kami Yang Berbahagia</p>				</div>
				</div>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-4ca0f89 wdsdv-enabled--yes inv-atas elementor-widget elementor-widget-heading" data-id="4ca0f89" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FAFDF9" style="background-color: #FAFDF9 !important; border-top: 1px solid #E2E8F0; padding: 48px 16px 40px;" class="elementor-section elementor-inner-section elementor-element elementor-element-cc953ce elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="cc953ce" data-element_type="section" data-e-type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1ce1d4d" data-id="1ce1d4d" data-element_type="column" data-e-type="column">
            <div class="klikmomen-signature-footer" style="text-align: center; max-width: 420px; margin: 0 auto; padding: 4px 12px; font-family: 'Sora', sans-serif;">
							<div style="font-size: 11px; color: #7B8F82; display: flex; align-items: center; justify-content: center; gap: 7px;">
								<a href="{{ route('themes.catalog') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; text-decoration: none; color: inherit; transition: opacity 0.2s;">
									<span style="font-size: 11px; color: #4A6354;">
										Platform Undangan Digital oleh KlikMomen.id
									</span>
								</a>
							</div>
						</div>
        </div>
    </div>
</section>
<section class="elementor-section elementor-inner-section elementor-element elementor-element-651aeac elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="651aeac" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8bb700e" data-id="8bb700e" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3a875fa elementor-widget elementor-widget-html" data-id="3a875fa" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> 
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" ></script>
<script>
var cover = document.getElementById('cover');
var btn_open = document.getElementById('btn_open');
let delaySection = 0;
const isEditorActive = document.body.classList.contains('elementor-editor-active');

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.motionSection .elementor-background-video-container video').removeAttribute('autoplay');
    document.querySelector('.kolomPertama').style.display = 'none';

    delaySection = document.querySelector('.kolomPertama').dataset.delayTime;
});

if (typeof elementorFrontendConfig === 'undefined') {
    disableScrolling();
    document.body.style.height = "100vh";
    btn_open.onclick = function() {
        enableScrolling();
        closeCover();
        myFunction();
    };

}

function myFunction() {
    setTimeout(() => {
        document.querySelector('.motionSection .elementor-background-video-container video').play();
    }, 100);

    setTimeout(() => {
        document.querySelector('.kolomPertama').style.display = 'block';
    }, delaySection);
}

function disableScrolling() {
    var x = window.scrollX;
    var y = window.scrollY;
    window.onscroll = function() {
        window.scrollTo(x, y);
    };
    jQuery('body').css('overflow', 'hidden');
}

function enableScrolling() {
    window.onscroll = function() {};
    jQuery('body').css('overflow', 'visible');
}

function closeCover() {
    $("#cover").slideUp(1500, 'easeInOutCubic');
}

function munculKolom() {
    setTimeout(function() {
        document.querySelector('.kolomPertama').style.display = 'block';
    }, 14000);
}
</script>				</div>
				</div>
				<div class="elementor-element elementor-element-e9fcb34 elementor-widget elementor-widget-html" data-id="e9fcb34" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<meta name="theme-color" content="#7F96A8">
<script>
if ('scrollRestoration' in history) {
					history.scrollRestoration = 'manual';
				}
        window.onbeforeunload = function () {
            window.scrollTo(0, 0);
        };
function revealElements(selector) {
  var elements = document.querySelectorAll(selector);
  var windowHeight = window.innerHeight;
  var elementVisible = 150;

  elements.forEach(function(element) {
    var elementTop = element.getBoundingClientRect().top;
    if (elementTop < windowHeight - elementVisible) {
      element.classList.add("active");
    } else {
      element.classList.remove("active");
    }
  });
}

window.addEventListener("scroll", function() {
  revealElements(".inv-fade-in, .inv-atas, .inv-bawah, .inv-kiri, .inv-kanan, .inv-rotate-in, .inv-flip-x, .inv-flip-y, .inv-zoom-in, .inv-zoom-out");
});
</script>

<style>
.inv-fade-in {
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
}

.inv-fade-in.active {
  opacity: 1;
}

.inv-atas {
  transform: translateY(50%);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-atas.active {
  transform: translateY(0);
  opacity: 1;
}

.inv-bawah {
  transform: translateY(-50%);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-bawah.active {
  transform: translateY(0);
  opacity: 1;
}

.inv-kiri {
  position: relative;
  transform: translateX(-100%) scale(0.93);
  opacity: 0;
  transition: opacity 0.5s ease, transform 1.5s ease;
}

.inv-kiri.active {
  transform: translateX(0);
  opacity: 1;
}

.inv-kanan {
  position: relative;
  transform: translateX(100%) scale(0.93);
  opacity: 0;
  transition: opacity 0.5s ease, transform 1.5s ease;
}

.inv-kanan.active {
  transform: translateX(0);
  opacity: 1;
}

.inv-rotate-in {
  transform: rotate(-180deg);
  opacity: 0;
  transition: transform 1.5s ease-out, opacity 1.5s ease-out;
}

.inv-rotate-in.active {
  transform: rotate(0deg);
  opacity: 1;
}

.inv-flip-x {
  transform: rotateX(90deg);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-flip-x.active {
  transform: rotateX(0deg);
  opacity: 1;
}

.inv-flip-y {
  transform: rotateY(90deg);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-flip-y.active {
  transform: rotateY(0deg);
  opacity: 1;
}

.inv-zoom-in {
  transform: scale(0.9);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-zoom-in.active {
  transform: scale(1);
  opacity: 1;
}

.inv-zoom-out {
  transform: scale(1.1);
  opacity: 0;
  transition: transform 1.5s ease, opacity 1.5s ease;
}

.inv-zoom-out.active {
  transform: scale(1);
  opacity: 1;
}
</style>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-d3c31bc elementor-section-full_width elementor-section-height-min-height elementor-section-items-stretch elementor-section-content-middle elementor-section-height-default" data-id="d3c31bc" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-color="#00000000" data-dce-background-image-url="/themes/3d-motion-05/uploads/2024/10/Garden-05-Ayat.jpg" class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-f3a4387 elementor-hidden-mobile" data-id="f3a4387" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div data-dce-title-color="#333333" class="elementor-element elementor-element-674b44d elementor-invisible elementor-widget elementor-widget-heading" data-id="674b44d" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<div data-dce-title-color="#7F96A8" class="elementor-element elementor-element-1e37561 wdsdv-enabled--yes animated-slow playball elementor-invisible elementor-widget elementor-widget-heading" data-id="1e37561" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#333333" class="elementor-element elementor-element-a368302 elementor-invisible elementor-widget elementor-widget-heading" data-id="a368302" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['date'] ?? 'Minggu, 28 Desember 2027' }}</p>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6239dc8" data-id="6239dc8" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-bc6bba3 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="bc6bba3" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;video&quot;,&quot;background_video_link&quot;:&quot;\/themes\/3d-motion-05\/uploads\/2024\/10\/Garden-05-Video-BG.mp4&quot;,&quot;background_play_on_mobile&quot;:&quot;yes&quot;}">
								<div class="elementor-background-video-container">
													<video class="elementor-background-video-hosted" role="presentation" autoplay muted playsinline loop></video>
											</div>
								<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-0a9eba2" data-id="0a9eba2" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				</div>
		<script type="speculationrules">
{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/*"},{"not":{"href_matches":["/wp-*.php","/wp-admin/*","/wp-content/uploads/*","/wp-content/*","/wp-content/plugins/*","/wp-content/themes/weddingsaas-wp-child/*","/wp-content/themes/weddingsaas-wp/*","/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
	<script>
		let vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty('--vh', `${vh}px`);

		window.addEventListener('resize', () => {
			let vh = window.innerHeight * 0.01;
			document.documentElement.style.setProperty('--vh', `${vh}px`);
		});
	</script>
<style id="elementor-post-dynamic-913817">.elementor-913817 .elementor-element.elementor-element-81d06c9 .elementor-heading-title{font-size:42px;}.elementor-913817 .elementor-element.elementor-element-03ae64e .elementor-heading-title{font-size:42px;}</style>		<div data-elementor-type="popup" data-post-id="8019" data-obj-id="8019" data-elementor-id="913817" class="elementor elementor-913817 e-post-8019 elementor-location-popup" data-elementor-settings="{&quot;entrance_animation&quot;:&quot;fadeIn&quot;,&quot;exit_animation&quot;:&quot;fadeInDown&quot;,&quot;entrance_animation_duration&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1.2,&quot;sizes&quot;:[]},&quot;ha_cmc_init_switcher&quot;:&quot;no&quot;,&quot;a11y_navigation&quot;:&quot;yes&quot;,&quot;timing&quot;:[]}" data-elementor-post-type="elementor_library">
					<section data-dce-background-color="#222222" class="elementor-section elementor-top-section elementor-element elementor-element-8e0edac elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8e0edac" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-6eafdff" data-id="6eafdff" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-text-color="#FFFFFF" class="elementor-element elementor-element-2e79ae7 elementor-align-center elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="2e79ae7" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-qrcode"></i>						</span>
										<span class="elementor-icon-list-text">CHECK-IN</span>
									</li>
						</ul>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-top-section elementor-element elementor-element-d6e7d2d elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="d6e7d2d" data-element_type="section" data-e-type="section" id="sec_qr_checkin" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-94cb6a0" data-id="94cb6a0" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section data-dce-background-overlay-color="#101010" class="elementor-section elementor-inner-section elementor-element elementor-element-555937f elementor-section-full_width elementor-section-height-min-height elementor-section-content-middle elementor-section-height-default" data-id="555937f" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:8137,&quot;url&quot;:&quot;{{ $coverPhotoUrl }}&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7cde5ca" data-id="7cde5ca" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-255ed39 posisi-nama-cover elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="255ed39" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-18d5964" data-id="18d5964" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-06b83f5 elementor-widget elementor-widget-heading" data-id="06b83f5" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-81d06c9 wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="81d06c9" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" class="elementor-section elementor-inner-section elementor-element elementor-element-952b975 elementor-section-full_width elementor-section-content-middle elementor-section-height-default elementor-section-height-default" data-id="952b975" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-de5dc16" data-id="de5dc16" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#444444" class="elementor-element elementor-element-4e524c0 elementor-widget elementor-widget-heading" data-id="4e524c0" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Kepada Yth.<br>Bapak/Ibu/Saudara/i</h2>				</div>
				</div>
				<div data-dce-title-color="#444444" class="elementor-element elementor-element-a10a974 elementor-widget elementor-widget-heading" data-id="a10a974" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Tes</p>				</div>
				</div>
				<div data-dce-title-color="#444444" class="elementor-element elementor-element-51800fb elementor-widget elementor-widget-heading" data-id="51800fb" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">*Mohon maaf jika ada kesalahan dalam penulisan nama / gelar.</h2>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-98528c0" data-id="98528c0" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-8c6915a elementor-widget elementor-widget-dce_barcode" data-id="8c6915a" data-element_type="widget" data-e-type="widget" data-widget_type="dce_barcode.default">
				<div class="elementor-widget-container">
					<img class="dce-barcode dce-barcode-png" loading="eager" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANIAAADSAQMAAAAFVwwBAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAANhJREFUWIXtl8sNBCEMQyNRACXROiVNAUhZyA80zFbg5AASj5MVG0JsNUj3Xv2kEzTrtKpO1n2RgmdVlBrnLZEwmbFVyS5mHZRsvDzGT1HNPvyHx3YmW/Z85jUcO6pdJ8BsdhCpqahJL9FcmuuJzHglMYmpCssiTDTDZRY2a9ETiWgqydRMopRciF8ONDN7RUOZ2/ytgmWHcPGtsZEBmrGVn6yIFqMRYTOVLb41mslPuWZtOLZnJ/0LM/utZDo7/dcMm5FrppYDZ+Ex3m94TRaZfEwL11sFx35/PqfGQZ8ZtwAAAABJRU5ErkJggg==">				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#EBEBEB" class="elementor-section elementor-inner-section elementor-element elementor-element-670950f elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="670950f" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-075d92f" data-id="075d92f" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#444444" class="elementor-element elementor-element-9a92dee elementor-widget elementor-widget-heading" data-id="9a92dee" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Mohon tunjukkan QR Code ini pada area buku tamu di lokasi acara. Scan QR Code digunakan untuk mencatat kehadiran.</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#EBEBEB" class="elementor-section elementor-top-section elementor-element elementor-element-c264888 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c264888" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f2e1e64" data-id="f2e1e64" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a2f2f80 elementor-align-justify elementor-widget elementor-widget-button" data-id="a2f2f80" data-element_type="widget" data-e-type="widget" id="btn_download_qr" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-size-sm elementor-animation-shrink" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="huge huge-download-05"></i>			</span>
									<span class="elementor-button-text">Download e-invitation</span>
					</span>
					</a>
				</div>
								</div>
				</div>
				<div class="elementor-element elementor-element-212d750 elementor-widget elementor-widget-html" data-id="212d750" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>


<script>
jQuery(function($) {

    $(document).off('click.downloadQR', '#btn_download_qr');

    $(document).on('click.downloadQR', '#btn_download_qr', function(e) {

        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        const button = $(this);

        if (button.data('downloading') === true) {
            return false;
        }

        button.data('downloading', true);


        const buttonText = button.find('.elementor-button-text');
        const buttonIcon = button.find('i');

        const originalText = buttonText.text();

        if (typeof html2canvas === 'undefined') {

            console.error('html2canvas belum berhasil dimuat.');

            button.data('downloading', false);

            return false;
        }

        const target = document.getElementById('sec_qr_checkin');


        if (!target) {

            console.error(
                'Element dengan ID #sec_qr_checkin tidak ditemukan.'
            );

            button.data('downloading', false);

            return false;
        }

        buttonText.text('Please wait...');


        if (buttonIcon.length) {

            buttonIcon
                .removeClass('fas fa-download')
                .addClass('fas fa-spinner fa-spin');
        
        }


        button.css({
            'pointer-events': 'none',
            'opacity': '0.7'
        });

        setTimeout(function() {

            const rect = target.getBoundingClientRect();

            const targetWidth = Math.ceil(rect.width);

            const targetHeight = Math.ceil(
                target.scrollHeight
            );


            console.log(
                'QR Section Width:',
                targetWidth
            );

            console.log(
                'QR Section Height:',
                targetHeight
            );


            /* =================================================
               HTML2CANVAS
            ================================================= */

            html2canvas(target, {

                // Jangan tampilkan log html2canvas
                logging: false,

                // Izinkan gambar dari domain lain
                useCORS: true,

                // Izinkan canvas dengan image tertentu
                allowTaint: true,

                // Waktu tunggu image
                imageTimeout: 30000,

                // Resolusi hasil
                scale: 2,

                // Lebar section
                width: targetWidth,

                // Tinggi section
                height: targetHeight,

                // Background putih
                backgroundColor: '#ffffff',

                // Posisi scroll horizontal
                scrollX: 0,

                // Posisi scroll vertikal
                scrollY: -window.scrollY,

                // Ukuran window
                windowWidth: document.documentElement.clientWidth,

                windowHeight: document.documentElement.clientHeight

            })


            /* =================================================
               BERHASIL MEMBUAT CANVAS
            ================================================= */

            .then(function(canvas) {


                /* =================================================
                   CROP AREA PUTIH DI SEBELAH KANAN
                ================================================= */

                const ctx = canvas.getContext('2d');

                const imageWidth = canvas.width;

                const imageHeight = canvas.height;


                let rightMostPixel = 0;


                /*
                 * Ambil seluruh pixel gambar
                 */
                const pixels = ctx.getImageData(
                    0,
                    0,
                    imageWidth,
                    imageHeight
                ).data;


                /*
                 * Cari pixel paling kanan
                 * yang bukan putih.
                 */
                for (
                    let x = imageWidth - 1;
                    x >= 0;
                    x--
                ) {

                    let found = false;


                    for (
                        let y = 0;
                        y < imageHeight;
                        y++
                    ) {

                        const index =
                            (y * imageWidth + x) * 4;


                        const r = pixels[index];

                        const g = pixels[index + 1];

                        const b = pixels[index + 2];

                        const a = pixels[index + 3];


                        /*
                         * Jika pixel bukan putih
                         */
                        if (
                            a > 0 &&
                            (
                                r < 245 ||
                                g < 245 ||
                                b < 245
                            )
                        ) {

                            found = true;

                            break;
                        }

                    }


                    /*
                     * Jika menemukan pixel
                     */
                    if (found) {

                        rightMostPixel = x + 1;

                        break;
                    }

                }


                /* =================================================
                   BUAT CANVAS HASIL CROP
                ================================================= */

                if (
                    rightMostPixel > 0 &&
                    rightMostPixel < imageWidth
                ) {


                    console.log(
                        'Crop kanan:',
                        imageWidth,
                        '→',
                        rightMostPixel
                    );


                    const croppedCanvas =
                        document.createElement('canvas');


                    /*
                     * Lebar baru mengikuti batas
                     * konten sebenarnya.
                     */
                    croppedCanvas.width =
                        rightMostPixel;


                    /*
                     * Tinggi tetap sama.
                     */
                    croppedCanvas.height =
                        imageHeight;


                    const croppedContext =
                        croppedCanvas.getContext('2d');


                    /*
                     * Copy gambar ke canvas baru
                     */
                    croppedContext.drawImage(

                        canvas,

                        // Source X
                        0,

                        // Source Y
                        0,

                        // Source Width
                        rightMostPixel,

                        // Source Height
                        imageHeight,

                        // Destination X
                        0,

                        // Destination Y
                        0,

                        // Destination Width
                        rightMostPixel,

                        // Destination Height
                        imageHeight

                    );


                    /*
                     * Ganti canvas dengan
                     * canvas hasil crop.
                     */
                    canvas = croppedCanvas;

                }


                /* =================================================
                   CONVERT KE PNG
                ================================================= */

                const imageData =
                    canvas.toDataURL(
                        'image/png',
                        1.0
                    );


                /* =================================================
                   DOWNLOAD
                ================================================= */

                downloadURI(
                    imageData,
                    'qr-checkin.png'
                );


            })


            /* =================================================
               JIKA ERROR
            ================================================= */

            .catch(function(error) {

                console.error(
                    'html2canvas error:',
                    error
                );

                alert(
                    'Gagal membuat gambar. Silakan coba lagi.'
                );

            })


            /* =================================================
               SELESAI
            ================================================= */

            .finally(function() {


                /*
                 * Kembalikan teks tombol
                 */
                buttonText.text(
                    originalText
                );


                /*
                 * Kembalikan icon
                 */
                if (buttonIcon.length) {

                    buttonIcon
                        .removeClass(
                            'fas fa-spinner fa-spin'
                        )
                        .addClass(
                            'fas fa-download'
                        );
                
                }


                /*
                 * Aktifkan kembali tombol
                 */
                button.css({
                    'pointer-events': '',
                    'opacity': ''
                });


                /*
                 * Tandai proses download selesai
                 */
                button.data(
                    'downloading',
                    false
                );

            });


        }, 500);


        return false;

    });


});



/* =============================================================
   FUNGSI DOWNLOAD
============================================================= */

function downloadURI(uri, name) {

    const link =
        document.createElement('a');


    link.href = uri;

    link.download = name;


    document.body.appendChild(link);


    link.click();


    document.body.removeChild(link);

}
</script>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</div>
					<script>
				;
				(function($, w) {
					'use strict';
					let $window = $(w);

					$(document).ready(function() {

						let isEnable = "";
						let isEnableLazyMove = "";
						let speed = isEnableLazyMove ? '0.7' : '0.2';

						if( !isEnable ) {
							return;
						}

						if (typeof haCursor == 'undefined' || haCursor == null) {
							initiateHaCursorObject(speed);
						}

						setTimeout(function() {
							let targetCursor = $('.ha-cursor');
							if (targetCursor) {
								if (!isEnable) {
									$('body').removeClass('hm-init-default-cursor-none');
									$('.ha-cursor').addClass('ha-init-hide');
								} else {
									$('body').addClass('hm-init-default-cursor-none');
									$('.ha-cursor').removeClass('ha-init-hide');
								}
							}
						}, 500);

					});

				}(jQuery, window));
			</script>
		
					<script>
				const lazyloadRunObserver = () => {
					const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
					const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
						entries.forEach( ( entry ) => {
							if ( entry.isIntersecting ) {
								let lazyloadBackground = entry.target;
								if( lazyloadBackground ) {
									lazyloadBackground.classList.add( 'e-lazyloaded' );
								}
								lazyloadBackgroundObserver.unobserve( entry.target );
							}
						});
					}, { rootMargin: '200px 0px 200px 0px' } );
					lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
						lazyloadBackgroundObserver.observe( lazyloadBackground );
					} );
				};
				const events = [
					'DOMContentLoaded',
					'elementor/lazyload/observe',
				];
				events.forEach( ( event ) => {
					document.addEventListener( event, lazyloadRunObserver );
				} );
			</script>
			<style id="template-fix-f864b3a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f864b3a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image: url("{{ $coverPhotoUrl }}");}
/*# sourceURL=template-fix-f864b3a-inline-inline-css */
</style>
<style id="template-fix-8211d57-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-8211d57:not(.elementor-motion-effects-element-type-background), .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-8211d57 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image: url("{{ $coverPhotoUrl }}");}
/*# sourceURL=template-fix-8211d57-inline-inline-css */
</style>
<style id="template-fix-ace10ab-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ace10ab.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ace10ab.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ace10ab.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ace10ab.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ace10ab.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-ace10ab-inline-inline-css */
</style>
<style id="template-fix-7c6f2d3-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7c6f2d3.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7c6f2d3.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7c6f2d3.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7c6f2d3.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7c6f2d3.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-7c6f2d3-inline-inline-css */
</style>
<style id="template-fix-17be9d8-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-17be9d8.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-17be9d8.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-17be9d8.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-17be9d8.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-17be9d8.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-17be9d8-inline-inline-css */
</style>
<style id="template-fix-404c5a5-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-404c5a5.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-404c5a5.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-404c5a5.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-404c5a5.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-404c5a5.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-404c5a5-inline-inline-css */
</style>
<link rel='stylesheet' id='elementor-post-370686-css' href='/themes/3d-motion-05/uploads/elementor/css/post-370686.css' media='all' />
<style id="global-styles-inline-css">
:root{--wp--preset--aspect-ratio--square: 1;--wp--preset--aspect-ratio--4-3: 4/3;--wp--preset--aspect-ratio--3-4: 3/4;--wp--preset--aspect-ratio--3-2: 3/2;--wp--preset--aspect-ratio--2-3: 2/3;--wp--preset--aspect-ratio--16-9: 16/9;--wp--preset--aspect-ratio--9-16: 9/16;--wp--preset--color--black: #000000;--wp--preset--color--cyan-bluish-gray: #abb8c3;--wp--preset--color--white: #ffffff;--wp--preset--color--pale-pink: #f78da7;--wp--preset--color--vivid-red: #cf2e2e;--wp--preset--color--luminous-vivid-orange: #ff6900;--wp--preset--color--luminous-vivid-amber: #fcb900;--wp--preset--color--light-green-cyan: #7bdcb5;--wp--preset--color--vivid-green-cyan: #00d084;--wp--preset--color--pale-cyan-blue: #8ed1fc;--wp--preset--color--vivid-cyan-blue: #0693e3;--wp--preset--color--vivid-purple: #9b51e0;--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg,rgb(6,147,227) 0%,rgb(155,81,224) 100%);--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%);--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg,rgb(252,185,0) 0%,rgb(255,105,0) 100%);--wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg,rgb(255,105,0) 0%,rgb(207,46,46) 100%);--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%);--wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%);--wp--preset--gradient--blush-light-purple: linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%);--wp--preset--gradient--blush-bordeaux: linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%);--wp--preset--gradient--luminous-dusk: linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%);--wp--preset--gradient--pale-ocean: linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%);--wp--preset--gradient--electric-grass: linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%);--wp--preset--gradient--midnight: linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%);--wp--preset--font-size--small: 13px;--wp--preset--font-size--medium: 20px;--wp--preset--font-size--large: 36px;--wp--preset--font-size--x-large: 42px;--wp--preset--spacing--20: 0.44rem;--wp--preset--spacing--30: 0.67rem;--wp--preset--spacing--40: 1rem;--wp--preset--spacing--50: 1.5rem;--wp--preset--spacing--60: 2.25rem;--wp--preset--spacing--70: 3.38rem;--wp--preset--spacing--80: 5.06rem;--wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);--wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);--wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);--wp--preset--shadow--outlined: 6px 6px 0px -3px rgb(255, 255, 255), 6px 6px rgb(0, 0, 0);--wp--preset--shadow--crisp: 6px 6px 0px rgb(0, 0, 0);}:where(body) { margin: 0; }:where(.is-layout-flex){gap: 0.5em;}:where(.is-layout-grid){gap: 0.5em;}body .is-layout-flex{display: flex;}.is-layout-flex{flex-wrap: wrap;align-items: center;}.is-layout-flex > :is(*, div){margin: 0;}body .is-layout-grid{display: grid;}.is-layout-grid > :is(*, div){margin: 0;}body{padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;}:root :where(.wp-element-button, .wp-block-button__link){background-color: #32373c;border-width: 0;color: #fff;font-family: inherit;font-size: inherit;font-style: inherit;font-weight: inherit;letter-spacing: inherit;line-height: inherit;padding-top: calc(0.667em + 2px);padding-right: calc(1.333em + 2px);padding-bottom: calc(0.667em + 2px);padding-left: calc(1.333em + 2px);text-decoration: none;text-transform: inherit;}.has-black-color{color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-color{color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-color{color: var(--wp--preset--color--white) !important;}.has-pale-pink-color{color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-color{color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-color{color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-color{color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-color{color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-color{color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-color{color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-color{color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-color{color: var(--wp--preset--color--vivid-purple) !important;}.has-black-background-color{background-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-background-color{background-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-background-color{background-color: var(--wp--preset--color--white) !important;}.has-pale-pink-background-color{background-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-background-color{background-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-background-color{background-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-background-color{background-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-background-color{background-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-background-color{background-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-background-color{background-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-background-color{background-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-background-color{background-color: var(--wp--preset--color--vivid-purple) !important;}.has-black-border-color{border-color: var(--wp--preset--color--black) !important;}.has-cyan-bluish-gray-border-color{border-color: var(--wp--preset--color--cyan-bluish-gray) !important;}.has-white-border-color{border-color: var(--wp--preset--color--white) !important;}.has-pale-pink-border-color{border-color: var(--wp--preset--color--pale-pink) !important;}.has-vivid-red-border-color{border-color: var(--wp--preset--color--vivid-red) !important;}.has-luminous-vivid-orange-border-color{border-color: var(--wp--preset--color--luminous-vivid-orange) !important;}.has-luminous-vivid-amber-border-color{border-color: var(--wp--preset--color--luminous-vivid-amber) !important;}.has-light-green-cyan-border-color{border-color: var(--wp--preset--color--light-green-cyan) !important;}.has-vivid-green-cyan-border-color{border-color: var(--wp--preset--color--vivid-green-cyan) !important;}.has-pale-cyan-blue-border-color{border-color: var(--wp--preset--color--pale-cyan-blue) !important;}.has-vivid-cyan-blue-border-color{border-color: var(--wp--preset--color--vivid-cyan-blue) !important;}.has-vivid-purple-border-color{border-color: var(--wp--preset--color--vivid-purple) !important;}.has-vivid-cyan-blue-to-vivid-purple-gradient-background{background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;}.has-light-green-cyan-to-vivid-green-cyan-gradient-background{background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;}.has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;}.has-luminous-vivid-orange-to-vivid-red-gradient-background{background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;}.has-very-light-gray-to-cyan-bluish-gray-gradient-background{background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;}.has-cool-to-warm-spectrum-gradient-background{background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;}.has-blush-light-purple-gradient-background{background: var(--wp--preset--gradient--blush-light-purple) !important;}.has-blush-bordeaux-gradient-background{background: var(--wp--preset--gradient--blush-bordeaux) !important;}.has-luminous-dusk-gradient-background{background: var(--wp--preset--gradient--luminous-dusk) !important;}.has-pale-ocean-gradient-background{background: var(--wp--preset--gradient--pale-ocean) !important;}.has-electric-grass-gradient-background{background: var(--wp--preset--gradient--electric-grass) !important;}.has-midnight-gradient-background{background: var(--wp--preset--gradient--midnight) !important;}.has-small-font-size{font-size: var(--wp--preset--font-size--small) !important;}.has-medium-font-size{font-size: var(--wp--preset--font-size--medium) !important;}.has-large-font-size{font-size: var(--wp--preset--font-size--large) !important;}.has-x-large-font-size{font-size: var(--wp--preset--font-size--x-large) !important;}
/*# sourceURL=global-styles-inline-css */
</style>
<style id="core-block-supports-inline-css">
/**
 * Core styles: block-supports
 */

/*# sourceURL=core-block-supports-inline-css */
</style>
<link rel='stylesheet' id='elementor-post-913817-css' href='/themes/3d-motion-05/uploads/elementor/css/post-913817.css' media='all' />
<link rel='stylesheet' id='e-popup-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/conditionals/popup.min.css' media='all' />
<link rel='stylesheet' id='elementor-gf-poppins-css' href='https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-icons-huge-icons-css' href='/themes/3d-motion-05/plugins/happy-elementor-addons/assets/fonts/huge-icons/huge-icons.min.css' media='all' />
<script id="imagesloaded-js" src="/themes/3d-motion-05/wp-includes/js/imagesloaded.min.js"></script>
<script id="masonry-js" src="/themes/3d-motion-05/wp-includes/js/masonry.min.js"></script>
<script id="betterdocs-categorygrid-js" src="/themes/3d-motion-05/plugins/betterdocs/assets/build/blocks/categorygrid/frontend.js"></script>
<script id="saic_library-js" src="/themes/3d-motion-05/plugins/weddingsaas-pro/assets/plugins/custom/commentpress/saic_lib.js"></script>
<script id="wds_rsvp-js-extra">
var WDS_RSVP = {"ajaxurl":"/themes/3d-motion-05/wp-admin/admin-ajax.php","nonce":"9114be834b","jPagesNum":"100","textCounterNum":"300","thanksComment":"Terimakasih atas ucapan Anda!","duplicateComment":"Anda mungkin membiarkan salah satu kolom kosong, atau menggandakan komentar","guestMax":"2","textNavNext":"Next","textNavPrev":"Previous"};
//# sourceURL=wds_rsvp-js-extra
</script>
<script id="wds_rsvp-js" src="/themes/3d-motion-05/plugins/weddingsaas-pro/assets/js/wds-rsvp.js"></script>
<script id="dce-fix-background-loop-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/fix-background-loop.js"></script>
<script id="dce-settings-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/settings.js"></script>
<script id="dce-formatted-number-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/formatted-number.js"></script>
<script id="dce-dynamic-select-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/dynamic-select.js"></script>
<script id="dce-tooltip-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/tooltip.js"></script>
<script id="dce-popper-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/popperjs/popper.min.js"></script>
<script id="dce-tippy-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/tippy.js/tippy-bundle.umd.min.js"></script>
<script id="wdsfa-dfu-theme-capture-js" src="/themes/3d-motion-05/plugins/wds-feature-addons/assets/js/done-for-you-theme-capture.js"></script>
<script id="elementor-webpack-runtime-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/webpack.runtime.js"></script>
<script id="elementor-frontend-modules-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/frontend-modules.js"></script>
<script id="jquery-ui-core-js" src="/themes/3d-motion-05/wp-includes/js/jquery/ui/core.js"></script>
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":true},"i18n":{"shareOnFacebook":"Bagikan di Facebook","shareOnTwitter":"Bagikan di Twitter","pinIt":"Buat Pin","download":"Unduh","downloadImage":"Unduh gambar","fullscreen":"Layar Penuh","zoom":"Perbesar","share":"Bagikan","playVideo":"Putar Video","previous":"Sebelumnya","next":"Selanjutnya","close":"Tutup","a11yCarouselPrevSlideMessage":"Slide sebelumnya","a11yCarouselNextSlideMessage":"Slide selanjutnya","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Layar lebar","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.1.4","is_static":false,"experimentalFeatures":{"additional_custom_breakpoints":true,"e_panel_promotions":true,"theme_builder_v2":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true,"e_pro_atomic_form":true,"e_pro_variables":true,"e_pro_interactions":true},"urls":{"assets":"\/themes\/3d-motion-05\/plugins\/elementor\/assets\/","ajaxurl":"\/themes\/3d-motion-05\/wp-admin\/admin-ajax.php","uploadUrl":"\/themes\/3d-motion-05\/uploads"},"nonces":{"floatingButtonsClickTracking":"edabf8bb06","atomicFormsSendForm":"6ce74f06cb"},"swiperClass":"swiper","settings":{"page":{"ha_cmc_init_switcher":"no"},"editorPreferences":[],"dynamicooo":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","ha_rpb_enable":"no"},"post":{"id":8019,"title":"Tema%203D%20Motion%2005","excerpt":"","featuredImage":"\/themes\/3d-motion-05\/uploads\/2026\/01\/preview-m05-reseller.jpg"}};
//# sourceURL=elementor-frontend-js-before
</script>
<script id="elementor-frontend-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/frontend.js"></script>
<script id="swiper-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/swiper/v8/swiper.js"></script>
<script id="jet-tween-js-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/lib/tweenjs/tweenjs.min.js"></script>
<script id="jet-elements-js-extra">
var jetElements = {"ajaxUrl":"/themes/3d-motion-05/wp-admin/admin-ajax.php","isMobile":"false","templateApiUrl":"/themes/3d-motion-05/wp-json/jet-elements-api/v1/elementor-template","devMode":"false","mapboxToken":"","messages":{"invalidMail":"Please specify a valid e-mail"}};
//# sourceURL=jet-elements-js-extra
</script>
<script id="jet-elements-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/jet-elements.js"></script>
<script id="jet-timeline-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/addons/jet-timeline.js"></script>
<script id="elementor-gallery-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/e-gallery/js/e-gallery.js"></script>
<script id="dce-prism-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism.js"></script>
<script id="dce-prism-markup-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-markup.min.js"></script>
<script id="dce-prism-markup-templating-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-markup-templating.min.js"></script>
<script id="dce-prism-php-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-php.min.js"></script>
<script id="dce-prism-line-numbers-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-line-numbers.min.js"></script>
<script id="dce-clipboard-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/clipboard/clipboard.min.js"></script>
<script id="dce-copy-to-clipboard-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/copy-to-clipboard.js"></script>
<script id="happy-elementor-addons-js-extra">
var HappyLocalize = {"ajax_url":"/themes/3d-motion-05/wp-admin/admin-ajax.php","nonce":"e731c5c050","pdf_js_lib":"/themes/3d-motion-05/plugins/happy-elementor-addons/assets/vendor/pdfjs/lib"};
//# sourceURL=happy-elementor-addons-js-extra
</script>
<script id="happy-elementor-addons-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/js/happy-addons.js"></script>
<script id="happy-reading-progress-bar-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/js/extension-reading-progress-bar.js"></script>
<script id="wdsfa-rsvp-guard-js-extra">
var WDSFARsvpGuard = {"postId":"8019","ajaxUrl":"/themes/3d-motion-05/wp-admin/admin-ajax.php","browserChallenge":"1","behaviorGuard":"1","turnstileEnabled":"0","turnstileSiteKey":"","challengeMinAge":"4","ticketRequired":"1","ticketExpiresIn":"180"};
//# sourceURL=wdsfa-rsvp-guard-js-extra
</script>
<script id="wdsfa-rsvp-guard-js" src="/themes/3d-motion-05/plugins/wds-feature-addons/assets/js/rsvp-guard.js"></script>
<script id="unitegallery-js" src="/themes/3d-motion-05/plugins/unlimited-elements-for-elementor-premium/assets_libraries/unitegallery/js/unitegallery.min.js"></script>
<script id="uc_ac_assets_file_ug_theme_compact_js_9736-js" src="/themes/3d-motion-05/uploads/ac_assets/uc_compact_image_theme/ug-theme-compact.js"></script>
<script id="elementor-pro-webpack-runtime-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/webpack-pro.runtime.js"></script>
<script id="wp-hooks-js" src="/themes/3d-motion-05/wp-includes/js/dist/hooks.js"></script>
<script id="wp-i18n-js" src="/themes/3d-motion-05/wp-includes/js/dist/i18n.js"></script>
<script id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
//# sourceURL=wp-i18n-js-after
</script>
<script id="elementor-pro-frontend-js-before">
var ElementorProFrontendConfig = {"ajaxurl":"\/themes\/3d-motion-05\/wp-admin\/admin-ajax.php","nonce":"2780e9f183","urls":{"assets":"\/themes\/3d-motion-05\/plugins\/elementor-pro\/assets\/","rest":"\/wp-json\/"},"settings":{"lazy_load_background_images":true},"popup":{"hasPopUps":true},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"},"x-twitter":{"title":"X"},"threads":{"title":"Threads"}},"facebook_sdk":{"lang":"id_ID","app_id":""},"lottie":{"defaultAnimationUrl":"\/themes\/3d-motion-05\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
//# sourceURL=elementor-pro-frontend-js-before
</script>
<script id="elementor-pro-frontend-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/frontend.js"></script>
<script id="pro-elements-handlers-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/elements-handlers.js"></script>

<!--   Unlimited Elements 1.5.109 Scripts --> 
<script type='text/javascript' id='unlimited-elements-scripts'>

/* Compact Gallery scripts: */ 

jQuery(document).ready(function(){	
function uc_uc_compact_image_theme_elementor_3fa3003_start(){

  var objGallery = jQuery("#uc_uc_compact_image_theme_elementor_3fa3003");
  
  var api = objGallery.unitegallery({
    gallery_theme:"compact",
    theme_panel_position: "bottom",			//top, bottom, left, right - thumbs panel position
    theme_hide_panel_under_width: 0,		//hide panel under certain browser width, if null, don't hide

					// gallery options
				
					gallery_width:'100%',							//gallery width		
					gallery_height:500,							//gallery height
					gallery_min_width: 100,						//gallery minimal width when resizing
					gallery_min_height: 300,					//gallery minimal height when resizing
					gallery_skin:"default",						//default, alexis etc... - the global skin of the gallery. Will change all gallery items by default.
					gallery_images_preload_type:"minimal",		//all , minimal , visible - preload type of the images.
																
					gallery_autoplay:true,						//true / false - begin slideshow autoplay on start
					gallery_play_interval: 4000,				//play interval of the slideshow
					gallery_pause_on_mouseover: false,			//true,false - pause on mouseover when playing slideshow true/false
	
					gallery_control_thumbs_mousewheel:false,	//true,false - enable / disable the mousewheel
					gallery_control_keyboard: false,				//true,false - enable / disble keyboard controls
					gallery_carousel:true,						//true,false - next button on last image goes to first image.
	
					gallery_preserve_ratio: true,				//true, false - preserver ratio when on window resize
					gallery_debug_errors:true,					//show error message when there is some error on the gallery area.
					slider_background_color:"#7F96A8",
                                    
					//slider options: 
					slider_video_autoplay: false,
					slider_scale_mode: "fill",	//fit: scale down and up the image to always fit the slider								
					slider_scale_mode_media: "fill",			//fit, down, full scale mode on media items
					slider_scale_mode_fullscreen: "down",		//fit, down, full scale mode on fullscreen.
					slider_item_padding_top: 0,					//padding top of the slider item
					slider_item_padding_bottom: 0,				//padding bottom of the slider item
					slider_item_padding_left: 0,				//padding left of the slider item
					slider_item_padding_right: 0,				//padding right of the slider item
	
					slider_transition: "fade",					//fade, slide - the transition of the slide change
					slider_transition_speed:2000,				//transition duration of slide change
					slider_transition_easing: "easeInOutQuad",	//transition easing function of slide change
	
					slider_control_swipe:false,					//true,false - enable swiping control
					slider_control_zoom:false,					//true, false - enable zooming control
					slider_zoom_max_ratio: 3,					//max zoom ratio
					slider_loader_type: 1,						//shape of the loader (1-7)
					slider_loader_color:"white",
                    
                    slider_enable_bullets: false,				//enable the bullets onslider element
					slider_bullets_skin: "",					//skin of the bullets, if empty inherit from gallery skin
					slider_bullets_space_between: 5,			//set the space between bullets. If -1 then will be set default space from the skins
					slider_bullets_align_hor:"center",			//left, center, right - bullets horizontal align
					slider_bullets_align_vert:"bottom",			//top, middle, bottom - bullets vertical algin
					slider_bullets_offset_hor:0,				//bullets horizontal offset 
					slider_bullets_offset_vert:20,				//bullets vertical offset
	
					slider_enable_arrows: true,					//enable arrows onslider element
					slider_arrows_skin: "",						//skin of the slider arrows, if empty inherit from gallery skin
					slider_arrow_left_align_hor:"left",	  		//left, center, right - left arrow horizonal align
					slider_arrow_left_align_vert:"middle", 		//top, middle, bottom - left arrow vertical align
					slider_arrow_left_offset_hor:20,		  	//left arrow horizontal offset
					slider_arrow_left_offset_vert:0,		  	//left arrow vertical offset
					slider_arrow_right_align_hor:"right",   	//left, center, right - right arrow horizontal algin
					slider_arrow_right_align_vert:"middle", 	//top, middle, bottom - right arrow vertical align
					slider_arrow_right_offset_hor:20,	   		//right arrow horizontal offset 
					slider_arrow_right_offset_vert:0,	   		//right arrow vertical offset
	             
					slider_enable_progress_indicator: false,		 //enable progress indicator element
					slider_progress_indicator_type: "pie",		 //pie, pie2, bar (if pie not supported, it will switch to bar automatically)
					slider_progress_indicator_align_hor:"left",  //left, center, right - progress indicator horizontal align
					slider_progress_indicator_align_vert:"top",  //top, middle, bottom - progress indicator vertical align
					slider_progress_indicator_offset_hor:30,	 //progress indicator horizontal offset 
					slider_progress_indicator_offset_vert:40,	 //progress indicator vertical offset
					slider_progressbar_color:"#ffffff",			 //progress bar color
					slider_progressbar_opacity: 0.6,			 //progress bar opacity
					slider_progressbar_line_width: 5,			 //progress bar line width
					slider_progresspie_type_fill: false,		 //false is stroke, true is fill - the progress pie type, stroke of fill
					slider_progresspie_color1: "#B5B5B5", 		 //the first color of the progress pie
					slider_progresspie_color2: "#ffffff",		 //progress pie second color 
					slider_progresspie_stroke_width: 6,			 //progress pie stroke width 
					slider_progresspie_width: 30,				 //progess pie width
					slider_progresspie_height:30,				 //progress pie height
	
				    slider_enable_play_button: false,			 //true,false - enable play / pause button onslider element
				    slider_play_button_skin: "",				 //skin of the slider play button, if empty inherit from gallery skin
				    slider_play_button_align_hor:"left",    	 //left, center, right - play button horizontal align
				    slider_play_button_align_vert:"top",         //top, middle, bottom - play button vertical align
				    slider_play_button_offset_hor:40,	       	 //play button horizontal offset 
				    slider_play_button_offset_vert:8,	   		 //play button vertical offset
	
				    slider_enable_fullscreen_button: true,		 //true,false - enable fullscreen button onslider element
				    slider_fullscreen_button_skin: "",			 //skin of the slider fullscreen button, if empty inherit from gallery skin
				    slider_fullscreen_button_align_hor:"left",   //left, center, right	- fullscreen button horizonatal align
				    slider_fullscreen_button_align_vert:"top",   //top, middle, bottom - fullscreen button vertical align
				    slider_fullscreen_button_offset_hor:11,	     //fullscreen button horizontal offset 
				    slider_fullscreen_button_offset_vert:9,	   	 //fullscreen button vertical offset
	
					slider_enable_zoom_panel: false,				 //true,false - enable the zoom buttons, works together with zoom control.
					slider_zoompanel_skin: "",					 //skin of the slider zoom panel, if empty inherit from gallery skin		  
					slider_zoompanel_align_hor:"right",    		 //left, center, right - zoom panel horizontal align
					slider_zoompanel_align_vert:"top",     	 	 //top, middle, bottom - zoom panel vertical align
					slider_zoompanel_offset_hor:12,	       		 //zoom panel horizontal offset 
					slider_zoompanel_offset_vert:10,	   	     //zoom panel vertical offset
	
					slider_controls_always_on: true,		     //true,false - controls are always on, false - show only on mouseover
					slider_controls_appear_ontap: true,			 //true,false - appear controls on tap event on touch devices
					slider_controls_appear_duration: 300,		 //the duration of appearing controls
					slider_videoplay_button_type: "square",		  //square, round - the videoplay button type, square or round	
                    
                    slider_enable_text_panel: false,			 //true,false - enable the text panel
					slider_textpanel_always_on: false,			 //true,false - text panel are always on, false - show only on mouseover
					slider_textpanel_text_valign:"middle",			//middle, top, bottom - text vertical align
					slider_textpanel_padding_top:20,				//textpanel padding top 
					slider_textpanel_padding_bottom:20,				//textpanel padding bottom
                    slider_textpanel_padding_right: 20,				//cut some space for text from right
					slider_textpanel_padding_left: 20,				//cut some space for text from left
					slider_textpanel_height: null,					//textpanel height. if null it will be set dynamically
					slider_textpanel_padding_title_description: 5,	//the space between the title and the description
					slider_textpanel_fade_duration: 200,			//the fade duration of textpanel appear
					slider_textpanel_enable_title: false,			//enable the title text
					slider_textpanel_enable_description: true,		//enable the description text
					slider_textpanel_enable_bg: true,				//enable the textpanel background
					slider_textpanel_bg_color:"#000000",			//textpanel background color
					slider_textpanel_bg_opacity: 0.5,				//textpanel background opacity
                                    
                    thumb_width:65,								//thumb width
					thumb_height:65,							//thumb height
					thumb_fixed_size:true,						//true,false - fixed/dynamic thumbnail width
	
					thumb_border_effect:true,					//true, false - specify if the thumb has border
					thumb_border_width: 0,						//thumb border width
					thumb_border_color: "#686868",				//thumb border color
					thumb_over_border_width: 0,					//thumb border width in mouseover state
					thumb_over_border_color: "#c0c0c0",			//thumb border color in mouseover state
					thumb_selected_border_width: 0,				//thumb width in selected state
					thumb_selected_border_color: "#ffffff",		//thumb border color in selected state
	
					thumb_round_corners_radius:8,				//thumb border radius
	
					thumb_color_overlay_effect: true,			//true,false - thumb color overlay effect, release the overlay on mouseover and selected states
					thumb_overlay_color: "#000000",				//thumb overlay color
					thumb_overlay_opacity: 0.5,					//thumb overlay color opacity
					thumb_overlay_reverse:false,				//true,false - reverse the overlay, will be shown on selected state only
					thumb_image_overlay_effect: false,			//true,false - images overlay effect on normal state only
					thumb_image_overlay_type: "blur",				//bw , blur, sepia - the type of image effect overlay, black and white, sepia and blur.
					thumb_transition_duration: 200,				//thumb effect transition duration
					thumb_transition_easing: "easeOutQuad",		//thumb effect transition easing        
					strippanel_background_color:"#7F96A8",
  });

  objGallery.data("unitegallery-api",api);
			
			objGallery.trigger("uc-object-ready");
			jQuery(document).trigger("uc-remote-parent-init", [objGallery]);
			  

   objGallery.on("uc_ajax_sethtml",function(event, htmlItems, isAppend){      	
        api.changeItems(htmlItems);         
   });

  
}if(jQuery("#uc_uc_compact_image_theme_elementor_3fa3003").length) uc_uc_compact_image_theme_elementor_3fa3003_start(); else
	jQuery( document ).on( 'elementor/popup/show', () => { if(jQuery("#uc_uc_compact_image_theme_elementor_3fa3003").length) uc_uc_compact_image_theme_elementor_3fa3003_start();});
});
</script>
<script id="wp-emoji-settings" type="application/json">
{"baseUrl":"https://s.w.org/images/core/emoji/17.0.2/72x72/","ext":".png","svgUrl":"https://s.w.org/images/core/emoji/17.0.2/svg/","svgExt":".svg","source":{"wpemoji":"/themes/3d-motion-05/wp-includes/js/wp-emoji.js","twemoji":"/themes/3d-motion-05/wp-includes/js/twemoji.js"}}
</script>
<script type="module">
/**
 * @output wp-includes/js/wp-emoji-loader.js
 */

/* eslint-env es6 */

// Note: This is loaded as a script module, so there is no need for an IIFE to prevent pollution of the global scope.

/**
 * Emoji Settings as exported in PHP via _print_emoji_detection_script().
 * @typedef WPEmojiSettings
 * @type {object}
 * @property {?object} source
 * @property {?string} source.concatemoji
 * @property {?string} source.twemoji
 * @property {?string} source.wpemoji
 */

const selector = 'script#wp-emoji-settings';
const script = document.querySelector( selector );
if ( ! ( script instanceof HTMLScriptElement ) ) {
	throw new Error( `Element missing: ${ selector }`);
}
const settings = /** @type {WPEmojiSettings} */ ( JSON.parse( script.text ) );

// For compatibility with other scripts that read from this global, in particular wp-includes/js/wp-emoji.js (source file: js/_enqueues/wp/emoji.js).
window._wpemojiSettings = settings;

/**
 * Support tests.
 * @typedef SupportTests
 * @type {object}
 * @property {?boolean} flag
 * @property {?boolean} emoji
 */

const sessionStorageKey = 'wpEmojiSettingsSupports';
const tests = [ 'flag', 'emoji' ];

/**
 * Checks whether the browser supports offloading to a Worker.
 *
 * @since 6.3.0
 *
 * @private
 *
 * @returns {boolean}
 */
function supportsWorkerOffloading() {
	return (
		typeof Worker !== 'undefined' &&
		typeof OffscreenCanvas !== 'undefined' &&
		typeof URL !== 'undefined' &&
		URL.createObjectURL &&
		typeof Blob !== 'undefined'
	);
}

/**
 * @typedef SessionSupportTests
 * @type {object}
 * @property {number} timestamp
 * @property {SupportTests} supportTests
 */

/**
 * Get support tests from session.
 *
 * @since 6.3.0
 *
 * @private
 *
 * @returns {?SupportTests} Support tests, or null if not set or older than 1 week.
 */
function getSessionSupportTests() {
	try {
		/** @type {SessionSupportTests} */
		const item = JSON.parse(
			sessionStorage.getItem( sessionStorageKey )
		);
		if (
			typeof item === 'object' &&
			typeof item.timestamp === 'number' &&
			new Date().valueOf() < item.timestamp + 604800 && // Note: Number is a week in seconds.
			typeof item.supportTests === 'object'
		) {
			return item.supportTests;
		}
	} catch ( e ) {}
	return null;
}

/**
 * Persist the supports in session storage.
 *
 * @since 6.3.0
 *
 * @private
 *
 * @param {SupportTests} supportTests Support tests.
 */
function setSessionSupportTests( supportTests ) {
	try {
		/** @type {SessionSupportTests} */
		const item = {
			supportTests: supportTests,
			timestamp: new Date().valueOf()
		};

		sessionStorage.setItem(
			sessionStorageKey,
			JSON.stringify( item )
		);
	} catch ( e ) {}
}

/**
 * Checks if two sets of Emoji characters render the same visually.
 *
 * This is used to determine if the browser is rendering an emoji with multiple data points
 * correctly. set1 is the emoji in the correct form, using a zero-width joiner. set2 is the emoji
 * in the incorrect form, using a zero-width space. If the two sets render the same, then the browser
 * does not support the emoji correctly.
 *
 * This function may be serialized to run in a Worker. Therefore, it cannot refer to variables from the containing
 * scope. Everything must be passed by parameters.
 *
 * @since 4.9.0
 *
 * @private
 *
 * @param {CanvasRenderingContext2D} context 2D Context.
 * @param {string} set1 Set of Emoji to test.
 * @param {string} set2 Set of Emoji to test.
 *
 * @return {boolean} True if the two sets render the same.
 */
function emojiSetsRenderIdentically( context, set1, set2 ) {
	// Cleanup from previous test.
	context.clearRect( 0, 0, context.canvas.width, context.canvas.height );
	context.fillText( set1, 0, 0 );
	const rendered1 = new Uint32Array(
		context.getImageData(
			0,
			0,
			context.canvas.width,
			context.canvas.height
		).data
	);

	// Cleanup from previous test.
	context.clearRect( 0, 0, context.canvas.width, context.canvas.height );
	context.fillText( set2, 0, 0 );
	const rendered2 = new Uint32Array(
		context.getImageData(
			0,
			0,
			context.canvas.width,
			context.canvas.height
		).data
	);

	return rendered1.every( ( rendered2Data, index ) => {
		return rendered2Data === rendered2[ index ];
	} );
}

/**
 * Checks if the center point of a single emoji is empty.
 *
 * This is used to determine if the browser is rendering an emoji with a single data point
 * correctly. The center point of an incorrectly rendered emoji will be empty. A correctly
 * rendered emoji will have a non-zero value at the center point.
 *
 * This function may be serialized to run in a Worker. Therefore, it cannot refer to variables from the containing
 * scope. Everything must be passed by parameters.
 *
 * @since 6.8.2
 *
 * @private
 *
 * @param {CanvasRenderingContext2D} context 2D Context.
 * @param {string} emoji Emoji to test.
 *
 * @return {boolean} True if the center point is empty.
 */
function emojiRendersEmptyCenterPoint( context, emoji ) {
	// Cleanup from previous test.
	context.clearRect( 0, 0, context.canvas.width, context.canvas.height );
	context.fillText( emoji, 0, 0 );

	// Test if the center point (16, 16) is empty (0,0,0,0).
	const centerPoint = context.getImageData(16, 16, 1, 1);
	for ( let i = 0; i < centerPoint.data.length; i++ ) {
		if ( centerPoint.data[ i ] !== 0 ) {
			// Stop checking the moment it's known not to be empty.
			return false;
		}
	}

	return true;
}

/**
 * Determines if the browser properly renders Emoji that Twemoji can supplement.
 *
 * This function may be serialized to run in a Worker. Therefore, it cannot refer to variables from the containing
 * scope. Everything must be passed by parameters.
 *
 * @since 4.2.0
 *
 * @private
 *
 * @param {CanvasRenderingContext2D} context 2D Context.
 * @param {string} type Whether to test for support of "flag" or "emoji".
 * @param {Function} emojiSetsRenderIdentically Reference to emojiSetsRenderIdentically function, needed due to minification.
 * @param {Function} emojiRendersEmptyCenterPoint Reference to emojiRendersEmptyCenterPoint function, needed due to minification.
 *
 * @return {boolean} True if the browser can render emoji, false if it cannot.
 */
function browserSupportsEmoji( context, type, emojiSetsRenderIdentically, emojiRendersEmptyCenterPoint ) {
	let isIdentical;

	switch ( type ) {
		case 'flag':
			/*
			 * Test for Transgender flag compatibility. Added in Unicode 13.
			 *
			 * To test for support, we try to render it, and compare the rendering to how it would look if
			 * the browser doesn't render it correctly (white flag emoji + transgender symbol).
			 */
			isIdentical = emojiSetsRenderIdentically(
				context,
				'\uD83C\uDFF3\uFE0F\u200D\u26A7\uFE0F', // as a zero-width joiner sequence
				'\uD83C\uDFF3\uFE0F\u200B\u26A7\uFE0F' // separated by a zero-width space
			);

			if ( isIdentical ) {
				return false;
			}

			/*
			 * Test for Sark flag compatibility. This is the least supported of the letter locale flags,
			 * so gives us an easy test for full support.
			 *
			 * To test for support, we try to render it, and compare the rendering to how it would look if
			 * the browser doesn't render it correctly ([C] + [Q]).
			 */
			isIdentical = emojiSetsRenderIdentically(
				context,
				'\uD83C\uDDE8\uD83C\uDDF6', // as the sequence of two code points
				'\uD83C\uDDE8\u200B\uD83C\uDDF6' // as the two code points separated by a zero-width space
			);

			if ( isIdentical ) {
				return false;
			}

			/*
			 * Test for English flag compatibility. England is a country in the United Kingdom, it
			 * does not have a two letter locale code but rather a five letter sub-division code.
			 *
			 * To test for support, we try to render it, and compare the rendering to how it would look if
			 * the browser doesn't render it correctly (black flag emoji + [G] + [B] + [E] + [N] + [G]).
			 */
			isIdentical = emojiSetsRenderIdentically(
				context,
				// as the flag sequence
				'\uD83C\uDFF4\uDB40\uDC67\uDB40\uDC62\uDB40\uDC65\uDB40\uDC6E\uDB40\uDC67\uDB40\uDC7F',
				// with each code point separated by a zero-width space
				'\uD83C\uDFF4\u200B\uDB40\uDC67\u200B\uDB40\uDC62\u200B\uDB40\uDC65\u200B\uDB40\uDC6E\u200B\uDB40\uDC67\u200B\uDB40\uDC7F'
			);

			return ! isIdentical;
		case 'emoji':
			/*
			 * Is there a large, hairy, humanoid mythical creature living in the browser?
			 *
			 * To test for Emoji 17.0 support, try to render a new emoji: Hairy Creature.
			 *
			 * The hairy creature emoji is a single code point emoji. Testing for browser
			 * support required testing the center point of the emoji to see if it is empty.
			 *
			 * 0xD83E 0x1FAC8 (\uD83E\u1FAC8) == 🫈 Hairy creature.
			 *
			 * When updating this test, please ensure that the emoji is either a single code point
			 * or switch to using the emojiSetsRenderIdentically function and testing with a zero-width
			 * joiner vs a zero-width space.
			 */
			const notSupported = emojiRendersEmptyCenterPoint( context, '\uD83E\u1FAC8' );
			return ! notSupported;
	}

	return false;
}

/**
 * Checks emoji support tests.
 *
 * This function may be serialized to run in a Worker. Therefore, it cannot refer to variables from the containing
 * scope. Everything must be passed by parameters.
 *
 * @since 6.3.0
 *
 * @private
 *
 * @param {string[]} tests Tests.
 * @param {Function} browserSupportsEmoji Reference to browserSupportsEmoji function, needed due to minification.
 * @param {Function} emojiSetsRenderIdentically Reference to emojiSetsRenderIdentically function, needed due to minification.
 * @param {Function} emojiRendersEmptyCenterPoint Reference to emojiRendersEmptyCenterPoint function, needed due to minification.
 *
 * @return {SupportTests} Support tests.
 */
function testEmojiSupports( tests, browserSupportsEmoji, emojiSetsRenderIdentically, emojiRendersEmptyCenterPoint ) {
	let canvas;
	if (
		typeof WorkerGlobalScope !== 'undefined' &&
		self instanceof WorkerGlobalScope
	) {
		canvas = new OffscreenCanvas( 300, 150 ); // Dimensions are default for HTMLCanvasElement.
	} else {
		canvas = document.createElement( 'canvas' );
	}

	const context = canvas.getContext( '2d', { willReadFrequently: true } );

	/*
	 * Chrome on OS X added native emoji rendering in M41. Unfortunately,
	 * it doesn't work when the font is bolder than 500 weight. So, we
	 * check for bold rendering support to avoid invisible emoji in Chrome.
	 */
	context.textBaseline = 'top';
	context.font = '600 32px Arial';

	const supports = {};
	tests.forEach( ( test ) => {
		supports[ test ] = browserSupportsEmoji( context, test, emojiSetsRenderIdentically, emojiRendersEmptyCenterPoint );
	} );
	return supports;
}

/**
 * Adds a script to the head of the document.
 *
 * @ignore
 *
 * @since 4.2.0
 *
 * @param {string} src The url where the script is located.
 *
 * @return {void}
 */
function addScript( src ) {
	const script = document.createElement( 'script' );
	script.src = src;
	script.defer = true;
	document.head.appendChild( script );
}

settings.supports = {
	everything: true,
	everythingExceptFlag: true
};

// Obtain the emoji support from the browser, asynchronously when possible.
new Promise( ( resolve ) => {
	let supportTests = getSessionSupportTests();
	if ( supportTests ) {
		resolve( supportTests );
		return;
	}

	if ( supportsWorkerOffloading() ) {
		try {
			// Note that the functions are being passed as arguments due to minification.
			const workerScript =
				'postMessage(' +
				testEmojiSupports.toString() +
				'(' +
				[
					JSON.stringify( tests ),
					browserSupportsEmoji.toString(),
					emojiSetsRenderIdentically.toString(),
					emojiRendersEmptyCenterPoint.toString()
				].join( ',' ) +
				'));';
			const blob = new Blob( [ workerScript ], {
				type: 'text/javascript'
			} );
			const worker = new Worker( URL.createObjectURL( blob ), { name: 'wpTestEmojiSupports' } );
			worker.onmessage = ( event ) => {
				supportTests = event.data;
				setSessionSupportTests( supportTests );
				worker.terminate();
				resolve( supportTests );
			};
			return;
		} catch ( e ) {}
	}

	supportTests = testEmojiSupports( tests, browserSupportsEmoji, emojiSetsRenderIdentically, emojiRendersEmptyCenterPoint );
	setSessionSupportTests( supportTests );
	resolve( supportTests );
} )
	// Once the browser emoji support has been obtained from the session, finalize the settings.
	.then( ( supportTests ) => {
		/*
		 * Tests the browser support for flag emojis and other emojis, and adjusts the
		 * support settings accordingly.
		 */
		for ( const test in supportTests ) {
			settings.supports[ test ] = supportTests[ test ];

			settings.supports.everything =
				settings.supports.everything && settings.supports[ test ];

			if ( 'flag' !== test ) {
				settings.supports.everythingExceptFlag =
					settings.supports.everythingExceptFlag &&
					settings.supports[ test ];
			}
		}

		settings.supports.everythingExceptFlag =
			settings.supports.everythingExceptFlag &&
			! settings.supports.flag;

		// When the browser can not render everything we need to load a polyfill.
		if ( ! settings.supports.everything ) {
			const src = settings.source || {};

			if ( src.concatemoji ) {
				addScript( src.concatemoji );
			} else if ( src.wpemoji && src.twemoji ) {
				addScript( src.twemoji );
				addScript( src.wpemoji );
			}
		}
	} );
//# sourceURL=/themes/3d-motion-05/wp-includes/js/wp-emoji-loader.js
</script>
<style id="e-addons-template-dynamic-f864b3a-inline">.elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-f864b3a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-f864b3a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image: url("{{ $coverPhotoUrl }}");--e-bg-lazyload:url("{{ $coverPhotoUrl }}");background-position: center center;background-size: cover;}</style><style id="e-addons-template-dynamic-8211d57-inline">.elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-8211d57:not(.elementor-motion-effects-element-type-background), .elementor:is(.e-post-8019,.e-loop-item-8019) .elementor-element.elementor-element-8211d57 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image: url("{{ $coverPhotoUrl }}");--e-bg-lazyload:url("{{ $coverPhotoUrl }}");background-position: center center;background-size: cover;}</style>

<script>
// ponytail: ?to= handler for static clone
(function(){
  const to = new URLSearchParams(location.search).get('to');
  if(!to) return;
  const decoded = decodeURIComponent(to.replace(/\+/g,' '));
  // Find the guest name h2 that currently shows "Tes" or "Tamu"
  for(const h of document.querySelectorAll('h2.elementor-heading-title')){
    if(h.textContent.trim()==='Tes' || h.textContent.trim()==='Tamu' || h.textContent.trim()==='Tamu Undangan'){
      h.textContent = decoded;
      break;
    }
  }
})();
</script>


<!-- TOAST NOTIFICATION CONTAINER -->
<div id="klikmomen_toast" style="display:none; position:fixed; bottom:28px; left:50%; transform:translateX(-50%); z-index:999999; background:rgba(30, 41, 59, 0.95); backdrop-filter:blur(10px); color:#FFFFFF; padding:12px 22px; border-radius:50px; font-size:12.5px; font-weight:600; font-family:'Sora', sans-serif; box-shadow:0 10px 30px rgba(0,0,0,0.25); border:1px solid rgba(255,255,255,0.18); align-items:center; gap:8px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#68D391" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
    <span id="klikmomen_toast_msg">Berhasil disalin!</span>
</div>

<script>
// Antigravity 3D Motion 05 Template Helpers
document.addEventListener('DOMContentLoaded', function() {
    // 1. Robust Countdown Timer
    var countdownWrapper = document.querySelector('.elementor-countdown-wrapper');
    if (countdownWrapper) {
        var targetTimestamp = parseInt(countdownWrapper.getAttribute('data-date'), 10);
        if (targetTimestamp) {
            var targetMs = targetTimestamp * 1000;
            function updateCountdown() {
                var now = new Date().getTime();
                var diff = targetMs - now;
                if (diff < 0) diff = 0;

                var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                var dEl = countdownWrapper.querySelector('.elementor-countdown-days');
                var hEl = countdownWrapper.querySelector('.elementor-countdown-hours');
                var mEl = countdownWrapper.querySelector('.elementor-countdown-minutes');
                var sEl = countdownWrapper.querySelector('.elementor-countdown-seconds');

                if (dEl) dEl.textContent = String(days).padStart(2, '0');
                if (hEl) hEl.textContent = String(hours).padStart(2, '0');
                if (mEl) mEl.textContent = String(minutes).padStart(2, '0');
                if (sEl) sEl.textContent = String(seconds).padStart(2, '0');
            }
            updateCountdown();
            setInterval(updateCountdown, 1000);
        }
    }

    // 2. Toast System
    window.showToast = function(msg) {
        var t = document.getElementById('klikmomen_toast');
        var m = document.getElementById('klikmomen_toast_msg');
        if (!t || !m) return;
        m.textContent = msg;
        t.style.display = 'flex';
        t.style.opacity = '1';
        clearTimeout(window._toastTimer);
        window._toastTimer = setTimeout(function() {
            t.style.display = 'none';
        }, 3200);
    };

    // 3. Copy Text Helper
    window.copyGiftText = function(text, label) {
        if (!text) return;
        navigator.clipboard.writeText(text).then(function() {
            showToast((label || 'Teks') + ' berhasil disalin ke clipboard!');
        }).catch(function() {
            var tempInput = document.createElement('input');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            showToast((label || 'Teks') + ' berhasil disalin!');
        });
    };

    // 4. Gift Toggle Box
    var btnGift = document.getElementById('btn_gift');
    var secGift = document.getElementById('sec_gift');
    if (btnGift && secGift) {
        btnGift.addEventListener('click', function(e) {
            e.preventDefault();
            if (secGift.style.display === 'none' || secGift.style.display === '') {
                secGift.style.display = 'block';
                btnGift.style.display = 'none';
                secGift.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    // 5. Interactive Wish Submission
    window.handleWishSubmit = function(e) {
        if (e) {
            if (typeof e.preventDefault === 'function') e.preventDefault();
            if (typeof e.stopPropagation === 'function') e.stopPropagation();
        }
        var nameInput = document.getElementById('wish_name');
        var attendanceInput = document.getElementById('wish_attendance');
        var messageInput = document.getElementById('wish_message');
        var btn = document.getElementById('wish_btn_submit');
        var container = document.getElementById('wishes_stream_container');

        if (!nameInput || !messageInput || !container) return false;

        var name = nameInput.value.trim();
        var attendance = attendanceInput ? attendanceInput.value : 'Hadir (1 Orang)';
        var message = messageInput.value.trim();

        if (!name || !message) {
            showToast('Silakan isi nama dan doa restu Anda.');
            return false;
        }

        var originalBtnHtml = btn ? btn.innerHTML : '';
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<span>Mengirimkan...</span>';
        }

        var invitationSlug = "{{ $invitation->slug ?? '' }}";
        if (invitationSlug) {
            fetch('/u/' + invitationSlug + '/wishes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ guest_name: name, attendance: attendance, message: message })
            }).catch(function(){});
        }

        setTimeout(function() {
            var card = document.createElement('div');
            card.className = 'wish-item-card';
            card.style.cssText = 'background: #FFFFFF; border-radius: 16px; border: 1px solid #E2E8F0; padding: 14px 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: left;';
            
            function esc(t) {
                var d = document.createElement('div');
                d.textContent = t;
                return d.innerHTML;
            }

            var badgeBg = '#EEF4F8';
            var badgeCol = '#34495E';
            if (attendance.indexOf('Tidak') !== -1) {
                badgeBg = '#FED7D7';
                badgeCol = '#9B2C2C';
            } else if (attendance.indexOf('Hadir') !== -1) {
                badgeBg = '#E8F3E5';
                badgeCol = '#2D5A27';
            }

            card.innerHTML = '<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">' +
                '<span style="font-family: \'Playfair Display\', serif; font-weight: 700; font-size: 13.5px; color: #1E293B;">' + esc(name) + '</span>' +
                '<span style="background: ' + badgeBg + '; color: ' + badgeCol + '; font-size: 9.5px; font-weight: 600; padding: 2px 8px; border-radius: 9999px; font-family: \'Sora\', sans-serif; white-space: nowrap;">' + esc(attendance) + '</span>' +
                '</div>' +
                '<p style="font-size: 12px; color: #4B5563; font-style: italic; line-height: 1.55; margin: 0 0 6px; font-family: \'Sora\', sans-serif;">' + esc(message) + '</p>' +
                '<span style="font-size: 10px; color: #9CA3AF; display: block; text-align: right; font-family: \'Sora\', sans-serif;">Baru saja</span>';

            if (container.firstChild) {
                container.insertBefore(card, container.firstChild);
            } else {
                container.appendChild(card);
            }

            messageInput.value = '';
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalBtnHtml;
            }

            showToast('Terima kasih! Doa restu Anda telah terkirim.');
        }, 350);

        return false;
    };

    // GALLERY MODAL LIGHTBOX
    var galleryPhotos = {!! json_encode(array_values($data['galleries'] ?? [])) !!};
    var currentGalleryIdx = 0;

    window.openGalleryModal = function(idx) {
        if (!galleryPhotos || galleryPhotos.length === 0) return;
        currentGalleryIdx = idx;
        updateModalPhoto();
        var modal = document.getElementById('gallery_lightbox_modal');
        if (modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeGalleryModal = function(e, force) {
        if (force || (e && (e.target && e.target.id === 'gallery_lightbox_modal'))) {
            var modal = document.getElementById('gallery_lightbox_modal');
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
    };

    window.prevGalleryModal = function(e) {
        if (e) e.stopPropagation();
        if (galleryPhotos.length <= 1) return;
        currentGalleryIdx = (currentGalleryIdx - 1 + galleryPhotos.length) % galleryPhotos.length;
        updateModalPhoto();
    };

    window.nextGalleryModal = function(e) {
        if (e) e.stopPropagation();
        if (galleryPhotos.length <= 1) return;
        currentGalleryIdx = (currentGalleryIdx + 1) % galleryPhotos.length;
        updateModalPhoto();
    };

    function updateModalPhoto() {
        var img = document.getElementById('gallery_lightbox_img');
        var counter = document.getElementById('gallery_lightbox_counter');
        if (img && galleryPhotos[currentGalleryIdx]) {
            img.src = galleryPhotos[currentGalleryIdx];
        }
        if (counter) {
            counter.textContent = (currentGalleryIdx + 1) + ' / ' + galleryPhotos.length;
        }
        var prevBtn = document.getElementById('modal_prev_btn');
        var nextBtn = document.getElementById('modal_next_btn');
        if (prevBtn) prevBtn.style.display = galleryPhotos.length > 1 ? 'flex' : 'none';
        if (nextBtn) nextBtn.style.display = galleryPhotos.length > 1 ? 'flex' : 'none';
    }

    document.addEventListener('keydown', function(e) {
        var modal = document.getElementById('gallery_lightbox_modal');
        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') closeGalleryModal(null, true);
            if (e.key === 'ArrowLeft') prevGalleryModal(null);
            if (e.key === 'ArrowRight') nextGalleryModal(null);
        }
    });
});
</script>
@include('demo.partials.preview-sync')

</body>
</html>
<!-- Performance optimized by Redis Object Cache. Learn more: https://wprediscache.com -->


<!-- Page uncached by LiteSpeed Cache 7.9 on 2026-09-11 09:43:28 -->