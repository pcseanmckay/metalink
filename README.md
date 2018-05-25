# metalink
Project for implementation of fedora/epel metalink repo site for closed networks.

# Path File
This php script used a path file called 'path.txt'.  This file contains a 
comma separated values that map a repository, architecture, and a URL path to the repomd.xml file.

## Example Path File
Here is an example line for a Fedora 28 main repo, update repo, and an EPEL 7 repo:
- fedora-28,x86_64,/fedora/releases/28/Everything/x86_64/os/repodata/repomd.xml
- updates-released-f28,x86_64,/fedora/updates/28/Everything/x86_64/repodata/repomd.xml
- epel-7,x86_64,/epel/7/x86_64/repodata/repomd.xml