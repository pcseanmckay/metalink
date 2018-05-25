<?php 

$repo = $_GET["repo"];
$arch = $_GET["arch"];

#echo "Repository: $repo with arch: $arch\n\n";

# Here we open the paths file and read it into an associative array

$myfile = fopen("path.txt", "r") or die("Unable to open file!");
# Read each line from the file and add to an associative array

#$paths = array();

while(!feof($myfile)) {
  $line = fgets($myfile);
  $line_array = explode(",", $line);
  #$key = $line_array[0] . "|" .$line_array[1];
  #$value = $line_array[2];
  #array_push($paths, $key=>$value);
}
fclose($myfile);

if (strncmp($repo, "fedora-", 7) == 0) {
    $url = explode("-", $repo);
    $ver = $url[1];
    echo '<metalink version="3.0" type="dynamic" pubdate="Tue, 22 May 2018 15:28:39 GMT" generator="mirrormanager">
    <files>
        <file name="repomd.xml">'
            #<mm0:timestamp>1509861107</mm0:timestamp>
            #<size>3926</size>
             . '<resources maxconnections="1">
                <url protocol="http" type="http" location="US" preference="100">http://mirror.rackspace.com/fedora/releases/' . $ver . '/Everything/' . $arch . '/os/repodata/repomd.xml</url>
            </resources>
        </file>
    </files>
</metalink>';
}
elseif (strncmp($repo, "updates", 7) == 0) {
    $url = explode("-", $repo);
    $tmpver = $url[2];
    $ver = substr($tmpver, 1);
    echo '<metalink version="3.0" type="dynamic" pubdate="Tue, 22 May 2018 15:28:39 GMT" generator="mirrormanager">
    <files>
        <file name="repomd.xml">'
            #<mm0:timestamp>1509861107</mm0:timestamp>
            #<size>3926</size>
             . '<resources maxconnections="1">
                <url protocol="http" type="http" location="US" preference="100">http://mirror.rackspace.com/fedora/updates/' . $ver . '/' . $arch . '/repodata/repomd.xml</url>
            </resources>
        </file>
    </files>
</metalink>';
}
elseif (strncmp($repo, "epel-", 5) == 0) {
    $url = explode("-", $repo);
    $ver = $url[1];
    echo '<metalink version="3.0" type="dynamic" pubdate="Tue, 22 May 2018 15:28:39 GMT" generator="mirrormanager">
    <files>
        <file name="repomd.xml">'
            #<mm0:timestamp>1509861107</mm0:timestamp>
            #<size>3926</size>
             . '<resources maxconnections="1">
                <url protocol="http" type="http" location="US" preference="100">http://mirror.rackspace.com/epel/' . $ver . '/' . $arch . '/repodata/repomd.xml</url>
            </resources>
        </file>
    </files>
</metalink>';

}

?>