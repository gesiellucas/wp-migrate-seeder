<?php
/*
Template Name: Custom Blog Page Template
*/

get_header();

?>
<main id="primary" class="content-area bg-white min-h-[100vh]">
    <?php lpcpt_render_header(); ?>

    <?php lpcpt_one_post($_GET['postid']); ?>
    
    <?php lpcpt_render_footer(); ?>
</main>

<?php
get_footer();