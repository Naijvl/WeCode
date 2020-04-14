(function () { 
    $(document).ready(function () {
        $(window).scroll(function(){
            var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
            //alert(scrollTop);
            if(scrollTop > 0){
                $("#sidebar").css("left", $("#sidebar").offset().left + 'px');  
                $("#sidebar").addClass("fixed"); 

            }
            else{
                $("#sidebar").removeClass("fixed");  
            }
        });


        //搜索
        $(".submit-btn").click(function () {
            $("#global-search").submit();
        });


        //点击登录、注册按钮
        $(".signbtn, .tologin-btn").click(function () {
            var index = 0;
            if ($(this).text() == '注册') {
                index = 1;
            }

            $(".small-wrapper .active").removeClass("active");
            $("#tab a").eq(index).addClass("active");
            $(".part").eq(index).addClass("active");

            $("#tab .line").css({
                left: $("#tab a").width() * index + 'px'
            });

            $("body").addClass("fadeIn");
        });


        $("#tab a").click(function () {
            $("#tab a").removeClass("active");
            $(this).addClass("active");


            var index = $(this).index();

            $("#tab .line").css({
                left: $(this).width() * index + 'px'
            });

            
            $(".part").removeClass("active");
            $(".part").eq(index).addClass("active");
        });

        //关闭登录弹窗
        $(".close-btn").click(function () {
            $("body").removeClass("fadeIn");
        });



        //ajax登录
        $(".fast-login").click(function () {
            $.ajax({
                type: 'post',
                url: ajaxUrl,
                data: {
                    'action':'ajax_login',
                    'username': $("#username").val(), 
                    'password': $("#password").val()
                },
                dataType:'json',
                success: function(result){
                    if (result.status == 'success') {
                        window.location.href = currentUrl;
                    } else {
                        showMsg(result.message, 2000); 
                    }
                },
                error: function(data){
                    showMsg(data, 2000); 
                }
            });

        });


        //ajax注册
        $(".fast-register").click(function () {
            
            var username = $("#username1").val();
            var password = $("#password1").val();
            var repeat_password = $("#password2").val();
            var email = $("#useremail1").val(); 

            //前端验证
            var reg = new RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
            var isEmail = reg.test(email);

            if (!isEmail) {
                showMsg('邮箱填写错误！', 2000); 
                return false;
            }

            if (password.length < 6) {
                showMsg('密码不能少于6位！', 2000); 
                return false;
            } else if (password != repeat_password) {
                showMsg('两次输入的密码不一致！', 2000); 
                return false;
            }

            $.ajax({
                type: 'post',
                url: ajaxUrl,
                data: {
                    'action': 'ajax_register',
                    'username': username, 
                    'password': password,
                    'repeat_password': repeat_password,
                    'email': email,                    
                },
                dataType:'json',
                success: function(result){
                    showMsg(result.message, 2000);                    
                },
                error: function(data){
                    showMsg(data, 2000); 
                }
            });

        });


        function showMsg(content, time) {
            $("#message-tips").addClass("active");
            $("#message-tips").text(content);
            setTimeout(function () {
                $("#message-tips").removeClass("active");
            }, time);
        }



        //关注、取消关注
        $(".follow-btn").click(function () {
            var userid = $(this).data("userid");
            var that = $(this);
            $.ajax({
                type: 'get',
                url: ajaxUrl,
                data: {
                    'action': 'ajax_follow',
                    'userid': userid                
                },
                dataType:'json',
                success: function(result){
                    if (result.status == '0') {
                        alert("已取消关注！");
                        that.text("关注");
                        $(".fans-number").text(parseInt($(".fans-number").text()) - 1);
                         
                    } else {
                        alert("关注成功！");
                        that.text("取消关注");
                        $(".fans-number").text(parseInt($(".fans-number").text()) + 1);
                        
                    }
                                       
                },
                error: function(data){
                    alert("发生未知错误，请联系管理员！");    
                }
            });
        });



        //【个人中心】关注、取消关注
        $(".mf-btn").click(function () {
            var id = $(this).data("id");
            var that = $(this);
            $.ajax({
                type: 'get',
                url: ajaxUrl,
                data: {
                    'action': 'ajax_follow',
                    'userid': id          
                },
                dataType:'json',
                success: function(result){
                    if (result.status == '0') {
                        alert("已取消关注！");
                        that.parents("li").remove();
                         
                    } else {
                        alert("关注成功！");
                        that.attr("disabled", "disabled").text("已关注");
                        
                    }
                                       
                },
                error: function(data){
                    alert("发生未知错误，请联系管理员！");    
                }
            });
        });

    });



} ());




