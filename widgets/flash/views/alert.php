<?php
/**
 * @var $var
 * @var $message
 */
?>
<div class="alert alert-success alert-dismissible alert-fadeable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?= $message ?>
</div>
<script>
    $(function(){
        $('.alert-fadeable').delay(1500).fadeOut(500);
    });
</script>