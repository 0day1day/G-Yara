<?php
//--------------------------------
// G-Yara By ApoNIe
// twitter.com/GeeKzLIfe
//--------------------------------
include("config.php");
//--------------------------------

if (get_magic_quotes_gpc())
{
   $process = array(&$_POST);

    while (list($key, $val) = each($process))
    {
       foreach ($val as $k => $v)
       {
          unset($process[$key][$k]);
          if (is_array($v))
          {
             $process[$key][stripslashes($k)] = $v;
             $process[] = &$process[$key][stripslashes($k)];
          }
          else
          {
             $process[$key][stripslashes($k)] = stripslashes($v);
          }
       }
    }
    unset($process);
}

if (isset($_POST['rule'])){
	
	$fh = fopen($ruleFile, 'w') or die("can't open file");
	fwrite($fh, $_POST['rule']);
	fclose($fh);
}

if (isset($_POST['ayat'])){
	
	$fh = fopen($dumpFile, 'w') or die("can't open file");
	fwrite($fh, $_POST['ayat']);
	fclose($fh);
	$notice="";
	
	
	if ($_POST['scan'] == 1){ //scan with collection of rules
		$a = shell_exec("$yaraBinary -r $rulePath $dumpPath");
	}else{ //scan with single rule
		$a = shell_exec("$yaraBinary $singleRule $dumpPath");
	}

	if(strlen($a) == 0){
		$notice = '<div class="ui-state-highlight ui-corner-all">
					<p>
					<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
					<strong>Not Detected.</strong>
					
					</p>
					</div>';	
	}else{
		$a = str_replace("$dumpPath","",$a);
		
		$notice = '<div class="ui-state-error ui-corner-all" >
					<p>
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
					<strong>Detected:</strong>
					<strong>'.$a.'</strong>
					</p>
					</div>';	
	}
}

echo $notice;

?>
