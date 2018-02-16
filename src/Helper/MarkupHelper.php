<?php

namespace Spqr\Toc\Helper;

use Pagekit\Application as App;

/**
 * Class MarkupHelper
 *
 * @package Spqr\Toc\Helper
 */
class MarkupHelper
{
    public function hasHeadings($content, array $headings)
    {
        $count = 0;
        $dom   = new \DOMDocument;
        $dom->loadHtml($content);
        
        foreach ($headings as $heading) {
            $h     = ($dom->getElementsByTagName($heading));
            $count += $h->length;
        }
        
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}