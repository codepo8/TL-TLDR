# TL-TLDR

A PHP script to convert [TLDR's newsletters](https://tldr.tech/newsletters) to smaller link lists without any redirects. 

## Usage 

1. Add the links to the newsletters (browser version) to tldrs.txt
1. Execute tldr.php on the command line
1. The content of each of the URLs will be added to the tldrs.txt file.

Each link will be in the format headline, URL and description. Links hidden with the "links.tldrnewsletter.com" redirect will automatically get converted and you get the full URL. 