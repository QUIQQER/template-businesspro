<?php

/**
 * template file
 *
 * @var QUI\Projects\Project $Project
 * @var QUI\Projects\Site $Site
 * @var QUI\Interfaces\Template\EngineInterface $Engine
 * @var QUI\Template $Template
 **/


$Locale = QUI::getLocale();
$lang = $Project->getLang();

/**
 * Emotion
 */
QUI\Utils\Site::setRecursiveAttribute($Site, 'image_emotion');

// Content behavior
if (
    $Site->getAttribute('templateBusinessPro.showTitle') ||
    $Site->getAttribute('templateBusinessPro.showShort')
) {
    $Template->setAttribute('content-header', false);
}

/**
 * search
 */
$search = '';
$dataQui = '';
$noSearch = 'no-search';
$searchType = false;

/* search setting is on? template header allowed? */
if (
    $Project->getConfig('templateBusinessPro.settings.search') != 'hide'
    && $Template->getAttribute('template-header')
) {
    $noSearch = '';

    $types = [
        'quiqqer/sitetypes:types/search'
    ];

    /* check if quiqqer search packet is installed */
    if (QUI::getPackageManager()->isInstalled('quiqqer/search')) {
        $types = [
            'quiqqer/sitetypes:types/search',
            'quiqqer/search:types/search'
        ];

        // Suggest Search integrate
        $dataQui = 'data-qui="package/quiqqer/search/bin/controls/Suggest"';
    }

    $searchSites = $Project->getSites([
        'where' => [
            'type' => [
                'type' => 'IN',
                'value' => $types
            ]
        ],
        'limit' => 1
    ]);

    $lg = 'quiqqer/template-businesspro';

    if (count($searchSites)) {
        try {
            $searchUrl = $searchSites[0]->getUrlRewritten();
            $searchForm = '';

            switch ($Project->getConfig('templateBusinessPro.settings.search')) {
                case 'input':
                    $searchType = 'input';

                    $searchForm = '';
                    $searchForm .= '<form  action="' . $searchUrl . '" class="header-bar-suggestSearch hide-on-mobile" ';
                    $searchForm .= 'method="get" style="position: relative; right: auto; float: right;">';
                    $searchForm .= '<input type="search" name="search" class="only-input" ' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get($lg, 'navbar.search.text') . '" />';
                    $searchForm .= '</form>';
                    break;

                case 'inputAndIcon':
                    $searchType = 'inputAndIcon';

                    $searchForm = '';
                    $searchForm .= '<form  action="' . $searchUrl . '" class="header-bar-suggestSearch hide-on-mobile" method="get">';
                    $searchForm .= '<div class="header-bar-suggestSearch-wrapper">';
                    $searchForm .= '<input type="search" name="search" class="input-and-icon" ' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get($lg, 'navbar.search.text') . '" />';
                    $searchForm .= '</div><span class="fa fa-fw fa-search"></span></form>';
                    break;

                case 'inputAndIconVisible':
                    $searchType = 'inputAndIconVisible';

                    $searchForm = '';
                    $searchForm .= '<form action="' . $searchUrl . '" ';
                    $searchForm .= 'class="header-bar-suggestSearch header-bar-suggestSearch-inputAndIconVisible hide-on-mobile" method="get">';
                    $searchForm .= '<input type="search" name="search" class="input-inputAndIconVisible" ' . $dataQui . ' ';
                    $searchForm .= 'placeholder="' . $Locale->get($lg, 'navbar.search.text') . '" />';
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

// social
$social = 'false';
$socialNav = '';
$socialFooter = '';
$socialMobileNav = '';

if (
    ($Project->getConfig('templateBusinessPro.settings.social.show.nav')
        || $Project->getConfig('templateBusinessPro.settings.social.show.footer'))
    && ($Template->getAttribute('template-footer') || $Template->getAttribute('template-header'))
) {
    $social = 'true';
    $socialHTML = '';

    // check which socials should be displayed
    if ($Project->getConfig('templateBusinessPro.settings.social.facebook')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.facebook')
            . '" target="_blank"><span class="fa fa-facebook"></span></a>';
    }
    if ($Project->getConfig('templateBusinessPro.settings.social.twitter')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.twitter')
            . '" target="_blank"><span class="fa fa-twitter"></span></a>';
    }
    if ($Project->getConfig('templateBusinessPro.settings.social.google')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.google')
            . '" target="_blank"><span class="fa fa-google-plus"></span></a>';
    }
    if ($Project->getConfig('templateBusinessPro.settings.social.youtube')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.youtube')
            . '" target="_blank"><span class="fa fa-youtube-play"></span></a>';
    }
    if ($Project->getConfig('templateBusinessPro.settings.social.github')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.github')
            . '" target="_blank"><span class="fa fa-github"></span></a>';
    }
    if ($Project->getConfig('templateBusinessPro.settings.social.gitlab')) {
        $socialHTML .= '<a href="' .
            $Project->getConfig('templateBusinessPro.settings.social.gitlab')
            . '" target="_blank"><span class="fa fa-gitlab"></span></a>';
    }

    // prepare social for nav
    if (
        $Project->getConfig('templateBusinessPro.settings.social.show.nav')
        && $Template->getAttribute('template-header')
    ) {
        $socialNav .= '<div class="header-bar-social hide-on-mobile ' . $noSearch . $searchType . '">';
        $socialNav .= $socialHTML;
        $socialNav .= '</div>';

        $socialMobileNav .= '<div class="mobile-bar-social-container">';
        $socialMobileNav .= $socialHTML;
        $socialMobileNav .= '</div>';
    }

    // prepare social for footer
    if (
        $Project->getConfig('templateBusinessPro.settings.social.show.footer')
        && $Template->getAttribute('template-footer')
    ) {
        $socialFooter .= '<div class="footer-bar-social">';
        $socialFooter .= $socialHTML;
        $socialFooter .= '</div>';
    }
}


/**
 * Mega menu
 */
$MegaMenu = false;

if ($Template->getAttribute('template-header')) {
    /**
     * Mega menu
     */
    $MegaMenu = new QUI\Menu\MegaMenu([
        'showStart' => false
    ]);

    $MegaMenu->appendHTML(
        $search . $socialNav
    );

    /* Logo in menu */
    $imgTitle = $Project->get(1)->getAttribute('title');
    $imgAlt = '';
    $logoUrl = $Project->getMedia()->getPlaceholder();

    if ($Project->getMedia()->getLogoImage()) {
        $Logo = $Project->getMedia()->getLogoImage();
        $logoUrl = $Logo->getSizeCacheUrl(400, 300);
        $imgAltArray = json_decode($Logo->getAttribute('title'), true);

        if (isset($imgTitleArray[$lang])) {
            $imgAlt = $imgAltArray[$lang];
        } else {
            // alt attributes must be defined, otherwise the title comes from the image
            $imgAlt = $imgTitle;
        }
    }

    $MegaMenu->prependHTML(
        '<div class="header-bar-inner-logo">
                <a href="' . URL_DIR . '" class="page-header-logo">
                <img src="' . $logoUrl . '" alt="' . $imgAlt . '" title="' . $imgTitle . '"/></a>
            </div>'
    );
}

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

/**
 * Template config
 */
$templateSettings = QUI\TemplateBusinessPro\Utils::getConfig([
    'Project' => $Project,
    'Site' => $Site,
    'Template' => $Template
]);

if ($templateSettings['themeColor']) {
    $Template->extendHeader('<meta name="theme-color" content="' . $templateSettings['themeColor'] . '"/>');
}

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

$templateSettings['BricksManager'] = QUI\Bricks\Manager::init();
$templateSettings['Breadcrumb'] = $Breadcrumb;
$templateSettings['MegaMenu'] = $MegaMenu;
$templateSettings['bodyClass'] = $bodyClass;
$templateSettings['startPage'] = $startPage;
$templateSettings['searchType'] = $searchType;
$templateSettings['social'] = $social;
$templateSettings['socialMobileNav'] = $socialMobileNav;

$Engine->assign($templateSettings);
