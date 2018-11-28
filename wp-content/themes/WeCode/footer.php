        <div class="blank"></div>
        <div id="back" title="返回顶部">
            <i class="ico ico-back"></i>
        </div>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.8.3.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.SuperSlide.2.1.1.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.lazyload.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/js/common.js"></script>
        
        <script>
            jQuery(".slidebox").slide({mainCell:".bd ul",autoPlay:true,effect:"left"});
        </script>
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $("img.lazy").lazyload({effect: "fadeIn",placeholder: "<?php bloginfo('template_url'); ?>/images/lazydefault.png"});


                $(document).ready(function(){ 
                    $("#back").click(function(){ 
                        $("html,body").animate({ 
                            'scrollTop':'0' 
                        }); 
                    });
                });
            });
        </script>
    </body>
</html>

