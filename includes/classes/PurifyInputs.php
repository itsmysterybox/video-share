<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/VideoTube/htmlpurifier/HTMLPurifier.standalone.php');
class PurifyInputs {
	
	public static function removeHtmlTags($input) {		
		$config = HTMLPurifier_Config::createDefault();
		$config->set('HTML.Allowed', '');
		$purifier = new HTMLPurifier($config);
		return trim($purifier->purify($input));
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
	public static function removeAbusiveWords($input) {
		$abusive_words = file('../bad_words.txt');
		$replaceWith = '*';

		$replace = array();
		$replace['a'] = '(a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ä|ä|Ã|ã|Å|å|α|Δ|Λ|λ)';
		$replace['b'] = '(b|b\.|b\-|8|\|3|ß|Β|β)';
		$replace['c'] = '(c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©)';
		$replace['d'] = '(d|d\.|d\-|&part;|\|\)|Þ|þ|Ð|ð)';
		$replace['e'] = '(e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)';
		$replace['f'] = '(f|f\.|f\-|ƒ)';
		$replace['g'] = '(g|g\.|g\-|6|9)';
		$replace['h'] = '(h|h\.|h\-|Η)';
		$replace['i'] = '(i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï)';
		$replace['j'] = '(j|j\.|j\-)';
		$replace['k'] = '(k|k\.|k\-|Κ|κ)';
		$replace['l'] = '(l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï)';
		$replace['m'] = '(m|m\.|m\-)';
		$replace['n'] = '(n|n\.|n\-|η|Ν|Π)';
		$replace['o'] = '(o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)';
		$replace['p'] = '(p|p\.|p\-|ρ|Ρ|¶|þ)';
		$replace['q'] = '(q|q\.|q\-)';
		$replace['r'] = '(r|r\.|r\-|®)';
		$replace['s'] = '(s|s\.|s\-|5|\$|§)';
		$replace['t'] = '(t|t\.|t\-|Τ|τ)';
		$replace['u'] = '(u|u\.|u\-|υ|µ)';
		$replace['v'] = '(v|v\.|v\-|υ|ν)';
		$replace['w'] = '(w|w\.|w\-|ω|ψ|Ψ)';
		$replace['x'] = '(x|x\.|x\-|Χ|χ)';
		$replace['y'] = '(y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)';
		$replace['z'] = '(z|z\.|z\-|Ζ)';

		$replacement = array();
		$abusive_words = array_map('trim', $abusive_words);
		$whiteListCount = count($abusive_words);

		for ($x = 0; $x < $whiteListCount; $x++) {
		    $replacement[$x] = str_repeat($replaceWith, strlen($abusive_words[$x]));
		    $abusive_words[$x] = '/' . str_ireplace(array_keys($replace), array_values($replace), $abusive_words[$x]) . '/i';
		}
		return preg_replace($abusive_words, $replacement, $input);
	}
}
?>