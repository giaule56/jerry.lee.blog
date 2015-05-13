<?php
/*
 * Footer box (sidebar) section of Profound theme
 * 
 * @package Profound
 */
?>

</div> <!-- main section ends -->

<?php
    if ( ! is_active_sidebar( 'footerbox_sidebar_1'  ) &&
          ! is_active_sidebar( 'footerbox_sidebar_2'  ) &&
          ! is_active_sidebar( 'footerbox_sidebar_3'  )
    ) return ?>

        <div class="footerbox-bg-section clearfix">
            <div id="footerbox-section" class="footerbox-section grid-col-16 clearfix">
                <div id="footerbox-col-1" class="footerbox-col-1 footerbox-cols grid-col-33 grid-float-left">
                    <?php dynamic_sidebar( 'footerbox_sidebar_1'  ); ?>
                </div>
                <div id="footerbox-col-2" class="footerbox-col-2 footerbox-cols grid-col-33 grid-float-left">
                    <?php dynamic_sidebar( 'footerbox_sidebar_2'  ); ?>
                </div>
                <div id="footerbox-col-3" class="footerbox-col-3 footerbox-cols grid-col-33 grid-float-left">
                    <?php dynamic_sidebar( 'footerbox_sidebar_3'  ); ?>
                </div>
            </div> <!-- footerbox section ends -->
        </div>
