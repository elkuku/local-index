<?php
ob_start();
date_default_timezone_set('UTC');
phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES);
$string = ob_get_clean();

preg_match_all('#<body[^>]*>(.*)</body>#siU', $string, $phpInfo);
$phpInfo = preg_replace('#<table[^>]*>#', '<table class="table table-striped adminlist">', $phpInfo[1][0]);
$phpInfo = preg_replace('#(\w),(\w)#', '\1, \2', $phpInfo);
$phpInfo = preg_replace('#<hr />#', '', $phpInfo);
$phpInfo = str_replace('<div class="center">', '', $phpInfo);
$phpInfo = preg_replace('#<tr class="h">(.*)<\/tr>#', '<thead><tr class="h">$1</tr></thead><tbody>', $phpInfo);
$phpInfo = str_replace('</table>', '</tbody></table>', $phpInfo);
$phpInfo = str_replace('</div>', '', $phpInfo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPInfo</title>

    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
                <a class="navbar-brand" href="/">Back to Admin</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="/"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                    <li class="selected"><a href="phpinfo.php"><i class="fa fa-tasks"></i> PHP Info</a></li>
                    <li><a href="forms.html"><i class="fa fa-list-ol"></i> Forms</a></li>
                    <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                    <li><a href="bootstrap-elements.html"><i class="fa fa-list-ul"></i> Bootstrap Elements</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">2</span> <b class="caret"></b></a>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Steve Miller<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

       <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?= $phpInfo ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
