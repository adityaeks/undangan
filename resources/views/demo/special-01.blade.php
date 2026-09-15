@php
    $coverPhotoUrl = $data['cover_image'] ?? $data['groom']['photo'] ?? $data['bride']['photo'] ?? '/themes/luxury-01/uploads/2025/02/thumbnail-luxury-01-1.jpg';
    $bridePhotoUrl = $data['bride']['photo'] ?? $data['cover_image'] ?? '/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-12.jpg';
    $groomPhotoUrl = $data['groom']['photo'] ?? $data['cover_image'] ?? '/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-13.jpg';
    $saveTheDateUrl = (!empty($data['galleries']) && count($data['galleries']) > 0) ? $data['galleries'][0] : ($data['cover_image'] ?? '/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-11.jpg');
    $closingPhotoUrl = (!empty($data['galleries']) && count($data['galleries']) > 1) ? $data['galleries'][1] : ($saveTheDateUrl ?? '/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-10.jpg');
@endphp
<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playball&family=Playfair+Display:ital,wght@0,400..800;1,400..800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		
<meta name="robots" content="noindex,nofollow,noarchive,nosnippet,noimageindex" />

<title>{{ $data['title'] ?? ('The Wedding of ' . ($data['bride']['nickname'] ?? 'Putri') . ' & ' . ($data['groom']['nickname'] ?? 'Andika')) }}</title>

<style id="wp-img-auto-sizes-contain-inline-css">
img:is([sizes=auto i],[sizes^="auto," i]){contain-intrinsic-size:3000px 1500px}
/*# sourceURL=wp-img-auto-sizes-contain-inline-css */
</style>
<link rel='stylesheet' id='dce-animations-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/animations.css?ver=3.4.0' media='all' />

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
<link rel='stylesheet' id='dashicons-css' href='/themes/3d-motion-05/wp-includes/css/dashicons.css?ver=7.0.4' media='all' />
<link rel='stylesheet' id='jet-engine-frontend-css' href='/themes/3d-motion-05/plugins/jet-engine/assets/css/frontend.css?ver=3.8.14.3' media='all' />
<style id="wp-global-styles-placeholder-inline-css">
:root { --wp-internal-comment: "Placeholder for wp_hoist_late_printed_styles() to replace with the global-styles printed at wp_footer." }
/*# sourceURL=wp-global-styles-placeholder-inline-css */
</style>
<link rel='stylesheet' id='uaf_client_css-css' href='/wp-content/uploads/useanyfont/uaf.css?ver=1786431129' media='all' />
<link rel='stylesheet' id='wpb-lib-frontend-css' href='/themes/3d-motion-05/plugins/wpbits-addons-for-elementor/assets/css/frontend.min.css?ver=1.8.1' media='all' />
<link rel='stylesheet' id='wds-elementor-css' href='/themes/3d-motion-05/plugins/weddingsaas-pro/assets/css/wds-elementor.css?ver=2.10.2.1' media='all' />
<link rel='stylesheet' id='saic_style-css' href='/themes/3d-motion-05/plugins/weddingsaas-pro/assets/plugins/custom/commentpress/saic_style.css?ver=2.10.2.1' media='screen' />
<link rel='stylesheet' id='dce-style-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/style.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='dce-dynamic-visibility-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/dynamic-visibility.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='dce-tooltip-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/tooltip.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='wds-reset-css' href='#/wp-content/themes/weddingsaas-wp/assets/css/reset.css?ver=2.0.11' media='all' />
<link rel='stylesheet' id='betterdocs-elementor-editor-css' href='/themes/3d-motion-05/plugins/betterdocs/assets/static/elementor/css/betterdocs-el-edit.css?ver=1788681705' media='all' />
<link rel='stylesheet' id='e-animation-fadeInDown-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInDown.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='elementor-frontend-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/frontend.css?ver=4.2.4' media='all' />
<style id="elementor-frontend-inline-css">
@-webkit-keyframes ha_fadeIn{0%{opacity:0}to{opacity:1}}@keyframes ha_fadeIn{0%{opacity:0}to{opacity:1}}@-webkit-keyframes ha_zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@keyframes ha_zoomIn{0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}50%{opacity:1}}@-webkit-keyframes ha_rollIn{0%{opacity:0;-webkit-transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg);transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg)}to{opacity:1}}@keyframes ha_rollIn{0%{opacity:0;-webkit-transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg);transform:translate3d(-100%,0,0) rotate3d(0,0,1,-120deg)}to{opacity:1}}@-webkit-keyframes ha_bounce{0%,20%,53%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}40%,43%{-webkit-transform:translate3d(0,-30px,0) scaleY(1.1);transform:translate3d(0,-30px,0) scaleY(1.1);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}70%{-webkit-transform:translate3d(0,-15px,0) scaleY(1.05);transform:translate3d(0,-15px,0) scaleY(1.05);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}80%{-webkit-transition-timing-function:cubic-bezier(.215,.61,.355,1);transition-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translate3d(0,0,0) scaleY(.95);transform:translate3d(0,0,0) scaleY(.95)}90%{-webkit-transform:translate3d(0,-4px,0) scaleY(1.02);transform:translate3d(0,-4px,0) scaleY(1.02)}}@keyframes ha_bounce{0%,20%,53%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}40%,43%{-webkit-transform:translate3d(0,-30px,0) scaleY(1.1);transform:translate3d(0,-30px,0) scaleY(1.1);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}70%{-webkit-transform:translate3d(0,-15px,0) scaleY(1.05);transform:translate3d(0,-15px,0) scaleY(1.05);-webkit-animation-timing-function:cubic-bezier(.755,.05,.855,.06);animation-timing-function:cubic-bezier(.755,.05,.855,.06)}80%{-webkit-transition-timing-function:cubic-bezier(.215,.61,.355,1);transition-timing-function:cubic-bezier(.215,.61,.355,1);-webkit-transform:translate3d(0,0,0) scaleY(.95);transform:translate3d(0,0,0) scaleY(.95)}90%{-webkit-transform:translate3d(0,-4px,0) scaleY(1.02);transform:translate3d(0,-4px,0) scaleY(1.02)}}@-webkit-keyframes ha_bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{opacity:1;-webkit-transform:scale3d(1.03,1.03,1.03);transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{opacity:1}}@keyframes ha_bounceIn{0%,20%,40%,60%,80%,to{-webkit-animation-timing-function:cubic-bezier(.215,.61,.355,1);animation-timing-function:cubic-bezier(.215,.61,.355,1)}0%{opacity:0;-webkit-transform:scale3d(.3,.3,.3);transform:scale3d(.3,.3,.3)}20%{-webkit-transform:scale3d(1.1,1.1,1.1);transform:scale3d(1.1,1.1,1.1)}40%{-webkit-transform:scale3d(.9,.9,.9);transform:scale3d(.9,.9,.9)}60%{opacity:1;-webkit-transform:scale3d(1.03,1.03,1.03);transform:scale3d(1.03,1.03,1.03)}80%{-webkit-transform:scale3d(.97,.97,.97);transform:scale3d(.97,.97,.97)}to{opacity:1}}@-webkit-keyframes ha_flipInX{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(1,0,0,90deg);transform:perspective(400px) rotate3d(1,0,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-20deg);transform:perspective(400px) rotate3d(1,0,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(1,0,0,10deg);transform:perspective(400px) rotate3d(1,0,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-5deg);transform:perspective(400px) rotate3d(1,0,0,-5deg)}}@keyframes ha_flipInX{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(1,0,0,90deg);transform:perspective(400px) rotate3d(1,0,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-20deg);transform:perspective(400px) rotate3d(1,0,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(1,0,0,10deg);transform:perspective(400px) rotate3d(1,0,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(1,0,0,-5deg);transform:perspective(400px) rotate3d(1,0,0,-5deg)}}@-webkit-keyframes ha_flipInY{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}}@keyframes ha_flipInY{0%{opacity:0;-webkit-transform:perspective(400px) rotate3d(0,1,0,90deg);transform:perspective(400px) rotate3d(0,1,0,90deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}40%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-20deg);transform:perspective(400px) rotate3d(0,1,0,-20deg);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}60%{opacity:1;-webkit-transform:perspective(400px) rotate3d(0,1,0,10deg);transform:perspective(400px) rotate3d(0,1,0,10deg)}80%{-webkit-transform:perspective(400px) rotate3d(0,1,0,-5deg);transform:perspective(400px) rotate3d(0,1,0,-5deg)}}@-webkit-keyframes ha_swing{20%{-webkit-transform:rotate3d(0,0,1,15deg);transform:rotate3d(0,0,1,15deg)}40%{-webkit-transform:rotate3d(0,0,1,-10deg);transform:rotate3d(0,0,1,-10deg)}60%{-webkit-transform:rotate3d(0,0,1,5deg);transform:rotate3d(0,0,1,5deg)}80%{-webkit-transform:rotate3d(0,0,1,-5deg);transform:rotate3d(0,0,1,-5deg)}}@keyframes ha_swing{20%{-webkit-transform:rotate3d(0,0,1,15deg);transform:rotate3d(0,0,1,15deg)}40%{-webkit-transform:rotate3d(0,0,1,-10deg);transform:rotate3d(0,0,1,-10deg)}60%{-webkit-transform:rotate3d(0,0,1,5deg);transform:rotate3d(0,0,1,5deg)}80%{-webkit-transform:rotate3d(0,0,1,-5deg);transform:rotate3d(0,0,1,-5deg)}}@-webkit-keyframes ha_slideInDown{0%{visibility:visible;-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0)}}@keyframes ha_slideInDown{0%{visibility:visible;-webkit-transform:translate3d(0,-100%,0);transform:translate3d(0,-100%,0)}}@-webkit-keyframes ha_slideInUp{0%{visibility:visible;-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}}@keyframes ha_slideInUp{0%{visibility:visible;-webkit-transform:translate3d(0,100%,0);transform:translate3d(0,100%,0)}}@-webkit-keyframes ha_slideInLeft{0%{visibility:visible;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@keyframes ha_slideInLeft{0%{visibility:visible;-webkit-transform:translate3d(-100%,0,0);transform:translate3d(-100%,0,0)}}@-webkit-keyframes ha_slideInRight{0%{visibility:visible;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}@keyframes ha_slideInRight{0%{visibility:visible;-webkit-transform:translate3d(100%,0,0);transform:translate3d(100%,0,0)}}.ha_fadeIn{-webkit-animation-name:ha_fadeIn;animation-name:ha_fadeIn}.ha_zoomIn{-webkit-animation-name:ha_zoomIn;animation-name:ha_zoomIn}.ha_rollIn{-webkit-animation-name:ha_rollIn;animation-name:ha_rollIn}.ha_bounce{-webkit-transform-origin:center bottom;-ms-transform-origin:center bottom;transform-origin:center bottom;-webkit-animation-name:ha_bounce;animation-name:ha_bounce}.ha_bounceIn{-webkit-animation-name:ha_bounceIn;animation-name:ha_bounceIn;-webkit-animation-duration:.75s;-webkit-animation-duration:calc(var(--animate-duration)*.75);animation-duration:.75s;animation-duration:calc(var(--animate-duration)*.75)}.ha_flipInX,.ha_flipInY{-webkit-animation-name:ha_flipInX;animation-name:ha_flipInX;-webkit-backface-visibility:visible!important;backface-visibility:visible!important}.ha_flipInY{-webkit-animation-name:ha_flipInY;animation-name:ha_flipInY}.ha_swing{-webkit-transform-origin:top center;-ms-transform-origin:top center;transform-origin:top center;-webkit-animation-name:ha_swing;animation-name:ha_swing}.ha_slideInDown{-webkit-animation-name:ha_slideInDown;animation-name:ha_slideInDown}.ha_slideInUp{-webkit-animation-name:ha_slideInUp;animation-name:ha_slideInUp}.ha_slideInLeft{-webkit-animation-name:ha_slideInLeft;animation-name:ha_slideInLeft}.ha_slideInRight{-webkit-animation-name:ha_slideInRight;animation-name:ha_slideInRight}.ha-css-transform-yes{-webkit-transition-duration:var(--ha-tfx-transition-duration, .2s);transition-duration:var(--ha-tfx-transition-duration, .2s);-webkit-transition-property:-webkit-transform;transition-property:transform;transition-property:transform,-webkit-transform;-webkit-transform:translate(var(--ha-tfx-translate-x, 0),var(--ha-tfx-translate-y, 0)) scale(var(--ha-tfx-scale-x, 1),var(--ha-tfx-scale-y, 1)) skew(var(--ha-tfx-skew-x, 0),var(--ha-tfx-skew-y, 0)) rotateX(var(--ha-tfx-rotate-x, 0)) rotateY(var(--ha-tfx-rotate-y, 0)) rotateZ(var(--ha-tfx-rotate-z, 0));transform:translate(var(--ha-tfx-translate-x, 0),var(--ha-tfx-translate-y, 0)) scale(var(--ha-tfx-scale-x, 1),var(--ha-tfx-scale-y, 1)) skew(var(--ha-tfx-skew-x, 0),var(--ha-tfx-skew-y, 0)) rotateX(var(--ha-tfx-rotate-x, 0)) rotateY(var(--ha-tfx-rotate-y, 0)) rotateZ(var(--ha-tfx-rotate-z, 0))}.ha-css-transform-yes:hover{-webkit-transform:translate(var(--ha-tfx-translate-x-hover, var(--ha-tfx-translate-x, 0)),var(--ha-tfx-translate-y-hover, var(--ha-tfx-translate-y, 0))) scale(var(--ha-tfx-scale-x-hover, var(--ha-tfx-scale-x, 1)),var(--ha-tfx-scale-y-hover, var(--ha-tfx-scale-y, 1))) skew(var(--ha-tfx-skew-x-hover, var(--ha-tfx-skew-x, 0)),var(--ha-tfx-skew-y-hover, var(--ha-tfx-skew-y, 0))) rotateX(var(--ha-tfx-rotate-x-hover, var(--ha-tfx-rotate-x, 0))) rotateY(var(--ha-tfx-rotate-y-hover, var(--ha-tfx-rotate-y, 0))) rotateZ(var(--ha-tfx-rotate-z-hover, var(--ha-tfx-rotate-z, 0)));transform:translate(var(--ha-tfx-translate-x-hover, var(--ha-tfx-translate-x, 0)),var(--ha-tfx-translate-y-hover, var(--ha-tfx-translate-y, 0))) scale(var(--ha-tfx-scale-x-hover, var(--ha-tfx-scale-x, 1)),var(--ha-tfx-scale-y-hover, var(--ha-tfx-scale-y, 1))) skew(var(--ha-tfx-skew-x-hover, var(--ha-tfx-skew-x, 0)),var(--ha-tfx-skew-y-hover, var(--ha-tfx-skew-y, 0))) rotateX(var(--ha-tfx-rotate-x-hover, var(--ha-tfx-rotate-x, 0))) rotateY(var(--ha-tfx-rotate-y-hover, var(--ha-tfx-rotate-y, 0))) rotateZ(var(--ha-tfx-rotate-z-hover, var(--ha-tfx-rotate-z, 0)))}.happy-addon>.elementor-widget-container{word-wrap:break-word;overflow-wrap:break-word}.happy-addon>.elementor-widget-container,.happy-addon>.elementor-widget-container *{-webkit-box-sizing:border-box;box-sizing:border-box}.happy-addon:not(:has(.elementor-widget-container)),.happy-addon:not(:has(.elementor-widget-container)) *{-webkit-box-sizing:border-box;box-sizing:border-box;word-wrap:break-word;overflow-wrap:break-word}.happy-addon p:empty{display:none}.happy-addon .elementor-inline-editing{min-height:auto!important}.happy-addon-pro img{max-width:100%;height:auto;-o-object-fit:cover;object-fit:cover}.ha-screen-reader-text{position:absolute;overflow:hidden;clip:rect(1px,1px,1px,1px);margin:-1px;padding:0;width:1px;height:1px;border:0;word-wrap:normal!important;-webkit-clip-path:inset(50%);clip-path:inset(50%)}.ha-has-bg-overlay>.elementor-widget-container{position:relative;z-index:1}.ha-has-bg-overlay>.elementor-widget-container:before{position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;content:""}.ha-has-bg-overlay:not(:has(.elementor-widget-container)){position:relative;z-index:1}.ha-has-bg-overlay:not(:has(.elementor-widget-container)):before{position:absolute;top:0;left:0;z-index:-1;width:100%;height:100%;content:""}.ha-popup--is-enabled .ha-js-popup,.ha-popup--is-enabled .ha-js-popup img{cursor:-webkit-zoom-in!important;cursor:zoom-in!important}.mfp-wrap .mfp-arrow,.mfp-wrap .mfp-close{background-color:transparent}.mfp-wrap .mfp-arrow:focus,.mfp-wrap .mfp-close:focus{outline-width:thin}.ha-advanced-tooltip-enable{position:relative;cursor:pointer;--ha-tooltip-arrow-color:black;--ha-tooltip-arrow-distance:0}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content{position:absolute;z-index:999;display:none;padding:5px 0;width:120px;height:auto;border-radius:6px;background-color:#000;color:#fff;text-align:center;opacity:0}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content::after{position:absolute;border-width:5px;border-style:solid;content:""}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content.no-arrow::after{visibility:hidden}.ha-advanced-tooltip-enable .ha-advanced-tooltip-content.show{display:inline-block;opacity:1}.ha-advanced-tooltip-enable.ha-advanced-tooltip-top .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-top .ha-advanced-tooltip-content{top:unset;right:0;bottom:calc(101% + var(--ha-tooltip-arrow-distance));left:0;margin:0 auto}.ha-advanced-tooltip-enable.ha-advanced-tooltip-top .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-top .ha-advanced-tooltip-content::after{top:100%;right:unset;bottom:unset;left:50%;border-color:var(--ha-tooltip-arrow-color) transparent transparent transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-bottom .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-bottom .ha-advanced-tooltip-content{top:calc(101% + var(--ha-tooltip-arrow-distance));right:0;bottom:unset;left:0;margin:0 auto}.ha-advanced-tooltip-enable.ha-advanced-tooltip-bottom .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-bottom .ha-advanced-tooltip-content::after{top:unset;right:unset;bottom:100%;left:50%;border-color:transparent transparent var(--ha-tooltip-arrow-color) transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-left .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-left .ha-advanced-tooltip-content{top:50%;right:calc(101% + var(--ha-tooltip-arrow-distance));bottom:unset;left:unset;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-left .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-left .ha-advanced-tooltip-content::after{top:50%;right:unset;bottom:unset;left:100%;border-color:transparent transparent transparent var(--ha-tooltip-arrow-color);-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-right .ha-advanced-tooltip-content,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-right .ha-advanced-tooltip-content{top:50%;right:unset;bottom:unset;left:calc(101% + var(--ha-tooltip-arrow-distance));-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}.ha-advanced-tooltip-enable.ha-advanced-tooltip-right .ha-advanced-tooltip-content::after,body[data-elementor-device-mode=tablet] .ha-advanced-tooltip-enable.ha-advanced-tooltip-tablet-right .ha-advanced-tooltip-content::after{top:50%;right:100%;bottom:unset;left:unset;border-color:transparent var(--ha-tooltip-arrow-color) transparent transparent;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-top .ha-advanced-tooltip-content{top:unset;right:0;bottom:calc(101% + var(--ha-tooltip-arrow-distance));left:0;margin:0 auto}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-top .ha-advanced-tooltip-content::after{top:100%;right:unset;bottom:unset;left:50%;border-color:var(--ha-tooltip-arrow-color) transparent transparent transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-bottom .ha-advanced-tooltip-content{top:calc(101% + var(--ha-tooltip-arrow-distance));right:0;bottom:unset;left:0;margin:0 auto}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-bottom .ha-advanced-tooltip-content::after{top:unset;right:unset;bottom:100%;left:50%;border-color:transparent transparent var(--ha-tooltip-arrow-color) transparent;-webkit-transform:translateX(-50%);-ms-transform:translateX(-50%);transform:translateX(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-left .ha-advanced-tooltip-content{top:50%;right:calc(101% + var(--ha-tooltip-arrow-distance));bottom:unset;left:unset;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-left .ha-advanced-tooltip-content::after{top:50%;right:unset;bottom:unset;left:100%;border-color:transparent transparent transparent var(--ha-tooltip-arrow-color);-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-right .ha-advanced-tooltip-content{top:50%;right:unset;bottom:unset;left:calc(101% + var(--ha-tooltip-arrow-distance));-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body[data-elementor-device-mode=mobile] .ha-advanced-tooltip-enable.ha-advanced-tooltip-mobile-right .ha-advanced-tooltip-content::after{top:50%;right:100%;bottom:unset;left:unset;border-color:transparent var(--ha-tooltip-arrow-color) transparent transparent;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}body.elementor-editor-active .happy-addon.ha-gravityforms .gform_wrapper{display:block!important}.ha-scroll-to-top-wrap.ha-scroll-to-top-hide{display:none}.ha-scroll-to-top-wrap.edit-mode,.ha-scroll-to-top-wrap.single-page-off{display:none!important}.ha-scroll-to-top-button{position:fixed;right:15px;bottom:15px;z-index:9999;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-ms-flex-align:center;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;width:50px;height:50px;border-radius:50px;background-color:#5636d1;color:#fff;text-align:center;opacity:1;cursor:pointer;-webkit-transition:all .3s;transition:all .3s}.ha-scroll-to-top-button i{color:#fff;font-size:16px}.ha-scroll-to-top-button:hover{background-color:#e2498a}
.elementor-22504 .elementor-element.elementor-element-7b9bdea .elementor-heading-title{font-size:42px;}.elementor-22504 .elementor-element.elementor-element-7f8812b .elementor-heading-title{font-size:42px;}.elementor-22504 .elementor-element.elementor-element-2870960:not(.elementor-motion-effects-element-type-background), .elementor-22504 .elementor-element.elementor-element-2870960 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333A6;}.elementor-22504 .elementor-element.elementor-element-3c343a6 .elementor-heading-title{font-size:42px;}.elementor-22504 .elementor-element.elementor-element-8f1925f .elementor-heading-title{font-size:42px;}.elementor-22504 .elementor-element.elementor-element-43d6938f > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-7758529 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-8a485f3 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-a2b4550 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-c4d61a1 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-0c6f27d > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-0826e4c .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-a845224 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-6e039b7 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-d57f08b .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-3ebc0bc .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-ec16f65 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-28aea2f > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-f0b632e > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-eb93dd0 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-6739ea1 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-3dd008ad > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-a4c4034 .elementor-heading-title{font-size:30px;color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-6ada326 .elementor-button{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-e039c1f > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-f332e88 .elementor-heading-title{font-size:30px;color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-853d6bb .elementor-button{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-725c61a9 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-af89533 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-ad48c5e > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-29e5574 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-700017e0 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-c16e51c .elementor-heading-title{font-size:30px;color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-e186042 .elementor-button{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-9eabdd4 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-13b42f3 .elementor-heading-title{font-size:30px;color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-338d011 .elementor-button{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-20bc11e > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-23aa393f > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-a9d35af > .elementor-background-overlay{background-color:#6d8998;}.elementor-22504 .elementor-element.elementor-element-587fa63a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor-22504 .elementor-element.elementor-element-587fa63a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-b2cf532 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-88a7b8a .elementor-button:hover, .elementor-22504 .elementor-element.elementor-element-88a7b8a .elementor-button:focus{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-88a7b8a .elementor-button{fill:#5e5e5e;color:#5e5e5e;border-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-6fb65d6a > .elementor-background-overlay{background-color:#6d8998;}.elementor-22504 .elementor-element.elementor-element-da41331 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-adc246b .elementor-button:hover, .elementor-22504 .elementor-element.elementor-element-adc246b .elementor-button:focus{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-adc246b .elementor-button{fill:#5e5e5e;color:#5e5e5e;border-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-53cbacd0:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor-22504 .elementor-element.elementor-element-53cbacd0 > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-78918e03 > .elementor-background-overlay{background-color:#6d8998;}.elementor-22504 .elementor-element.elementor-element-4379f05a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor-22504 .elementor-element.elementor-element-4379f05a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-4fcb3a4 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-ab6ee34 .elementor-button:hover, .elementor-22504 .elementor-element.elementor-element-ab6ee34 .elementor-button:focus{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-ab6ee34 .elementor-button{fill:#5e5e5e;color:#5e5e5e;border-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-757c1fd > .elementor-background-overlay{background-color:#6d8998;}.elementor-22504 .elementor-element.elementor-element-6a4e337 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-1a6fa6c .elementor-button:hover, .elementor-22504 .elementor-element.elementor-element-1a6fa6c .elementor-button:focus{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-1a6fa6c .elementor-button{fill:#5e5e5e;color:#5e5e5e;border-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-fc1904d:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor-22504 .elementor-element.elementor-element-fc1904d > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-06fd409.elementor-view-stacked .elementor-icon{background-color:#000000;}.elementor-22504 .elementor-element.elementor-element-06fd409.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-06fd409.elementor-view-default .elementor-icon{color:#000000;border-color:#000000;}.elementor-22504 .elementor-element.elementor-element-06fd409.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-06fd409.elementor-view-default .elementor-icon svg{fill:#000000;}.elementor-22504 .elementor-element.elementor-element-9346b7b.elementor-view-stacked .elementor-icon{background-color:#faf5f5;}.elementor-22504 .elementor-element.elementor-element-9346b7b.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-9346b7b.elementor-view-default .elementor-icon{color:#faf5f5;border-color:#faf5f5;}.elementor-22504 .elementor-element.elementor-element-9346b7b.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-9346b7b.elementor-view-default .elementor-icon svg{fill:#faf5f5;}.elementor-22504 .elementor-element.elementor-element-aaba4e7.elementor-view-stacked .elementor-icon{background-color:#000000;}.elementor-22504 .elementor-element.elementor-element-aaba4e7.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-aaba4e7.elementor-view-default .elementor-icon{color:#000000;border-color:#000000;}.elementor-22504 .elementor-element.elementor-element-aaba4e7.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-aaba4e7.elementor-view-default .elementor-icon svg{fill:#000000;}.elementor-22504 .elementor-element.elementor-element-3b6ccf4.elementor-view-stacked .elementor-icon{background-color:#000000;}.elementor-22504 .elementor-element.elementor-element-3b6ccf4.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-3b6ccf4.elementor-view-default .elementor-icon{color:#000000;border-color:#000000;}.elementor-22504 .elementor-element.elementor-element-3b6ccf4.elementor-view-framed .elementor-icon, .elementor-22504 .elementor-element.elementor-element-3b6ccf4.elementor-view-default .elementor-icon svg{fill:#000000;}.elementor-22504 .elementor-element.elementor-element-318b31ac > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-5931375 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-e4376d9{--divider-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-85d157e .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-340493e .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-6b5bd22{--divider-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-32e3662 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-9a5e447 .jet-timeline-item .timeline-item__card-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-f7af679 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-88dcdd > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-3c58a9b4 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-42fe188a{--divider-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-2c02a5ec .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-919b7ef .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-5ad3c5c{--divider-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-848ed45 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-cbef084 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-03728df .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-6e59bcc > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-802d262 .elementor-button{fill:#333333;color:#333333;}.elementor-22504 .elementor-element.elementor-element-30e164e9 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-7913746 .elementor-heading-title{color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-f07b76a .saic-button{background-color:#5e5e5e25;}.elementor-22504 .elementor-element.elementor-element-f07b76a .saic-button:hover, .elementor-22504 .elementor-element.elementor-element-f07b76a .rvspSelect, .elementor-22504 .elementor-element.elementor-element-f07b76a .saic-button:focus, .elementor-22504 .elementor-element.elementor-element-f07b76a .saic-button:active{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form input[type="submit"], .elementor-22504 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form input[type="button"].saic-form-btn:hover, .elementor-22504 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form .saic-wrap-guest .guest-count{background-color:#5e5e5e;}.elementor-22504 .elementor-element.elementor-element-f07b76a .saic-wrapper ul.saic-container-comments li.saic-item-comment .saic-comment-content .saic-comment-info .saic-commenter-name{color:#5e5e5e !important;}.elementor-22504 .elementor-element.elementor-element-bb53199 > .elementor-background-overlay{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-61d70535:not(.elementor-motion-effects-element-type-background), .elementor-22504 .elementor-element.elementor-element-61d70535 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-100e95a:not(.elementor-motion-effects-element-type-background), .elementor-22504 .elementor-element.elementor-element-100e95a > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#333333;}.elementor-22504 .elementor-element.elementor-element-2e4d24e:not(.elementor-motion-effects-element-type-background), .elementor-22504 .elementor-element.elementor-element-2e4d24e > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:#33333326;}
/*# sourceURL=elementor-frontend-inline-css */
</style>
<link rel='stylesheet' id='widget-heading-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-heading.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='e-animation-zoomIn-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/zoomIn.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='e-animation-fadeInUp-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInUp.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-spacer-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-spacer.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='e-animation-shrink-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/e-animation-shrink.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='swiper-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/swiper/v8/css/swiper.css?ver=8.4.5' media='all' />
<link rel='stylesheet' id='e-swiper-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/conditionals/e-swiper.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-countdown-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/widget-countdown.min.css?ver=4.2.3' media='all' />
<link rel='stylesheet' id='widget-lottie-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/widget-lottie.min.css?ver=4.2.3' media='all' />
<link rel='stylesheet' id='widget-image-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-image.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-divider-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-divider.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='e-animation-fadeIn-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeIn.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='e-animation-fadeInRight-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInRight.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-icon-list-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-icon-list.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-image-carousel-css' href='/themes/3d-motion-05/plugins/elementor/assets/css/widget-image-carousel.min.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='jet-elements-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/jet-elements.css?ver=2.9.2' media='all' />
<link rel='stylesheet' id='jet-timeline-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/addons/jet-timeline.css?ver=2.9.2' media='all' />
<link rel='stylesheet' id='jet-timeline-skin-css' href='/themes/3d-motion-05/plugins/jet-elements/assets/css/skin/jet-timeline.css?ver=2.9.2' media='all' />
<link rel='stylesheet' id='e-animation-fadeInLeft-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/fadeInLeft.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='widget-gallery-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/widget-gallery.min.css?ver=4.2.3' media='all' />
<link rel='stylesheet' id='elementor-gallery-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/e-gallery/css/e-gallery.css?ver=1.2.0' media='all' />
<link rel='stylesheet' id='e-transitions-css' href='/themes/3d-motion-05/plugins/elementor-pro/assets/css/conditionals/transitions.min.css?ver=4.2.3' media='all' />
<link rel='stylesheet' id='dce-copy-to-clipboard-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/css/copy-to-clipboard.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='dce-prism-css-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism.min.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='dce-prism-line-numbers-css-css' href='/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-line-numbers.min.css?ver=3.4.0' media='all' />
<link rel='stylesheet' id='e-animation-grow-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/animations/styles/e-animation-grow.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='elementor-icons-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/eicons/css/elementor-icons.css?ver=5.53.0' media='all' />
<link rel='stylesheet' id='elementor-post-7-css' href='/themes/luxury-01/uploads/elementor/css/post-7.css?ver=1789183427' media='all' />
<link rel='stylesheet' id='jet-form-builder-frontend-css' href='/themes/3d-motion-05/plugins/jetformbuilder/assets/build/frontend/main.css?ver=3.6.5.1' media='all' />
<link rel='stylesheet' id='font-awesome-5-all-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/all.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='font-awesome-4-shim-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/v4-shims.css?ver=4.2.4' media='all' />
<link rel='stylesheet' id='elementor-post-22504-css' href='/themes/luxury-01/uploads/elementor/css/post-22504.css?ver=1789183473' media='all' />
<link rel='stylesheet' id='happy-icons-css' href='/themes/3d-motion-05/plugins/happy-elementor-addons/assets/fonts/style.min.css?ver=3.23.1' media='all' />
<link rel='stylesheet' id='font-awesome-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/font-awesome.css?ver=4.7.0' media='all' />
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
<link rel='stylesheet' id='elementor-gf-poppins-css' href='https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-gf-nunitosans-css' href='https://fonts.googleapis.com/css?family=Nunito+Sans:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&#038;display=auto' media='all' />
<link rel='stylesheet' id='elementor-icons-shared-0-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/fontawesome.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-regular-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/regular.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-brands-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/brands.css?ver=5.15.3' media='all' />
<link rel='stylesheet' id='elementor-icons-fa-solid-css' href='/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/css/solid.css?ver=5.15.3' media='all' />
<script id="jquery-core-js-extra">
var aagb_local_object = {"ajax_url":"/wp-admin/admin-ajax.php","nonce":"a5a4db8d9d","licensing":"","assets":"/themes/3d-motion-05/plugins/advanced-accordion-block/assets/"};
//# sourceURL=jquery-core-js-extra
</script>
<script id="jquery-core-js" src="/themes/3d-motion-05/wp-includes/js/jquery/jquery.js?ver=3.7.1"></script>
<script id="jquery-migrate-js" src="/themes/3d-motion-05/wp-includes/js/jquery/jquery-migrate.js?ver=3.4.1"></script>
<script id="font-awesome-4-shim-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/font-awesome/js/v4-shims.js?ver=4.2.4"></script>
<script id="dom-purify-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/vendor/dom-purify/purify.min.js?ver=3.1.6"></script>
<meta name="generator" content="WordPress 7.0.4" />
	<meta name="color-scheme" content="light dark">
	<meta name="google" content="notranslate" />
	<script>
		jQuery(function($) {
			$("[name='viewport']").attr('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
		});
	</script>
<meta name="generator" content="Elementor 4.2.4; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
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
<!-- End Google Tag Manager --><meta name="theme-color" content="#333333"><meta name="theme-color" content="#333333"><meta name="theme-color" content="#333333"><link rel="icon" href="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-32x32.png" sizes="32x32" />
<link rel="icon" href="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-180x180.png" />
<meta name="msapplication-TileImage" content="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-270x270.png" />
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

.badge-hadir {
    background: #F5E6D3;
    color: #5B1A21;
    font-size: 9.5px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 9999px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
}

.badge-tidak-hadir {
    background: #FED7D7;
    color: #9B2C2C;
    font-size: 9.5px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 9999px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    white-space: nowrap;
}

/* DESKTOP SPLIT LAYOUT & FOOTER FIX */
@media only screen and (min-width: 450px) {
    /* 1. Desktop Left Cover Panel (Fixed) */
    .elementor-element-e47b0ce {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: calc(100% - 450px) !important;
        height: 100vh !important;
        z-index: 1 !important;
        display: flex !important;
        overflow: hidden !important;
    }
    .elementor-element-e47b0ce > .elementor-container {
        width: 100% !important;
        height: 100% !important;
        min-height: 100vh !important;
    }
    .elementor-element-848e89d {
        width: 100% !important;
        height: 100% !important;
        background-image: url('{{ $data['cover_image'] ?? '/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2025/01/0-PEMBUKA.jpg' }}') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        display: flex !important;
    }
    .elementor-element-848e89d > .elementor-element-populated {
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
    }
    .elementor-element-848e89d .elementor-background-overlay {
        background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.65) 100%) !important;
        opacity: 0.75 !important;
    }
    .elementor-element-e47b0ce .elementor-invisible {
        visibility: visible !important;
        opacity: 1 !important;
        animation: none !important;
    }
    .elementor-element-e47b0ce .elementor-heading-title {
        color: #FFFFFF !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.6) !important;
    }
    .elementor-element-a932614 {
        display: none !important;
    }

    /* 2. Desktop Right Column (Invitation) */
    .elementor-element-875d96b {
        position: relative !important;
        z-index: 2 !important;
    }

    /* 3. Constrain Terima Kasih & Footer to 450px aligned right */
    .elementor-element-bb53199,
    .elementor-element-100e95a {
        width: 450px !important;
        max-width: 450px !important;
        margin-left: calc(100% - 450px) !important;
        margin-right: 0 !important;
        position: relative !important;
        z-index: 2 !important;
        box-sizing: border-box !important;
    }
    .elementor-element-bb53199 .elementor-container,
    .elementor-element-100e95a .elementor-container,
    .elementor-element-100e95a footer,
    .elementor-element-d28a23a {
        width: 100% !important;
        max-width: 450px !important;
    }
    .elementor-element-bb53199 {
        background: transparent !important;
    }
}
</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" /></head>
<body class="wp-singular post-template-default single single-post postid-22578 single-format-standard wp-custom-logo wp-embed-responsive wp-theme-weddingsaas-wp wp-child-theme-weddingsaas-wp-child elementor-default elementor-template-canvas elementor-kit-7 elementor-page elementor-page-22578 elementor-page-22504 elementor-page-916707 elementor-page-843619 elementor-page-843600 elementor-page-805683">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4B3LZ2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->		<div data-elementor-type="single-post" data-post-id="22578" data-obj-id="22578" data-elementor-id="22504" class="elementor elementor-22504 e-post-22578 elementor-location-single post-22578 post type-post status-publish format-standard has-post-thumbnail hentry category-pernikahan template-pernikahan-luxury-01" data-elementor-settings="{&quot;ha_cmc_init_switcher&quot;:&quot;no&quot;}" data-elementor-post-type="elementor_library">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-875d96b elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="875d96b" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div data-dce-background-overlay-color="#000000" class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-52f6b538 elementor-hidden-mobile elementor-hidden-tablet" data-id="52f6b538" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap">
					<div class="elementor-background-overlay"></div>
							</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-49f92c84" data-id="49f92c84" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-c3a2441 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="c3a2441" data-element_type="section" data-e-type="section" id="cover" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:26988,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/0-PEMBUKA.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-color="#10101070" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8359aaf" data-id="8359aaf" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-0c497c6 posisi-nama-cover elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0c497c6" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-aa18aae" data-id="aa18aae" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-751175a animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="751175a" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-7b9bdea wdsdv-enabled--yes animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="7b9bdea" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="couple-nickname">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-8faf4ef animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="8faf4ef" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Kepada Yth.<br>Bapak/Ibu/Saudara/i</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-419bc50 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="419bc50" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;_animation_delay&quot;:800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Tes</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-e4ffb61 animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="e4ffb61" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:1800}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">*Mohon maaf jika ada kesalahan dalam penulisan nama / gelar.</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-cfbcf2f elementor-widget elementor-widget-spacer" data-id="cfbcf2f" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-e2611c6 elementor-align-center animated-slow elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-button" data-id="e2611c6" data-element_type="widget" data-e-type="widget" id="btn_open" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:1200}" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="dce-animations">				<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-size-sm elementor-animation-shrink" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="far fa-envelope-open"></i>			</span>
									<span class="elementor-button-text">Buka Undangan</span>
					</span>
					</a>
				</div>
				</div>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-6cddb82 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="6cddb82" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:4000,&quot;jet_parallax_layout_list&quot;:[],&quot;background_slideshow_slide_transition&quot;:&quot;slide_left&quot;,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-overlay-color="#10101070" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-47a23df" data-id="47a23df" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section data-dce-background-color="#333333A6" data-dce-background-overlay-color="#10101059" class="elementor-section elementor-inner-section elementor-element elementor-element-2870960 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="2870960" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3c4afea" data-id="3c4afea" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-ce50a76 posisi-nama-slide-awal elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="ce50a76" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-543d784" data-id="543d784" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-42946fb animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="42946fb" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-3c343a6 wdsdv-enabled--yes animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="3c343a6" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;zoomIn&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="couple-nickname">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-b2d15c0 elementor-widget__width-auto animated-slow wdsdv-enabled--yes elementor-invisible elementor-widget elementor-widget-heading" data-id="b2d15c0" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">28 . 12 . 2027</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-62f8c0b animated-slow elementor-countdown--label-block elementor-invisible elementor-widget elementor-widget-countdown" data-id="62f8c0b" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation_delay&quot;:1200,&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="countdown.default">
				<div class="elementor-widget-container">
							<div class="elementor-countdown-wrapper" data-date="{{ $data['countdown_timestamp'] ?? strtotime('+30 days') }}">
			<div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-days"></span> <span class="elementor-countdown-label">Hari</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-hours"></span> <span class="elementor-countdown-label">Jam</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-minutes"></span> <span class="elementor-countdown-label">Menit</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-seconds"></span> <span class="elementor-countdown-label">Detik</span></div>		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-69107df animated-slow elementor-align-center elementor-invisible elementor-widget elementor-widget-lottie" data-id="69107df" data-element_type="widget" data-e-type="widget" data-settings="{&quot;loop&quot;:&quot;yes&quot;,&quot;source_json&quot;:{&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/2025\/01\/scroll-down-off-white.json&quot;,&quot;id&quot;:22497,&quot;size&quot;:&quot;&quot;},&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;source&quot;:&quot;media_file&quot;,&quot;caption_source&quot;:&quot;none&quot;,&quot;link_to&quot;:&quot;none&quot;,&quot;trigger&quot;:&quot;arriving_to_viewport&quot;,&quot;viewport&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:100}},&quot;play_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;start_point&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:0,&quot;sizes&quot;:[]},&quot;end_point&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:100,&quot;sizes&quot;:[]},&quot;renderer&quot;:&quot;svg&quot;}" data-widget_type="lottie.default">
				<div class="elementor-widget-container">
					<div class="e-lottie__container"><div class="e-lottie__animation"></div></div>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-43d6938f elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="43d6938f" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-654ec53c" data-id="654ec53c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3c8150c6 elementor-widget__width-auto elementor-absolute elementor-widget elementor-widget-image" data-id="3c8150c6" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="700" height="540" src="/themes/luxury-01/uploads/2025/01/img-tree-shadow-01.png" class="attachment-full size-full wp-image-22498" alt="" />															</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-434d2f5 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="434d2f5" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-78fcfed" data-id="78fcfed" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-7758529 elementor-widget__width-auto inv-kiri elementor-widget elementor-widget-heading" data-id="7758529" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['initials']['bride'] ?? 'P' }}</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-e1503ad e-transform elementor-widget__width-auto inv-zoom-in elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="e1503ad" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-8a485f3 elementor-widget__width-auto inv-kanan elementor-widget elementor-widget-heading" data-id="8a485f3" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['initials']['groom'] ?? 'A' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-17afdbf inv-atas animated-slow elementor-widget elementor-widget-heading" data-id="17afdbf" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">"{{ $data['quote_text'] ?? 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.' }}<br><span style="font-size:13px;opacity:0.85;display:inline-block;margin-top:6px;">{{ $data['quote_source'] ?? 'QS. Ar-Rum: 21' }}</span></p>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFFF2" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-0c6f27d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0c6f27d" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-d6bbe4b" data-id="d6bbe4b" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-2382709 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2382709" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-73df8cb" data-id="73df8cb" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-0826e4c elementor-widget__width-inherit inv-kiri elementor-widget elementor-widget-heading" data-id="0826e4c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Kedua</h2>				</div>
				</div>
				<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-a845224 elementor-widget__width-inherit inv-kanan elementor-widget elementor-widget-heading" data-id="a845224" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Mempelai</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-bcf8aff inv-bawah elementor-widget elementor-widget-heading" data-id="bcf8aff" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default"><b>Assalamu’alaikum Warahmatullahi Wabarakatuh</b><br />
<br />
Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah semoga ridho-Mu tercurah mengiringi pernikahan kami.</p>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFFF2" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-28aea2f elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="28aea2f" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-784bf1b7 animated-slow inv-zoom-out foto_mempelai_1 elementor-invisible" data-id="784bf1b7" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_slide_transition&quot;:&quot;slide_left&quot;,&quot;background_slideshow_transition_duration&quot;:3000,&quot;animation&quot;:&quot;fadeIn&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:26992,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/2-WANITA-1.jpg&quot;},{&quot;id&quot;:26993,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/2-WANITA-2.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-f0b632e elementor-section-full_width elementor-section-height-min-height elementor-section-height-default" data-id="f0b632e" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-d1a86b1" data-id="d1a86b1" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a79a8ae elementor-widget elementor-widget-spacer" data-id="a79a8ae" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
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
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-0534b33 animated-slow elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-heading" data-id="0534b33" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="bride-nickname">{{ $data['bride']['nickname'] ?? 'Putri' }}</h2>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-41f6260c" data-id="41f6260c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFFF2" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-3dd008ad elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="3dd008ad" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-50c0b251" data-id="50c0b251" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-a4c4034 inv-bawah elementor-widget elementor-widget-heading" data-id="a4c4034" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="bride-name">{{ $data['bride']['name'] ?? 'Putri Cantika Sari' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-72409c7 inv-bawah elementor-widget elementor-widget-heading" data-id="72409c7" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putri {{ $data['bride']['child_order'] ?? 'Pertama' }} dari</p>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-0f2052b inv-bawah elementor-widget elementor-widget-heading" data-id="0f2052b" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ (!empty($data['bride']['father']) || !empty($data['bride']['mother'])) ? (($data['bride']['father'] ? 'Bapak ' . $data['bride']['father'] : '') . ($data['bride']['father'] && $data['bride']['mother'] ? ' dan ' : '') . ($data['bride']['mother'] ? 'Ibu ' . $data['bride']['mother'] : '')) : 'Bapak Abdul Rozak dan Ibu Adelia Marni' }}</p>				</div>
				</div>
				<div class="elementor-element elementor-element-6ada326 wdsdv-enabled--yes inv-bawah animated-slow elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-button" data-id="6ada326" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
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
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFFF2" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-725c61a9 elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="725c61a9" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-482bcf14" data-id="482bcf14" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap">
							</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-487ade9 animated-slow inv-zoom-out foto_mempelai_2 elementor-invisible" data-id="487ade9" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_slide_transition&quot;:&quot;slide_right&quot;,&quot;background_slideshow_transition_duration&quot;:3000,&quot;animation&quot;:&quot;fadeIn&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:26994,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/3-PRIA-1.jpg&quot;},{&quot;id&quot;:26995,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/3-PRIA-2.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-af89533 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default" data-id="af89533" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-06b788c" data-id="06b788c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-76f901b elementor-widget elementor-widget-spacer" data-id="76f901b" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
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
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-46c9943 animated-slow elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-heading" data-id="46c9943" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="groom-nickname">{{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFFF2" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-700017e0 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="700017e0" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-26794e7c" data-id="26794e7c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-c16e51c inv-bawah elementor-widget elementor-widget-heading" data-id="c16e51c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="groom-name">{{ $data['groom']['name'] ?? 'Putra Andika Pratama' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-7cb8831 inv-bawah elementor-widget elementor-widget-heading" data-id="7cb8831" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putra {{ $data['groom']['child_order'] ?? 'Pertama' }} dari</p>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-da30051 inv-bawah elementor-widget elementor-widget-heading" data-id="da30051" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">{{ (!empty($data['groom']['father']) || !empty($data['groom']['mother'])) ? (($data['groom']['father'] ? 'Bapak ' . $data['groom']['father'] : '') . ($data['groom']['father'] && $data['groom']['mother'] ? ' dan ' : '') . ($data['groom']['mother'] ? 'Ibu ' . $data['groom']['mother'] : '')) : 'Bapak Deni Bastian dan Ibu Aisha Dania' }}</p>				</div>
				</div>
				<div class="elementor-element elementor-element-e186042 wdsdv-enabled--yes inv-bawah animated-slow elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-button" data-id="e186042" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
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
				<section data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-20bc11e elementor-section-height-min-height saveTheDate elementor-section-boxed elementor-section-height-default" data-id="20bc11e" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1500,&quot;background_slideshow_slide_transition&quot;:&quot;slide_up&quot;,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997677,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-9.jpg&quot;},{&quot;id&quot;:997678,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-10.jpg&quot;},{&quot;id&quot;:997679,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-11.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-color="#00000080" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-f64ddc9" data-id="f64ddc9" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-02669aa inv-bawah elementor-widget elementor-widget-heading" data-id="02669aa" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Save The Date</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-b0e3a08 inv-kanan elementor-countdown--label-block elementor-widget elementor-widget-countdown" data-id="b0e3a08" data-element_type="widget" data-e-type="widget" data-widget_type="countdown.default">
				<div class="elementor-widget-container">
							<div class="elementor-countdown-wrapper" data-date="{{ $data['countdown_timestamp'] ?? strtotime('+30 days') }}">
			<div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-days"></span> <span class="elementor-countdown-label">Hari</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-hours"></span> <span class="elementor-countdown-label">Jam</span></div>		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-cb0640f inv-kiri elementor-countdown--label-block elementor-widget elementor-widget-countdown" data-id="cb0640f" data-element_type="widget" data-e-type="widget" data-widget_type="countdown.default">
				<div class="elementor-widget-container">
							<div class="elementor-countdown-wrapper" data-date="{{ $data['countdown_timestamp'] ?? strtotime('+30 days') }}">
			<div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-minutes"></span> <span class="elementor-countdown-label">Menit</span></div><div class="elementor-countdown-item"><span class="elementor-countdown-digits elementor-countdown-seconds"></span> <span class="elementor-countdown-label">Detik</span></div>		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-7450841 elementor-widget elementor-widget-spacer" data-id="7450841" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
				<div class="elementor-widget-container">
							<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
						</div>
				</div>
				<div data-dce-background-color="#FFFFFF1A" class="elementor-element elementor-element-1f5c674 elementor-widget__width-auto inv-atas elementor-widget elementor-widget-wds_calendar" data-id="1f5c674" data-element_type="widget" data-e-type="widget" data-widget_type="wds_calendar.default">
				<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">

			<a href="https://www.google.com/calendar/render?action=TEMPLATE&amp;text=Tema%20Luxury%2001&amp;details=The%20Wedding%20Of%20%3A%3Cbr%3E%3Cbr%3EPutri%20Cantika%20Sari%3Cbr%3E%26amp%3B%3Cbr%3EPutra%20Andika%20Pratama%3Cbr%3E%3Cbr%3E&amp;dates=20271228T010000Z%2F20271229T010000Z" class="elementor-button-link elementor-button elementor-size-sm elementor-animation-shrink" target="_blank" rel="nofollow" role="button">		<span class="elementor-button-content-wrapper wds-flexbox">
							<span class="elementor-button-icon elementor-align-icon-row">
					<i aria-hidden="true" class="far fa-calendar-check"></i>				</span>
						<span class="elementor-button-text">Simpan Tanggal</span>
		</span>
		</a>
			
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-f78579c elementor-hidden-desktop elementor-hidden-tablet elementor-hidden-mobile elementor-widget elementor-widget-html" data-id="f78579c" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<style>
.saveTheDate {
    background: #333333;
}
</style>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#00000080" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-23aa393f elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="23aa393f" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2851b2c5" data-id="2851b2c5" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-c37dfd4 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c37dfd4" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-22f24b1" data-id="22f24b1" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-231229b5 animated-slow inv-bawah elementor-invisible elementor-widget elementor-widget-heading" data-id="231229b5" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Wedding</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-ddf6918 animated-slow inv-kanan elementor-widget-divider--view-line elementor-invisible elementor-widget elementor-widget-divider" data-id="ddf6918" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInRight&quot;}" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-137c8a07 animated-slow inv-atas elementor-invisible elementor-widget elementor-widget-heading" data-id="137c8a07" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Event</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-14591b4a animated-slow elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-invisible" data-id="14591b4a" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-26c7cdd3 inv-atas" data-id="26c7cdd3" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-65af6d38 elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="65af6d38" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1500,&quot;background_slideshow_slide_transition&quot;:&quot;slide_left&quot;,&quot;background_slideshow_transition_duration&quot;:3000,&quot;jet_parallax_layout_list&quot;:[],&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997680,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-12.jpg&quot;},{&quot;id&quot;:997681,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-13.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7cb8047f" data-id="7cb8047f" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:2000,&quot;background_slideshow_slide_transition&quot;:&quot;slide_left&quot;,&quot;background_slideshow_transition_duration&quot;:4000,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#6d8998" class="elementor-section elementor-inner-section elementor-element elementor-element-a9d35af elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="a9d35af" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-color="#333333" class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-587fa63a" data-id="587fa63a" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-2c0f2d7 elementor-widget__width-auto playball elementor-widget elementor-widget-heading" data-id="2c0f2d7" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Akad Nikah</h2>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-54cd7fe1" data-id="54cd7fe1" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-7e1e0086 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7e1e0086" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-5f3473d8" data-id="5f3473d8" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-b2cf532 elementor-widget elementor-widget-heading" data-id="b2cf532" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['day_num'] ?? '28' }}</h2>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-bbc0d32" data-id="bbc0d32" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-08dd59f playball elementor-widget elementor-widget-heading" data-id="08dd59f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['day'] ?? 'Minggu' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-56ab567 playball elementor-widget elementor-widget-heading" data-id="56ab567" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['month'] ?? 'Desember' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-08e54bb playball elementor-widget elementor-widget-heading" data-id="08e54bb" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['events']['akad']['year'] ?? '2026' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-text-color="#5E5E5E" class="elementor-element elementor-element-e0e202e wdsdv-enabled--yes elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e0e202e" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items">
							<li class="elementor-icon-list-item">
											<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fas fa-clock"></i>						</span>
										<span class="elementor-icon-list-text">{{ $data['events']['akad']['formatted_time'] ?? '08:00 WIB' }}</span>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-3d9bab5 wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="3d9bab5" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Lokasi Acara</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-704dcf9 elementor-widget elementor-widget-heading" data-id="704dcf9" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default" data-preview="venue-name"><b>{{ $data['events']['akad']['venue'] ?? 'Menara 165' }}</b><br />{{ $data['events']['akad']['address'] ?? 'Jl. TB Simatupang Jakarta Selatan' }}</p>				</div>
				</div>
				<div class="elementor-element elementor-element-88a7b8a wdsdv-enabled--yes elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="88a7b8a" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="{{ $data['events']['akad']['maps_link'] ?: 'https://maps.google.com' }}" target="_blank" rel="nofollow">
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
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-40eef1a0 animated-slow wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-invisible" data-id="40eef1a0" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-4dfbda8c inv-atas" data-id="4dfbda8c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-5c35b44f elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="5c35b44f" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1500,&quot;background_slideshow_slide_transition&quot;:&quot;slide_right&quot;,&quot;background_slideshow_transition_duration&quot;:3000,&quot;jet_parallax_layout_list&quot;:[],&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997682,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-14.jpg&quot;},{&quot;id&quot;:997683,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-15.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-4636223d" data-id="4636223d" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:2000,&quot;background_slideshow_slide_transition&quot;:&quot;slide_right&quot;,&quot;background_slideshow_transition_duration&quot;:4000,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997682,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-14.jpg&quot;},{&quot;id&quot;:997683,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-15.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;}">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#6d8998" class="elementor-section elementor-inner-section elementor-element elementor-element-6fb65d6a elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="6fb65d6a" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-4eef32ea" data-id="4eef32ea" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-4b860ccc elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4b860ccc" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-3f9eb6bd" data-id="3f9eb6bd" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-da41331 elementor-widget elementor-widget-heading" data-id="da41331" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['events']['resepsi']['day_num'] ?? '28' }}</h2>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-2f694943" data-id="2f694943" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-212fdac elementor-widget elementor-widget-heading" data-id="212fdac" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Minggu</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-5b392e2 elementor-widget elementor-widget-heading" data-id="5b392e2" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Desember</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-ff0fb7a elementor-widget elementor-widget-heading" data-id="ff0fb7a" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">2027</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-text-color="#5E5E5E" class="elementor-element elementor-element-3ef55dc elementor-align-start wdsdv-enabled--yes elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="3ef55dc" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
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
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-434e16f wdsdv-enabled--yes elementor-widget elementor-widget-heading" data-id="434e16f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Lokasi Acara</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-3a7f0d2 elementor-widget elementor-widget-heading" data-id="3a7f0d2" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default" data-preview="venue-name"><b>{{ $data['events']['akad']['venue'] ?? 'Menara 165' }}</b><br />{{ $data['events']['akad']['address'] ?? 'Jl. TB Simatupang Jakarta Selatan' }}</p>				</div>
				</div>
				<div class="elementor-element elementor-element-adc246b wdsdv-enabled--yes elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="adc246b" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-button-link elementor-size-sm elementor-animation-shrink" href="{{ $data['events']['akad']['maps_link'] ?: 'https://maps.google.com' }}" target="_blank" rel="nofollow">
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
				<div data-dce-background-color="#333333" class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-53cbacd0" data-id="53cbacd0" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-de39056 elementor-widget__width-auto playball elementor-widget elementor-widget-heading" data-id="de39056" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Resepsi</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-cc4493f wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="cc4493f" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e95d2bf" data-id="e95d2bf" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-405b21c inv-atas elementor-widget elementor-widget-image-carousel" data-id="405b21c" data-element_type="widget" data-e-type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;1&quot;,&quot;navigation&quot;:&quot;none&quot;,&quot;effect&quot;:&quot;slide&quot;,&quot;speed&quot;:500}" data-widget_type="image-carousel.default">
				<div class="elementor-widget-container">
							<div class="elementor-image-carousel-wrapper swiper" role="region" aria-roledescription="carousel" aria-label="Karosel Gambar" dir="ltr">
			<div class="elementor-image-carousel swiper-wrapper" aria-live="polite">
								<div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="1 of 1"><figure class="swiper-slide-inner"><img class="swiper-slide-image" src="/themes/luxury-01/uploads/elementor/thumbs/cropped_image_1788951084478-rt5c9r7t4xbnbizfyvao7f3hbosv1okv0j2xqt9ns0.jpg" alt="cropped_image_1788951084478" /></figure></div>			</div>
					</div>
						</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-ff68d21 inv-atas elementor-widget elementor-widget-heading" data-id="ff68d21" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Live Streaming</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-4c4c255 inv-bawah elementor-widget elementor-widget-heading" data-id="4c4c255" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Temui kami secara virtual untuk menyaksikan acara pernikahan kami yang insyaaAllah akan disiarkan langsung melalui link dibawah ini.</p>				</div>
				</div>
				<div class="elementor-element elementor-element-e0c2b2a elementor-align-center elementor-widget__width-auto inv-atas elementor-widget elementor-widget-button" data-id="e0c2b2a" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-size-sm elementor-animation-shrink" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fas fa-video"></i>			</span>
									<span class="elementor-button-text">Lihat Live Streaming</span>
					</span>
					</a>
				</div>
								</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-8fbe745 inv-zoom-out wdsdv-enabled--yes e-transform elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="8fbe745" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:90,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-79a733b wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="79a733b" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-e1205f5" data-id="e1205f5" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-0844b66 inv-atas elementor-widget elementor-widget-heading" data-id="0844b66" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Dresscode</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-f497061 inv-bawah elementor-widget elementor-widget-heading" data-id="f497061" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Kami dengan hormat menganjurkan tamu kami untuk mengenakan warna-warna ini untuk hari istimewa kami.</p>				</div>
				</div>
				<div class="elementor-element elementor-element-06fd409 elementor-widget__width-auto wdsdv-enabled--yes inv-zoom-in elementor-view-default elementor-widget elementor-widget-icon" data-id="06fd409" data-element_type="widget" data-e-type="widget" data-widget_type="icon.default">
				<div class="elementor-widget-container">
							<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="fas fa-square-full"></i>			</div>
		</div>
						</div>
				</div>
				<div class="elementor-element elementor-element-9346b7b elementor-widget__width-auto wdsdv-enabled--yes inv-zoom-in elementor-view-default elementor-widget elementor-widget-icon" data-id="9346b7b" data-element_type="widget" data-e-type="widget" data-widget_type="icon.default">
				<div class="elementor-widget-container">
							<div class="elementor-icon-wrapper">
			<div class="elementor-icon">
			<i aria-hidden="true" class="fas fa-square-full"></i>			</div>
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
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-318b31ac wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="318b31ac" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;video&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-400adbf8" data-id="400adbf8" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-dcf37e9 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="dcf37e9" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2ba69b3" data-id="2ba69b3" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-5931375 elementor-widget__width-inherit inv-bawah elementor-widget elementor-widget-heading" data-id="5931375" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Love</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-e4376d9 inv-kanan elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="e4376d9" data-element_type="widget" data-e-type="widget" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-85d157e elementor-widget__width-inherit inv-atas elementor-widget elementor-widget-heading" data-id="85d157e" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Story</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-9a5e447 inv-zoom-in elementor-widget elementor-widget-jet-timeline" data-id="9a5e447" data-element_type="widget" data-e-type="widget" data-widget_type="jet-timeline.default">
				<div class="elementor-widget-container">
					<div class="elementor-jet-timeline jet-elements"><div class="jet-timeline jet-timeline--align-left jet-timeline--align-top">
	<div class="jet-timeline__line"><div class="jet-timeline__line-progress"></div></div>
	<div class="jet-timeline-list"><div class="jet-timeline-item jet-timeline-item--animated elementor-repeater-item-0363b0b-0 jet-timeline-item--image-inside">
	<div class="timeline-item__card">
		<div class="timeline-item__card-inner">
								<div class="timeline-item__card-content">
					<div class="timeline-item__meta"></div><h5 class="timeline-item__card-title">25 AGUSTUS 2023</h5><div class="timeline-item__card-desc">Berawal dari tempat pekerjaan Cianjur-2023, kami mengenal satu sama lain dan belum ada benih cinta kala itu, hanya sebatas teman kerja.</div>				</div>
						</div>
		<div class="timeline-item__card-arrow"></div>
	</div>
	<div class="timeline-item__point"><div class="timeline-item__point-content timeline-item__point-content--icon"><span class="jet-elements-icon"><i aria-hidden="true" class="fas fa-heart"></i></span></div></div><div class="timeline-item__meta"></div></div><div class="jet-timeline-item jet-timeline-item--animated elementor-repeater-item-0363b0b-1 jet-timeline-item--image-inside">
	<div class="timeline-item__card">
		<div class="timeline-item__card-inner">
								<div class="timeline-item__card-content">
					<div class="timeline-item__meta"></div><h5 class="timeline-item__card-title">03 JUNI 2024</h5><div class="timeline-item__card-desc">Setelah cukup mengenal satu sama lain, satu tahun kurang lebih nya kami menjalin hubungan. 03 Juni 2024 Akhirnya kita memutuskan untuk melanjutkan ke Hubungan yang lebih serius mempertemukan kedua keluarga.</div>				</div>
						</div>
		<div class="timeline-item__card-arrow"></div>
	</div>
	<div class="timeline-item__point"><div class="timeline-item__point-content timeline-item__point-content--icon"><span class="jet-elements-icon"><i aria-hidden="true" class="fas fa-heart"></i></span></div></div><div class="timeline-item__meta"></div></div><div class="jet-timeline-item jet-timeline-item--animated elementor-repeater-item-0363b0b-2 jet-timeline-item--image-inside">
	<div class="timeline-item__card">
		<div class="timeline-item__card-inner">
								<div class="timeline-item__card-content">
					<div class="timeline-item__meta"></div><h5 class="timeline-item__card-title">29 DESEMBER 2025</h5><div class="timeline-item__card-desc">Sampai tanggal ini kami melaksanakan akad terlebih dahulu dan akhirnya kami mengubah status hingga menjadi pasangan suami istri. Semoga allah swt. Memberikan keberkahan pernikahan ini. "AMIN</div>				</div>
						</div>
		<div class="timeline-item__card-arrow"></div>
	</div>
	<div class="timeline-item__point"><div class="timeline-item__point-content timeline-item__point-content--icon"><span class="jet-elements-icon"><i aria-hidden="true" class="fas fa-heart"></i></span></div></div><div class="timeline-item__meta"></div></div></div></div></div>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-f7af679 elementor-section-full_width elementor-section-content-middle wdsdv-enabled--yes elementor-section-height-default elementor-section-height-default" data-id="f7af679" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-a6a87ca" data-id="a6a87ca" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;in&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<div class="elementor-element elementor-element-4d522e3 elementor-widget elementor-widget-ams-video" data-id="4d522e3" data-element_type="widget" data-e-type="widget" data-widget_type="ams-video.default">
				<div class="elementor-widget-container">
					
        <style>
            .videoWrapper {
                position: relative;
                padding-bottom: 56.25%;
                padding-top: 0;
                height: 0;
                overflow: hidden;
            }

            .videoWrapper iframe,
            .videoWrapper #video-yt {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: 0;
            }
        </style>

        <div class="videoWrapper" data-ams-video-widget="4d522e3">
            <div id="video-yt"></div>
        </div>

        <script>
        (function () {
            'use strict';

            var currentScript = document.currentScript;
            var localWrapper = currentScript ? currentScript.previousElementSibling : null;
            var root = localWrapper && localWrapper.classList && localWrapper.classList.contains('videoWrapper')
                ? localWrapper.querySelector('#video-yt')
                : document.getElementById('video-yt');

            if (!root || root.dataset.amsInitialized === '1') {
                return;
            }
            root.dataset.amsInitialized = '1';

            var sourceUrl = "https:\/\/www.youtube.com\/watch?v=LU-4XEqUp-A";
            var autoPlay = 1;
            var player = null;
            var playing = false;
            var retriedWithNoCookie = false;
            var widgetId = "4d522e3";

            function isGoogleDrive(url) {
                return /(^|\.)drive\.google\.com/i.test((url || '').replace(/^https?:\/\//i, '').split('/')[0]) ||
                    /drive\.google\.com/i.test(url || '');
            }

            function getDriveEmbed(url) {
                var match = (url || '').match(/\/d\/([a-zA-Z0-9_-]+)/);
                if (match && match[1]) {
                    return 'https://drive.google.com/file/d/' + match[1] + '/preview';
                }
                return url;
            }

            function extractVideoId(url) {
                if (!url) return '';

                var value = String(url).trim();

                // Allow a raw 11-character YouTube video ID.
                if (/^[a-zA-Z0-9_-]{11}$/.test(value)) {
                    return value;
                }

                var patterns = [
                    /[?&]v=([a-zA-Z0-9_-]{11})/,
                    /youtu\.be\/([a-zA-Z0-9_-]{11})/,
                    /youtube(?:-nocookie)?\.com\/embed\/([a-zA-Z0-9_-]{11})/,
                    /youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/,
                    /youtube\.com\/live\/([a-zA-Z0-9_-]{11})/
                ];

                for (var i = 0; i < patterns.length; i++) {
                    var match = value.match(patterns[i]);
                    if (match && match[1]) return match[1];
                }

                return '';
            }

            function getOrigin() {
                if (window.location && window.location.origin && /^https?:\/\//i.test(window.location.origin)) {
                    return window.location.origin;
                }
                return window.location.protocol + '//' + window.location.host;
            }

            function waitForYouTubeAPI(callback) {
                if (window.YT && typeof window.YT.Player === 'function') {
                    callback();
                    return;
                }

                if (!document.querySelector('script[src*="youtube.com/iframe_api"]')) {
                    var script = document.createElement('script');
                    script.src = 'https://www.youtube.com/iframe_api';
                    script.async = true;
                    script.dataset.amsYoutubeApi = '1';
                    (document.head || document.documentElement).appendChild(script);
                }

                var attempts = 0;
                var timer = window.setInterval(function () {
                    attempts++;
                    if (window.YT && typeof window.YT.Player === 'function') {
                        window.clearInterval(timer);
                        callback();
                    } else if (attempts >= 200) {
                        window.clearInterval(timer);
                    }
                }, 50);
            }

            function pauseBackgroundAudio() {
                if (typeof window.pauseAudio === 'function') window.pauseAudio();
                if (typeof window.audioInactive === 'function') window.audioInactive();
            }

            function resumeBackgroundAudio() {
                if (typeof window.playAudio === 'function') window.playAudio();
                if (typeof window.audioActive === 'function') window.audioActive();
            }

            function buildIframe(videoId, useNoCookie) {
                var origin = getOrigin();
                var host = useNoCookie ? 'https://www.youtube-nocookie.com' : 'https://www.youtube.com';
                var iframe = document.createElement('iframe');
                var iframeId = 'ams-video-youtube-' + widgetId + (useNoCookie ? '-privacy' : '');

                var params = new URLSearchParams({
                    enablejsapi: '1',
                    autoplay: String(autoPlay),
                    mute: String(autoPlay),
                    loop: String(autoPlay),
                    playlist: videoId,
                    playsinline: '1',
                    rel: '0',
                    origin: origin,
                    widget_referrer: window.location.href
                });

                iframe.id = iframeId;
                iframe.src = host + '/embed/' + encodeURIComponent(videoId) + '?' + params.toString();
                iframe.title = 'YouTube video player';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
                iframe.allowFullscreen = true;
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.border = '0';

                root.innerHTML = '';
                root.appendChild(iframe);
                return iframe;
            }

            function showExternalFallback(videoId) {
                var watchUrl = 'https://www.youtube.com/watch?v=' + encodeURIComponent(videoId);
                var link = document.createElement('a');
                link.href = watchUrl;
                link.target = '_blank';
                link.rel = 'noopener';
                link.setAttribute('aria-label', 'Tonton video di YouTube');
                link.style.cssText = 'position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:#111;text-decoration:none;overflow:hidden;';

                var image = document.createElement('img');
                image.src = 'https://i.ytimg.com/vi/' + encodeURIComponent(videoId) + '/hqdefault.jpg';
                image.alt = '';
                image.loading = 'lazy';
                image.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:.82;';

                var play = document.createElement('span');
                play.textContent = '▶';
                play.setAttribute('aria-hidden', 'true');
                play.style.cssText = 'position:relative;z-index:2;display:flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:50%;background:rgba(0,0,0,.72);color:#fff;font-size:28px;line-height:1;padding-left:4px;';

                link.appendChild(image);
                link.appendChild(play);
                root.innerHTML = '';
                root.appendChild(link);
            }

            function attachPlayer(iframe, videoId, useNoCookie) {
                waitForYouTubeAPI(function () {
                    try {
                        player = new YT.Player(iframe, {
                            events: {
                                onStateChange: onPlayerStateChange,
                                onError: function (event) {
                                    // Error 153 = missing/invalid player identity / Referer.
                                    // Retry once through the privacy-enhanced host while keeping
                                    // an explicit referrer policy and origin.
                                    if (Number(event.data) === 153 && !retriedWithNoCookie && !useNoCookie) {
                                        retriedWithNoCookie = true;
                                        try {
                                            if (player && typeof player.destroy === 'function') player.destroy();
                                        } catch (e) {}
                                        var retryIframe = buildIframe(videoId, true);
                                        window.setTimeout(function () {
                                            attachPlayer(retryIframe, videoId, true);
                                        }, 150);
                                    } else if (Number(event.data) === 153) {
                                        // Some iOS Safari/WebKit builds currently reject YouTube embeds
                                        // even with a valid referrer. Avoid leaving a broken Error 153 box.
                                        showExternalFallback(videoId);
                                    }
                                }
                            }
                        });
                    } catch (e) {
                        // Keep the native iframe visible even if the JS API cannot attach.
                    }
                });
            }

            function onPlayerStateChange(event) {
                if (!player || !window.YT) return;

                var isMuted = false;
                try {
                    isMuted = player.isMuted();
                } catch (e) {}

                if (event.data === YT.PlayerState.PLAYING) {
                    if (!isMuted) pauseBackgroundAudio();
                    playing = true;
                } else if (event.data === YT.PlayerState.PAUSED) {
                    if (!isMuted) resumeBackgroundAudio();
                    playing = false;
                } else if (event.data === YT.PlayerState.ENDED) {
                    playing = false;
                    if (autoPlay && player) {
                        try {
                            player.seekTo(0, true);
                            player.playVideo();
                        } catch (e) {}
                    } else {
                        resumeBackgroundAudio();
                    }
                }
            }

            function toggleMute() {
                if (!player) return;

                try {
                    if (player.isMuted()) {
                        player.unMute();
                        // Once video audio is audible, background music should stop.
                        if (playing) pauseBackgroundAudio();
                    } else {
                        player.mute();
                        // Muted video may coexist with background music.
                        resumeBackgroundAudio();
                    }
                } catch (e) {}
            }

            // Preserve the old global helper name for pages that call toggleMute() themselves.
            window.toggleMute = toggleMute;

            if (!sourceUrl) {
                return;
            }

            if (isGoogleDrive(sourceUrl)) {
                var driveIframe = document.createElement('iframe');
                driveIframe.src = getDriveEmbed(sourceUrl);
                driveIframe.style.width = '100%';
                driveIframe.style.height = '100%';
                driveIframe.style.border = '0';
                driveIframe.allow = 'autoplay; fullscreen';
                driveIframe.allowFullscreen = true;
                driveIframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                root.innerHTML = '';
                root.appendChild(driveIframe);
                return;
            }

            var videoId = extractVideoId(sourceUrl);
            if (!videoId) {
                return;
            }

            // Create the iframe ourselves first so the very first request already carries
            // referrerpolicy="strict-origin-when-cross-origin". The JS API is attached after.
            var youtubeIframe = buildIframe(videoId, false);
            attachPlayer(youtubeIframe, videoId, false);

            var muteBtn = document.getElementById('mute-button');
            if (muteBtn && !muteBtn.dataset.amsVideoBound) {
                muteBtn.dataset.amsVideoBound = '1';
                muteBtn.addEventListener('click', toggleMute);
            }
        })();
        </script>

        				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-88dcdd wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="88dcdd" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;video&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2a0839b" data-id="2a0839b" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-c9c42bb wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c9c42bb" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-250405c" data-id="250405c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-3c58a9b4 animated-slow inv-bawah elementor-invisible elementor-widget elementor-widget-heading" data-id="3c58a9b4" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Gallery</h2>				</div>
				</div>
				<div class="elementor-element elementor-element-42fe188a animated-slow inv-kiri elementor-widget-divider--view-line elementor-invisible elementor-widget elementor-widget-divider" data-id="42fe188a" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}" data-widget_type="divider.default">
				<div class="elementor-widget-container">
							<div class="elementor-divider">
			<span class="elementor-divider-separator">
						</span>
		</div>
						</div>
				</div>
				<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-2c02a5ec animated-slow inv-atas elementor-invisible elementor-widget elementor-widget-heading" data-id="2c02a5ec" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Our Moments</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div class="elementor-element elementor-element-1220348 animated-slow wdsdv-enabled--yes inv-zoom-out elementor-invisible elementor-widget elementor-widget-ucaddon_uc_compact_image_theme" data-id="1220348" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;}" data-widget_type="ucaddon_uc_compact_image_theme.default">
				<div class="elementor-widget-container">
					
<!-- start Compact Gallery -->
		<link id='unitegallery-css' href='/themes/3d-motion-05/plugins/unlimited-elements-for-elementor-premium/assets_libraries/unitegallery/css/unite-gallery.css' type='text/css' rel='stylesheet' >


<div id="uc_uc_compact_image_theme_elementor_1220348" class="uc-items-wrapper  " style="display:none; margin:0 auto;"  data-remote-type="gallery" data-custom-sethtml="true" >


<img alt="sample-luxury-01-new-13"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-13.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-13.jpg"
    data-title="sample-luxury-01-new-13">

<img alt="sample-luxury-01-new-12"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-12.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-12.jpg"
    data-title="sample-luxury-01-new-12">

<img alt="sample-luxury-01-new-11"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-11.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-11.jpg"
    data-title="sample-luxury-01-new-11">

<img alt="sample-luxury-01-new-10"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-10.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-10.jpg"
    data-title="sample-luxury-01-new-10">

<img alt="sample-luxury-01-new-9"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-9.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-9.jpg"
    data-title="sample-luxury-01-new-9">

<img alt="sample-luxury-01-new-4"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-4.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-4.jpg"
    data-title="sample-luxury-01-new-4">

<img alt="sample-luxury-01-new-3"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-3.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-3.jpg"
    data-title="sample-luxury-01-new-3">

<img alt="sample-luxury-01-new-2"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-2.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-2.jpg"
    data-title="sample-luxury-01-new-2">

<img alt="sample-luxury-01-new-24"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-24.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-24.jpg"
    data-title="sample-luxury-01-new-24">

<img alt="sample-luxury-01-new-23"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-23.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-23.jpg"
    data-title="sample-luxury-01-new-23">

<img alt="sample-luxury-01-new-17"
   src="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-17.jpg"
    data-image="/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2026/09/sample-luxury-01-new-17.jpg"
    data-title="sample-luxury-01-new-17">

  
</div>
<!-- end Compact Gallery -->				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#00000080" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-6e59bcc wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6e59bcc" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-523ea5c" data-id="523ea5c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-11a300a inv-zoom-in elementor-widget elementor-widget-image-carousel" data-id="11a300a" data-element_type="widget" data-e-type="widget" data-settings="{&quot;slides_to_show&quot;:&quot;1&quot;,&quot;navigation&quot;:&quot;none&quot;,&quot;effect&quot;:&quot;slide&quot;,&quot;speed&quot;:500}" data-widget_type="image-carousel.default">
				<div class="elementor-widget-container">
							<div class="elementor-image-carousel-wrapper swiper" role="region" aria-roledescription="carousel" aria-label="Karosel Gambar" dir="ltr">
			<div class="elementor-image-carousel swiper-wrapper" aria-live="polite">
								<div class="swiper-slide" role="group" aria-roledescription="slide" aria-label="1 of 1"><figure class="swiper-slide-inner"><img class="swiper-slide-image" src="/themes/luxury-01/uploads/elementor/thumbs/cropped_image_1737476207222-r1qxugb5cuyv0ruil3rh9d5uqgie2u8j7xr08zsq34.jpeg" alt="sample-luxury-01" /></figure></div>			</div>
					</div>
						</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-6fcc432 inv-atas elementor-widget elementor-widget-heading" data-id="6fcc432" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Wedding Gift</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-8cda8c1 inv-atas elementor-widget elementor-widget-heading" data-id="8cda8c1" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Doa Restu Anda merupakan<br />
karunia yang sangat berarti bagi kami.<br />
<br />
Dan jika memberi adalah ungkapan tanda kasih, Anda dapat memberi melalui dibawah ini.</p>				</div>
				</div>
				<div class="elementor-element elementor-element-802d262 elementor-align-center wdsdv-enabled--yes inv-atas elementor-widget elementor-widget-button" data-id="802d262" data-element_type="widget" data-e-type="widget" id="btn_gift" data-widget_type="button.default">
				<div class="elementor-widget-container">
									<div class="elementor-button-wrapper">
					<a class="elementor-button elementor-size-sm elementor-animation-shrink" role="button">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon">
				<i aria-hidden="true" class="fas fa-credit-card"></i>			</span>
									<span class="elementor-button-text">Klik di Sini</span>
					</span>
					</a>
				</div>
								</div>
				</div>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-bbce64d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="bbce64d" data-element_type="section" data-e-type="section" id="sec_gift" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-3daf475" data-id="3daf475" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-9558a62 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="9558a62" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-62c0559 inv-atas" data-id="62c0559" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-547ebd4 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="547ebd4" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-ddf317d" data-id="ddf317d" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-79c0cd9 content elementor-widget elementor-widget-heading" data-id="79c0cd9" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">No Rekening</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-89a4d93 content elementor-widget elementor-widget-heading" data-id="89a4d93" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">123123123</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-5cd4c55 content elementor-widget elementor-widget-heading" data-id="5cd4c55" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Atas Nama</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-0d496fb content elementor-widget elementor-widget-heading" data-id="0d496fb" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putri Cantika Sari</p>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-6340166" data-id="6340166" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-advanced-background-color="#FFFFFF" class="elementor-element elementor-element-683d85c elementor-widget__width-auto ha-has-bg-overlay elementor-widget elementor-widget-image" data-id="683d85c" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="153" height="50" src="/themes/luxury-01/uploads/2024/10/bca.png" class="attachment-full size-full wp-image-6268" alt="" srcset="/themes/luxury-01/uploads/2024/10/bca.png 153w, /themes/luxury-01/uploads/2024/10/bca-150x50.png 150w" sizes="(max-width: 153px) 100vw, 153px" />															</div>
				</div>
				<div data-dce-background-color="#FFFFFF00" class="elementor-element elementor-element-9ebe607 elementor-align-center elementor-widget__width-auto content elementor-widget elementor-widget-dce-copy-to-clipboard" data-id="9ebe607" data-element_type="widget" data-e-type="widget" data-settings="{&quot;animation_on_copy&quot;:&quot;shake-animation&quot;,&quot;dce_clipboard_type&quot;:&quot;text&quot;}" data-widget_type="dce-copy-to-clipboard.default">
				<div class="elementor-widget-container">
					
		<div class="dce-clipboard-wrapper dce-clipboard-wrapper-text">
					<button class="elementor-button elementor-size-sm elementor-animation-shrink" type="button" id="dce-clipboard-btn-1" data-clipboard-text="123123123">
			<span class="elementor-button-content-wrapper dce-flexbox">
									<span class="elementor-button-icon elementor-align-icon-left">
						<i aria-hidden="true" class="far fa-copy"></i>					</span>
								<span class="elementor-button-text">Salin</span>
			</span>
		</button>
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
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-bab75fc wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="bab75fc" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-8cc5575 inv-atas" data-id="8cc5575" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-5b6600d elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="5b6600d" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-aaf746f" data-id="aaf746f" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-927302c content elementor-widget elementor-widget-heading" data-id="927302c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">No Rekening</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-4bdd210 content elementor-widget elementor-widget-heading" data-id="4bdd210" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">321321321</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-7a30514 content elementor-widget elementor-widget-heading" data-id="7a30514" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Atas Nama</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-1edcde5 content elementor-widget elementor-widget-heading" data-id="1edcde5" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putra Andika Pratama</p>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-7e86543" data-id="7e86543" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-advanced-background-color="#FFFFFF" class="elementor-element elementor-element-5c4c0f5 elementor-widget__width-auto ha-has-bg-overlay elementor-widget elementor-widget-image" data-id="5c4c0f5" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="153" height="50" src="/themes/luxury-01/uploads/2024/10/bri.png" class="attachment-full size-full wp-image-6272" alt="" srcset="/themes/luxury-01/uploads/2024/10/bri.png 153w, /themes/luxury-01/uploads/2024/10/bri-150x50.png 150w" sizes="(max-width: 153px) 100vw, 153px" />															</div>
				</div>
				<div data-dce-background-color="#FFFFFF00" class="elementor-element elementor-element-7d6c35a elementor-align-center elementor-widget__width-auto content elementor-widget elementor-widget-dce-copy-to-clipboard" data-id="7d6c35a" data-element_type="widget" data-e-type="widget" data-settings="{&quot;animation_on_copy&quot;:&quot;shake-animation&quot;,&quot;dce_clipboard_type&quot;:&quot;text&quot;}" data-widget_type="dce-copy-to-clipboard.default">
				<div class="elementor-widget-container">
					
		<div class="dce-clipboard-wrapper dce-clipboard-wrapper-text">
					<button class="elementor-button elementor-size-sm elementor-animation-shrink" type="button" id="dce-clipboard-btn-2" data-clipboard-text="321321321">
			<span class="elementor-button-content-wrapper dce-flexbox">
									<span class="elementor-button-icon elementor-align-icon-left">
						<i aria-hidden="true" class="far fa-copy"></i>					</span>
								<span class="elementor-button-text">Salin</span>
			</span>
		</button>
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
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-d85e630 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d85e630" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-57fea3b inv-atas" data-id="57fea3b" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-d3a712b elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="d3a712b" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-1eb5753" data-id="1eb5753" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-edcdc94 content elementor-widget elementor-widget-heading" data-id="edcdc94" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Nama Penerima</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-84a7073 content elementor-widget elementor-widget-heading" data-id="84a7073" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Putri / Putra</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-da3c476 content elementor-widget elementor-widget-heading" data-id="da3c476" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">( +6285150000715 )</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-2531a6f content elementor-widget elementor-widget-heading" data-id="2531a6f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Alamat Penerima</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-7c49190 content elementor-widget elementor-widget-heading" data-id="7c49190" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Jl. Raya Cilandak KKO No.27<br />
Jakarta Selatan</p>				</div>
				</div>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-54f82a1" data-id="54f82a1" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-f43677c content elementor-widget elementor-widget-heading" data-id="f43677c" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Kado</h2>				</div>
				</div>
				<div data-dce-background-color="#FFFFFF00" class="elementor-element elementor-element-63b3387 elementor-align-center elementor-widget__width-auto content elementor-widget elementor-widget-dce-copy-to-clipboard" data-id="63b3387" data-element_type="widget" data-e-type="widget" data-settings="{&quot;dce_clipboard_type&quot;:&quot;textarea&quot;,&quot;animation_on_copy&quot;:&quot;shake-animation&quot;}" data-widget_type="dce-copy-to-clipboard.default">
				<div class="elementor-widget-container">
					
		<div class="dce-clipboard-wrapper dce-clipboard-wrapper-textarea">
					<button class="elementor-button elementor-size-sm elementor-animation-shrink" type="button" id="dce-clipboard-btn-3" data-clipboard-text="Jl. Raya Cilandak KKO No.27&lt;br /&gt;
Jakarta Selatan">
			<span class="elementor-button-content-wrapper dce-flexbox">
									<span class="elementor-button-icon elementor-align-icon-left">
						<i aria-hidden="true" class="far fa-copy"></i>					</span>
								<span class="elementor-button-text">Salin</span>
			</span>
		</button>
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
				<div class="elementor-element elementor-element-2285ecb elementor-widget elementor-widget-html" data-id="2285ecb" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script>
var btn_gift = document.getElementById('btn_gift');
var sec_gift = document.getElementById("sec_gift");

btn_gift.onclick = function(){   
    if (sec_gift.style.display === "block") {
        $("#sec_gift").slideUp(1500, 'easeInOutCubic');
    } 
    else{
        $("#sec_gift").slideDown(1500, 'easeInOutCubic');
         $("#btn_gift").animate({ opacity: 0 }, 1000, 'easeInOutCirc');
         window.setTimeout(function(){
          btn_gift.style.display = 'none';
        },2000);
    }
};
</script>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#FFFFFF" data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-30e164e9 wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="30e164e9" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;jet_parallax_layout_list&quot;:[]}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1933b9b3" data-id="1933b9b3" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-3e3de892 elementor-widget__width-auto elementor-absolute elementor-widget elementor-widget-image" data-id="3e3de892" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;}" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="700" height="540" src="/themes/luxury-01/uploads/2025/01/img-tree-shadow-01.png" class="attachment-full size-full wp-image-22498" alt="" />															</div>
				</div>
				<div data-dce-title-color="#6D8998" class="elementor-element elementor-element-7913746 inv-bawah animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="7913746" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Ucapan &amp; RSVP</h2>				</div>
				</div>
				<div data-dce-title-color="#5E5E5E" class="elementor-element elementor-element-b13170b inv-atas elementor-widget elementor-widget-heading" data-id="b13170b" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Berikan doa dan ucapan terbaik untuk kami.</p>				</div>
				</div>
				<!-- KLIKMOMEN DYNAMIC WISHES & RSVP FORM -->
<div class="klikmomen-wishes-section" style="max-width: 440px; margin: 0 auto; padding: 0 16px;">
    <div style="background: #FFFFFF; border-radius: 20px; padding: 22px 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.06); border: 1px solid rgba(182, 126, 34, 0.25); text-align: left; margin-bottom: 24px;">
        <form id="klikmomen_wish_form" onsubmit="event.preventDefault(); return handleWishSubmit(event);">
            <div style="margin-bottom: 14px;">
                <label style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="wish_name" 
                    name="name" 
                    required 
                    value="{{ $guestName ?? ($to ?? '') }}" 
                    placeholder="Nama Anda"
                    style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; transition: border-color 0.2s;"
                >
            </div>

            <div style="margin-bottom: 14px;">
                <label style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Konfirmasi Kehadiran</label>
                <select 
                    id="wish_attendance" 
                    name="attendance"
                    style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; transition: border-color 0.2s; cursor: pointer;"
                >
                    <option value="Hadir (1 Orang)">Hadir (1 Orang)</option>
                    <option value="Hadir (2 Orang)">Hadir (2 Orang)</option>
                    <option value="Masih Ragu">Masih Ragu</option>
                    <option value="Tidak Hadir">Mohon Maaf, Tidak Bisa Hadir</option>
                </select>
            </div>

            <div style="margin-bottom: 18px;">
                <label style="font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; color: #1E293B; display: block; margin-bottom: 6px;">Pesan &amp; Doa Restu</label>
                <textarea 
                    id="wish_message" 
                    name="message" 
                    rows="3" 
                    required 
                    placeholder="Tuliskan ucapan selamat &amp; doa restu Anda..."
                    style="width: 100%; box-sizing: border-box; padding: 10px 14px; border-radius: 12px; border: 1px solid #D1D5DB; background: #FFFFFF; color: #1F2937; font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; outline: none; resize: vertical; min-height: 80px;"
                ></textarea>
            </div>

            <button 
                type="button" 
                onclick="handleWishSubmit(event)"
                id="wish_btn_submit"
                style="width: 100%; padding: 13px 18px; border-radius: 14px; background: #B67E22; color: #FFFFFF; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 13px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 14px rgba(182, 126, 34, 0.35); transition: all 0.2s;"
            >
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
            <div class="wish-item-card" style="background: #FFFFFF; border-radius: 16px; border: 1px solid #ECDDCB; padding: 14px 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.04); text-align: left;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">
                    <span style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 14px; color: #1E293B;">{{ $w['name'] ?? '' }}</span>
                    @php
                        $isNotComing = str_contains($w['attendance'] ?? '', 'Tidak');
                    @endphp
                    <span class="{{ $isNotComing ? 'badge-tidak-hadir' : 'badge-hadir' }}">
                        {{ $w['attendance'] ?? 'Hadir' }}
                    </span>
                </div>
                <p style="font-size: 12px; color: #4B5563; font-style: italic; line-height: 1.55; margin: 0 0 6px; font-family: 'Plus Jakarta Sans', sans-serif;">{{ $w['message'] ?? ($w['msg'] ?? '') }}</p>
                <span style="font-size: 10px; color: #9CA3AF; display: block; text-align: right; font-family: 'Plus Jakarta Sans', sans-serif;">{{ $w['time'] ?? 'Baru saja' }}</span>
            </div>
        @endforeach
    </div>
</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-overlay-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-bb53199 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="bb53199" data-element_type="section" data-e-type="section" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1500,&quot;background_slideshow_transition_duration&quot;:3000,&quot;jet_parallax_layout_list&quot;:[],&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;out&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997685,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-17.jpg&quot;},{&quot;id&quot;:997686,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-23.jpg&quot;},{&quot;id&quot;:997687,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-24.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div data-dce-background-color="#0000004D" class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-65ce6f4" data-id="65ce6f4" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section data-dce-background-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-61d70535 elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="61d70535" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-62f9fc16" data-id="62f9fc16" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap">
							</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-42364e58 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="42364e58" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-2ebffdf1" data-id="2ebffdf1" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-173c6e6 inv-zoom-out elementor-widget elementor-widget-heading" data-id="173c6e6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">Terima Kasih</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-f9747a1 inv-zoom-out elementor-widget elementor-widget-heading" data-id="f9747a1" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Merupakan suatu kebahagiaan dan kehormatan bagi kami, apabila Bapak/Ibu/Saudara/i, berkenan hadir dan memberikan do’a restu kepada kami.<br />
<br />
<b>Wassalamu’alaikum warahmatullahi wabarakatuh</b></p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-d3791d1 inv-zoom-out elementor-widget elementor-widget-heading" data-id="d3791d1" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<p class="elementor-heading-title elementor-size-default">Kami Yang Berbahagia</p>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-f35979f wdsdv-enabled--yes inv-zoom-out elementor-widget elementor-widget-heading" data-id="f35979f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="couple-nickname">{{ $data['bride']['nickname'] ?? 'Putri' }} &amp; {{ $data['groom']['nickname'] ?? 'Andika' }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
					</div>
		</section>
				<section data-dce-background-color="#333333" class="elementor-section elementor-inner-section elementor-element elementor-element-100e95a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="100e95a" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-7bbaf7c" data-id="7bbaf7c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-8946ad6 elementor-widget elementor-widget-shortcode" data-id="8946ad6" data-element_type="widget" data-e-type="widget" data-widget_type="shortcode.default">
				<div class="elementor-widget-container">
							<div class="elementor-shortcode">		<footer data-elementor-type="footer" data-elementor-id="370638" class="elementor elementor-370638 elementor-location-single" data-elementor-settings="{&quot;ha_cmc_init_switcher&quot;:&quot;no&quot;}" data-elementor-post-type="elementor_library">
					<section class="elementor-section elementor-top-section elementor-element elementor-element-d28a23a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="d28a23a" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-29df735" data-id="29df735" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-a39c06a elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a39c06a" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-ede022c" data-id="ede022c" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-183e84a elementor-widget__width-auto elementor-widget elementor-widget-image" data-id="183e84a" data-element_type="widget" data-e-type="widget" data-widget_type="image.default">
				<div class="elementor-widget-container">
															<img width="512" height="512" src="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple.png" class="attachment-full size-full wp-image-5541" alt="" srcset="/themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple.png 512w, /themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-150x150.png 150w, /themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-270x270.png 270w, /themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-192x192.png 192w, /themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-180x180.png 180w, /themes/luxury-01/uploads/2024/10/cropped-cropped-icon-invisimple-32x32.png 32w" sizes="(max-width: 512px) 100vw, 512px" />															</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-57b7bb4 elementor-widget__width-auto elementor-widget elementor-widget-heading" data-id="57b7bb4" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">invisimple.id</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<div data-dce-text-color="#FFFFFF" class="elementor-element elementor-element-c24d411 elementor-icon-list--layout-inline elementor-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="c24d411" data-element_type="widget" data-e-type="widget" data-widget_type="icon-list.default">
				<div class="elementor-widget-container">
							<ul class="elementor-icon-list-items elementor-inline-items">
							<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.instagram.com/invisimple.id/" target="_blank" rel="nofollow">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-instagram"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://api.whatsapp.com/send/?phone=6285150000715&#038;text=Halo,+saya+ingin+tanya+mengenai+Undangan+Website,+saya+mendapatkan+WA+dari+undangan+yang+telah+disebar." target="_blank" rel="nofollow">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-whatsapp"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
								<li class="elementor-icon-list-item elementor-inline-item">
											<a href="https://www.tiktok.com/@invisimple.id" target="_blank" rel="nofollow">

												<span class="elementor-icon-list-icon">
							<i aria-hidden="true" class="fab fa-tiktok"></i>						</span>
										<span class="elementor-icon-list-text"></span>
											</a>
									</li>
						</ul>
						</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-e94142f elementor-widget elementor-widget-heading" data-id="e94142f" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default"><a href="https://api.whatsapp.com/send/?phone=6285150000715&#038;text=Halo,+saya+ingin+tanya+mengenai+Undangan+Website,+saya+mendapatkan+WA+dari+undangan+yang+telah+disebar." target="_blank" rel="nofollow">HUBUNGI KAMI</a></h2>				</div>
				</div>
				<div class="elementor-element elementor-element-5be042e elementor-absolute wdsdv-enabled--yes elementor-view-default elementor-shape-circle elementor-widget elementor-widget-ams-audio" data-id="5be042e" data-element_type="widget" data-e-type="widget" data-settings="{&quot;audio_loop&quot;:&quot;yes&quot;,&quot;_position&quot;:&quot;absolute&quot;,&quot;song_start&quot;:&quot;0:30&quot;}" data-widget_type="ams-audio.default">
				<div class="elementor-widget-container">
					
        <style>
            #wds-audio-container {
                transition: transform .75s ease-in-out;
            }

            #mute-sound {
                animation: rotating 8s linear infinite;
                -webkit-animation: rotating 8s linear infinite;
                -moz-animation: rotating 8s linear infinite;
                -ms-animation: rotating 8s linear infinite;
                -o-animation: rotating 8s linear infinite;
            }

            @keyframes rotating {
                from {
                    -ms-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -webkit-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }

                to {
                    -ms-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -webkit-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            [class~=slide-right] {
                transform: translateX(150%);
            }

            [class~=slide-left] {
                transform: translateX(0);
            }
        </style>

        
            <div id="wds-audio-container" class="wds-audio-box" style="position:fixed;z-index:50;bottom:0;right:0;">

                
                                        
                    <audio id="song" loop>
                        <source src="/themes/luxury-01/uploads/2024/06/McBride-My-Valentine-Martina.mp3" type="audio/mp3">
                    </audio>

                
                <div class="elementor-icon-wrapper" id="unmute-sound" style="display: block; line-height: 0;">
                    <div class="elementor-icon" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 45.75 45.75"><defs><style>.b088c895-30ef-4b38-8bef-465c79cceef2{stroke:#000;stroke-miterlimit:10;stroke-width:0.25px;fill:url(#add51f77-6c43-4e92-98c1-48c56afe77db);}.a95d47f6-75cd-4161-8b64-9641bbc2a22b{fill:url(#fe3aecdf-9a06-4e57-bc62-aff2babc5340);}.ad4c80e8-1f3e-4ae5-bd8f-56eead1a3d35{fill:#fff;fill-rule:evenodd;}</style><linearGradient id="add51f77-6c43-4e92-98c1-48c56afe77db" x1="0.13" y1="22.87" x2="50.96" y2="22.87" gradientUnits="userSpaceOnUse"><stop offset="0.09" stop-color="#0c0c0c"></stop><stop offset="0.17" stop-color="#101010"></stop><stop offset="0.26" stop-color="#1d1e1e"></stop><stop offset="0.35" stop-color="#313434"></stop><stop offset="0.44" stop-color="#4b4f4f"></stop><stop offset="0.54" stop-color="#333636"></stop><stop offset="0.68" stop-color="#151616"></stop><stop offset="0.76" stop-color="#0a0a0a"></stop></linearGradient><linearGradient id="fe3aecdf-9a06-4e57-bc62-aff2babc5340" x1="12.8" y1="27.1" x2="33.91" y2="18.24" gradientUnits="userSpaceOnUse"><stop offset="0.46" stop-color="#00928b"></stop><stop offset="0.77" stop-color="#00736d"></stop><stop offset="1" stop-color="#00625d"></stop></linearGradient></defs><title>Asset 2</title><g id="a0582147-efb1-4ecf-91cf-63f6669d9ac9" data-name="Layer 2"><g id="ae69d7be-e777-4282-9194-3cadb6813425" data-name="Layer 1"><circle class="b088c895-30ef-4b38-8bef-465c79cceef2" cx="22.87" cy="22.87" r="22.75"></circle><circle class="a95d47f6-75cd-4161-8b64-9641bbc2a22b" cx="22.87" cy="22.87" r="11.21"></circle><path class="ad4c80e8-1f3e-4ae5-bd8f-56eead1a3d35" d="M20.16,16A1.27,1.27,0,1,1,18.9,17.3,1.27,1.27,0,0,1,20.16,16Zm1.27,13.25A5.41,5.41,0,0,1,18.9,24.7V19.29h0a2.51,2.51,0,0,1,2.5,2.5v7.5Z"></path><path class="ad4c80e8-1f3e-4ae5-bd8f-56eead1a3d35" d="M25.58,16.46a1.27,1.27,0,1,1-1.26,1.26,1.26,1.26,0,0,1,1.26-1.26Zm1.27,13.25a5.42,5.42,0,0,1-2.53-4.59V19.7h0a2.51,2.51,0,0,1,2.5,2.5v7.51Z"></path></g></g></svg>                    </div>
                </div>

                <div class="elementor-icon-wrapper" id="mute-sound" style="display: none; line-height: 0;">
                    <div class="elementor-icon" style="cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="a23e99a7-4f9a-4212-82bf-846542e15be3" data-name="Layer 1" viewBox="0 0 45.74686 45.74686"><defs><style>      .e6b615f0-3a34-4966-9b0f-fa8f36adb2f9 {        stroke: #000;        stroke-miterlimit: 10;        stroke-width: 0.25px;        fill: url(#eb30a15e-de7f-402d-8331-fcf7dede9ed7);      }      .a9172555-7ee9-4b9b-b7d7-58b349085bf6 {        fill: url(#f86929c6-8c25-4754-a222-5e6d3ff0148a);      }      .ec20c653-b043-416a-a11f-32db94110313 {        fill: #fff;      }    </style><linearGradient id="eb30a15e-de7f-402d-8331-fcf7dede9ed7" x1="0.125" y1="25.12657" x2="50.95953" y2="25.12657" gradientTransform="matrix(1, 0, 0, -1, 0, 48)" gradientUnits="userSpaceOnUse"><stop offset="0.09096" stop-color="#0c0c0c"></stop><stop offset="0.17232" stop-color="#101010"></stop><stop offset="0.26163" stop-color="#1d1e1e"></stop><stop offset="0.35434" stop-color="#313434"></stop><stop offset="0.44121" stop-color="#4b4f4f"></stop><stop offset="0.53874" stop-color="#333636"></stop><stop offset="0.68102" stop-color="#151616"></stop><stop offset="0.76007" stop-color="#0a0a0a"></stop></linearGradient><linearGradient id="f86929c6-8c25-4754-a222-5e6d3ff0148a" x1="12.8031" y1="20.89854" x2="33.90705" y2="29.75903" gradientTransform="matrix(1, 0, 0, -1, 0, 48)" gradientUnits="userSpaceOnUse"><stop offset="0.45725" stop-color="#00928b"></stop><stop offset="0.77455" stop-color="#00736d"></stop><stop offset="1" stop-color="#00625d"></stop></linearGradient></defs><title>icon-audio-invisimple</title><g id="b4e59988-9b80-4119-9938-2513d707876a" data-name="b6468ed4-3545-4f34-9fb7-c938e0b9d8e9"><g id="b3b0dd33-6cd0-46df-9657-c6aceee1b551" data-name="ea460610-dc09-4185-bce2-3dccd975cfed"><circle class="e6b615f0-3a34-4966-9b0f-fa8f36adb2f9" cx="22.87343" cy="22.87343" r="22.74843"></circle><circle class="a9172555-7ee9-4b9b-b7d7-58b349085bf6" cx="22.87343" cy="22.87343" r="11.21049"></circle><path class="ec20c653-b043-416a-a11f-32db94110313" d="M20.11842,18.37793a.52877.52877,0,0,0-.33191.49076v7.16513a1.98982,1.98982,0,1,0,.9198,1.87062h.00037V27.897c.00539-.05969.00914-.11987.00914-.181s-.00375-.12127-.00914-.181V20.69581l5.87859-2.35809v5.016a1.99048,1.99048,0,1,0-.93534,3.663,2.02737,2.02737,0,0,0,1.85551-2.04222V15.97461h0a.37864.37864,0,0,0-.51961-.35142Z"></path></g></g></svg>                    </div>
                </div>

            </div>

                <script type="text/javascript">
        (function () {
            'use strict';

            var isYoutube = false;
            var fadeDuration = 2000;
            var song = document.getElementById('song');
            var youtubeContainer = document.getElementById('youtube-audio');
            var pauseTimer = null;
            var isFirstPlay = true;
            var loopStartTime = 0;
            var loopEndTime = null;
            var ytPlayer = null;
            var ytReady = false;
            var ytShouldPlay = true;

            var songStartSetting = "0:30";
            var songEndSetting = "";
            var youtubeStartSetting = "";
            var youtubeEndSetting = "";
            var youtubeUrl = "";
            var audioLoopEnabled = true;

            function parseTime(time) {
                if (time === null || typeof time === 'undefined' || time === '') return 0;

                time = String(time).trim();
                if (!time) return 0;

                if (/^\d+(?:\.\d+)?$/.test(time) && time.indexOf('.') === -1) {
                    return parseFloat(time);
                }

                // Existing AMS behavior: dot may be used as a colon, e.g. 01.30.
                time = time.replace(/\./g, ':');
                var parts = time.split(':').map(function (part) {
                    return Number(part);
                });

                if (parts.some(function (part) { return Number.isNaN(part); })) return 0;

                if (parts.length === 2) {
                    return (parts[0] * 60) + parts[1];
                }

                if (parts.length === 3) {
                    return (parts[0] * 3600) + (parts[1] * 60) + parts[2];
                }

                return Number(parts[0]) || 0;
            }

            function parseTimeRange(value) {
                if (!value) {
                    return { start: 0, end: null };
                }

                var parts = String(value).split('-');
                return {
                    start: parseTime(parts[0].trim()),
                    end: parts[1] ? parseTime(parts[1].trim()) : null
                };
            }

            function audioActive() {
                if (window.jQuery) {
                    jQuery('#mute-sound').show();
                    jQuery('#unmute-sound').hide();
                }
            }

            function audioInactive() {
                if (window.jQuery) {
                    jQuery('#mute-sound').hide();
                    jQuery('#unmute-sound').show();
                }
            }

            // Keep these names global because AMS Video and existing pages may call them.
            window.audioActive = audioActive;
            window.audioInactive = audioInactive;

            function waitForYouTubeAPI(callback) {
                if (window.YT && typeof window.YT.Player === 'function') {
                    callback();
                    return;
                }

                if (!document.querySelector('script[src*="youtube.com/iframe_api"]')) {
                    var script = document.createElement('script');
                    script.src = 'https://www.youtube.com/iframe_api';
                    script.async = true;
                    script.dataset.amsYoutubeApi = '1';
                    (document.head || document.documentElement).appendChild(script);
                }

                var attempts = 0;
                var timer = window.setInterval(function () {
                    attempts++;
                    if (window.YT && typeof window.YT.Player === 'function') {
                        window.clearInterval(timer);
                        callback();
                    } else if (attempts >= 200) {
                        window.clearInterval(timer);
                    }
                }, 50);
            }

            function getOrigin() {
                if (window.location && window.location.origin && /^https?:\/\//i.test(window.location.origin)) {
                    return window.location.origin;
                }
                return window.location.protocol + '//' + window.location.host;
            }

            function extractVideoID(url) {
                if (!url) return '';
                var value = String(url).trim();
                if (/^[a-zA-Z0-9_-]{11}$/.test(value)) return value;

                var patterns = [
                    /[?&]v=([a-zA-Z0-9_-]{11})/,
                    /youtu\.be\/([a-zA-Z0-9_-]{11})/,
                    /youtube(?:-nocookie)?\.com\/embed\/([a-zA-Z0-9_-]{11})/,
                    /youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/,
                    /youtube\.com\/live\/([a-zA-Z0-9_-]{11})/
                ];

                for (var i = 0; i < patterns.length; i++) {
                    var match = value.match(patterns[i]);
                    if (match && match[1]) return match[1];
                }
                return '';
            }

            /**
             * Elementor background videos are decorative media and should always be silent.
             * Some Android/WebView builds can briefly restore audio after a user gesture or
             * when Elementor rebuilds the background player. Keep them hard-muted without
             * pausing the visual video, and do not touch normal/foreground video widgets.
             */
            function initElementorBackgroundVideoAudioGuard() {
                if (window.__amsElementorBackgroundAudioGuard === true) {
                    if (typeof window.amsMuteElementorBackgroundVideos === 'function') {
                        window.amsMuteElementorBackgroundVideos();
                    }
                    return;
                }

                window.__amsElementorBackgroundAudioGuard = true;

                var nativeSelector = 'video.elementor-background-video-hosted, .elementor-background-video-container video';
                var iframeSelector = '.elementor-background-video-container iframe, .elementor-background-video-embed iframe';
                var youtubePattern = /(?:youtube\.com|youtube-nocookie\.com)/i;
                var vimeoPattern = /player\.vimeo\.com/i;
                var mutationTimer = null;
                var gestureTimer = null;

                function isBackgroundNativeVideo(video) {
                    return !!(
                        video &&
                        video.nodeType === 1 &&
                        video.matches &&
                        (
                            video.matches('video.elementor-background-video-hosted') ||
                            video.matches('.elementor-background-video-container video')
                        )
                    );
                }

                function isBackgroundIframe(iframe) {
                    if (!iframe || iframe.nodeType !== 1 || !iframe.matches || !iframe.matches('iframe')) return false;
                    return !!(
                        iframe.closest('.elementor-background-video-container') ||
                        iframe.closest('.elementor-background-video-embed')
                    );
                }

                function muteNativeVideo(video) {
                    if (!isBackgroundNativeVideo(video)) return;
                    if (video.__amsApplyingBackgroundMute) return;

                    video.__amsApplyingBackgroundMute = true;
                    try {
                        // Use both DOM properties and HTML attributes. Some Android/WebView
                        // implementations behave differently depending on when the media is initialized.
                        video.muted = true;
                        video.defaultMuted = true;
                        if (video.volume !== 0) video.volume = 0;
                        video.setAttribute('muted', '');
                        video.setAttribute('playsinline', '');
                        video.setAttribute('webkit-playsinline', '');
                    } catch (e) {}
                    video.__amsApplyingBackgroundMute = false;

                    if (video.dataset && video.dataset.amsBackgroundMuteBound !== '1') {
                        video.dataset.amsBackgroundMuteBound = '1';

                        ['loadedmetadata', 'canplay', 'play', 'playing', 'volumechange'].forEach(function (eventName) {
                            video.addEventListener(eventName, function () {
                                muteNativeVideo(video);
                            }, true);
                        });
                    }
                }

                function muteBackgroundIframe(iframe) {
                    if (!isBackgroundIframe(iframe)) return;

                    var src = iframe.getAttribute('src') || '';
                    var target = iframe.contentWindow;
                    if (!target) return;

                    try {
                        if (youtubePattern.test(src)) {
                            // YouTube IFrame Player API command format.
                            target.postMessage(JSON.stringify({ event: 'command', func: 'mute', args: [] }), '*');
                            target.postMessage(JSON.stringify({ event: 'command', func: 'setVolume', args: [0] }), '*');
                        } else if (vimeoPattern.test(src)) {
                            // Vimeo player postMessage API.
                            target.postMessage(JSON.stringify({ method: 'setVolume', value: 0 }), '*');
                            target.postMessage(JSON.stringify({ method: 'setMuted', value: true }), '*');
                        }
                    } catch (e) {}

                    if (iframe.dataset && iframe.dataset.amsBackgroundMuteBound !== '1') {
                        iframe.dataset.amsBackgroundMuteBound = '1';
                        iframe.addEventListener('load', function () {
                            scheduleMutePass(document);
                        });
                    }
                }

                function scanBackgroundVideos(root) {
                    root = root || document;

                    if (root.nodeType === 1) {
                        if (isBackgroundNativeVideo(root)) muteNativeVideo(root);
                        if (isBackgroundIframe(root)) muteBackgroundIframe(root);
                    }

                    if (!root.querySelectorAll) return;

                    root.querySelectorAll(nativeSelector).forEach(function (video) {
                        muteNativeVideo(video);
                    });

                    root.querySelectorAll(iframeSelector).forEach(function (iframe) {
                        muteBackgroundIframe(iframe);
                    });
                }

                function scheduleMutePass(root) {
                    scanBackgroundVideos(root || document);

                    // Embedded players may not accept mute commands until their API is ready.
                    // Retry only a few times; native videos are already protected by events.
                    [80, 250, 650, 1400, 2800].forEach(function (delay) {
                        window.setTimeout(function () {
                            scanBackgroundVideos(document);
                        }, delay);
                    });
                }

                function scheduleGestureMutePass() {
                    if (gestureTimer) window.clearTimeout(gestureTimer);
                    scanBackgroundVideos(document);
                    gestureTimer = window.setTimeout(function () {
                        scanBackgroundVideos(document);
                    }, 180);
                    window.setTimeout(function () {
                        scanBackgroundVideos(document);
                    }, 700);
                }

                // Expose one harmless helper for troubleshooting/manual calls.
                window.amsMuteElementorBackgroundVideos = function () {
                    scheduleMutePass(document);
                };

                scheduleMutePass(document);

                // Elementor may insert/rebuild the background player after its frontend handlers run.
                if (window.MutationObserver && document.documentElement) {
                    var observer = new MutationObserver(function (mutations) {
                        var needsScan = false;

                        for (var i = 0; i < mutations.length && !needsScan; i++) {
                            var addedNodes = mutations[i].addedNodes || [];
                            for (var j = 0; j < addedNodes.length; j++) {
                                var node = addedNodes[j];
                                if (!node || node.nodeType !== 1) continue;

                                if (
                                    isBackgroundNativeVideo(node) ||
                                    isBackgroundIframe(node) ||
                                    (node.querySelector && (
                                        node.querySelector(nativeSelector) ||
                                        node.querySelector(iframeSelector)
                                    ))
                                ) {
                                    needsScan = true;
                                    break;
                                }
                            }
                        }

                        if (!needsScan) return;
                        if (mutationTimer) window.clearTimeout(mutationTimer);
                        mutationTimer = window.setTimeout(function () {
                            scheduleMutePass(document);
                        }, 40);
                    });

                    observer.observe(document.documentElement, {
                        childList: true,
                        subtree: true
                    });
                }

                // A user gesture can unlock audible autoplay on some Android browsers/WebViews.
                // Use pointerdown when available so one physical tap does not trigger three guard passes.
                if ('PointerEvent' in window) {
                    document.addEventListener('pointerdown', scheduleGestureMutePass, true);
                } else {
                    document.addEventListener('touchstart', scheduleGestureMutePass, true);
                    document.addEventListener('click', scheduleGestureMutePass, true);
                }

                // Especially important because AMS Audio starts from this same user gesture.
                var openButton = document.getElementById('btn_open');
                if (openButton) {
                    openButton.addEventListener('click', function () {
                        scheduleMutePass(document);
                    }, true);
                }

                document.addEventListener('visibilitychange', function () {
                    if (document.visibilityState === 'visible') {
                        scheduleMutePass(document);
                    }
                });

                window.addEventListener('pageshow', function () {
                    scheduleMutePass(document);
                });
            }

            function bindScrollAnimation() {
                var audioBox = document.getElementById('wds-audio-container');
                if (!audioBox || audioBox.dataset.amsScrollBound === '1') return;
                audioBox.dataset.amsScrollBound = '1';

                var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop || 0;
                window.addEventListener('scroll', function () {
                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop || 0;
                    if (scrollTop > lastScrollTop) {
                        audioBox.classList.remove('slide-left');
                        audioBox.classList.add('slide-right');
                    } else {
                        audioBox.classList.remove('slide-right');
                        audioBox.classList.add('slide-left');
                    }
                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                }, { passive: true });
            }

            function bindCommonVisibilityHandlers() {
                document.addEventListener('visibilitychange', function () {
                    if (document.visibilityState === 'visible') {
                        if (typeof window.playAudio === 'function') window.playAudio();
                    } else if (typeof window.pauseAudio === 'function') {
                        // Immediate pause when leaving the tab, matching the old behavior.
                        if (!isYoutube && song) {
                            try { song.pause(); } catch (e) {}
                        } else {
                            window.pauseAudio(true);
                        }
                    }
                });
            }

            initElementorBackgroundVideoAudioGuard();

            if (!isYoutube) {
                if (!song) {
                    bindScrollAnimation();
                    return;
                }

                var range = parseTimeRange(songStartSetting);
                loopStartTime = range.start;
                loopEndTime = range.end;

                // Preserve support for the separate End Time control.
                if (loopEndTime === null && songEndSetting !== '') {
                    var explicitEnd = parseTime(songEndSetting);
                    if (explicitEnd > loopStartTime) loopEndTime = explicitEnd;
                }

                if (loopEndTime !== null && loopEndTime <= loopStartTime) {
                    loopEndTime = null;
                }

                function fadeAudio(targetVolume, duration) {
                    if (!song) return;
                    var startVolume = Number(song.volume);
                    if (!Number.isFinite(startVolume)) startVolume = 1;
                    var startTime = Date.now();

                    function step() {
                        if (!song) return;
                        var elapsed = Date.now() - startTime;
                        if (elapsed < duration) {
                            var fraction = elapsed / duration;
                            song.volume = Math.max(0, Math.min(1, startVolume + ((targetVolume - startVolume) * fraction)));
                            window.requestAnimationFrame(step);
                        } else {
                            song.volume = Math.max(0, Math.min(1, targetVolume));
                        }
                    }
                    window.requestAnimationFrame(step);
                }

                function nativePlayAudio() {
                    if (!song) return;
                    if (pauseTimer) {
                        window.clearTimeout(pauseTimer);
                        pauseTimer = null;
                    }

                    if (isFirstPlay) {
                        try {
                            song.currentTime = loopStartTime;
                        } catch (e) {}
                        isFirstPlay = false;
                    }

                    if (!song.paused) {
                        audioActive();
                        return;
                    }

                    song.volume = 0;
                    var promise;
                    try {
                        promise = song.play();
                    } catch (e) {
                        audioInactive();
                        return;
                    }

                    if (promise && typeof promise.then === 'function') {
                        promise.then(function () {
                            fadeAudio(1, fadeDuration);
                            audioActive();
                        }).catch(function () {
                            // Autoplay may be blocked until #btn_open/user interaction.
                            audioInactive();
                        });
                    } else {
                        fadeAudio(1, fadeDuration);
                        audioActive();
                    }
                }

                function nativePauseAudio(immediate) {
                    if (!song) return;
                    if (pauseTimer) {
                        window.clearTimeout(pauseTimer);
                        pauseTimer = null;
                    }

                    if (immediate) {
                        try { song.pause(); } catch (e) {}
                        audioInactive();
                        return;
                    }

                    fadeAudio(0, fadeDuration);
                    pauseTimer = window.setTimeout(function () {
                        try { song.pause(); } catch (e) {}
                        pauseTimer = null;
                    }, fadeDuration);
                    audioInactive();
                }

                function toggleNativeAudio() {
                    if (song.paused) nativePlayAudio();
                    else nativePauseAudio(false);
                }

                window.playAudio = nativePlayAudio;
                window.pauseAudio = nativePauseAudio;
                window.toggleAudio = toggleNativeAudio;

                song.addEventListener('timeupdate', function () {
                    if (loopEndTime !== null && song.currentTime >= (loopEndTime - 0.05)) {
                        song.currentTime = loopStartTime;
                        if (song.paused) nativePlayAudio();
                    }
                });

                if (window.jQuery) {
                    jQuery('#unmute-sound .elementor-icon').off('click.amsAudio').on('click.amsAudio', toggleNativeAudio);
                    jQuery('#btn_open').off('click.amsAudio').on('click.amsAudio', nativePlayAudio);
                    jQuery('#mute-sound .elementor-icon').off('click.amsAudio').on('click.amsAudio', function () {
                        if (!song.paused) toggleNativeAudio();
                    });
                }

                bindCommonVisibilityHandlers();

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', nativePlayAudio, { once: true });
                } else {
                    nativePlayAudio();
                }
            } else {
                var videoId = extractVideoID(youtubeUrl);
                var ytStart = parseTime(youtubeStartSetting);
                var ytEnd = youtubeEndSetting !== '' ? parseTime(youtubeEndSetting) : null;
                if (ytEnd !== null && ytEnd <= ytStart) ytEnd = null;

                function youtubePlayAudio() {
                    ytShouldPlay = true;
                    if (!ytReady || !ytPlayer) return;
                    try {
                        if (ytStart > 0 && ytPlayer.getCurrentTime && ytPlayer.getCurrentTime() < (ytStart - 0.5)) {
                            ytPlayer.seekTo(ytStart, true);
                        }
                        ytPlayer.playVideo();
                    } catch (e) {}
                }

                function youtubePauseAudio() {
                    ytShouldPlay = false;
                    if (!ytReady || !ytPlayer) {
                        audioInactive();
                        return;
                    }
                    try { ytPlayer.pauseVideo(); } catch (e) {}
                    audioInactive();
                }

                function toggleYoutubeAudio() {
                    if (!ytReady || !ytPlayer) {
                        ytShouldPlay = true;
                        return;
                    }
                    try {
                        var state = ytPlayer.getPlayerState();
                        if (state === 1 || state === 3) youtubePauseAudio();
                        else youtubePlayAudio();
                    } catch (e) {}
                }

                window.playAudio = youtubePlayAudio;
                window.pauseAudio = youtubePauseAudio;
                window.toggleAudio = toggleYoutubeAudio;

                if (youtubeContainer && videoId) {
                    youtubeContainer.style.cssText = 'position:absolute;width:1px;height:1px;overflow:hidden;opacity:0;pointer-events:none;';

                    var iframe = document.createElement('iframe');
                    var params = new URLSearchParams({
                        enablejsapi: '1',
                        playsinline: '1',
                        origin: getOrigin(),
                        widget_referrer: window.location.href,
                        start: String(Math.max(0, Math.floor(ytStart)))
                    });

                    if (ytEnd !== null) params.set('end', String(Math.max(0, Math.floor(ytEnd))));
                    if (audioLoopEnabled) {
                        params.set('loop', '1');
                        params.set('playlist', videoId);
                    }

                    iframe.id = 'youtube-player';
                    iframe.src = 'https://www.youtube.com/embed/' + encodeURIComponent(videoId) + '?' + params.toString();
                    iframe.title = 'YouTube audio player';
                    iframe.allow = 'autoplay; encrypted-media';
                    iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                    iframe.setAttribute('frameborder', '0');
                    iframe.style.width = '1px';
                    iframe.style.height = '1px';
                    iframe.style.border = '0';

                    youtubeContainer.innerHTML = '';
                    youtubeContainer.appendChild(iframe);

                    waitForYouTubeAPI(function () {
                        try {
                            ytPlayer = new YT.Player(iframe, {
                                events: {
                                    onReady: function (event) {
                                        ytReady = true;
                                        try { event.target.setPlaybackQuality('small'); } catch (e) {}
                                        if (ytShouldPlay) youtubePlayAudio();
                                    },
                                    onStateChange: function (event) {
                                        if (!window.YT) return;
                                        if (event.data === YT.PlayerState.PLAYING) {
                                            audioActive();
                                        } else if (event.data === YT.PlayerState.PAUSED) {
                                            audioInactive();
                                        } else if (event.data === YT.PlayerState.ENDED) {
                                            if (audioLoopEnabled || ytEnd !== null) {
                                                try {
                                                    ytPlayer.seekTo(ytStart, true);
                                                    if (ytShouldPlay) ytPlayer.playVideo();
                                                } catch (e) {}
                                            } else {
                                                audioInactive();
                                            }
                                        }
                                    },
                                    onError: function () {
                                        audioInactive();
                                    }
                                }
                            });
                            window.amsAudioPlayer = ytPlayer;
                        } catch (e) {
                            audioInactive();
                        }
                    });
                }

                if (window.jQuery) {
                    jQuery('#btn_open').off('click.amsAudio').on('click.amsAudio', youtubePlayAudio);
                    jQuery('#unmute-sound .elementor-icon').off('click.amsAudio').on('click.amsAudio', toggleYoutubeAudio);
                    jQuery('#mute-sound .elementor-icon').off('click.amsAudio').on('click.amsAudio', youtubePauseAudio);
                }

                bindCommonVisibilityHandlers();
            }

            bindScrollAnimation();
        })();
        </script>

    				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				</footer>
		</div>
						</div>
				</div>
					</div>
		</div>
					</div>
		</section>
				<section class="elementor-section elementor-inner-section elementor-element elementor-element-90e6141 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="90e6141" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[]}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-fd6f577" data-id="fd6f577" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-97c753e elementor-widget elementor-widget-html" data-id="97c753e" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<style>
    #cover .elementor-background-overlay, #cover_desktop .elementor-background-overlay, #slide_awal .elementor-background-overlay {
	background-image: linear-gradient(0deg, #333333 0%, #00000000 45%);
    opacity: 0.6;
    }
</style>				</div>
				</div>
				<div class="elementor-element elementor-element-0de4156 elementor-widget elementor-widget-html" data-id="0de4156" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" ></script>
<script>
var cover = document.getElementById('cover');
var btn_open = document.getElementById('btn_open');
const isEditorActive = document.body.classList.contains('elementor-editor-active');

document.addEventListener('DOMContentLoaded', () => {
    var _vid = document.querySelector('.motionSection .elementor-background-video-container video');
    if (_vid && typeof _vid.removeAttribute === 'function') { _vid.removeAttribute('autoplay'); }
    var _kp = document.querySelector('.kolomPertama');
    if (_kp && _kp.style) { _kp.style.display = 'none'; }
});

if (typeof elementorFrontendConfig === 'undefined') {
    disableScrolling();
    document.body.style.height = "100vh";
    if (btn_open) { btn_open.onclick = function() {
        enableScrolling();
        closeCover();
        myFunction();
    }; }

}

function myFunction() {
    setTimeout(() => {
        var _mv = document.querySelector(".motionSection .elementor-background-video-container video"); if (_mv && typeof _mv.play === "function") { _mv.play(); }
    }, 100);
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
    $("#cover").css({
    position: 'absolute'});
    $("#cover").animate({ opacity: 0, top : "-100vh"}, 2500, 'easeInOutCubic');
	$("#cover").hide(2500);
}

</script>				</div>
				</div>
				<div class="elementor-element elementor-element-b879db8 elementor-widget elementor-widget-html" data-id="b879db8" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
					<script>
var btnCustomColor = document.getElementById('btn_custom_color');
var secCustomColor = document.getElementById('sec_custom_color');

var btnText = btnCustomColor ? btnCustomColor.querySelector('.elementor-button-text') : null;

if (btnCustomColor && secCustomColor && btnText) {
    btnCustomColor.onclick = function () {
        toggleSecColor();
    };

    function toggleSecColor() {
        if (secCustomColor.style.right === "-250px" || secCustomColor.style.right === "") {
            $("#sec_custom_color").animate({ right: "0" }, 1000, 'easeInOutCubic');
            setTimeout(function () {
                btnText.textContent = "TUTUP";
            }, 1000);
        } else {
            $("#sec_custom_color").animate({ right: "-250px" }, 1000, 'easeInOutCubic');
            setTimeout(function () {
                btnText.textContent = "GANTI WARNA";
            }, 1000);
        }
    }
} else {
}

</script>				</div>
				</div>
				<div class="elementor-element elementor-element-1276f46 elementor-widget elementor-widget-html" data-id="1276f46" data-element_type="widget" data-e-type="widget" data-widget_type="html.default">
				<div class="elementor-widget-container">
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
  filter: blur(5px);
  transition: transform 1.5s ease, opacity 1.5s ease, filter 1.5s ease;
}

.inv-zoom-in.active {
  transform: scale(1);
  opacity: 1;
  filter: blur(0);
}

.inv-zoom-out {
  transform: scale(1.1);
  opacity: 0;
  filter: blur(5px);
  transition: transform 1.5s ease, opacity 1.5s ease, filter 1.5s ease;
}

.inv-zoom-out.active {
  transform: scale(1);
  opacity: 1;
  filter: blur(0);
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
				<section class="elementor-section elementor-top-section elementor-element elementor-element-e47b0ce elementor-section-full_width elementor-section-height-min-height elementor-section-items-stretch elementor-section-content-middle elementor-section-height-default" data-id="e47b0ce" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
						<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-848e89d elementor-hidden-mobile elementor-hidden-tablet" data-id="848e89d" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:26988,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2025\/01\/0-PEMBUKA.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section data-dce-background-color="#33333326" data-dce-background-overlay-color="#101010" class="elementor-section elementor-inner-section elementor-element elementor-element-2e4d24e elementor-section-height-min-height elementor-section-boxed elementor-section-height-default" data-id="2e4d24e" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6975281" data-id="6975281" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-40c9c80 elementor-section-full_width elementor-section-height-min-height elementor-section-height-default" data-id="40c9c80" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;video&quot;,&quot;background_video_link&quot;:&quot;https:\/\/file.invisimple.id\/2025\/02\/light_leak_effect.mp4&quot;}">
								<div class="elementor-background-video-container elementor-hidden-mobile">
													<video class="elementor-background-video-hosted" role="presentation" autoplay muted playsinline loop></video>
											</div>
								<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-28f3140" data-id="28f3140" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-b2df0bb elementor-widget elementor-widget-spacer" data-id="b2df0bb" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
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
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-0e1a38f animated-slow elementor-invisible elementor-widget elementor-widget-heading" data-id="0e1a38f" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">The Wedding Of</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-53ccaa1 wdsdv-enabled--yes animated-slow playball elementor-invisible elementor-widget elementor-widget-heading" data-id="53ccaa1" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInDown&quot;,&quot;_animation_delay&quot;:400}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default" data-preview="couple-nickname">{{ $data['bride']['nickname'] ?? 'Arinda' }} &amp; {{ $data['groom']['nickname'] ?? 'Raka' }}</h2>				</div>
				</div>
				<div data-dce-title-color="#FFFFFF" class="elementor-element elementor-element-830933a elementor-widget__width-inherit animated-slow wdsdv-enabled--yes elementor-invisible elementor-widget elementor-widget-heading" data-id="830933a" data-element_type="widget" data-e-type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
				<div class="elementor-widget-container">
					<h2 class="elementor-heading-title elementor-size-default">{{ $data['reception_date'] ?? ($data['wedding_date'] ?? '28 . 12 . 2027') }}</h2>				</div>
				</div>
					</div>
		</div>
					</div>
		</section>
					</div>
		</div>
				<div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-a932614" data-id="a932614" data-element_type="column" data-e-type="column" data-settings="{&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1500,&quot;background_slideshow_transition_duration&quot;:3000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;out&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997674,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-2.jpg&quot;},{&quot;id&quot;:997675,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-3.jpg&quot;},{&quot;id&quot;:997676,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-4.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;}">
			<div class="elementor-widget-wrap elementor-element-populated">
					<div class="elementor-background-overlay"></div>
						<section class="elementor-section elementor-inner-section elementor-element elementor-element-43f26ab elementor-section-height-min-height wdsdv-enabled--yes elementor-section-boxed elementor-section-height-default" data-id="43f26ab" data-element_type="section" data-e-type="section" data-settings="{&quot;jet_parallax_layout_list&quot;:[],&quot;background_background&quot;:&quot;slideshow&quot;,&quot;background_slideshow_slide_duration&quot;:1000,&quot;background_slideshow_transition_duration&quot;:4000,&quot;background_slideshow_ken_burns&quot;:&quot;yes&quot;,&quot;background_slideshow_ken_burns_zoom_direction&quot;:&quot;out&quot;,&quot;background_slideshow_gallery&quot;:[{&quot;id&quot;:997674,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-2.jpg&quot;},{&quot;id&quot;:997675,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-3.jpg&quot;},{&quot;id&quot;:997676,&quot;url&quot;:&quot;\/themes\/luxury-01\/uploads\/jet-form-builder\/695b3bdcd89a6aa8982774659196c290\/2026\/09\/sample-luxury-01-new-4.jpg&quot;}],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;}">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-d852738" data-id="d852738" data-element_type="column" data-e-type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-a0edea7 elementor-widget elementor-widget-spacer" data-id="a0edea7" data-element_type="widget" data-e-type="widget" data-widget_type="spacer.default">
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
				( () => {
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
				} )();
			</script>
			<style id="template-fix-2870960-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2870960:not(.elementor-motion-effects-element-type-background), .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2870960 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333A6;}
/*# sourceURL=template-fix-2870960-inline-inline-css */
</style>
<style id="template-fix-7758529-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7758529 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7758529 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-7758529-inline-inline-css */
</style>
<style id="template-fix-8a485f3-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-8a485f3 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-8a485f3 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-8a485f3-inline-inline-css */
</style>
<style id="template-fix-43d6938f-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-43d6938f > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-43d6938f-inline-inline-css */
</style>
<style id="template-fix-0826e4c-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-0826e4c .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-0826e4c .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-0826e4c-inline-inline-css */
</style>
<style id="template-fix-a845224-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-a845224 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-a845224 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-a845224-inline-inline-css */
</style>
<style id="template-fix-0c6f27d-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-0c6f27d > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-0c6f27d-inline-inline-css */
</style>
<style id="template-fix-f0b632e-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f0b632e > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-f0b632e-inline-inline-css */
</style>
<style id="template-fix-28aea2f-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-28aea2f > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-28aea2f-inline-inline-css */
</style>
<style id="template-fix-eb93dd0-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-eb93dd0 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-eb93dd0-inline-inline-css */
</style>
<style id="template-fix-a4c4034-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-a4c4034 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-a4c4034 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-a4c4034-inline-inline-css */
</style>
<style id="template-fix-3dd008ad-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3dd008ad > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-3dd008ad-inline-inline-css */
</style>
<style id="template-fix-e039c1f-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-e039c1f > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-e039c1f-inline-inline-css */
</style>
<style id="template-fix-af89533-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-af89533 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-af89533-inline-inline-css */
</style>
<style id="template-fix-725c61a9-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-725c61a9 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-725c61a9-inline-inline-css */
</style>
<style id="template-fix-ad48c5e-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-ad48c5e > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-ad48c5e-inline-inline-css */
</style>
<style id="template-fix-c16e51c-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-c16e51c .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-c16e51c .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-c16e51c-inline-inline-css */
</style>
<style id="template-fix-700017e0-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-700017e0 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-700017e0-inline-inline-css */
</style>
<style id="template-fix-9eabdd4-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9eabdd4 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-9eabdd4-inline-inline-css */
</style>
<style id="template-fix-20bc11e-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-20bc11e > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-20bc11e-inline-inline-css */
</style>
<style id="template-fix-587fa63a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-587fa63a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-587fa63a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}
/*# sourceURL=template-fix-587fa63a-inline-inline-css */
</style>
<style id="template-fix-b2cf532-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-b2cf532 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-b2cf532 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-b2cf532-inline-inline-css */
</style>
<style id="template-fix-88a7b8a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-88a7b8a .elementor-button{fill: #5E5E5E; color: #5E5E5E;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-88a7b8a .elementor-button{border-color: #5E5E5E;}
/*# sourceURL=template-fix-88a7b8a-inline-inline-css */
</style>
<style id="template-fix-a9d35af-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-a9d35af > .elementor-background-overlay{background-color: #6d8998;}
/*# sourceURL=template-fix-a9d35af-inline-inline-css */
</style>
<style id="template-fix-da41331-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-da41331 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-da41331 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-da41331-inline-inline-css */
</style>
<style id="template-fix-adc246b-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-adc246b .elementor-button{fill: #5E5E5E; color: #5E5E5E;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-adc246b .elementor-button{border-color: #5E5E5E;}
/*# sourceURL=template-fix-adc246b-inline-inline-css */
</style>
<style id="template-fix-53cbacd0-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-53cbacd0:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-53cbacd0 > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}
/*# sourceURL=template-fix-53cbacd0-inline-inline-css */
</style>
<style id="template-fix-6fb65d6a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-6fb65d6a > .elementor-background-overlay{background-color: #6d8998;}
/*# sourceURL=template-fix-6fb65d6a-inline-inline-css */
</style>
<style id="template-fix-06fd409-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-06fd409.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-06fd409.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-06fd409.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-06fd409.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-06fd409.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-06fd409-inline-inline-css */
</style>
<style id="template-fix-9346b7b-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9346b7b.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9346b7b.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9346b7b.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9346b7b.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9346b7b.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-9346b7b-inline-inline-css */
</style>
<style id="template-fix-aaba4e7-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-aaba4e7.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-aaba4e7.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-aaba4e7.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-aaba4e7.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-aaba4e7.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-aaba4e7-inline-inline-css */
</style>
<style id="template-fix-3b6ccf4-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3b6ccf4.elementor-view-stacked .elementor-icon{background-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3b6ccf4.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3b6ccf4.elementor-view-default .elementor-icon{color: #01928B; border-color: #01928B;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3b6ccf4.elementor-view-framed .elementor-icon, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3b6ccf4.elementor-view-default .elementor-icon svg{fill: #01928B;}
/*# sourceURL=template-fix-3b6ccf4-inline-inline-css */
</style>
<style id="template-fix-23aa393f-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-23aa393f > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-23aa393f-inline-inline-css */
</style>
<style id="template-fix-5931375-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-5931375 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-5931375 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-5931375-inline-inline-css */
</style>
<style id="template-fix-e4376d9-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-e4376d9{--divider-color: #5e5e5e}
/*# sourceURL=template-fix-e4376d9-inline-inline-css */
</style>
<style id="template-fix-85d157e-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-85d157e .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-85d157e .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-85d157e-inline-inline-css */
</style>
<style id="template-fix-9a5e447-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-9a5e447 .jet-timeline-item .timeline-item__card-title{color: #6D8998}
/*# sourceURL=template-fix-9a5e447-inline-inline-css */
</style>
<style id="template-fix-318b31ac-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-318b31ac > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-318b31ac-inline-inline-css */
</style>
<style id="template-fix-f7af679-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f7af679 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-f7af679-inline-inline-css */
</style>
<style id="template-fix-3c58a9b4-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3c58a9b4 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-3c58a9b4 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-3c58a9b4-inline-inline-css */
</style>
<style id="template-fix-42fe188a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-42fe188a{--divider-color: #5e5e5e}
/*# sourceURL=template-fix-42fe188a-inline-inline-css */
</style>
<style id="template-fix-2c02a5ec-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2c02a5ec .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2c02a5ec .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-2c02a5ec-inline-inline-css */
</style>
<style id="template-fix-88dcdd-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-88dcdd > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-88dcdd-inline-inline-css */
</style>
<style id="template-fix-cbef084-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-cbef084 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-cbef084-inline-inline-css */
</style>
<style id="template-fix-802d262-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-802d262 .elementor-button{fill: #000000; color: #000000;}
/*# sourceURL=template-fix-802d262-inline-inline-css */
</style>
<style id="template-fix-6e59bcc-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-6e59bcc > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-6e59bcc-inline-inline-css */
</style>
<style id="template-fix-7913746-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7913746 .elementor-heading-title{color:#5e5e5e;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-7913746 .elementor-heading-title{color: #6D8998;}
/*# sourceURL=template-fix-7913746-inline-inline-css */
</style>
<style id="template-fix-f07b76a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-wrapper ul.saic-container-comments li.saic-item-comment .saic-comment-content .saic-comment-info .saic-commenter-name{color: #5E5E5E !important;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form input[type="submit"], .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form input[type="button"].saic-form-btn:hover, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-wrapper .saic-wrap-form .saic-container-form .saic-wrap-guest .guest-count{background-color: #6D8998;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-button{background-color: #6D899825;}.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-button:hover, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .rvspSelect, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-button:focus, .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-f07b76a .saic-button:active{background-color: #6D8998;}
/*# sourceURL=template-fix-f07b76a-inline-inline-css */
</style>
<style id="template-fix-30e164e9-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-30e164e9 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-30e164e9-inline-inline-css */
</style>
<style id="template-fix-61d70535-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-61d70535:not(.elementor-motion-effects-element-type-background), .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-61d70535 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}
/*# sourceURL=template-fix-61d70535-inline-inline-css */
</style>
<style id="template-fix-bb53199-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-bb53199 > .elementor-background-overlay{background-color: #333333;}
/*# sourceURL=template-fix-bb53199-inline-inline-css */
</style>
<link rel='stylesheet' id='elementor-post-370638-css' href='/themes/luxury-01/uploads/elementor/css/post-370638.css?ver=1789183424' media='all' />
<style id="template-fix-100e95a-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-100e95a:not(.elementor-motion-effects-element-type-background), .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-100e95a > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}
/*# sourceURL=template-fix-100e95a-inline-inline-css */
</style>
<style id="template-fix-2e4d24e-inline-inline-css">
.dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2e4d24e:not(.elementor-motion-effects-element-type-background), .dce-fix-background-loop .dce-elementor-rendering-id-0 .elementor-element.elementor-element-2e4d24e > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #33333326;}
/*# sourceURL=template-fix-2e4d24e-inline-inline-css */
</style>
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
<script id="imagesloaded-js" src="/themes/3d-motion-05/wp-includes/js/imagesloaded.min.js?ver=5.0.0"></script>
<script id="masonry-js" src="/themes/3d-motion-05/wp-includes/js/masonry.min.js?ver=4.2.2"></script>
<script id="betterdocs-categorygrid-js" src="/themes/3d-motion-05/plugins/betterdocs/assets/build/blocks/categorygrid/frontend.js?ver=a4a7e7ed1fd9a2aaf85a"></script>
<script id="saic_library-js" src="/themes/3d-motion-05/plugins/weddingsaas-pro/assets/plugins/custom/commentpress/saic_lib.js?ver=2.10.2.1"></script>
<script id="wds_rsvp-js-extra">
var WDS_RSVP = {"ajaxurl":"/wp-admin/admin-ajax.php","nonce":"019b03f4f6","jPagesNum":"100","textCounterNum":"300","thanksComment":"Terimakasih atas ucapan Anda!","duplicateComment":"Anda mungkin membiarkan salah satu kolom kosong, atau menggandakan komentar","guestMax":"2","textNavNext":"Next","textNavPrev":"Previous"};
//# sourceURL=wds_rsvp-js-extra
</script>
<script id="wds_rsvp-js" src="/themes/3d-motion-05/plugins/weddingsaas-pro/assets/js/wds-rsvp.js?ver=2.10.2.1"></script>
<script id="dce-fix-background-loop-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/fix-background-loop.js?ver=3.4.0"></script>
<script id="dce-settings-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/settings.js?ver=3.4.0"></script>
<script id="dce-formatted-number-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/formatted-number.js?ver=3.4.0"></script>
<script id="dce-dynamic-select-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/dynamic-select.js?ver=3.4.0"></script>
<script id="dce-tooltip-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/tooltip.js?ver=3.4.0"></script>
<script id="dce-popper-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/popperjs/popper.min.js?ver=3.4.0"></script>
<script id="dce-tippy-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/tippy.js/tippy-bundle.umd.min.js?ver=3.4.0"></script>
<script id="wdsfa-dfu-theme-capture-js" src="/themes/3d-motion-05/plugins/wds-feature-addons/assets/js/done-for-you-theme-capture.js?ver=0.3.0"></script>
<script id="betterdocs-elementor-editor-js" src="/themes/3d-motion-05/plugins/betterdocs/assets/build/elementor/js/editor.js?ver=227f1a8a046dbe6ba8f5"></script>
<script id="elementor-webpack-runtime-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/webpack.runtime.js?ver=4.2.4"></script>
<script id="elementor-frontend-modules-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/frontend-modules.js?ver=4.2.4"></script>
<script id="jquery-ui-core-js" src="/themes/3d-motion-05/wp-includes/js/jquery/ui/core.js?ver=1.13.3"></script>
<script id="elementor-frontend-js-before">
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":true},"i18n":{"shareOnFacebook":"Bagikan di Facebook","shareOnX":"Share on X","pinIt":"Buat Pin","download":"Unduh","downloadImage":"Unduh gambar","fullscreen":"Layar Penuh","zoom":"Perbesar","share":"Bagikan","playVideo":"Putar Video","previous":"Sebelumnya","next":"Selanjutnya","close":"Tutup","a11yCarouselPrevSlideMessage":"Slide sebelumnya","a11yCarouselNextSlideMessage":"Slide selanjutnya","a11yCarouselFirstSlideMessage":"This is the first slide","a11yCarouselLastSlideMessage":"This is the last slide","a11yCarouselPaginationBulletMessage":"Go to slide"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Layar lebar","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.2.4","is_static":false,"experimentalFeatures":{"additional_custom_breakpoints":true,"e_panel_promotions":true,"theme_builder_v2":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true,"e_pro_atomic_form":true,"e_pro_collection_loop":true,"e_pro_variables":true,"e_pro_interactions":true},"urls":{"assets":"\/themes\/3d-motion-05\/plugins\/elementor\/assets\/","ajaxurl":"\/wp-admin\/admin-ajax.php","uploadUrl":"\/themes\/3d-motion-05\/uploads"},"nonces":{"floatingButtonsClickTracking":"578a570890","atomicFormsSendForm":"e3c32ef756"},"swiperClass":"swiper","settings":{"page":{"ha_cmc_init_switcher":"no"},"editorPreferences":[],"dynamicooo":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","ha_rpb_enable":"no"},"post":{"id":22578,"title":"Tema%20Luxury%2001","excerpt":"","featuredImage":"\/themes\/luxury-01\/uploads\/2025\/02\/thumbnail-luxury-01-1.jpg"}};
//# sourceURL=elementor-frontend-js-before
</script>
<script id="elementor-frontend-js" src="/themes/3d-motion-05/plugins/elementor/assets/js/frontend.js?ver=4.2.4"></script>
<script id="swiper-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/swiper/v8/swiper.js?ver=8.4.5"></script>
<script id="lottie-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/lib/lottie/lottie.js?ver=5.6.6"></script>
<script id="jet-tween-js-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/lib/tweenjs/tweenjs.min.js?ver=2.0.2"></script>
<script id="jet-elements-js-extra">
var jetElements = {"ajaxUrl":"/wp-admin/admin-ajax.php","isMobile":"false","templateApiUrl":"/wp-json/jet-elements-api/v1/elementor-template","devMode":"false","mapboxToken":"","messages":{"invalidMail":"Please specify a valid e-mail"}};
//# sourceURL=jet-elements-js-extra
</script>
<script id="jet-elements-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/jet-elements.js?ver=2.9.2"></script>
<script id="jet-timeline-js" src="/themes/3d-motion-05/plugins/jet-elements/assets/js/addons/jet-timeline.js?ver=2.9.2"></script>
<script id="elementor-gallery-js" src="/themes/3d-motion-05/plugins/elementor/assets/lib/e-gallery/js/e-gallery.js?ver=1.2.0"></script>
<script id="dce-prism-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism.js?ver=3.4.0"></script>
<script id="dce-prism-markup-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-markup.min.js?ver=3.4.0"></script>
<script id="dce-prism-markup-templating-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-markup-templating.min.js?ver=3.4.0"></script>
<script id="dce-prism-php-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-php.min.js?ver=3.4.0"></script>
<script id="dce-prism-line-numbers-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/prismjs/prism-line-numbers.min.js?ver=3.4.0"></script>
<script id="dce-clipboard-js-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/node/clipboard/clipboard.min.js?ver=3.4.0"></script>
<script id="dce-copy-to-clipboard-js" src="/themes/3d-motion-05/plugins/dynamic-content-for-elementor-new-version/assets/js/copy-to-clipboard.js?ver=3.4.0"></script>
<script id="happy-elementor-addons-js-extra">
var HappyLocalize = {"ajax_url":"/wp-admin/admin-ajax.php","nonce":"6436d11a6e","pdf_js_lib":"/themes/3d-motion-05/plugins/happy-elementor-addons/assets/vendor/pdfjs/lib"};
//# sourceURL=happy-elementor-addons-js-extra
</script>
<script id="happy-elementor-addons-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/js/happy-addons.js?ver=3.23.1"></script>
<script id="happy-reading-progress-bar-js" src="/themes/3d-motion-05/plugins/happy-elementor-addons/assets/js/extension-reading-progress-bar.js?ver=3.23.1"></script>
<script id="wdsfa-rsvp-guard-js-extra">
var WDSFARsvpGuard = {"postId":"22578","ajaxUrl":"/wp-admin/admin-ajax.php","browserChallenge":"1","behaviorGuard":"1","turnstileEnabled":"0","turnstileSiteKey":"","challengeMinAge":"4","ticketRequired":"1","ticketExpiresIn":"180"};
//# sourceURL=wdsfa-rsvp-guard-js-extra
</script>
<script id="wdsfa-rsvp-guard-js" src="/themes/3d-motion-05/plugins/wds-feature-addons/assets/js/rsvp-guard.js?ver=0.3.0"></script>
<script id="unitegallery-js" src="/themes/3d-motion-05/plugins/unlimited-elements-for-elementor-premium/assets_libraries/unitegallery/js/unitegallery.min.js?ver=1.5.109"></script>
<script id="uc_ac_assets_file_ug_theme_compact_js_9736-js" src="/themes/luxury-01/uploads/ac_assets/uc_compact_image_theme/ug-theme-compact.js?ver=1.5.109"></script>
<script id="elementor-pro-webpack-runtime-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/webpack-pro.runtime.js?ver=4.2.3"></script>
<script id="wp-hooks-js" src="/themes/3d-motion-05/wp-includes/js/dist/hooks.js?ver=7496969728ca0f95732d"></script>
<script id="wp-i18n-js" src="/themes/3d-motion-05/wp-includes/js/dist/i18n.js?ver=781d11515ad3d91786ec"></script>
<script id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
//# sourceURL=wp-i18n-js-after
</script>
<script id="elementor-pro-frontend-js-before">
var ElementorProFrontendConfig = {"ajaxurl":"\/wp-admin\/admin-ajax.php","nonce":"e259e5bc7e","urls":{"assets":"\/themes\/3d-motion-05\/plugins\/elementor-pro\/assets\/","rest":"\/wp-json\/"},"settings":{"lazy_load_background_images":true},"popup":{"hasPopUps":true},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"},"x-twitter":{"title":"X"},"threads":{"title":"Threads"}},"facebook_sdk":{"lang":"id_ID","app_id":""},"lottie":{"defaultAnimationUrl":"\/themes\/3d-motion-05\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
//# sourceURL=elementor-pro-frontend-js-before
</script>
<script id="elementor-pro-frontend-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/frontend.js?ver=4.2.3"></script>
<script id="pro-elements-handlers-js" src="/themes/3d-motion-05/plugins/elementor-pro/assets/js/elements-handlers.js?ver=4.2.3"></script>

<!--   Unlimited Elements 1.5.109 Scripts --> 
<script type='text/javascript' id='unlimited-elements-scripts'>

/* Compact Gallery scripts: */ 

jQuery(document).ready(function(){	
function uc_uc_compact_image_theme_elementor_1220348_start(){

  var objGallery = jQuery("#uc_uc_compact_image_theme_elementor_1220348");
  
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
					slider_background_color:"#FFFFFF",
                                    
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
					thumb_border_color: "#FFFFFF",				//thumb border color
					thumb_over_border_width: 0,					//thumb border width in mouseover state
					thumb_over_border_color: "#c0c0c0",			//thumb border color in mouseover state
					thumb_selected_border_width: 0,				//thumb width in selected state
					thumb_selected_border_color: "#ffffff",		//thumb border color in selected state
	
					thumb_round_corners_radius:0,				//thumb border radius
	
					thumb_color_overlay_effect: true,			//true,false - thumb color overlay effect, release the overlay on mouseover and selected states
					thumb_overlay_color: "#000000",				//thumb overlay color
					thumb_overlay_opacity: 0.5,					//thumb overlay color opacity
					thumb_overlay_reverse:false,				//true,false - reverse the overlay, will be shown on selected state only
					thumb_image_overlay_effect: false,			//true,false - images overlay effect on normal state only
					thumb_image_overlay_type: "blur",				//bw , blur, sepia - the type of image effect overlay, black and white, sepia and blur.
					thumb_transition_duration: 200,				//thumb effect transition duration
					thumb_transition_easing: "easeOutQuad",		//thumb effect transition easing        
					strippanel_background_color:"#FFFFFF",
  });

  objGallery.data("unitegallery-api",api);
			
			objGallery.trigger("uc-object-ready");
			jQuery(document).trigger("uc-remote-parent-init", [objGallery]);
			  

   objGallery.on("uc_ajax_sethtml",function(event, htmlItems, isAppend){      	
        api.changeItems(htmlItems);         
   });

  
}if(jQuery("#uc_uc_compact_image_theme_elementor_1220348").length) uc_uc_compact_image_theme_elementor_1220348_start(); else
	jQuery( document ).on( 'elementor/popup/show', () => { if(jQuery("#uc_uc_compact_image_theme_elementor_1220348").length) uc_uc_compact_image_theme_elementor_1220348_start();});
});
</script>
<script id="wp-emoji-settings" type="application/json">
{"baseUrl":"https://s.w.org/images/core/emoji/17.0.2/72x72/","ext":".png","svgUrl":"https://s.w.org/images/core/emoji/17.0.2/svg/","svgExt":".svg","source":{"wpemoji":"/themes/3d-motion-05/wp-includes/js/wp-emoji.js?ver=7.0.4","twemoji":"/themes/3d-motion-05/wp-includes/js/twemoji.js?ver=7.0.4"}}
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
<style id="e-addons-template-dynamic-2870960-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-2870960:not(.elementor-motion-effects-element-type-background), .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-2870960 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333A6;}</style><style id="e-addons-template-dynamic-43d6938f-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-43d6938f > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-0c6f27d-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-0c6f27d > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-f0b632e-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-f0b632e > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-28aea2f-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-28aea2f > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-eb93dd0-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-eb93dd0 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-3dd008ad-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-3dd008ad > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-e039c1f-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-e039c1f > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-af89533-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-af89533 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-725c61a9-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-725c61a9 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-ad48c5e-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-ad48c5e > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-700017e0-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-700017e0 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-9eabdd4-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-9eabdd4 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-20bc11e-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-20bc11e > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-587fa63a-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-587fa63a:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-587fa63a > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}</style><style id="e-addons-template-dynamic-a9d35af-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-a9d35af > .elementor-background-overlay{background-color: #6d8998;}</style><style id="e-addons-template-dynamic-53cbacd0-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-53cbacd0:not(.elementor-motion-effects-element-type-background) > .elementor-widget-wrap, .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-53cbacd0 > .elementor-widget-wrap > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}</style><style id="e-addons-template-dynamic-6fb65d6a-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-6fb65d6a > .elementor-background-overlay{background-color: #6d8998;}</style><style id="e-addons-template-dynamic-23aa393f-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-23aa393f > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-e4376d9-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-e4376d9{--divider-color: #5e5e5e}</style><style id="e-addons-template-dynamic-318b31ac-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-318b31ac > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-f7af679-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-f7af679 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-42fe188a-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-42fe188a{--divider-color: #5e5e5e}</style><style id="e-addons-template-dynamic-88dcdd-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-88dcdd > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-cbef084-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-cbef084 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-6e59bcc-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-6e59bcc > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-30e164e9-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-30e164e9 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-61d70535-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-61d70535:not(.elementor-motion-effects-element-type-background), .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-61d70535 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}</style><style id="e-addons-template-dynamic-bb53199-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-bb53199 > .elementor-background-overlay{background-color: #333333;}</style><style id="e-addons-template-dynamic-100e95a-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-100e95a:not(.elementor-motion-effects-element-type-background), .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-100e95a > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #333333;}</style><style id="e-addons-template-dynamic-2e4d24e-inline">.elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-2e4d24e:not(.elementor-motion-effects-element-type-background), .elementor:is(.e-post-22578,.e-loop-item-22578) .elementor-element.elementor-element-2e4d24e > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color: #33333326;}</style>	<!-- KLIKMOMEN INTERACTIVE CONTROLLERS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Toast Notification Helper
    window.showToast = function(msg) {
        var toast = document.createElement('div');
        toast.className = 'klikmomen-toast';
        toast.textContent = msg;
        toast.style.cssText = 'position: fixed; bottom: 28px; left: 50%; transform: translateX(-50%); background: #2B0E11; color: #FDF8F2; padding: 11px 22px; border-radius: 9999px; font-size: 13px; font-weight: 600; z-index: 99999; box-shadow: 0 8px 24px rgba(0,0,0,0.3); font-family: "Plus Jakarta Sans", sans-serif; pointer-events: none; opacity: 0; transition: opacity 0.3s ease, transform 0.3s ease; text-align: center; border: 1px solid #B67E22;';
        document.body.appendChild(toast);
        setTimeout(function() {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(-50%) translateY(-6px)';
        }, 10);
        setTimeout(function() {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(-50%) translateY(0)';
            setTimeout(function() { if (toast.parentNode) toast.parentNode.removeChild(toast); }, 300);
        }, 2800);
    };

    // 2. 1-Click Clipboard Copy
    window.copyGiftText = function(text, label) {
        if (!text) return;
        navigator.clipboard.writeText(text).then(function() {
            showToast((label || 'Teks') + ' berhasil disalin!');
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

    // 3. Interactive Wish Submission
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
            card.style.cssText = 'background: #FFFFFF; border-radius: 16px; border: 1px solid #ECDDCB; padding: 14px 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.04); text-align: left;';
            
            function esc(t) {
                var d = document.createElement('div');
                d.textContent = t;
                return d.innerHTML;
            }

            var isNotComing = attendance.indexOf('Tidak') !== -1;
            var badgeBg = isNotComing ? '#FED7D7' : '#F5E6D3';
            var badgeCol = isNotComing ? '#9B2C2C' : '#5B1A21';

            card.innerHTML = '<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 6px;">' +
                '<span style="font-family: \'Playfair Display\', serif; font-weight: 700; font-size: 14px; color: #1E293B;">' + esc(name) + '</span>' +
                '<span style="background: ' + badgeBg + '; color: ' + badgeCol + '; font-size: 9.5px; font-weight: 600; padding: 2px 8px; border-radius: 9999px; font-family: \'Plus Jakarta Sans\', sans-serif; white-space: nowrap;">' + esc(attendance) + '</span>' +
                '</div>' +
                '<p style="font-size: 12px; color: #4B5563; font-style: italic; line-height: 1.55; margin: 0 0 6px; font-family: \'Plus Jakarta Sans\', sans-serif;">' + esc(message) + '</p>' +
                '<span style="font-size: 10px; color: #9CA3AF; display: block; text-align: right; font-family: \'Plus Jakarta Sans\', sans-serif;">Baru saja</span>';

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
});
</script>
@include('demo.partials.preview-sync')
</body>
</html>

<!-- Performance optimized by Redis Object Cache. Learn more: https://wprediscache.com -->


<!-- Page uncached by LiteSpeed Cache 7.9.1 on 2026-09-12 11:47:50 -->