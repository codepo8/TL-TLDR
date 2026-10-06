<?php
$URLS = file_get_contents('tldrs.txt');
$out = '';
foreach (array_filter(explode("\n", $URLS)) as $url) {
    echo $url . "\n";
    $html = file_get_contents($url);
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();
    $xpath = new DOMXPath($dom);
    $links = $xpath->query('//a');
    foreach($links as $link) {
        $content = $link->nodeValue;
        if (strstr($content,'minute read') || strstr($content,'GitHub Repo')) {
                $text = trim(preg_replace("/ \(\d+ minute read\)|\(GitHub Repo\)/","",$link->nodeValue));
                $details = trim($link->parentNode->lastChild->previousSibling->nodeValue);
                $link = $link->getAttribute('href');
                if (strpos($link, 'links.tldrnewsletter.com') !== 0) {
                    $link = exec('curl -Ls -o /dev/null -w %{url_effective} ' . escapeshellarg($link));
                }
                $out .= trim($text)." " . $link . "\n" . $details . "\n\n";
        }
    }
}
file_put_contents('tldrs.txt', $URLS . "\n" . $out);
?>