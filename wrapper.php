<?php

error_reporting(0);

echo "




 _    _      _       _____                    _           
| |  | |    | |     /  __ \                  | |          
| |  | | ___| |__   | /  \/_ __ __ ___      _| | ___ _ __ 
| |/\| |/ _ \ '_ \  | |   | '__/ _` \ \ /\ / / |/ _ \ '__|
\  /\  /  __/ |_) | | \__/\ | | (_| |\ V  V /| |  __/ |   
 \/  \/ \___|_.__/   \____/_|  \__,_| \_/\_/ |_|\___|_|   
                                                          
                                                          
@Ahmed Safa



";
echo "\n\n";

$target = readline("Enter web link : ");

function crawler($url = null)
{
	$input   =  @file_get_contents($url);
	$regexp  = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU",$input,$matches);
	$base_url = parse_url($url,PHP_URL_HOST);
	$links = $matches[2];
	echo "Total Link Found : ".count($links)."\n\n";
	
	foreach($links as $link)
	{
		
		if(strpos($link,'#'))
		{
			$link = substr($link,0,strpos($link,'#'));
		}
		
		if(substr($link,0,1) == ".")
		{
			$link = substr($link,1);
		}
		
		if(substr($link,0,7) == "http://")
		{
			$link = $link;
		}
		elseif(substr($link,0,8) == "https://")
		{
			$link = $link;
		}
		elseif(substr($link,0,2) == "//")
		{
			$link = substr($link,2);
		}
		elseif(substr($link,0,1) == "#")
		{
			$link = $url;
		}
		elseif(substr($link,0,7) == "mailto")
		{
			$link = "[".$link."]";
		}
		else
		{
			if(substr($link,0,7) != "/")
			{
				$link = $base_url."/".$link;
			}
			else
			{
				$link = $base_url.$link;
			}
		}
		
		if(substr($link,0,7) != "http://" && substr($link,0,8) != "https://" && substr($link,0,1) != "[")
		{
			if(substr($url,0,8) == "https://")
			{
				$link = "https://".$link;
			}
			else
			{
				$link = "http://".$link;
			}
		}
		
		echo $link."\n";
		
	}
	
}

crawler($target);

?>