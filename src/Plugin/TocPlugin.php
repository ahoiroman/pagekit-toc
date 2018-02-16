<?php

namespace Spqr\Toc\Plugin;

use Pagekit\Application as App;
use Pagekit\Content\Event\ContentEvent;
use Pagekit\Event\EventSubscriberInterface;
use TOC\MarkupFixer;

class TocPlugin implements EventSubscriberInterface
{
    /**
     * Content plugins callback.
     *
     * @param ContentEvent $event
     */
    public function onContentPlugins(ContentEvent $event)
    {
        
        $module = App::module('spqr/toc');
        $config = $module->config;
        
        if (!$event['post'] && !$event['page']) {
            return;
        }
        
        if ($event['post']
            && strpos(App::request()->attributes->get('_route'), '@blog/id')
            === false
        ) {
            return;
        }
        
        if ($config['autoinsert']
            && (!$config['nodes']
                || in_array(App::request()->attributes->get('_node'),
                    $config['nodes']))
        ) {
            
            $content = $event->getContent();
    
            if($content) {
                if(App::cache()->fetch('has_headings')){
                    $markupfixer = new MarkupFixer();
                    $content     = $markupfixer->fix( $content );
                    $toc         = "<div class='toc " . $config[ 'toc_selector_class' ] . "'></div>";
                    $event->setContent( $toc . $content );
                }
            }
        }
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function subscribe()
    {
        return [
            'content.plugins' => ['onContentPlugins', -1],
        ];
    }
}