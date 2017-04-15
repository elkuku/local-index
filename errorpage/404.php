<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html>
<head>
    <title>404 Not Found ;(</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<h1>Not Found <code>;(</code></h1>
<p>
    The requested URL <code style="color: green; font-size: 1.5em"><?= $_SERVER['REQUEST_URI'] ?></code> was not found
    on this bloody server.
</p>
<hr/>
<code>
    Freakin' <?= apache_get_version() ?> Server at <?= $_SERVER['SERVER_NAME'] ?> Port <?= $_SERVER['SERVER_PORT'] ?>
    says:
</code>
<h1 style="text-align: center; color: red">&dagger; 404&hellip;</h1>
<code><?= date('Y-m-d H:i:s') ?> in <?= date_default_timezone_get() ?></code>
<hr/>
</body>
</html>
