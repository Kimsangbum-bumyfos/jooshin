/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'ko';
	// config.uiColor = '#AADC6E';

	config.height = '400';

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	//폰트추가
	config.font_names = CKEDITOR.config.font_names = '본고딕_light/본고딕_light;나눔바른고딕/나눔바른고딕;맑은 고딕/Malgun Gothic;굴림/Gulim;돋움/Dotum;바탕/Batang;궁서/Gungsuh;' + CKEDITOR.config.font_names;

	config.removeButtons = 'Cut,Undo,Copy,Redo,Paste,PasteText,PasteFromWord,Find,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,RemoveFormat,CopyFormatting,Anchor,Flash,About,Save,NewPage,Templates,Preview,Print,PageBreak,Iframe,ShowBlocks,Language';
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.extraPlugins = 'youtube';

	//에디터 엔터처리 기본 br로 적용
	config.enterMode = CKEDITOR.ENTER_BR;

	//에디터 4.X 이상부터는 callback 함수 사용 시 해당 config설정 필요함 
	config.filebrowserUploadMethod = 'form';
	// config.filebrowserUploadUrl = '/makehome_user/admin/CKE_Upload/cke_upload';	

	config.allowedContent=true;
};

