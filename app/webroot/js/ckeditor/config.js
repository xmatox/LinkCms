/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'youtube,MediaEmbed';

	config.toolbar = 'Meduim';
 
	config.toolbar_Meduim =
	[
		{ name: 'document', items : [ 'Source' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'paragraph2', items : [ 'Table','HorizontalRule','-','NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv' ] },
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Youtube','MediaEmbed','Smiley','SpecialChar','PageBreak','Iframe' ] }
		
	];
	config.toolbar_Full =
	[
		{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
	        'HiddenField' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
	];
	//KCFinder
	var prefix = config.contentsCss.split('js/ckeditor/contents.css');
	config.filebrowserBrowseUrl = prefix[0]+'/js/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = prefix[0]+'/js/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = prefix[0]+'/js/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = prefix[0]+'/js/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = prefix[0]+'/js/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = prefix[0]+'/js/kcfinder/upload.php?type=flash';
};
