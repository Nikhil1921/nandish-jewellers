<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$dom = new DOMDocument();

$dom->encoding = 'utf-8';

$dom->xmlVersion = '1.0';

$dom->formatOutput = true;

        $root = $dom->createElement('urlset');

        $root->setAttributeNode(new DOMAttr('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9'));
        $root->setAttributeNode(new DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance'));
        $root->setAttributeNode(new DOMAttr('xsi:schemaLocation', "http://www.sitemaps.org/schemas/sitemap/0.9\nhttp://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"));
        
        createElement(['loc' => base_url(), 'priority' => 1.00], $dom, $root);
        createElement(['loc' => make_slug("about-us"), 'priority' => 0.80], $dom, $root);
        createElement(['loc' => make_slug("privacy"), 'priority' => 0.80], $dom, $root);
        createElement(['loc' => make_slug("contact-us"), 'priority' => 0.80], $dom, $root);

        foreach($items as $cat):
                createElement(['loc' => make_slug("$cat->c_name"), 'priority' => 0.80], $dom, $root);
                foreach($cat->sub_cats as $sub_cat):
                        createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name"), 'priority' => 0.80], $dom, $root);
                        foreach($sub_cat->inner_cats as $inn_cat):
                                createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name/$inn_cat->i_name"), 'priority' => 0.80], $dom, $root);
                                foreach($inn_cat->prods as $prod):
                                        createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name/$inn_cat->i_name/$prod->p_name-".e_id($prod->p_id)), 'priority' => 0.80], $dom, $root);
                                endforeach;
                        endforeach;
                endforeach;
        endforeach;
        
        function createElement($uri, $dom, $root)
        {
                $url = $dom->createElement('url');

                $loc = $dom->createElement('loc', $uri['loc']);

                        $url->appendChild($loc);

                        $lastmod = $dom->createElement('lastmod', date('Y-m-d h:i:s'));
                        // '2020-09-29T09:49:07+00:00'
                        $url->appendChild($lastmod);

                $priority = $dom->createElement('priority', $uri['priority']);

                        $url->appendChild($priority);

                        $root->appendChild($url);

                        $dom->appendChild($root);

                return $uri;
        }
        
$dom->save('sitemap.xml');