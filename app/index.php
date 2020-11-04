<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>rcon-console</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.5.2/slate/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body style="background: url(&quot;assets/img/37446.jpg&quot;) center center no-repeat fixed; background-size: cover;">
    <div>
        <nav class="navbar navbar-light navbar-expand-md bg-dark navigation-clean" style="box-shadow: 0 0;">
            <div class="container"><a class="navbar-brand text-white" href="#">Minecraft RCON Console -&nbsp;<br></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">Deployments</a></li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">Files</a></li>
                    </ul>
            </div>
    </div>
    </nav>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-8">
                    <h2 class="text-capitalize text-white" style="text-shadow: 2px 2px 5px;">Console</h2>
                    <div class="text-monospace" id="panel-body">
                        <ul class="list-group" id="groupConsole">
                            <li class="list-group-item bounce animated"><span>Welcome&nbsp;to&nbsp;Minecraft&nbsp;RCON&nbsp;Console.<br></span></li>
                            <li class="list-group-item bounce animated"><span>View&nbsp;all&nbsp;command&nbsp;at <a href="http://minecraft.gamepedia.com/Commands">https://minecraft.gamepedia.com/Commands</a><br></span></li>
                            <li class="list-group-item bounce animated"><span>View item names and IDs at&nbsp;<a href="http://www.minecraftinfo.com/idlist.html">http://www.minecraftinfo.com/idlist.html</a><br></span></li>
                        </ul>
                    </div>
                    <div class="form-check text-right"><input class="form-check-input" type="checkbox" id="chkAutoScroll"><label class="form-check-label" for="formCheck-1">Auto Scroll</label></div>
                    <div class="form-group"><input type="text" data-toggle="tooltip" data-bs-tooltip="" id="txtCommand" style="width: 50%;" autocomplete="off" minlength="1" required="" title="Place commands in here. Then hit send to send it to the server."><button class="btn btn-secondary pull-right"
                            id="btnClearLog" type="button">Clear Console</button><button class="btn btn-primary swing animated pull-right" id="btnSend" type="button">Send</button></div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <h2 class="text-capitalize text-white" style="text-shadow: 2px 2px 5px;">Server Status &amp; Info</h2>
                    <div class="list-group-item list-group-item-info"><?php
					$url = "http://localhost:8080/query/api.php";

					$ch = curl_init( $url );
					curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt( $ch, CURLOPT_HEADER, 0);
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

					$purejson = curl_exec( $ch );
					if($purejson != null) {
						echo "Server status: Online<br>";
					}
					else
					{
						echo "Server status: Offline<br>";
						#return;
					}

					$json = json_decode($purejson);
					
					echo format("Internal Port : {0}{1}", $json->hostport, "<br>");
					echo format("Internal IP : {0}{1}", $json->hostip, "<br>");
					echo format("Description : {0}{1}", $json->description, "<br>");
					echo format("Game Type : {0}{1}", $json->gametype, "<br>");
					echo format("Version : {0}{1}", $json->version, "<br>");
					echo format("Plugins : {0}{1}", $json->plugins, "<br>");
					echo format("Map Name : {0}{1}", $json->map, "<br>");
					$division = $json->numplayers / $json->maxplayers;
					$percent = $division * 100;
					echo format("Online : {0} / {1} ({2}%){3}", $json->numplayers, $json->maxplayers, $percent, "<p>");

					$progressClass = "progress-bar";
					if($percent > 80) $progressClass = "progress-bar progress-bar-danger";

					echo format("<div class='progress progress-striped'>
						<div class='{0}' role='progressbar' aria-valuenow='{1}' aria-valuemin='0' aria-valuemax='{2}' style='width: {3}%;'>
						<span class='sr-only'>{3}% Complete</span>
						</div>
						</div>", $progressClass, $json->numplayers, $json->maxplayers, $percent);


					//echo format("Software : {0}{1}", $json->Software, "<br>");



					function format($format) {
						$args = func_get_args();
						$format = array_shift($args);

						preg_match_all('/(?=\{)\{(\d+)\}(?!\})/', $format, $matches, PREG_OFFSET_CAPTURE);
						$offset = 0;
						foreach ($matches[1] as $data) {
							$i = $data[0];
							$format = substr_replace($format, @$args[$i], $offset + $data[1] - 1, 2 + strlen($i));
							$offset += strlen(@$args[$i]) - 2 - strlen($i);
						}

						return $format;
					}

					//////////////////////////////////////////////////////
					echo "<br>";

					echo "Name of current players online : ";
					if(empty($json->players)){
						echo "No players online";
					}
					foreach ($json->players as $key => $value) {
						echo $value;
						if($key != count($json->players) - 1) echo ', ';
					}

					?></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/scripts.min.js"></script>
</body>

</html>