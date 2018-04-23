<?php

namespace Spqr\Toc\Plugin;

use Pagekit\Application as App;
use Pagekit\Content\Event\ContentEvent;
use Pagekit\Event\EventSubscriberInterface;
use Spqr\Toc\Helper\MarkupHelper;

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
            
            if ($content) {
                $mhelper = new MarkupHelper;
                $content = $mhelper->fix($content);
                $toc     = "<div class='toc ".$config['toc_selector_class']
                    ."'></div>";
                $event->setContent($toc.$content);
                
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