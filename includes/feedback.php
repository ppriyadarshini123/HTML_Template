<?php
/**
 *
 * PHP course project
 * url: /includes/feedback.php
 */
?>
<section class="feedback">
    <?php if (isset($successMsg)) { ?>
        <div><?php echo $successMsg; ?></div>
        <?php
    } // if success msg
    if (isset($failMsg)) {
        ?>
        <div><?php echo $failMsg; ?></div>
    <?php } // if fail msg  ?>
</section><!--/feedBack-->


