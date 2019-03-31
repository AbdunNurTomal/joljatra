/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var bse_url=$('#base_url').val()+"/";
	config.filebrowserBrowseUrl = bse_url+'kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = bse_url+'kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = bse_url+'kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = bse_url+'kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = bse_url+'kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = bse_url+'kcfinder/upload.php?opener=ckeditor&type=flash';
};
