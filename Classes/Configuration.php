<?php

declare(strict_types=1);

namespace StarterTeam\StarterNessa;

/**
 * Class Configuration
 */
class Configuration
{
    /**
     * @var string[]
     */
    public const DEFAULT_BACKEND_LAYOUTS = [
        'DefaultLayout',
        'HeroLayout',
    ];

    /**
     * Array with all content elements and definition of type icons
     * @var array
     */
    public const CONTENT_ELEMENTS = [
        'nessa_cta' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-target.svg',
        ],
        'nessa_team' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/overlay/overlay-backenduser.svg',
        ],
        'nessa_teaser' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-menu-thumbnail.svg',
        ],
        'nessa_hero' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-carousel.svg',
        ],
        'nessa_partner' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/apps/apps-pagetree-page-backend-user-root.svg',
        ],
        'nessa_portfolio' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-target.svg',
        ],
        'nessa_portfolio_file_collections' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-menu-thumbnail.svg',
        ],
        'nessa_footer' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-special-div.svg',
        ],
        'nessa_teaser_background' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-card.svg',
        ],
        'nessa_teaser_icon' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-card.svg',
        ],
    ];

    /**
     * Array with all content elements and definition of type icons
     * @var array
     */
    public const CONTENT_ELEMENT_TABLES = [
        'tx_starternessa_team_element' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/overlay/overlay-backendusers.svg',
        ],
        'tx_starternessa_teaser_element' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-card.svg',
        ],
        'tx_starternessa_hero_element' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-carousel-item-calltoaction.svg',
        ],
        'tx_starternessa_social_element' => [
            'typeIconPath' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/apps/apps-pagetree-page-shortcut-external.svg',
        ],
    ];

    /**
     * Return the default defined backend layouts
     */
    public static function getDefaultBackendLayouts(): array
    {
        return self::DEFAULT_BACKEND_LAYOUTS;
    }

    /**
     * Return all custom content elements
     */
    public static function getContentElements(): array
    {
        return self::CONTENT_ELEMENTS;
    }

    /**
     * Return all custom content elements tables
     */
    public static function getContentElementTables(): array
    {
        return self::CONTENT_ELEMENT_TABLES;
    }
}
