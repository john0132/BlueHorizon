<?php

return [
    // How the package integrates with Filament. Options: 'plugins', 'panels', 'both'
    'mode' => 'both',

    // Automatically register all module Filament plugins discovered under Modules/*/app/Filament/*Plugin.php
    'auto-register-plugins' => true,

    // Clusters configuration (optional). Leave disabled if you are not using clusters.
    'clusters' => [
        // If true, the package will also discover Filament Clusters within modules
        'enabled' => false,
        // If you enable clusters and prefer top navigation for clusters, set this to true.
        // AdminPanelProvider currently forces sidebar with ->topNavigation(false), so this is left false.
        'use-top-navigation' => false,
    ],

    // Settings related to how module panels (if any) appear inside the main panel navigation
    'panels' => [
        'group' => 'Modules',
        // Default icon for the group in Filament v3 icons set
        'group-icon' => \Filament\Support\Icons\Heroicon::OutlinedRectangleStack,
        'group-sort' => 0,
        'open-in-new-tab' => false,
    ],
];
