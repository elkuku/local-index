<?php
$localFolders = [];
$localDomains = [];

$serverRoot = '/home/elkuku/srv/htdocs';
$hostsFile  = '/etc/hosts';

foreach (new DirectoryIterator($serverRoot) as $fileInfo)
{
	if ($fileInfo->isDir() && !$fileInfo->isDot() && !in_array($fileInfo->getFilename(), ['index', '.idea']))
	{
		$localFolders[] = $fileInfo->getFilename();
	}
}

sort($localFolders);

$lines = file($hostsFile);

foreach ($lines as $line)
{
	if (!trim($line))
	{
		continue;
	}

	$parts = explode("\t", $line);

	if (2 != count($parts))
	{
		$parts = explode(' ', $line);
	}

	if ('127.0.0.1' != $parts[0])
	{
		continue;
	}

	if (in_array(trim($parts[1]), [
		'localhost', 'google-analytics.com', 'www.google-analytics.com',
		'doubleclick.net', 'googleads.g.doubleclick.net',
		'googleadservices.com', 'www.googleadservices.com',
		'googleanalytics.com'
	]))
	{
		continue;
	}

	$localDomains[] = trim($parts[1]);
}

sort($localDomains);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El KuKu - Local!</title>

    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/local.css"/>

    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="elkuku.jpg" width="36" height="36" alt="elkuku"
                                                  style="float:left"/> El KuKu</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul id="active" class="nav navbar-nav side-nav">
                <li class="selected"><a href="/"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                <li><a href="phpinfo.php"><i class="fa fa-tasks"></i> PHP Info</a></li>
                <li><a href="forms.html"><i class="fa fa-list-ol"></i> Forms</a></li>
                <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                <li><a href="bootstrap-elements.html"><i class="fa fa-list-ul"></i> Bootstrap Elements</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown messages-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages
                        <span class="badge">2</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">2 New Messages</li>
                        <li class="message-preview">
                            <a href="#">
                                <span class="avatar"><i class="fa fa-bell"></i></span>
                                <span class="message">Security alert</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="message-preview">
                            <a href="#">
                                <span class="avatar"><i class="fa fa-bell"></i></span>
                                <span class="message">Security alert</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">Go to Inbox <span class="badge">2</span></a></li>
                    </ul>
                </li>
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Steve Miller<b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>

                    </ul>
                </li>
                <li class="divider-vertical"></li>
                <li>
                    <form class="navbar-search">
                        <input type="text" placeholder="Search" class="form-control">
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissable alert-warning pull-right">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    This is a local host!
                </div>
                <h1>El KuKu
                    <small>local</small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Local folders</h3>
                    </div>
                    <div class="panel-body">
                        <p><code><?= $serverRoot ?></code></p>
                        <ul>
							<?php foreach ($localFolders as $folder): ?>
								<?= '<li class="list-unstyled"><a href="../' . $folder . '">' . $folder . '</a></li>' ?>
							<?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Local Domains</h3>
                    </div>
                    <div class="panel-body">
                        <p><code><?= $hostsFile ?></code></p>
                        <ul>
							<?php foreach ($localDomains as $folder): ?>
								<?= '<li class="list-unstyled"><a href="http://' . $folder . '">' . $folder . '</a></li>' ?>
							<?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->

</body>
</html>
