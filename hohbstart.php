<?php
function pfa($arr){
	echo '<pre>';	
		print_r($arr);
	echo '</pre>';		
}
/*
$ip=$_SERVER['REMOTE_ADDR']; 
if ($ip != '37.153.208.146') { 
echo '
<style>
  html, body {
    height: 100%;
  }
  #tableContainer-1 {
    height: 100%;
    width: 100%;
    display: table;
  }
  #tableContainer-2 {
    vertical-align: middle;
    display: table-cell;
    height: 100%;
  }
  #myTable {
    margin: 0 auto;
  }
</style>
<div id="tableContainer-1">
  <div id="tableContainer-2">
    <table id="myTable">
      <tr><td><img src="http://tools.dev-hohb.nl/Wordpress/wordpress.png"></td></tr>
    </table>
  </div>
</div>
';
	exit;
} 
*/
if (isset($_POST['filename']) && $_POST['filename'] != '' && !empty($_POST['filename'])){
	



 	function recurse_copy($src,$dst) { 
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
    } 
	function deleteDirectory($directory) {
		if(!$dh=opendir($directory)) {
			return false;
		}
		while($file=readdir($dh)) {
			if($file == "." || $file == "..") {
				continue;
			}
			if(is_dir($directory."/".$file)) {
				deleteDirectory($directory."/".$file);
			}
			if(is_file($directory."/".$file)) {
				unlink($directory."/".$file);
			}
		}
		closedir($dh);
		rmdir($directory);
	}

	$url = $_POST['filename'];
	$fh = fopen(basename($url), "wb");
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FILE, $fh);
	curl_exec($ch);
	curl_close($ch);
	$filenameTemp =  end(explode('/', $_POST['filename']));

	$path = dirname(__FILE__).'/';
	$filename = $path.$filenameTemp;
	
 	/* PHP current path */
  	$path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
  	$filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  	$filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
 
  	$targetdir = $path . $filenoext; // target directory
  	$targetzip = $path . $filename; // target zip file
  	//echo $filename.' -> '.$targetzip;
  	/* create directory if not exists', otherwise overwrite */
  	/* target directory is same as filename without extension */
 
 
 
  	/* here it is really happening */
 
	
	$zip = new ZipArchive();
	if ($zip->open($filenameTemp) === TRUE) {
		$zip->extractTo(dirname(__FILE__).'/');
		$zip->close();
		recurse_copy('wordpress' , dirname(__FILE__).'/' );
		deleteDirectory('wordpress');
		unlink($filenameTemp);

		
	} else {
		echo 'Oops';
	}


	if (isset($_POST['themes'])){
		foreach($_POST['themes'] as $theme){
//			$handle = opendir('ftp://tools:4102rrnAR@tools.dev-hohb.nl/public_html/Wordpress/Themes/'.$theme) || die();
			$url = 'http://tools.dev-hohb.nl/Wordpress/Themes/'.$theme;
			
			$fh = fopen(basename($url), "wb");
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fh);
			curl_exec($ch);
			curl_close($ch);
			$filenameTemp =  end(explode('/', $url));
		
			$path = dirname(__FILE__).'/';
			$filename = $path.$filenameTemp;
			
			/* PHP current path */
			$path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
			$filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
			$filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
		 
			$targetdir = $path . $filenoext; // target directory
			$targetzip = $path . $filename; // target zip file
			$zip = new ZipArchive();
			if ($zip->open($filenameTemp) === TRUE) {
				$zip->extractTo(dirname(__FILE__).'/wp-content/themes/');
				$zip->close();
				unlink($filenameTemp);
			} else {
				echo 'Oops';
			}
		}
	}
	
	if (isset($_POST['plugins'])){
		foreach($_POST['plugins'] as $plugins){
//			$handle = opendir('ftp://tools:4102rrnAR@tools.dev-hohb.nl/public_html/Wordpress/Themes/'.$theme) || die();
			$url = 'http://tools.dev-hohb.nl/Wordpress/Plugins/'.$plugins;
			
			$fh = fopen(basename($url), "wb");
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fh);
			curl_exec($ch);
			curl_close($ch);
			$filenameTemp =  end(explode('/', $url));
		
			$path = dirname(__FILE__).'/';
			$filename = $path.$filenameTemp;
			
			/* PHP current path */
			$path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
			$filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
			$filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
		 
			$targetdir = $path . $filenoext; // target directory
			$targetzip = $path . $filename; // target zip file
			$zip = new ZipArchive();
			if ($zip->open($filenameTemp) === TRUE) {
				$zip->extractTo(dirname(__FILE__).'/wp-content/plugins/');
				$zip->close();
				unlink($filenameTemp);
			} else {
				echo 'Oops';
			}
		}
	}
	$redirect = $_SERVER['SERVER_NAME'].''.str_replace('hohbstart.php','',$_SERVER['REQUEST_URI']);
		//unlink('hohbstart.php');			
		header("Location: http://".$redirect);
		die();


} else {
	?>
    <!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HoHB installatie Wordpress</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<div class="container"> 
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-6 col-sm-offset-3">
            <h2>Wordpress versie</h2>
            <p>Ga naar <a href="https://nl.wordpress.org/">https://nl.wordpress.org/</a> en kopieer de link van de laatste versie<br />
            bijvoorbeeld : https://nl.wordpress.org/wordpress-4.X.X-nl_NL.zip</p>
            <form role="form" method="POST">
              <div class="form-group">
                <label for="filename">Bestandsnaam:</label>
                <input type="text" class="form-control" id="filename" name="filename">
              </div>
              <h2>Thema's</h2>
              <p>Welke thema's dienen er geinstalleerd te worden?</p>
              <?php
				$ch = curl_init();
				$timeout = 5; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, 'http://tools.dev-hohb.nl/Wordpress/themes.php');
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				
				// display file
				$array = json_decode($file_contents, true);
				foreach ($array as $themes){
				echo '
							  <div class="checkbox">
								  <label>
									<input type="checkbox" name="themes[]" value="'.str_replace('Themes/','',$themes).'">
									'.ucfirst(str_replace('.zip','',str_replace('Themes/','',$themes))).'
								  </label>
							  </div>
				';
				
				}
			  ?>              
              <h2>Plugins</h2>              
              <p>Welke plugins dienen er geinstalleerd te worden?</p>
              <?php
				$ch = curl_init();
				$timeout = 5; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, 'http://tools.dev-hohb.nl/Wordpress/plugins.php');
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				
				// display file
				$array = json_decode($file_contents, true);
				foreach ($array as $plugins){
				echo '
							  <div class="checkbox">
								  <label>
									<input type="checkbox" name="plugins[]" value="'.$plugins.'">
									'.ucfirst(str_replace('.zip','',str_replace('-',' ',$plugins))).'
								  </label>
							  </div>
				';
				
				}
			  ?>
              
              <input type="submit" class="btn btn-default" value="starten">
              
            </form>
        </div>
       
      </div>

      <hr>

      <footer>
        <p>© HoHB <?php echo date('Y') ?></p>
      </footer>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>

   
    <?php	
}
		
?>