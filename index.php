<?php
//--------------------------------
// G-Yara By ApoNIe
// twitter.com/GeeKzLIfe
//--------------------------------

include("config.php");

//Load current rule ------
$fh = fopen($ruleFile, 'r');
$theData = fread($fh, filesize($ruleFile));
fclose($fh);
//------------------------
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>G-YARA</title>


    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


  
    <!-- Styles --> 


    <link type="text/css" href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
    <link href="bootstrap/bootstrap.css" rel="stylesheet">
    <link href="css/demo.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; /* 40px to make the container go all the way to the bottom of the topbar */
      }
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 1280px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 810px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar .btn {
        border: 0;
      }

    </style>

  </head>

  <body>

  <!--[if IE]>
  <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.8.16.ie.css"/>
  <![endif]-->

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="">G-YARA</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>

          </ul>
          <form action="" class="pull-right">
          </form>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="content">
        <div class="page-header">
          <h1></small></h1>
        </div>
        

          <!--left col-->
          <div class="span10" style="width:100%">
			<?php echo $notice; ?>
            <div id="result"></div>
    	  <h1>G-YARA</h1>            
                <textarea name="content" rows="40" id="content" style="width:60%;height:300px"></textarea>	    
                <textarea name="rule" rows="40" id="rule" style="width:38%;height:300px;display:inline-block"><?php echo $theData; ?></textarea> <br />
                <button id="post" class="btn">CHECK</button> <button id="postx" class="btn">Scan With Local Rules</button><br /><br />
                
                 
       <h2>Regex quick reference</h2>    
<br />
<div class="alert-message block-message warning" style="width:38%;;display:inline-table">

    <table style="display:inline">
      <tbody bgcolor=""><tr>
        <td><code>[abc]</code></td>
        <td>A single character of: a, b or c</td>
      </tr>
      <tr>
        <td><code>[^abc]</code></td>
        <td>Any single character except: a, b, or c</td>
      </tr>
      <tr>
        <td><code>[a-z]</code></td>
        <td>Any single character in the range a-z</td>
      </tr>
      <tr>
        <td><code>[a-zA-Z]</code></td>
        <td>Any single character in the range a-z or A-Z</td>
      </tr>
      <tr>
        <td><code>^</code></td>
        <td>Start of line</td>
      </tr>
      <tr>
        <td><code>$</code></td>
        <td>End of line</td>
      </tr>
      <tr>
        <td><code>\A</code></td>
        <td>Start of string</td>
      </tr>
      <tr>
        <td><code>\z</code></td>
        <td>End of string</td>
      </tr>
    </tbody></table>
  </div>
  
<div class="alert-message block-message warning" style="width:30%;display:inline-table">
    <table style="display:inline">
      <tbody><tr>
        <td><code>.</code></td>
        <td>Any single character</td>
      </tr>
    <tr>
      <td><code>\s</code></td>
      <td>Any whitespace character</td>
    </tr>
    <tr>
      <td><code>\S</code></td>
      <td>Any non-whitespace character</td>
    </tr>
    <tr>
      <td><code>\d</code></td>
      <td>Any digit</td>
    </tr>
    <tr>
      <td><code>\D</code></td>
      <td>Any non-digit</td>
    </tr>
    <tr>
      <td><code>\w</code></td>
      <td>Any word character (letter, number, underscore)</td>
    </tr>
    <tr>
      <td><code>\W</code></td>
      <td>Any non-word character</td>
    </tr>
    <tr>
      <td><code>\b</code></td>
      <td>Any word boundary</td>
    </tr>
  </tbody></table>
</div>
<div class="alert-message block-message warning" style="width:23%;display:inline-table">
<table style="display:inline">
  <tbody><tr>
    <td><code>(...)</code></td>
    <td>Capture everything enclosed</td>
  </tr>
  <tr>
    <td><code>(a|b)</code></td>
    <td>a or b</td>
  </tr>
  <tr>
    <td><code>a?</code></td>
    <td>Zero or one of a</td>
  </tr>
  <tr>
    <td><code>a*</code></td>
    <td>Zero or more of a</td>
  </tr>
  <tr>
    <td><code>a+</code></td>
    <td>One or more of a</td>
  </tr>
  <tr>
    <td><code>a{3}</code></td>
    <td>Exactly 3 of a</td>
  </tr>
  <tr>
    <td><code>a{3,}</code></td>
    <td>3 or more of a</td>
  </tr>
  <tr>
    <td><code>a{3,6}</code></td>
    <td>Between 3 and 6 of a</td>
  </tr>        
</tbody></table>
</div>


<br />
<div id="regex_options" style="text-align:center">
	<p>
		options:
		<code>i</code> case insensitive
		<code>m</code> make dot match newlines
		<code>x</code> ignore whitespace in regex
		<code>o</code> perform #{...} substitutions only once
	</p>
</div>



         </div>

      </div>

      <footer>
        <p>G-Yara@2012</p>
      </footer>

    </div> <!-- /container -->

    <!--scripts-->

    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        


	<script>
    var loadUrl = "proc.php";
	
      $("#post").click(function(){  
    
            $("#post").attr("disabled", "true"); 
            $.post(  
                loadUrl,  
                {rule: $("#rule").val(), ayat: $("#content").val()},  
                function(responseText){  
                 
                    $("#result").html(responseText);  
                },  
                "html"  
            );
            $("#post").removeAttr("disabled");
        });  
    
      $("#postx").click(function(){  
    
            $("#postx").attr("disabled", "true"); 
            $.post(  
                loadUrl,  
                {rule: $("#rule").val(), ayat: $("#content").val(), scan: 1},  
                function(responseText){  
                 
                    $("#result").html(responseText);  
                },  
                "html"  
            );
    
            $("#postx").removeAttr("disabled");
        });
        </script>
  </body>
</html>