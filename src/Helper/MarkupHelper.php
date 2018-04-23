<?php

namespace Spqr\Toc\Helper;

use Sunra\PhpSimple\HtmlDomParser;
use Cocur\Slugify\Slugify;

/**
 * Class MarkupHelper
 *
 * @package Spqr\Toc\Helper
 */
class MarkupHelper
{
    
    /**
     * @var \Cocur\Slugify\Slugify
     */
    private $slugify;
    
    /**
     * @var array
     */
    private $used;
    
    
    /**
     * MarkupHelper constructor.
     *
     * @param \Cocur\Slugify\Slugify|null $slugify
     */
    public function __construct(Slugify $slugify = null)
    {
        $this->used    = [];
        $this->slugify = $slugify ? : new Slugify();
    }
    
    /**
     * @param     $content
     * @param int $toplevel
     * @param int $depth
     *
     * @return bool|mixed|string
     */
    public function fix($content, $toplevel = 1, $depth = 6)
    {
        if (!$content) {
            return false;
        }
        
        $dom = HtmlDomParser::str_get_html($content, true, true,
            DEFAULT_TARGET_CHARSET, false, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
        
        while ($toplevel <= $depth) {
            $h = "h".$toplevel;
            foreach ($dom->find($h) as $element) {
                $element->setAttribute('id',
                    $this->slugify($element->innertext));
            }
            $toplevel++;
        }
        
        return $dom->save();
    }
    
    /**
     * @param $content
     *
     * @return string
     */
    public function slugify($content)
    {
        $slugged = $this->slugify->slugify($content);
        $c       = 1;
        $orig    = $slugged;
        
        while (in_array($slugged, $this->used)) {
            $slugged = $orig.'-'.$c;
            $c++;
        }
        
        $this->used[] = $slugged;
        
        return $slugged;
    }
    
}