<?php
namespace Spqr\Toc\Controller;

use Pagekit\Application as App;


/**
 * @Access(admin=true)
 * @return string
 */
class TocController
{
	
	/**
	 * @Access("toc: manage settings")
	 */
	public function settingsAction()
	{
		$module = App::module( 'toc' );
		$config = $module->config;
		
		return [
			'$view' => [
				'title' => __( 'Toc Settings' ),
				'name'  => 'toc:views/admin/settings.php'
			],
			'$data' => [
				'config' => App::module( 'toc' )->config()
			]
		];
	}
	
	/**
	 * @Request({"config": "array"}, csrf=true)
	 * @param array $config
	 *
	 * @return array
	 */
	public function saveAction( $config = [] )
	{
		App::config()->set( 'toc', $config );
		
		return [ 'message' => 'success' ];
	}
	
}