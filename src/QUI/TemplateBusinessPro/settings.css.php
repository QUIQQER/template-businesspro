<?php

$navBarMainColor      = '#2d4d88';
$navBarFontColor      = '#ffffff';
$mobileFontColor      = '#fff';
$mobileMenuBackground = '#252122';

if ($Project->getConfig('templateBusinessPro.settings.navBarMainColor')) {
    $navBarMainColor = $Project->getConfig('templateBusinessPro.settings.navBarMainColor');
}

if ($Project->getConfig('templateBusinessPro.settings.navBarFontColor')) {
    $navBarFontColor = $Project->getConfig('templateBusinessPro.settings.navBarFontColor');
}

if ($Project->getConfig('templateBusinessPro.settings.mobileFontColor')) {
    $mobileFontColor = $Project->getConfig('templateBusinessPro.settings.mobileFontColor');
}

if ($Project->getConfig('templateBusinessPro.settings.mobileMenuBackground')) {
    $mobileMenuBackground = $Project->getConfig('templateBusinessPro.settings.mobileMenuBackground');
}

/**
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont       = '#D1D1D1';
$colorMain             = '#dd151b';
$buttonFontColor       = '#ffffff';
$colorFooterLinks      = '#E6E6E6';
$colorMainContentBg    = '#ffffff';
$colorMainContentFont  = '#5d5d5d';

if ($Project->getConfig('templateBusinessPro.settings.colorFooterBackground')) {
    $colorFooterBackground = $Project->getConfig('templateBusinessPro.settings.colorFooterBackground');
}

if ($Project->getConfig('templateBusinessPro.settings.colorFooterFont')) {
    $colorFooterFont = $Project->getConfig('templateBusinessPro.settings.colorFooterFont');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateBusinessPro.settings.colorMain');
}

if ($Project->getConfig('templateBusinessPro.settings.buttonFontColor')) {
    $buttonFontColor = $Project->getConfig('templateBusinessPro.settings.buttonFontColor');
}

if ($Project->getConfig('templateBusinessPro.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateBusinessPro.settings.colorFooterLinks');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentBg')) {
    $colorMainContentBg = $Project->getConfig('templateBusinessPro.settings.colorMainContentBg');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentFont')) {
    $colorMainContentFont = $Project->getConfig('templateBusinessPro.settings.colorMainContentFont');
}

$Convert = new \QUI\Utils\Convert();
$navBarHeight = (int)$Project->getConfig('templateBusinessPro.settings.navBarHeight');
$headerHeight = $Project->getConfig('templateBusinessPro.settings.headerHeight');
$headerHeightValue = (int)$Project->getConfig('templateBusinessPro.settings.headerHeightValue');
$bgColorSwitcherPrefix = $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherPrefix');
$bgColorSwitcherSuffix = $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherSuffix');
$headerImagePosition = $Project->getConfig('templateBusinessPro.settings.headerImagePosition');
$navPos = $Project->getConfig('templateBusinessPro.settings.navPos');

ob_start();

?>
/**
 * Farbeinstellungen
 */

/* nav bar */
.header-bar,
.header-bar-inner-nav {
    background: <?php echo $navBarMainColor; ?>;
}

/* mobile nav background */
.slideout-menu .page-menu {
    background: <?php echo $mobileMenuBackground; ?>;
}

.slideout-menu .page-navigation-home,
.slideout-menu .left-menu-a,
.slideout-menu .page-menu-close {
    color: <?php echo $mobileFontColor; ?>;
}

.page-header-navigation-sub-list,
.page-header-navigation li:hover,
.header-bar-search:hover,
.quiqqer-menu-megaMenu-list-item-menu.control-background,
.quiqqer-menu-megaMenu-list-item:hover, {
    background: <?php echo $Convert->colorBrightness($navBarMainColor, 0.9); ?>;
}

.header-bar,
.header-bar-inner a,
.header-bar-inner a:link,
.header-bar-inner a:active,
.header-bar-inner a:visited,
.header-bar-inner a:hover {
    color: <?php echo $navBarFontColor; ?>;
}

.color-main {
    color: <?php echo $colorMain; ?>;
}

.qui-sitetypes-sitemap-block-category .control-background {
    background: <?php echo $colorMain; ?>;
}

.page-header-logo-img {
    max-height: <?php echo 'calc(' . $navBarHeight . 'px - 20px)'; ?>;
}

.header-bar,
.header-bar-2,
.header-bar-inner-nav,
.page-header-navigation-entry,
.header-bar-search,
.header-bar-search:before,
.page-header-navigation-entry:before,
.header-bar-inner-logo {
    height: <?php echo $navBarHeight; ?>px;
}

.header-bar-search,
.page-header-navigation-entry,
.fa-chevron-down-mobile,
.quiqqer-menu-megaMenu-list-item,
.hide-on-desktop .quiqqer-menu-megaMenu-mobile,
.quiqqer-menu-megaMenu-mobile-search,
.header-bar-suggestSearch {
    line-height: <?php echo $navBarHeight; ?>px;
}

.quiqqer-fa-levels-icon:hover,
.quiqqer-navigation-level-1 a:hover,
a.quiqqer-navigation-home:hover {
    color: <?php echo $colorMain; ?>;
}

.quiqqer-navigation-entry:hover .quiqqer-fa-list-icon {
    color: <?php echo $colorMain; ?>;
}

.mainColor,
.mainColorHover:hover,
.template-breadcrumb .quiqqer-breadcrumb ul li:last-child a span:last-child {
    color: <?php echo $colorMain; ?>;
}

.tpl-businessPro-row a.qui-tags-tag:hover {
    border: 1px solid <?php echo $colorMain; ?>;
    color: <?php echo $colorMain; ?>;
}

#page input[type='checkbox']:checked + label::before,
#page input[type='radio']:checked + label::before,
.pace .pace-progress {
    background-color: <?php echo $colorMain; ?>;
}

input[type='submit'],
input[type='reset'],
input[type='button'],
button,
.button,
.tpl-businessPro-row .button,
button:disabled,
button:disabled:hover,
a.template-button {
    background-color: <?php echo $colorMain; ?>;
    color: <?php echo $buttonFontColor; ?>;
    border: 2px solid <?php echo $colorMain; ?>;
}

a.template-button:hover {
    background-color: <?php echo $Convert->colorBrightness($colorMain, 0.7); ?>;
}

#page .button.special {
    background: none !important;
    color: <?php echo $colorMainContentFont; ?>;
}

#page .button.special:hover {
    border: 3px solid <?php echo $colorMain; ?>;
}

body,
.mainFontColor {
    color: <?php echo $colorMainContentFont; ?> !important;
}

textarea:hover,
textarea:focus,
input:hover,
input:focus,
select:hover,
select:focus {
/*    box-shadow: 0 0 0 2px */<?php //echo $colorMain; ?>/*;*/
    border-color: <?php echo $colorMain; ?>;
}

.main-content-color-bg {
    background-color: <?php echo $colorMainContentBg; ?>;
}

a,
a.link-simple-color,
a.slide-up-color {
    color: <?php echo $colorMain; ?>;
}

a.link-slide-up-color::before {
    background: <?php echo $colorMain; ?>;

}

.quiqqer-content a:hover:after {
    color: <?php echo $colorMain; ?>;
}

input[type='submit']:hover,
input[type='reset']:hover,
input[type='button']:hover,
button:hover,
.button-active,
.button:active,
.button:hover {
    background: none;
    color: <?php echo $colorMain; ?>;
}

.page-footer button {
    background: <?php echo $colorMain; ?>;
    color: #ffffff;
}

.page-footer {
    background: <?php echo $colorFooterBackground; ?>;
    color: <?php echo $colorFooterFont; ?> !important;
}

.page-footer h2,
.page-footer h3,
.page-footer h4 {
    color: <?php echo $colorFooterFont; ?>;
}

footer a {
    color: <?php echo $colorFooterLinks; ?>;
}

footer a:hover {
    color: <?php echo $colorFooterLinks; ?>;
}

/* pagination */
.quiqqer-sheets-desktop a:hover {
    border: 1px solid <?php echo $colorMain; ?> !important;
    background-color: <?php echo $colorMain; ?>;
}

.quiqqer-sheets-desktop-limits a:hover {
    color: <?php echo $colorMain; ?>;
}

.control-background-active {
    background: <?php echo $colorMain; ?> !important;
    color: #FFFFFF !important;
}

.control-background {
    background: <?php echo $colorMain; ?>;
}

/**
 * background color prefix suffix switcher
 * Prefix
 */
<?php if ($bgColorSwitcherPrefix == 'display') { ?>
.brick-even-prefix {
    background: #f5f5f5;
}

.brick-odd-prefix {
    background: #e5e5e5;
}

<?php }; ?>

/**
 * background color prefix suffix switcher
 * Suffix
 */
<?php if ($bgColorSwitcherSuffix == 'display') { ?>
.brick-even-suffix {
    background: #f5f5f5;
}

.brick-odd-suffix {
    background: #e5e5e5;
}
<?php }; ?>

<?php if ($headerHeight) { ?>
.page-header {
    display: flex;
    height: <?php echo $headerHeightValue; ?>px;
    overflow: hidden;
}

.header-img {
    align-self: <?php echo $headerImagePosition; ?>;
}

<?php };
?>

/**
 * Menüposition
 */
<?php  if ($navPos == 'fix') { ?>
.header-bar {
    position: fixed !important;
}

.body-container {
    top: <?php echo $navBarHeight; ?>px;
}

<?php }; ?>

<?php

$settingsCSS = ob_get_contents();
ob_end_clean();

return $settingsCSS;

?>
