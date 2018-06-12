
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
									<div class="widget-contact black f-12" style="">
										email: <a href="mailto:info@brendanCaffrey.com">Info@brendanCaffrey.com</a><br/>
										<!--telephone: <a href="tel:#"></a>-->
									</div>


								</div>
								<!-- Copyright End -->
								<!-- Social Networks Start -->
								<div class="col-sm-6 text-right">
									<ul>
										<li><a href="https://www.facebook.com/#/" target="_blank"><i class="fa fa-facebook fa-lg"></i></a></li>
										<li><a href="https://twitter.com/#" target="_blank"><i class="fa fa-twitter fa-lg"></i></a></li>
										<li><a href="https://plus.google.com/#" target="_blank"><i class="fa fa-google-plus fa-lg"></i></a></li>
										<!--<li><a href="#"><i class="fa fa-linkedin fa-lg"></i></a></li>
										<li><a href="#"><i class="fa fa-youtube fa-lg"></i></a></li>
										<li><a href="#"><i class="fa fa-skype fa-lg"></i></a></li>-->
									</ul>
									<div class="basic-grey f-10 mt-5">
									&copy; 2018 Brendan Caffrey Photography
									</div>
								</div>
								<!-- Social Networks End -->
							</div>
						</div>
					</div>
				</div>

		</footer>

		<!-- ============ FOOTER END ============ -->

		<!--<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-72953701-1', 'auto');
			ga('send', 'pageview');

		</script>-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADYs4rQ5IKqs3sU49JoR-bCWy_U4En4fE"
				type="text/javascript"></script>

		<?php wp_footer(); ?>
		</div> <!-- End Main Wrapper started in header -->
	</body>
</html>


