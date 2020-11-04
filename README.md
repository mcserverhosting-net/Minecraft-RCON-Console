# Minecraft RCON Console
##### Tool for send server command via RCON protocal of minecraft server by website.

##### Forked by MCSH and updated. Now maintained. 
![Screenshot](https://raw.githubusercontent.com/mcserverhosting-net/Minecraft-RCON-Console/master/console-sample.png)
![Performance](https://raw.githubusercontent.com/mcserverhosting-net/Minecraft-RCON-Console/master/console-report.png)

### Version

##### 2.2
* Added k8s deployment configs.
* Updated configuration process
* Updated to bootstrap 4
* Set to be able to run as non-root user
* Containerized
* New background image
* Cleaned up API/query ref

##### 2.1
* Change query library.
* Fix responsive on mobile.
* Update jquery version.
* Update bootstrap version.

##### 2.0
* Responsive design.
* Change theme.
* Fix file path.
* Console clear button.
* Update jquery version.
* Update bootstrap version.

##### 1.0
* Send command to server directly.
* Show server status and number of current player online.
* List all name of current player online.

# Setting up
Note: If running inside MCSH, this dashboard is included by default.


1. docker pull docker.pkg.github.com/mcserverhosting-net/minecraft-rcon-console/rcon-console:v2.2
2. Adjust k8s/config.yaml to your server
```php
$rconHost = "localhost";
$rconPort = 25575;
$rconPassword = "rconpassword";
$queryHost = "localhost";
$queryPort = 25585;
```
3. Edit your "server.properties" file.
add (port number and RCON password on you.)
```
query.port=25585
rcon.port=25575
rcon.password=rconpassword
```
and change
```
enable-rcon=true
enable-query=true
```
4. Restart your server.
