<?php

return [
	'name'   => 'spqr/toc',
	'label'  => 'TOC Widget',
	'events' => [
		'view.scripts' => function( $event, $scripts ) use ( $app ) {
			$scripts->register(
				'toc-widget',
				'spqr/toc:app/bundle/toc-widget.js',
				[ '~widgets' ]
			);
		}
	],
	
	'render' => function( $widget ) use ( $app ) {
		
		$params                            = [];
		$paramstring                       = '';
		$params[ 'tocSelector' ]           =
			( !empty( $widget->get( 'toc_selector' ) ) ? $widget->get( 'toc_selector' ) : '' );
		$params[ 'headingSelector' ]       =
			( !empty( $widget->get( 'heading_selector' ) ) ? implode( ",", $widget->get( 'heading_selector' ) ) : '' );
		$params[ 'contentSelector' ]       =
			( !empty( $widget->get( 'content_selector' ) ) ? $widget->get( 'content_selector' ) : '' );
		$params[ 'ignoreSelector' ]        =
			( !empty( $widget->get( 'ignore_selector' ) ) ? $widget->get( 'ignore_selector' ) : '' );
		$params[ 'linkClass' ]             =
			( !empty( $widget->get( 'link_class' ) ) ? $widget->get( 'link_class' ) : '' );
		$params[ 'smoothScroll' ]          =
			( !empty( $widget->get( 'smoothscroll' ) ) ? $widget->get( 'smoothscroll' ) : false );
		$params[ 'smoothScrollDuration' ]  =
			( !empty( $widget->get( 'smoothscroll_duration' ) ) ? $widget->get( 'smoothscroll_duration' ) : 0 );
		$params[ 'activeLinkClass' ]       =
			( !empty( $widget->get( 'active_link_class' ) ) ? $widget->get( 'active_link_class' ) : '' );
		$params[ 'listClass' ]             =
			( !empty( $widget->get( 'list_class' ) ) ? $widget->get( 'list_class' ) : '' );
		$params[ 'listItemClass' ]         =
			( !empty( $widget->get( 'list_item_class' ) ) ? $widget->get( 'list_item_class' ) : '' );
		$params[ 'collapsibleClass' ]      =
			( !empty( $widget->get( 'collapsible_class' ) ) ? $widget->get( 'collapsible_class' ) : '' );
		$params[ 'isCollapsedClass' ]      =
			( !empty( $widget->get( 'collapsed_class' ) ) ? $widget->get( 'collapsed_class' ) : '' );
		$params[ 'collapseDepth' ]         =
			( !empty( $widget->get( 'collapse_depth' ) ) ? $widget->get( 'collapse_depth' ) : 0 );
		$params[ 'throttleTimeout' ]       =
			( !empty( $widget->get( 'throttle_timeout' ) ) ? $widget->get( 'throttle_timeout' ) : 0 );
		$params[ 'headingsOffset' ]        =
			( !empty( $widget->get( 'headings_offset' ) ) ? $widget->get( 'headings_offset' ) : 0 );
		$params[ 'positionFixedSelector' ] =
			( !empty( $widget->get( 'position_fixed_selector' ) ) ? $widget->get( 'position_fixed_selector' ) : null );
		$params[ 'positionFixedClass' ]    =
			( !empty( $widget->get( 'position_fixed_class' ) ) ? $widget->get( 'position_fixed_class' ) : 0 );
		$params[ 'fixedSidebarOffset' ]    =
			( !empty( $widget->get( 'fixed_sidebar_offset' ) ) ? $widget->get( 'fixed_sidebar_offset' ) : 'auto' );
		
		foreach ( $params as $key => $param ) {
			if ( is_bool( $param ) ) {
				if ( $param === true )
					$paramstring .= "$key: true,";
				if ( $param === false )
					$paramstring .= "$key: false,";
			} elseif ( is_numeric( $param ) ) {
				$paramstring .= "$key: $param,";
			} else {
				$paramstring .= "$key: '$param',";
			}
		}
		
		$paramstring = rtrim( $paramstring, "," );
		$init        = "$(function() { tocbot.init({ $paramstring }); });";
		
		$app[ 'styles' ]->add(
			'tocbot',
			'spqr/toc:app/assets/tocbot/dist/tocbot.css'
		);
		
		if ( !empty( $widget->get( 'css' ) ) ) {
			$app[ 'styles' ]->add( 'tocbotcustomcss', $widget->get( 'css' ), [], 'string' );
		}
		
		if ( !empty( $widget->get( 'js' ) ) ) {
			$app[ 'scripts' ]->add( 'tocbotcustomjs', $widget->get( 'js' ), [], 'string' );
		}
		
		$app[ 'scripts' ]->add(
			'tocbot',
			'spqr/toc:app/assets/tocbot/dist/tocbot.js'
		);
		
		$app[ 'scripts' ]->add( 'toc', $init, [], 'string' );
		
		return $app->view( 'spqr/toc/widget/toc.php' );
	}
];