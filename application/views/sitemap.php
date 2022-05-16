<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/* $client = new Google_Client();
// service_account_file.json is the private key that you created for your service account.
$client->setAuthConfig('service_account_file.json');
$client->addScope('https://www.googleapis.com/auth/indexing');
// Get a Guzzle HTTP Client
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
// Define contents here. The structure of the content is described in the next step.
$content = '{
  "url": "https://www.nandish.in",
  "type": "URL_UPDATED"
}';
$response = $httpClient->post($endpoint, [ 'body' => $content ]);
$status_code = $response->getStatusCode();
re($response); */
$dom = new DOMDocument();

$dom->encoding = 'utf-8';

$dom->xmlVersion = '1.0';

$dom->formatOutput = true;

        $root = $dom->createElement('urlset');

        $root->setAttributeNode(new DOMAttr('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9'));
        $root->setAttributeNode(new DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance'));
        $root->setAttributeNode(new DOMAttr('xsi:schemaLocation', "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"));
        
        createElement(['loc' => base_url(), 'priority' => "1.00"], $dom, $root);
        createElement(['loc' => make_slug("about-us"), 'priority' => "0.80"], $dom, $root);
        createElement(['loc' => make_slug("privacy"), 'priority' => "0.80"], $dom, $root);
        createElement(['loc' => make_slug("contact-us"), 'priority' => "0.80"], $dom, $root);

        foreach($items as $cat):
                createElement(['loc' => make_slug("$cat->c_name"), 'priority' => "0.80"], $dom, $root);
                foreach($cat->sub_cats as $sub_cat):
                        createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name"), 'priority' => "0.80"], $dom, $root);
                        foreach($sub_cat->inner_cats as $inn_cat):
                                createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name/$inn_cat->i_name"), 'priority' => "0.80"], $dom, $root);
                                foreach($inn_cat->sub_inners as $sub_inn):
                                        // re($sub_inn);
                                        createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name/$inn_cat->i_name/$sub_inn->si_name"), 'priority' => "0.80"], $dom, $root);
                                        foreach($sub_inn->prods as $prod):
                                                createElement(['loc' => make_slug("$cat->c_name/$sub_cat->sc_name/$inn_cat->i_name/$sub_inn->si_name/$prod->p_name-".e_id($prod->p_id)), 'priority' => "0.80"], $dom, $root);
                                        endforeach;
                                endforeach;
                        endforeach;
                endforeach;
        endforeach;

        foreach($this->main->getall('blog_category', 'id, c_name', ['is_deleted' => 0]) as $cat):
                createElement(['loc' => make_slug("blogs/$cat->c_name"), 'priority' => "0.80"], $dom, $root); 
                foreach($this->main->getall('blog_sub_category', 'id, sc_name', ['is_deleted' => 0, 'c_id' => $cat->id]) as $sub_cat):
                        createElement(['loc' => make_slug("blogs/$cat->c_name/$sub_cat->sc_name"), 'priority' => "0.80"], $dom, $root);
                        foreach($this->main->getall('blog_inner_category', 'id, ic_name', ['is_deleted' => 0, 's_id' => $sub_cat->id]) as $inn_cat):
                                createElement(['loc' => make_slug("blogs/$cat->c_name/$sub_cat->sc_name/$inn_cat->ic_name"), 'priority' => "0.80"], $dom, $root);
                                foreach($this->main->getall('blog_sub_inner_category', 'id, si_name', ['is_deleted' => 0, 'i_id' => $inn_cat->id]) as $sub_inn):
                                        createElement(['loc' => make_slug("blogs/$cat->c_name/$sub_cat->sc_name/$inn_cat->ic_name/$sub_inn->si_name"), 'priority' => "0.80"], $dom, $root);
                                endforeach;
                        endforeach;
                endforeach;
        endforeach;
        
        foreach($this->main->blogs_list(['b.is_deleted' => 0], 0, 10000) as $blog):
                createElement(['loc' => make_slug("blog/".$blog['title']."-".e_id($blog['id'])), 'priority' => "0.80"], $dom, $root);
        endforeach;
        
        function createElement($uri, $dom, $root)
        {
                $url = $dom->createElement('url');

                $loc = $dom->createElement('loc', $uri['loc']);

                        $url->appendChild($loc);

                        $lastmod = $dom->createElement('lastmod', date('Y-m-d').'T'.date('H:i:s').'+00:00');
                        // $lastmod = $dom->createElement('lastmod', date('Y-m-dTH:i:sP'));
                        // $lastmod = $dom->createElement('lastmod', date('Y-m-d h:i:s'));
                        // '2020-09-29T09:49:07+00:00'
                        $url->appendChild($lastmod);

                $priority = $dom->createElement('priority', $uri['priority']);

                        $url->appendChild($priority);

                        $root->appendChild($url);

                        $dom->appendChild($root);

                return $uri;
        }
$dom->save('sitemap.xml');