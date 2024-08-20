<?php if ( $fb = get_field( 'hownd_facebook_url', 'option' ) ) : ?>
    <a href="<?php echo $fb; ?>" class="fab fa-square-facebook" target="_blank"></a>
<?php endif; ?>
<?php if ( $twitter = get_field( 'hownd_x_url', 'option' ) ) : ?>
    <a href="<?php echo $twitter; ?>" class="fab fa-square-x-twitter" target="_blank"></a>
<?php endif; ?>
<?php if ( $ig = get_field( 'hownd_instagram_url', 'option' ) ) : ?>
    <a href="<?php echo $ig; ?>" class="fab fa-square-instagram" target="_blank"></a>
<?php endif; ?>