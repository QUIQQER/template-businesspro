<?php

/**
 * Emotion
 */
QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

// Inhalts Verhalten
if ($Site->getAttribute('templateBusinessPro.showTitle') ||
    $Site->getAttribute('templateBusinessPro.showShort')
) {
    $Template->setAttribute('content-header', false);
}

/**
 * Mega menu
 */
$MegaMenu = new QUI\Menu\MegaMenu(array(
    'showStart' => false
));

$searchMobile = '';

$types = array(
    'quiqqer/sitetypes:types/search',
    'quiqqer/search:types/search'
);

$searchSites = $Project->getSites(array(
    'where' => array(
        'type' => array(
            'type'  => 'IN',
            'value' => $types
        )
    ),
    'limit' => 1
));

if (count($searchSites)) {
    try {
        $searchUrl = $searchSites[0]->getUrlRewritten();

        $searchMobile = '<div class="quiqqer-menu-megaMenu-mobile-search hide-on-desktop"
                                  style="width: auto; font-size: 30px !important;">
                    <a href="' . $searchUrl . '"
                    class="header-bar-search-link searchMobile">
                        <i class="fa fa-search header-bar-search-icon"></i>
                    </a>
                </div>';
    } catch (QUI\Exception $Exception) {
        QUI\System\Log::addNotice($Exception->getMessage());
    }
}

$alt = "";
if ($Project->getMedia()->getLogoImage()) {
    $alt = $Project->getMedia()->getLogoImage()->getAttribute('title');
}

$MegaMenu->prependHTML(
    '<div class="header-bar-inner-logo">
                <a href="' . URL_DIR . '" class="page-header-logo">
                <img src="' . $Project->getMedia()->getLogo() . '" alt="' . $alt . '"/></a>
            </div>'
);

try {
    QUI::getPackage('quiqqer/search');
//    $Locale = QUI::getLocale();

    $MegaMenu->appendHTML(
        '<div class="header-bar-suggestSearch hide-on-mobile">
                    <input type="search" data-qui="package/quiqqer/search/bin/controls/Suggest" 
                    placeholder="' . $Locale->get('quiqqer/template-businesspro', 'navbar.search.text') . '"/>
                </div>' .
        $searchMobile
    );
} catch (QUI\Exception $Exception) {
    QUI\System\Log::addNotice($Exception->getMessage());
}


/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

/**
 * Template config
 */
$templateSettings = QUI\TemplateBusinessPro\Utils::getConfig(array(
    'Project'  => $Project,
    'Site'     => $Site,
    'Template' => $Template
));


/**
 * body class
 */
$bodyClass = '';
$startPage = false;

switch ($Template->getLayoutType()) {
    case 'layout/startPage':
        $bodyClass = 'start-page';
        $startPage = true;
        break;

    case 'layout/noSidebar':
        $bodyClass = 'no-sidebar';
        break;

    case 'layout/rightSidebar':
        $bodyClass = 'right-sidebar';
        break;

    case 'layout/leftSidebar':
        $bodyClass = 'left-sidebar';
        break;
}

$templateSettings['BricksManager'] = \QUI\Bricks\Manager::init();
$templateSettings['Breadcrumb']    = $Breadcrumb;
$templateSettings['MegaMenu']      = $MegaMenu;
$templateSettings['bodyClass']     = $bodyClass;
$templateSettings['startPage']     = $startPage;


$Engine->assign($templateSettings);
