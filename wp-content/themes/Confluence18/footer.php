<?php
//Social Media Icons
    $fb_url = cws_theme_get_option( 'cws_theme_facebookurl' );
    $twitter_url = cws_theme_get_option( 'cws_theme_twitterurl' );
    $youtube_url = cws_theme_get_option( 'cws_theme_youtubeurl' );
    $in_url = cws_theme_get_option( 'cws_theme_linkedinurl' );
    $gp_url = cws_theme_get_option( 'cws_theme_googleplusurl' );
    $instagram_url = cws_theme_get_option( 'cws_theme_instagramurl' );
    $email = cws_theme_get_option( 'cws_theme_email' );
    $phone = cws_theme_get_option( 'cws_theme_phone' );
    $ga_code = cws_theme_get_option( 'cws_theme_ga_code' );
    $copyright = cws_theme_get_option( 'cws_theme_copyright' );
    //$wildcarld_icon = cws_confluence_get_option( 'cws_confluence_wild_icon' );
    //$wildcard_url = cws_confluence_get_option( 'cws_confluence_wild_url' );
?>
<!-- ============ FOOTER START ============ -->

		<footer class="white">

				<div id="widgets">
					<div class="container-fluid">
						<div class="limit-width-footer">
							<div class="row">

								<!-- About Us Start -->
								<div class="col-sm-3 widget">
									<?php if ( ! dynamic_sidebar('footer1')) : ?>
									<?php endif; ?>
								</div>
								<!-- About Us End -->

								<!-- Quick Links Start -->
								<div class="col-sm-3 widget">
									<?php if ( ! dynamic_sidebar('footer2')) : ?>
									<?php endif; ?>
								</div>
								<!-- Quick Links End -->

								<!-- Newsletter Start -->
								<div class="col-sm-3 widget">
									<?php if ( ! dynamic_sidebar('footer3')) : ?>
									<?php endif; ?>
								</div>
								<!-- Newsletter End -->

								<!-- Contact Start -->
								<div class="col-sm-3 widget">
									<?php if ( ! dynamic_sidebar('footer4')) : ?>
									<?php endif; ?>
								</div>
								<!-- Contact End -->

							</div>
						</div>
					</div>
				</div>
				<div id="credits">
					<div class="container-fluid">
						<div class="limit-width">
							<div class="row">
								<!-- Copyright Start -->
								<div class="col-sm-6">
                                    <div class="basic-grey f-10 mt-5">
                                        <?php if ($copyright != '') {?>
                                            <?= $copyright; ?>
                                        <?php }; ?>
                                    </div>
                                </div>
								<!-- Copyright End -->
								<!-- Social Networks Start -->
								<div class="col-sm-6 text-right">
                                    <div class="widget-contact black f-12" style="">
                                        <?php if ($email != '') {?>
                                            email:<a href="mailto:<?= $email; ?>"> <?= $email; ?></a>
                                        <?php }; ?>
                                        <br/>
                                        <!--telephone: <a href="tel:#"></a>-->
                                        <?php if ($phone != '') {?>
                                            telephone:<a href="tel:<?= $phone; ?>"> <?= $phone; ?></a>
                                        <?php }; ?>
                                    </div>
									<ul>
                                        <?php if ($fb_url != '') {?>
                                            <li><a href="<?= $fb_url; ?>" class="fa fa-facebook fa-lg" target="_blank"></a></li>
                                        <?php }; ?>
                                        <?php if ($twitter_url != '') {?>
                                            <li><a href="<?= $twitter_url; ?>" class="fa fa-twitter fa-lg" target="_blank"></a></li>
                                        <?php }; ?>
                                        <?php if ($gplus_url != '') {?>
                                            <li><a href="<?= $gplus_url; ?>" class="fa fa-google-plus fa-lg" target="_blank"></a></li>
                                        <?php }; ?>
                                        <?php if ($youtube_url != '') {?>
                                            <li><a href="<?= $youtube_url; ?>" class="fa fa-youtube fa-lg" target="_blank"</a></li>
                                        <?php }; ?>

                                        <?php if ($instagram_url != '') {?>
                                            <li><a href="<?= $instagram_url; ?>" class="fa fa-instagram fa-lg" target="_blank"></a></li>
                                        <?php }; ?>
                                        <?php if (empty($in_url) && empty($fb_url) && empty($youtube_url) && empty($gplus_url) && empty($twitter_url) && empty($instagram_url)) {?>
                                            <li>Add Social Media Urls to the Site Options</li>
                                        <?php }; ?>
                                    </ul>

								</div>
								<!-- Social Networks End -->
							</div>
						</div>
					</div>
				</div>

		</footer>

		<!-- ============ FOOTER END ============ -->
        <?php if ($ga_code != '') {?>
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '<?= $ga_code; ?>', 'auto');
                ga('send', 'pageview');

            </script>

        <?php }; ?>
		<!---->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADYs4rQ5IKqs3sU49JoR-bCWy_U4En4fE"
				type="text/javascript"></script>

		<?php wp_footer(); ?>
		</div> <!-- End Main Wrapper started in header -->
	</body>
</html>


