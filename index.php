<?php

$Locale = QUI::getLocale();

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

/**
 * search
 */
$search     = '';
$dataQui    = '';
$searchType = false;

/* search setting is on? */
if ($Project->getConfig('templateBusinessPro.settings.search') != 'hide') {
    $types = array(
        'quiqqer/sitetypes:types/search'
    );

    /* check if quiqqer search packet is installed */
    if (QUI::getPackageManager()->isInstalled('quiqqer/search')) {
        $types = array(
            'quiqqer/sitetypes:types/search',
            'quiqqer/search:types/search'
        );

        // Suggest Search integrate
        $dataQui = 'data-qui="package/quiqqer/search/bin/controls/Suggest"';
    }

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
            $searchUrl  = $searchSites[0]->getUrlRewritten();
            $searchForm = '';

            switch ($Project->getConfig('templateBusinessPro.settings.search')) {
                case 'input':
                    $searchType = 'input';

                    $searchForm = '';
                    $searchForm .= '<form  action="' . $searchUrl . '" class="header-bar-suggestSearch hide-on-mobile" method="get">';
                    $searchForm .= '<input type="search" name="search" class="only-input"' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get('quiqqer/template-businesspro', 'navbar.search.text') . '" /></form>';
                    break;
                case 'inputAndIcon':
                    $searchType = 'inputAndIcon';

                    $searchForm = '';
                    $searchForm .= '<form  action="' . $searchUrl . '" class="header-bar-suggestSearch hide-on-mobile" method="get">';
                    $searchForm .= '<div class="header-bar-suggestSearch-wrapper">';
                    $searchForm .= '<input type="search" name="search" class="input-and-icon" ' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get('quiqqer/template-businesspro', 'navbar.search.text') . '" />';
                    $searchForm .= '</div><span class="fa fa-fw fa-search"></span></form>';
                    break;
                case 'inputAndIconVisible':
                    $searchType = 'inputAndIconVisible';

                    $searchForm = '';
                    $searchForm .= '<form action="' . $searchUrl . '" ';
                    $searchForm .= 'class="header-bar-suggestSearch header-bar-suggestSearch-inputAndIconVisible hide-on-mobile" method="get">';
                    $searchForm .= '<input type="search" name="search" class="input-inputAndIconVisible"' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get('quiqqer/template-businesspro', 'navbar.search.text') . '" />';
                    $searchForm .= '<span class="fa fa-fw fa-search"></span></form>';
                    break;
            }

            $search = $searchForm;
            $search .= '<div class="quiqqer-menu-megaMenu-mobile-search" style="width: auto; font-size: 30px !important;">';
            $search .= '<a href="' . $searchUrl . '" class="header-bar-search-link searchMobile">';
            $search .= '<span class="fa fa-search header-bar-search-icon"></span>';
            $search .= '</a></div>';
            
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::addNotice($Exception->getMessage());
        }
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

$MegaMenu->appendHTML($search);


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
$templateSettings['searchType']    = $searchType;


$Engine->assign($templateSettings);
