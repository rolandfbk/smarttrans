<!DOCTYPE html>
<html lang="en">
<?php
require("utility.php");
require_once 'signature-to-image.php';

//$img1 = $_GET['img'];


	$sql10="select * from delivery where delivery.WORK_ORDER_NUMBER='GTW1044' order by CREATED_AT desc";
	$result10=ExecuteQuery($sql10);
	
	$sql30="select * from delivery2 where delivery2.WORK_ORDER_NUMBER='GTW1044' order by CREATED_AT desc";
	$result30=ExecuteQuery($sql30);
	
	$row10 = mysqli_fetch_array($result10);
	$json = $row10['ID'];
	
	$row30 = mysqli_fetch_array($result30);
	$json8 = $row30['ID'];


?>
<body>
<a class="btn jquery-word-export" href="javascript:void(0)"><button style="width:150px" class="btn btn-primary">Print Delivery Note</button></a>
	<div id="page-content">
		<?php
			echo"<iframe src='http://localhost/gantrans/test6.php?img=$json' width='250' height='200' frameborder='0'></iframe>";
		?>
	</div>
	
	 <script src="assets/js/jquery-1.10.2.js"></script>
	<script src="FileSaver.js"></script> 
	<script src="jquery.wordexport.js"></script>
	<script>
		if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
		(function($) {
			$.fn.wordExport = function(fileName) {
				fileName = typeof fileName !== 'undefined' ? fileName : "Delivery Note";
				var static = {
					mhtml: {
						top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
						head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
						body: "<body>_body_</body>"
					}
				};
				var options = {
					maxWidth: 624
				};
				// Clone selected element before manipulating it
				var markup = $(this).clone();

				// Remove hidden elements from the output
				markup.each(function() {
					var self = $(this);
					if (self.is(':hidden'))
						self.remove();
				});

				// Embed all images using Data URLs
				var images = Array();
				var img = markup.find('img');
				for (var i = 0; i < img.length; i++) {
					// Calculate dimensions of output image
					var w = Math.min(img[i].width, options.maxWidth);
					var h = img[i].height * (w / img[i].width);
					// Create canvas for converting image to data URL
					var canvas = document.createElement("CANVAS");
					canvas.width = w;
					canvas.height = h;
					// Draw image to canvas
					var context = canvas.getContext('2d');
					context.drawImage(img[i], 0, 0, w, h);
					// Get data URL encoding of image
					var uri = canvas.toDataURL("image/png");
					$(img[i]).attr("src", img[i].src);
					img[i].width = w;
					img[i].height = h;
					// Save encoded image to array
					images[i] = {
						type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
						encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
						location: $(img[i]).attr("src"),
						data: uri.substring(uri.indexOf(",") + 1)
					};
				}

				// Prepare bottom of mhtml file with image data
				var mhtmlBottom = "\n";
				for (var i = 0; i < images.length; i++) {
					mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
					mhtmlBottom += "Content-Location: " + images[i].location + "\n";
					mhtmlBottom += "Content-Type: " + images[i].type + "\n";
					mhtmlBottom += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
					mhtmlBottom += images[i].data + "\n\n";
				}
				mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";

				//TODO: load css from included stylesheet
				var styles = "";

				// Aggregate parts of the file together
				var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;

				// Create a Blob with the file contents
				var blob = new Blob([fileContent], {
					type: "application/msword;charset=utf-8"
				});
				saveAs(blob, fileName + ".doc");
			};
		})(jQuery);
	} else {
		if (typeof jQuery === "undefined") {
			console.error("jQuery Word Export: missing dependency (jQuery)");
		}
		if (typeof saveAs === "undefined") {
			console.error("jQuery Word Export: missing dependency (FileSaver.js)");
		}
	}




	$("a.jquery-word-export").click(function(event) {
				$("#page-content").wordExport();
			});
	</script>
</body>
</html>