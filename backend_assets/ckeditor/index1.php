<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
  
        <script src="/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/ckeditor/plugins/lite/lite-interface.js"></script>
    </head>
    <body>
        <form id="editor" action="submit.php" method="post">
		
	<!-- creating a text area for my editor in the form -->
        <textarea id="editor1" name="editor1"> 
		
		
		
	    </textarea>
 

	<script type="text/javascript">

	CKEDITOR.replace('editor1', {
      height: 300,

      // Configure your file manager integration. This example uses CKFinder 3 for PHP.
     // filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
      //filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
      //filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserUploadUrl: "upload/upload.php" ,
     // filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'

    });


	
	
	</script>
 
      
	<input type="submit" value="Submit data" class="button"/>
        </form>

    </body>
</html>
