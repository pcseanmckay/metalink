<?php 

$repo = $_GET["repo"];
$arch = $_GET["arch"];

#echo "Repository: $repo with arch: $arch\n\n";

# Here we open the paths file and read it into an associative array

$myfile = fopen("path.txt", "r") or die("Unable to open file!");
# Read each line from the file and add to an associative array
# Line is in the following format: <repo>,<architecture>,<URL path to repomd.xml beyond domain name>,<full local path to repomd.xml>
# Example line for fedora 28 base repository:  fedora-28,x86_64,fedora/releases/28/Everything/x86_64/os/repodata/repomd.xml
# Example line for fedora 28 updates repository: updates-released-f28,x86_64,fedora/updates/28/Everything/x86_64/repodata/repomd.xml 
# Example line for EPEL 7 base repository: epel-7,x86_64,epel/7/x86_64/repodata/repomd.xml

#$paths = array();

while(!feof($myfile)) {
  $line = fgets($myfile);
  $line_array = explode(",", $line);
  #$key = $line_array[0] . "|" .$line_array[1];
  #$value = $line_array[2];
  #array_push($paths, $key=>$value);
  $myrepo = chop($line_array[0]);
  $myarch = chop($line_array[1]);
  $mypath = chop($line_array[2]);
  if (count($line_array) == 4) {
    $mylocalpath = chop($line_array[3]);
  }

  $mymirror = "http://mirror.rackspace.com";
  
  if ($myrepo == $repo and $myarch == $arch) {
    if ($mylocalpath != "") {
      # Get size of the repomd.xml file.
      $repomd_filesize = filesize($mylocalpath);
#echo "Local file: " . $mylocalpath;
#echo "Size of path: " . strlen($mylocalpath) . "\n";
#echo "File size: " . $repomd_filesize . "\n";
      # Get the 'timestamp' of the file by reading the <revision></revision> xml data from the repomd.xml file.
      $myxml = simplexml_load_file($mylocalpath) or die("Error: Cannot create xml object");
      $repomd_timestamp = $myxml->revision;
#echo "File revision: " . $repomd_timestamp . "\n";

      # Create timestamp xml element and size xml element as strings
      $xml_filesize = '<size>' . $repomd_filesize . '</size>';
      $xml_timestamp = '<mm0:timestamp>' . $repomd_timestamp . '</mm0:timestamp>';
      $repomd_md5_hash = hash_file('md5', $mylocalpath);
      $repomd_sha1_hash = hash_file('sha1', $mylocalpath);
      $repomd_sha256_hash = hash_file('sha256', $mylocalpath);
      $xml_verification = '<verification><hash type="md5">' . $repomd_md5_hash . '</hash>';
      $xml_verification .= '<hash type="sha1">' . $repomd_sha1_hash . '</hash>';
      $xml_verification .= '<hash type="sha256">' . $repomd_sha256_hash . '</hash>';
      $xml_verification .= '</verification>';
    }
    
    $outxml = '<?xml version="1.0" encoding="utf-8"?>
    <metalink version="3.0" type="dynamic" pubdate="Tue, 22 May 2018 15:28:39 GMT" generator="mirrormanager">
    <files>
        <file name="repomd.xml">' . $xml_timestamp . $xml_filesize . $xml_verification
             . '<resources maxconnections="1">
                <url protocol="http" type="http" location="US" preference="100">' . $mymirror . '/' . $mypath . '</url>
            </resources>
        </file>
    </files>
</metalink>';
    $myoutxml = simplexml_load_string($outxml);
    echo $myoutxml->asXML();
  break;
  }
}
fclose($myfile);

?>