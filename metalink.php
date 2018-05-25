<?php 

$repo = $_GET["repo"];
$arch = $_GET["arch"];

#echo "Repository: $repo with arch: $arch\n\n";

#https://mirrors.fedoraproject.org/metalink?repo=fedora-28&arch=x86_64
#https://fedora.mirror.constant.com/fedora/linux/releases/28/Everything/x86_64/os/repodata/repomd.xml

#https://mirrors.fedoraproject.org/metalink?repo=updates-released-f28&arch=x86_64
#https://download-ib01.fedoraproject.org/pub/fedora/linux/updates/28/Everything/x86_64/repodata/repomd.xml

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

}

?>