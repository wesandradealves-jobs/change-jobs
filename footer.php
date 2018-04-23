            </main>
            <footer style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/footer.jpg);">
                <div class="container">
                    <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 text-center-xs center-block-xs">
                            <?php if ( get_theme_mod( 'blog_description' ) ) : ?>
                            <p><?php echo get_theme_mod( 'blog_description' ); ?></p>
                            <?php endif; ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right text-center-xs center-block-xs">
                                <p>
                                    Want to post a job?
                                    <br/><br/>
                                    <?php if ( get_theme_mod( 'blog_contact' ) ) : ?>
                                    Email <a href="mailto:<?php echo get_theme_mod( 'blog_contact' ); ?>"><?php echo get_theme_mod( 'blog_contact' ); ?></a>
                                    <?php endif; ?>
                                    <br/><br/>
                                    EC Global HQ<br/>
                                    <?php if ( get_theme_mod( 'blog_address' ) ) : ?>
                                    <?php echo get_theme_mod( 'blog_address' ); ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <a role="back-to-top" href="javascript:void(0)">back to top <i class="glyphicon glyphicon-menu-up"></i></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <?php wp_footer(); ?> 
        </body>
    </html>