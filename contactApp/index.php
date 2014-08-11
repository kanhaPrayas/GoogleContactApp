<?php
session_start();
require_once 'app/init.php';
$googleClient = new Google_Client;
$auth = new GoogleAuth($googleClient);
if ($auth->checkRedirectCode()){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html class="bg-grey">
<head>
    <meta charset="UTF-8">
    <title>Test app</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<style type="text/css">
        div {
        position: absolute;
        left: 250px;
        top: 200px;
        background-color: #f1f1f1;
        width: 280px;
        padding: 10px;
        color: black;
        border: #0000cc 2px dashed;
        display: none;
        }
        </style>

        <script language="JavaScript">
        function setVisibility(id) {
        if(document.getElementById('bt1').value=='Hide Layer'){
        document.getElementById('bt1').value = 'Show Layer';
        document.getElementById(id).style.display = 'none';
        }else{
        document.getElementById('bt1').value = 'Hide Layer';
        document.getElementById(id).style.display = 'inline';
        }
        }

        </script>

    <style type="text/css">
    html, body {
        height: 100%;
        width: 100%;
    }
    .hideall {
        display: none;
    }
    </style>

</head>

<body class="bg-grey">
        <?php  if(!$auth->isLoggedIn()):?>
            <a href = "<?php echo $auth->getAuthUrl(); ?>" id="btnaction" class="btn btn-primary bg-blue btn-block"><i class="fa fa-google" ></i> &nbsp;Sign in with Google</a>
        <?php else:  ?>
            <h1 align="center">Contact Dashboard</h1><a style="float:right;" href="logout.php">Sign Out</a><br/>
                <a id="btnaction"  href = "contacts.php" class="btn btn-primary bg-blue btn-block"><i class="fa fa-user"></i> &nbsp;My Contacts</a>
                <a id="btnaction"  href = "contacts.php?test=true" class="btn btn-primary bg-blue btn-block"><i class="fa fa-users" ></i> &nbsp;My Meetings</a>
                <a id="btnaction"  href = "contacts.php?test=true" class="btn btn-primary bg-blue btn-block"><i class="fa fa-calendar-o" ></i> &nbsp;My Recent Conversation</a>
        <?php endif;?>
</body>

</html>