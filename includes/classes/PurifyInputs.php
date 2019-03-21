<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/video-share/htmlpurifier/HTMLPurifier.standalone.php');
class PurifyInputs {
	
	public static function removeHtmlTags($input) {		
		$config = HTMLPurifier_Config::createDefault();
		$config->set('HTML.Allowed', '');
		$purifier = new HTMLPurifier($config);
		return $purifier->purify($input);
	}

	public static function formatLinksInText($text) {

	    //Catch all links with protocols
	    $reg = '/(https?|ftps?)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}([\/\S*]+[^,.;\s])?/';
	    $text = preg_replace($reg, '<a href="$0" rel="nofollow" target="_blank">$0</a>', $text);

	    //Catch all links without protocol
	    $reg2 = '/(?<=\s|\A)([0-9a-zA-Z\-\.]+\.[a-zA-Z0-9\/]{2,})(?=\s|$|\,|\.)/';
	    $text = preg_replace($reg2, '<a href="//$0" rel="nofollow" target="_blank">$0</a>', $text);

	    //Catch all emails
	    $emailRegex = '/(\S+\@\S+\.\S+)/';
	    $text = preg_replace($emailRegex, '<a href="mailto:$1" target="_blank" title="$1">$1</a>', $text);

	    return $text;
	}
	// Detect and remove abusive words
}
?>