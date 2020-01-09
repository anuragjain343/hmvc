/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
/*CKEDITOR.config.extraPlugins = 'slideshow';*/
CKEDITOR.editorConfig = function( config ) {
	
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	/*CKEDITOR.config.language = 'en';*/
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.Slideshow
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	/*config.extraPlugins = 'slideshow'; 
	config.language = 'en'; */
 
	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	var mainurl = $('#weburl').attr('href');
//alert(mainurl);
	/*config.filebrowserImageBrowseUrl = mainurl+'backend_assets/ckeditor/kcfinder/browse.php?type=images';
    config.filebrowserImageUploadUrl = mainurl+'backend_assets/ckeditor/kcfinder/upload.php?type=images';
    *///alert(mainurl);
   /* config.filebrowserBrowseUrl      =  mainurl+'backend_assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl =  mainurl+'backend_assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
 */
	 
   config.filebrowserImageBrowseUrl = 'kcfinder/browse.php?type=images';
   //config.filebrowserImageUploadUrl = 'kcfinder/upload.php?type=images';
  
   config.filebrowserBrowseUrl      =  mainurl+'backend_assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl =  mainurl+'backend_assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserFlashBrowseUrl =  mainurl+'backend_assets/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';

 /* config.filebrowserUploadUrl    =    mainurl+'backend_assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl =  mainurl+'backend_assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
  config.filebrowserFlashUploadUrl =  mainurl+'backend_assets/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
*/



};
