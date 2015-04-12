<?php

namespace St\Parser;

class SimpleHtmlParser implements ParserInterface
{
    /**
     * @param $resourceUrl
     * @return \simple_html_dom
     */
    public function parse($resourceUrl)
    {
        return \Sunra\PhpSimple\HtmlDomParser::file_get_html($resourceUrl);
    }

}
