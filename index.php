<?php

use Pagekit\Application as App;
use Spqr\Toc\Plugin\TocPlugin;
use Pagekit\Widget\WidgetManager;


return [
    'name' => 'spqr/toc',
    'type' => 'extension',
    'main' => function ($app) {
    },
    
    'autoload' => [
        'Spqr\\Toc\\' => 'src',
    ],
    
    'nodes' => [],
    
    'routes'  => [],
    'widgets' => [
        'widgets/toc.php',
    ],
    
    'menu' => [],
    
    'permissions' => [
        'toc: manage settings' => [
            'title' => 'Manage settings',
        ],
    ],
    
    'settings' => 'toc-settings',
    
    'resources' => [
        'spqr/toc:' => '',
    ],
    
    'config' => [
        'autoinsert'              => true,
        'nodes'                   => [],
        'css'                     => '',
        'js'                      => '',
        'toc_selector'            => '.toc',
        'toc_selector_class'      => 'uk-panel uk-panel-box-primary',
        'content_selector'        => '.uk-article',
        'ignore_selector'         => '.toc-ignore',
        'heading_selector'        => ['h1', 'h2', 'h3'],
        'smoothscroll'            => true,
        'smoothscroll_duration'   => 420,
        'link_class'              => 'toc-link',
        'active_link_class'       => 'is-active-link',
        'list_class'              => 'toc-list',
        'list_item_class'         => 'toc-list-item',
        'collapsible_class'       => 'is-collapsible',
        'collapsed_class'         => 'is-collapsed',
        'collapse_depth'          => 0,
        'throttle_timeout'        => 50,
        'headings_offset'         => 0,
        'position_fixed_selector' => null,
        'position_fixed_class'    => 'is-position-fixed',
        'fixed_sidebar_offset'    => 'auto',
    ],
    
    'events' => [
        'boot'         => function ($event, $app) {
            $app->subscribe(new TocPlugin);
        },
        'site'         => function ($event, $app) {
            if ($this->config['autoinsert']
                && (!$this->config['nodes']
                    || in_array($app['node']->id, $this->config['nodes']))
            ) {
                $module      = App::module('spqr/toc');
                $config      = $module->config;
                $params      = [];
                $paramstring = '';
                
                $params['tocSelector']
                    = (!empty($config['toc_selector']) ? $config['toc_selector']
                    : '');
                $params['headingSelector']
                    = (!empty($config['heading_selector']) ? implode(",",
                    $config['heading_selector']) : '');
                $params['contentSelector']
                    = (!empty($config['content_selector'])
                    ? $config['content_selector'] : '');
                $params['ignoreSelector']
                    = (!empty($config['ignore_selector'])
                    ? $config['ignore_selector'] : '');
                $params['linkClass']
                    = (!empty($config['link_class']) ? $config['link_class']
                    : '');
                $params['smoothScroll']
                    = (!empty($config['smoothscroll']) ? $config['smoothscroll']
                    : false);
                $params['smoothScrollDuration']
                    = (!empty($config['smoothscroll_duration'])
                    ? $config['smoothscroll_duration'] : 0);
                $params['activeLinkClass']
                    = (!empty($config['active_link_class'])
                    ? $config['active_link_class'] : '');
                $params['listClass']
                    = (!empty($config['list_class']) ? $config['list_class']
                    : '');
                $params['listItemClass']
                    = (!empty($config['list_item_class'])
                    ? $config['list_item_class'] : '');
                $params['collapsibleClass']
                    = (!empty($config['collapsible_class'])
                    ? $config['collapsible_class'] : '');
                $params['isCollapsedClass']
                    = (!empty($config['collapsed_class'])
                    ? $config['collapsed_class'] : '');
                $params['collapseDepth']
                    = (!empty($config['collapse_depth'])
                    ? $config['collapse_depth'] : 0);
                $params['throttleTimeout']
                    = (!empty($config['throttle_timeout'])
                    ? $config['throttle_timeout'] : 0);
                $params['headingsOffset']
                    = (!empty($config['headings_offset'])
                    ? $config['headings_offset'] : 0);
                $params['positionFixedSelector']
                    = (!empty($config['position_fixed_selector'])
                    ? $config['position_fixed_selector'] : null);
                $params['positionFixedClass']
                    = (!empty($config['position_fixed_class'])
                    ? $config['position_fixed_class'] : 0);
                $params['fixedSidebarOffset']
                    = (!empty($config['fixed_sidebar_offset'])
                    ? $config['fixed_sidebar_offset'] : 'auto');
                
                foreach ($params as $key => $param) {
                    if (!empty($param)) {
                        if (is_bool($param)) {
                            if ($param === true) {
                                $paramstring .= "$key: true,";
                            }
                            if ($param === false) {
                                $paramstring .= "$key: false,";
                            }
                        } elseif (is_numeric($param)) {
                            $paramstring .= "$key: $param,";
                        } else {
                            $paramstring .= "$key: '$param',";
                        }
                    }
                }
                
                $paramstring = rtrim($paramstring, ",");
                
                $init
                    = "window.onload = function () { tocbot.init({ $paramstring }); }";
                
                $app['styles']->add('tocbot',
                    'spqr/toc:app/assets/tocbot/tocbot.css');
                
                if (!empty($config['css'])) {
                    $app['styles']->add('tocbotcustomcss', $config['css'], [],
                        'string');
                }
                
                $app['styles']->add('tocbotonempty',
                    '.toc:empty { display: none; }', [], 'string');
                
                if (!empty($config['js'])) {
                    $app['scripts']->add('tocbotcustomjs', $config['js'], [],
                        'string');
                }
                
                $app['scripts']->add('tocbot',
                    'spqr/toc:app/assets/tocbot/tocbot.js');
                
                
                $app['scripts']->add('toc', $init, ['vue'], 'string');
            }
        },
        'view.scripts' => function ($event, $scripts) use ($app) {
            $scripts->register('toc-settings',
                'spqr/toc:app/bundle/toc-settings.js',
                ['~extensions', 'input-tree', 'editor']);
        },
    ],
];