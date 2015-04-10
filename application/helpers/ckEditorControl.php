<?php
defined ( 'DS' ) or die ( 'no direct access allowed' );
class ckEditorControl extends TextareaControl {
	function draw() {
		$id = $this->attributes ( 'id' );
		ob_start ();
		?>
<script>
            $(function() {
                CKEDITOR.replace('<?php echo $id ?>', {
                    filebrowserBrowseUrl: '/file/browse_file',
                    filebrowserImageBrowseUrl: '/file/browse_file/image',
                    filebrowserUploadUrl: '/uploader/upload.php',
                    filebrowserImageUploadUrl: '/uploader/upload.php?type=Images'
                });
            });
        </script>
<?php
		return parent::draw () . ob_get_clean ();
	}
}
