        <div class="layui-footer footer footer-demo">
            <div class="layui-main">
                <p>{{isset($website['thank_word'])?$website['thank_word']:''}}</p>
                <p>
                    <a href="/">
                        {{isset($website['website_filing'])?$website['website_filing']:''}}
                    </a>
                </p>
                <p>
                    <a href="./" target="_blank">
                        {{isset($website['tech_support'])?$website['tech_support']:''}}
                    </a>
                </p>
            </div>
        </div>
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </body>
</html>