        <div class="blank"></div>
        <div id="back" title="返回顶部">
            <i class="ico ico-back"></i>
        </div>
		<script src="<?= wc_asset('libs/jquery-1.8.3.js') ?>"></script>
        <script src="<?= wc_asset('libs/jquery.SuperSlide.2.1.1.js') ?>"></script>
        <script src="<?= wc_asset('libs/jquery.lazyload.js') ?>"></script>
        <script src="<?= wc_asset('press/js/app.js') ?>"></script>

        
        <script>
            jQuery(".slidebox").slide({mainCell:".bd ul",autoPlay:true,effect:"left"});
        </script>
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $("img.lazy").lazyload({effect: "fadeIn",placeholder: "<?= wc_asset('press/images/lazydefault.png') ?>"});


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

