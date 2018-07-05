# metalink
Project for implementation of fedora/epel metalink repo site for closed networks.

# Path File
This php script uses a path file called 'path.txt'.  This file contains 
comma separated values that map a repository, architecture, URL path to the repomd.xml file, and local fileystem path to the repomd.xml file.

## Example Path File
Here is an example line for a Fedora 28 main repo, update repo, and an EPEL 7 repo:
- fedora-28,x86_64,fedora/releases/28/Everything/x86_64/os/repodata/repomd.xml,/var/www/html/fedora28/repomd.xml
- updates-released-f28,x86_64,fedora/updates/28/Everything/x86_64/repodata/repomd.xml,/var/www/html/fedora28-updates/repomd.xml
- epel-7,x86_64,epel/7/x86_64/repodata/repomd.xml,/var/www/html/epel7/repomd.xml