<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>



<title>Crossbow - Login</title>



<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />

<meta name="author" content="Amarnath Bagineni" />

<meta name="description" content="Site Description Here" />

<meta name="keywords" content="keywords, here" />

<meta name="robots" content="index, follow, noarchive" />

<meta name="googlebot" content="noarchive" />

<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/CodeIgniter/css/Crossbowstyle.css" />
<script type="text/javascript" src="http://localhost/CodeIgniter/jquery/js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter/jquery/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter/jquery/js/jquery-1.8.0.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/CodeIgniter/jquery/css/ui-lightness/jquery-ui-1.8.22.custom.css" />

<script type="text/javascript" src="http://localhost/CodeIgniter/jquery_scripts/screen_scripts_loggedin.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter/javascripts/field_validations.js"></script>

<!-- see if you need this
	<script type="text/javascript" src="<?php echo base_url();?>javascripts/field_validations.js"></script>
-->

	<style type="text/css">
		#gallery{
			border: 1px solid #ccc; margin: 10px auto; width: 400px; padding: 10px;
		}
		
		#upload {
			border: 1px solid #ccc; margin: 10px auto; width: 770px; padding: 10px;
		}
		#blank_gallery {
			font-family: Arial; font-size: 18px; font-weight: bold;
			text-align: center;
		}
		.thumb {
			float: left; width: 150px; height: 100px; padding: 10px; margin: 10px; background-color: #ddd;
		}
		.thumb:hover {
			outline: 1px solid #999;
			text-decoration: none;
			border-bottom:none;
		}
		img {
			border: 0;
		}
		#gallery:after {
			content: "."; visibility: hidden; display: block; clear: both; height: 0; font-size: 0;
		}
		
		#upload_button{
			background: #B4DB6F;
			padding: 5px 20px 5px 20px;
			color: #FFF;
			height:30px;
			text-decoration: none;
			border: 1px solid #BADE7D;
			text-transform: uppercase;
			font-size: 10px;
			font-weight: bold;
			line-height: 20px;	
			display: block;
    		float: right;
    		margin-right:250px;
		}
		
		#upload_button:hover {
			background: #008EFD;
			border-color: #007DE2;
			
		}
	</style>
</head>
<body>
	<div id="wrap">
		<div id="header">							

		<h1 id="logo-text"><a href="index.html" title="">Crossbow</a></h1>		

		<p id="slogan">&nbsp; &nbsp; &nbsp; - Admissions </p>		

	

	<!--header ends-->					

	</div>
	
	<div id="gallery">
		<div id="selected_documents_list">
			<strong>Your Uploaded Documents</strong><hr style="color:#ddddd;"/>
			<table id="selec_document_list" width="100%">
			<?php if (isset($images) && count($images)):
		
			foreach($images as $image):	?>
		
					<?php
					$doc_url = $image['url'];
					$url_pieces = explode("/", $image['url']);
					$pieces_size = sizeof($url_pieces);
										
					$filename_pieces = explode("_", $url_pieces[$pieces_size - 1]);
					$real_filename = $filename_pieces[2];
					
					$row_id_pieces = explode(".", $real_filename);
					$row_id = $row_id_pieces[0];
					
					//trimming this .. and the candidate id is prefixed with this
					?>
					<tr id="<?php echo $row_id; ?>">
						<td> <a class="url_link" href="<?php echo $image['url']; ?>"><?php echo $real_filename; ?></a> </td>
						<td> <a id="del_sch" href="javascript:del_table_row_doc(<?php echo $row_id; ?>)">&nbsp;&nbsp; X &nbsp;&nbsp;</a> </td>
					</tr>
					
		
		<?php endforeach; else: ?>
			<div id="blank_gallery">Please Upload a Document</div>
		<?php endif; ?>
		
		</table>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	<div id="upload">
		<?php
		//testing session data
		$sess_array = $this->session->all_userdata();
		//print_r($sess_array);	
			
		echo form_open_multipart('gallery');
		echo '<div id="doc_err" style="color:red;padding-left:30px;">';
		if($error_data != "success")
		{
			echo $error_data;
		}	
		echo '</div>';
		echo '<table style="border:1px solid #aaaaa">';
		echo "<tr>";
		echo "<td>";
		echo '<label for="userfile">Choose file</label>&nbsp; &nbsp; &nbsp;<br/>';
		echo form_upload('userfile');
		echo '</td>';
		echo "<td>";
		echo '<label for="doc_name">Document Name</label>&nbsp; &nbsp; &nbsp;<br/>';
		echo '<div id="doc_fill">';
		echo '<select style="width:250px;" name="doc_name" id="doc_name">
				<option value="0">Select Document Name</option>
				<option value="1">Document 2</option>
				<option value="2">Document 3</option>
				<option value="3">Document 4</option>
				</select>';
		echo '</div>';		
			
		echo '</td>';
		echo '<td style="padding-left:40px;">';
		echo '<br/>';
		echo '<input name="upload" id="upload_button" type="submit" value="Upload" >';
		echo '</td>';
		echo '</tr>';
		//echo "<tr>";		
	//	echo "<td colspan=2>";		
	//	echo '<label for="doc_comments">Document Comments</label>&nbsp; &nbsp; &nbsp;<br/>';
	//	echo '<input name="doc_comments" id="doc_comments" type="text" style="width:400px;"/>';
	//	echo "</td>";
	//	echo "<td>";
		
	//	echo "</td>";
		//echo "</tr>";
		echo "</table>";
				
		echo form_close();
		?>		
	</div>
	
	<div style=" float:right;margin-right:150px;" class="stdlinks"><p><a style="border:1px solid #026FCB;color:#090909;" class="more-link" href="javascript:update_doc_db()">&nbsp; Done &nbsp;</a></p></div>

<!-- footer-bottom starts -->		
<div style="clear: both;"> </div>
	<div id="footer-bottom">

		<div class="bottom-left">

			<p>

			&copy; 2012 <strong>All Rights Reserved</strong>&nbsp; &nbsp; &nbsp;

			Crossbow pvt Ltd.

			</p>
		<!-- some dummy links .. used by jquery to navigate -->
		
		<a id="logout_click" href="login_form.php"></a>
		</div>
	</div>
	
		<!--<div class="bottom-right">

			<p>		

				<a href="index.php">Home</a> | 

				<a href="admissions.php">Admissions</a>	|			

				<a href="#">Find Schools</a> |

				<a href="#">Contact Us</a>								

			</p>

		</div> -->

	<!-- footer-bottom ends -->		

<!-- wrap ends here -->

	</div>
	
</body>
</html>