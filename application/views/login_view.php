<!DOCTYPE html>
<html>
<?php echo includeStylesheets();?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url("css");?>login.css">
<head>
    <title>paload.io</title>
</head>
<body>
    <div class="container">
    <div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <form action="" method="">
                    <input id="username" name="user" type="text" placeholder="username">
                    <input id="password" type="password" placeholder="password">
                    <button id="submit" class="btn btn-info btn-block login" type="submit">Login</button>
                </form>
            </div>
        </div>
</div>
</body>
<?php echo includeScripts();?>
<script type='text/javascript' src="<?php echo asset_url("js");?>login.js"></script>
</html>