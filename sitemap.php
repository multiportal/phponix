<?php
include 'admin/conexion.php';
//$page_url='http://localhost/MisSitios/phponix';
/*************************************************************

 Simple site crawler to create a search engine XML Sitemap.
 Version: 2.4
 License: GPL v2
 Free to use, without any warranty.
 Written by Elmar Hanlhofer https://www.plop.at

 ChangeLog:
 ----------
 Version 2.4 2018/02/04 by Elmar Hanlhofer

     * Print configuration settings
     * Because of some confusion I moved the SITE configuration
       check down to the program start
     
 Version 2.3 2018/01/31 by Elmar Hanlhofer

     * Save creation date in sitemap file
     * Stop with error when user did not set the SITE variable
     * Replaced plop.at with example.com 
     * Remove commented text from HTML to avoid scanning 
       commented URLs

 Version 2.2 2017/10/12 by Elmar Hanlhofer
 
     * Cut off page anchor from URL

 Version 2.1 2016/10/07 by Elmar Hanlhofer
 
     * strpos fix (swap arguments) for first anchor - by William
     * First anchor check optimized - by Elmar Hanlhofer

 Version 2.0 2016/08/11 by Elmar Hanlhofer
 
     * Most program parts rewritten
     * Using quotes on define command
     * Supporting single and double quotes in href
     * Notices disabled

 Version 1.0 2015/10/14 by Elmar Hanlhofer
 
     * CLI / Website mode added
     * Multiple extension support added
     * Support for quoted URLs with spaces added
     * Skip mailto links
     * Converting special chars in the URLs for the XML file
     * Added user agent
     * Minor code updates

 Version 0.2 2013/01/16  

     * curl support - by Emanuel Ulses
     * write url, then scan url - by Elmar Hanlhofer

 Version 0.1 2012/02/01 by Elmar Hanlhofer

     * Initital release

*************************************************************/

    // Set the output file name.
    define ("OUTPUT_FILE", "sitemap.xml");
    
    // Set the start URL. Example: define ("SITE", "https://www.example.com");
    define ("SITE", $page_url);

    // Set true or false to define how the script is used.
    // true:  As CLI script.
    // false: As Website script.
    define ("CLI", false);

    // Define here the URLs to skip. All URLs that start with the defined URL 
    // will be skipped too.
    // Example: "https://www.example.com/print" will also skip
    //   https://www.example.com/print/bootmanager.html
    $skip_url = array (
                       SITE . "/print",
                       SITE . "/slide",
                      );
    
    // General information for search engines how often they should crawl the page.
    define ("FREQUENCY", "weekly");
    

    // General information for search engines. You have to modify the code to set
    // various priority values for different pages. Currently, the default behavior
    // is that all pages have the same priority.
    define ("PRIORITY", "0.5");


    // When your web server does not send the Content-Type header, then set
    // this to 'true'. But I don't suggest this.
    define ("IGNORE_EMPTY_CONTENT_TYPE", false);

/*************************************************************
    End of user defined settings.
*************************************************************/

function GetPage ($url_site)
{
    $ch = curl_init ($url_site);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_USERAGENT, AGENT);

    $data = curl_exec($ch);

    curl_close($ch);

    return $data;
}

function GetQuotedUrl ($str)
{
    $quote = substr ($str, 0, 1);
    if (($quote != "\"") && ($quote != "'")) // Only process a string 
    {                                        // starting with singe or
        return $str;                         // double quotes
    }                                                 

    $ret = "";
    $len = strlen ($str);    
    for ($i = 1; $i < $len; $i++) // Start with 1 to skip first quote
    {
        $ch = substr ($str, $i, 1);
        
        if ($ch == $quote) break; // End quote reached

        $ret .= $ch;
    }
    
    return $ret;
}

function GetHREFValue ($anchor)
{
    $split1  = explode ("href=", $anchor);
    $split2 = explode (">", $split1[1]);
    $href_string = $split2[0];

    $first_ch = substr ($href_string, 0, 1);
    if ($first_ch == "\"" || $first_ch == "'")
    {
        $url_site = GetQuotedUrl ($href_string);
    }
    else
    {
        $spaces_split = explode (" ", $href_string);
        $url_site          = $spaces_split[0];
    }
    return $url_site;
}

function GetEffectiveURL ($url_site)
{
    // Create a curl handle
    $ch = curl_init ($url_site);//En webcindario.com no funciona

    // Send HTTP request and follow redirections
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_USERAGENT, AGENT);
    curl_exec($ch);

    // Get the last effective URL
    $effective_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    // ie. "http://example.com/show_location.php?loc=M%C3%BCnchen"

    // Decode the URL, uncoment it an use the variable if needed
    // $effective_url_decoded = curl_unescape($ch, $effective_url);
    // "http://example.com/show_location.php?loc=München"

    // Close the handle
    curl_close($ch);

    return $effective_url;
}

function ValidateURL ($url_site_base, $url_site)
{
    global $scanned;
        
    $parsed_url = parse_url ($url_site);
        
    $scheme = $parsed_url["scheme"];
        
    // Skip URL if different scheme or not relative URL (skips also mailto)
    if (($scheme != SITE_SCHEME) && ($scheme != "")) return false;
        
    $host = $parsed_url["host"];
                
    // Skip URL if different host
    if (($host != SITE_HOST) && ($host != "")) return false;
    
    // Check for page anchor in url
    if ($page_anchor_pos = strpos ($url_site, "#"))
    {
        // Cut off page anchor
    	$url_site = substr ($url_site, 0, $page_anchor_pos);
    }
        
    if ($host == "")    // Handle URLs without host value
    {
        if (substr ($url_site, 0, 1) == '/') // Handle absolute URL
        {
            $url_site = SITE_SCHEME . "://" . SITE_HOST . $url_site;
        }
        else // Handle relative URL
        {
            $path = parse_url ($url_site_base, PHP_URL_PATH);
            
            if (substr ($path, -1) == '/') // URL is a directory
            {
                // Construct full URL
                $url_site = SITE_SCHEME . "://" . SITE_HOST . $path . $url_site;
            }
            else // URL is a file
            {
                $dirname = dirname ($path);

                // Add slashes if needed
                if ($dirname[0] != '/')
                {
                    $dirname = "/$dirname";
                }
    
                if (substr ($dirname, -1) != '/')
                {
                    $dirname = "$dirname/";
                }

                // Construct full URL
                $url_site = SITE_SCHEME . "://" . SITE_HOST . $dirname . $url_site;
            }
        }
    }

    // Get effective URL, follow redirected URL
    $url_site = GetEffectiveURL ($url_site); 

    // Don't scan when already scanned    
    if (in_array ($url_site, $scanned)) return false;
    
    return $url_site;
}

// Skip URLs from the $skip_url array
function SkipURL ($url_site){
    global $skip_url;

    if (isset ($skip_url)){
        foreach ($skip_url as $v){           
            if (substr ($url_site, 0, strlen ($v)) == $v) return true; // Skip this URL
        }
    }
    return false;            
}

function Scan ($url_site){
    global $scanned, $pf;
    $scanned[] = $url_site;  // Add URL to scanned array

    if (SkipURL ($url_site)){
        echo "Skip URL $url_site" . NL;
        return false;
    }
    
    // Remove unneeded slashes
    if (substr ($url_site, -2) == "//") {
        $url_site = substr ($url_site, 0, -2);
    }
    if (substr ($url_site, -1) == "/") {
        $url_site = substr ($url_site, 0, -1);
    }
    echo "Scan $url_site" . NL;

    $headers = get_headers ($url_site, 1);

    // Handle pages not found
    if (strpos ($headers[0], "404") !== false){
        echo "Not found: $url_site" . NL;
        return false;
    }

    // Handle redirected pages
    if (strpos ($headers[0], "301") !== false){   
        $url_site = $headers["Location"];     // Continue with new URL
        echo "Redirected to: $url_site" . NL;
    }
    // Handle other codes than 200
    else if (strpos ($headers[0], "200") == false){
        $url_site = $headers["Location"];
        echo "Skip HTTP code $headers[0]: $url_site" . NL;
        return false;
    }

    // Get content type
    if (is_array ($headers["Content-Type"])){
        $content = explode (";", $headers["Content-Type"][0]);
    }else{
        $content = explode (";", $headers["Content-Type"]);
    }
    $content_type = trim (strtolower ($content[0]));
    // Check content type for website
    if ($content_type != "text/html"){
        if ($content_type == "" && IGNORE_EMPTY_CONTENT_TYPE){
            echo "Info: Ignoring empty Content-Type." . NL;
        }else{
            if ($content_type == ""){
                echo "Info: Content-Type is not sent by the web server. Change " .
                     "'IGNORE_EMPTY_CONTENT_TYPE' to 'true' in the sitemap script " .
                     "to scan those pages too." . NL;
            }else{
                echo "Info: $url_site is not a website: $content[0]" . NL;
            }
            return false;
        }
    }

    $html = GetPage ($url_site);
    $html = trim ($html);
    if ($html == "") return true;  // Return on empty page
    
    $html = preg_replace("/(\<\!\-\-.*\-\-\>)/sU", "", $html); // Remove commented text
    $html = str_replace ("\r", " ", $html);        // Remove newlines
    $html = str_replace ("\n", " ", $html);        // Remove newlines
    $html = str_replace ("\t", " ", $html);        // Remove tabs
    $html = str_replace ("<A ", "<a ", $html);     // <A to lowercase

    $first_anchor = strpos ($html, "<a ");    // Find first anchor

    if ($first_anchor === false) return true; // Return when no anchor found

    $html = substr ($html, $first_anchor);    // Start processing from first anchor

    $a1   = explode ("<a ", $html);
    foreach ($a1 as $next_url){
        $next_url = trim ($next_url);
        
        // Skip empty array entry
        if ($next_url == "") continue; 
        
        // Get the attribute value from href
        $next_url = GetHREFValue ($next_url);
        
        // Do all skip checks and construct full URL
        $next_url = ValidateURL ($url_site, $next_url);
        
        // Skip if url is not valid
        if ($next_url == false) continue;

        if (Scan ($next_url)){
            // Add URL to sitemap
            fwrite ($pf, "  <url>\n" .
                         "    <loc>" . htmlentities ($next_url) ."</loc>\n" .
                         "    <changefreq>" . FREQUENCY . "</changefreq>\n" .
                         "    <priority>" . PRIORITY . "</priority>\n" .
                         "  </url>\n"); 
        }
    }
    return true;
}

    // Program start
    define ("VERSION", "2.4");
    define ("NL", CLI ? "\n" : "<br>");

    // Print configuration
    echo "Plop PHP XML Sitemap Generator Configuration:" . NL;
    echo "VERSION: " . VERSION . NL;
    echo "OUTPUT_FILE: " . OUTPUT_FILE . NL;
    echo "SITE: " . SITE . NL;
    echo "CLI: " . (CLI ? "true" : "false"). NL;
    echo "IGNORE_EMPTY_CONTENT_TYPE: " . (IGNORE_EMPTY_CONTENT_TYPE ? "true" : "false") . NL;
    echo "DATE: " . date ("Y-m-d H:i:s") . NL;
    echo NL;
    
    // SITE configuration check    
    if (!SITE){
        die ("ERROR: You did not set the SITE variable at line number " . 
             "68 with the URL of your website!\n");
    }

    define ("AGENT", "Mozilla/5.0 (compatible; Plop PHP XML Sitemap Generator/" . VERSION . ")");
    define ("SITE_SCHEME", parse_url (SITE, PHP_URL_SCHEME));
    define ("SITE_HOST"  , parse_url (SITE, PHP_URL_HOST));

    error_reporting (E_ERROR | E_WARNING | E_PARSE);

    $pf = fopen (OUTPUT_FILE, "w");
    if (!$pf){
        echo "ERROR: Cannot create " . OUTPUT_FILE . "!" . NL;
        return;
    }

    fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
                 "<!-- Created with Plop PHP XML Sitemap Generator " . VERSION . " https://www.phponix.webcindario.com -->\n" .
                 "<!-- Date: " . date ("Y-m-d H:i:s") . " -->\n" .
                 "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
                 "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
                 "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
                 "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
                 "  <url>\n" .
                 "    <loc>" . SITE . "/</loc>\n" .
                 "    <changefreq>" . FREQUENCY . "</changefreq>\n" .
                 "  </url>\n");

    echo "Scanning..." . NL;
    $scanned = array();
    Scan (GetEffectiveURL (SITE));
    
    fwrite ($pf, "</urlset>\n");
    fclose ($pf);

    echo "Done." . NL;
    echo OUTPUT_FILE . " created." . NL;
	echo '<a href="'.$page_url.'index.php?mod=sys&ext=admin/index&opc=sitemap">Volver</a> | <a target="_blank" href="'.$page_url.'sitemap.xml">Ver Sitemap</a> | <a href="'.$page_url.'">P&aacute;gina de Inicio</a>';
?>
