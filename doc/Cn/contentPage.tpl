<!DOCTYPE html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {if isset($page.config.title)}<title>{$page.config.title}</title>{/if}
    {if isset($page.config.meta)}
        {foreach from=$page.config.meta item=item key=key}
            <meta name="{$item.name}" content="{$item.content}">
        {/foreach}
    {/if}
    <style>
        .fa-angle-right::before {
            padding-right:0.3rem
        }
        .fa-angle-down::before {
            padding-right:0.3rem
        }
        li{
            line-height: 1.7rem !important;
        }
        .sideBar-toggle-button {
            display: block;
            position: fixed;
            left: 10px;
            bottom: 15px;
            z-index: 99;
        }
        .right-menu{
            width: 230px;
            position: fixed;
            right: 15px;
            top: 120px;
            min-height: 1px;
            z-index: 99;
            border: 1px solid #EEEEEE;
            border-radius: 0 3px 3px 3px;
            background-color: #fff;
            padding: 10px;
            max-height: 70%;
            overflow-y: auto;
        }
        .right-menu::-webkit-scrollbar{
            display:none;
        }
        .right-menu > .title {
            color: #aaaaaa;
            background-color: #fff;
            width: 100%;
            right: 15px;
            padding-left: 0.1em;
            line-height: 200%;
            border-bottom: 1px solid #EEEEEE;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            .right-menu {
                display:none;
            }
            #live2d-widget {
                display: none;
            }
        }

        .right-menu > li{
            list-style-type: none;
            padding-left:5px;
            padding-top: 5px;
        }
        .right-menu > li > a.active{
            color:#ff0006;
        }

        @media screen and (min-width: 700px) {
            .layout-2 .sideBar {
                width: 0 !important;
            }
            .layout-2 .mainContent {
                padding-left: 0 !important;
            }
            .navBar-menu-button {
                display: none;
            }
        }

        @media screen and (max-width: 700px) {
            .layout-1 .sideBar {
                width: 0 !important;
            }
            .layout-1 .mainContent {
                padding-left: 0 !important;
            }
            .container .navBar .navInnerRight {
                position: fixed !important;
                top: 3.6rem;
                left: 0 !important;
                right: 0 !important;
                padding: 0 1.5rem .5rem 1.5rem;
                display: none;
            }
            .navInnerRight > div {
                display: block !important;
                margin-left: 0 !important;
            }
            .navSearch > input {
                width: 100% !important;
                box-sizing: border-box;
            }
            .navBar-menu-button {
                display: block;
                float: right;
            }
            .sideBar-toggle-button {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="/Css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Css/highlight.css">
    <link rel="stylesheet" href="/Css/markdown.css">
    <link rel="stylesheet" href="/Css/content.css">
</head>
<body>
<div class="container layout-1">
    <a class="sideBar-toggle-button" href="javascript:;">
        <i class="fa fa-bars" style="font-size: 1.3rem;color: #333;"></i>
    </a>
    <header class="navBar">
        <div class="navInner">
            <a href="/">
                <img src="/Images/docNavLogo.png" alt="">
            </a>
            <a class="navBar-menu-button" href="javascript:;">
                <i class="fa fa-bars" style="font-size: 1.3rem;color: #333;"></i>
            </a>
            <div class="navInnerRight">
                <div class="navSearch">
                    <input aria-label="Search" autocomplete="off" spellcheck="false" class="" placeholder="" id="SearchValue">
                    <div class="resultList" id="resultList" style="display: none"></div>
                </div>
                <div class="navItem">
                    <div class="dropdown-wrapper">
                        <a href="/wstool.html" style="text-decoration:none;">websocket????????????</a>
                        {*{if $lang eq 'Cn'}*}
                            {*<a href="/wstool.html" style="text-decoration:none;">websocket????????????</a>*}
                        {*{else if}*}
                            {*<a href="/wstool.html" style="text-decoration:none;">websocket test online</a>*}
                        {*{/if}*}
                    </div>
                </div>
                <div class="navItem lang-select">
                    <div class="dropdown-wrapper">
                        <button type="button" aria-label="Select language" class="dropdown-title">
                            <span class="title">Language</span> <span class="arrow right"></span>
                        </button>
                        {*<ul class="nav-dropdown">*}
                        <ul class="nav-dropdown" style="display: none;">
                            {*{foreach from=$allowLanguages item=lang key=key}*}
                                {*<li class="dropdown-item">*}
                                    {*<a href="javascript:void(0)" data-lang="{$key}" class="nav-link lang-change">{$lang}</a>*}
                                {*</li>*}
                            {*{/foreach}*}
                            <li class="dropdown-item">
                                <a data-lang="Cn" class="nav-link lang-change" href="http://www.easyswoole.com">????????????</a>
                            </li>
                            <li class="dropdown-item">
                                <a data-lang="En" class="nav-link lang-change" href="http://english.easyswoole.com">English</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <aside class="sideBar">{$sideBar}</aside>
    <section class="mainContent">
        <div class="content markdown-body">{$page.html}</div>
        <div class="right-menu" id="right-menu"></div>
    </section>
</div>

</body>
{literal}
<script src="/Js/jquery.min.js"></script>
<script src="/Js/highlight.min.js"></script>
<script src="/Js/Layer/layer.js"></script>
<script src="/Js/global.js"></script>
<script src="/Js/js.cookie.min.js"></script>
<script src="/Js/global.js"></script>
<script>
    (function($) {
        var container = $('.container');
        $('.sideBar a').on('click', function() {
            container.removeClass('layout-2');
            container.addClass('layout-1');
        });
        var changeLayout = function() {
            if (container.hasClass('layout-1')) {
                container.removeClass('layout-1');
                container.addClass('layout-2');
            } else {
                container.removeClass('layout-2');
                container.addClass('layout-1');
            }
        };
        $('.sideBar-toggle-button, .navBar-menu-button').on('click', changeLayout);
    })(jQuery);
</script>
<script>
    hljs.initHighlightingOnLoad();
    $(document).ready(function() {
        function layerOpen(title,url)
        {
            $.ajax({
                url: url,
                method: 'POST',
                success: function (res) {
                    var newHtml = $(res);
                    var newBody = newHtml.find('.markdown-body').eq(0).html();
                    layer.open({
                        type: 1,
                        title: title,
                        shadeClose: true,
                        shade: false,
                        maxmin: true,
                        area: ['893px', '600px'],
                        content: "<div style='padding-left: 5rem'>"+newBody+"<\/div>"
                    });
                }
            });
        }
        $('layerOpen').click(function (obj){
            layerOpen($(this).html(),$(this).attr('href'));
        });

        /********** ????????????????????? **************/
        $.each($('.sideBar li:has(li)'), function () {
            $(this).attr('isOpen', 0).addClass('fa fa-angle-right');
        });

        $('.sideBar li:has(ul)').click(function (event) {
            if (this == event.target) {
                $(this).children().toggle('fast');
                if ($(this).attr('isOpen') == 1) {
                    $(this).attr('isOpen', 0);
                    $(this).removeClass('fa fa-angle-down');
                    $(this).addClass('fa fa-angle-right');
                } else {
                    $(this).attr('isOpen', 1);
                    $(this).removeClass('fa fa-angle-right');
                    $(this).addClass('fa fa-angle-down');
                }
            }
        });
        // ????????????????????????
        $.each($('.sideBar ul li a'), function () {
            $(this).filter("a").css("text-decoration", "none").css('color', '#2c3e50');
            if ($(this).attr('href') === window.location.pathname) {
                $(this).filter("a").css("text-decoration", "underline").css('color', '#0080ff');
                var list = [];
                var parent = this;
                while (1) {
                    parent = $(parent).parent();
                    if (parent.hasClass('sideBar')) {
                        break;
                    } else {
                        parent.click();
                    }
                }
            }
        });

        var articles = [];
        $.ajax({
            url: '/keywordCn.json',
            success: function (data) {
                articles = data;
            }
        });

        /**
         * ???????????????
         * @param keyword
         */
        function searchKeyword(keyword) {
            var result = [];
            articles.forEach(function (value) {
                var score = 0;
                !value.content && (value.content = '');
                var titleCount = value.title.match(new RegExp(keyword, 'g'));
                var contentCount = value.content.match(new RegExp(keyword, 'g'));
                if ( titleCount && titleCount.length > 0 ) {
                    score += titleCount.length * 100;
                } else if ( contentCount && contentCount.length > 0 ) {
                    score += contentCount.length;
                }

                // ????????????????????????
                var contentDesc = '';
                if ( contentCount ) {
                    var keywordIndex = value.content.indexOf(keyword);
                    contentDesc += value.content.slice(keywordIndex - 10, keywordIndex);
                    contentDesc += "<span class='searchKeyword'>" + keyword + "</span>";
                    contentDesc += value.content.slice(keywordIndex + keyword.length, keywordIndex + 30);
                }

                if ( score > 0 ) {
                    var searchResult = {
                        score: score,
                        hitType: titleCount ? 'title' : 'content',
                        title: value.title,
                        link: value.link,
                        contentDesc: titleCount ? value.title : contentDesc + '...',
                    };

                    result.push(searchResult);
                }
            });
            // ????????????
            result.sort(function (a, b) {
                return b.score - a.score;
            });

            // ????????????Dom
            var searchDom = '';
            result.forEach(function (value) {
                var dom = [
                    '<div class="resultItem">',
                    '<a href="' + value.link + '" class="resultLink">',
                    '<div class="resultTitle">' + value.title + '</div>',
                    value.hitType !== 'title' ? '<div class="resultDesc">' + value.contentDesc + '</div>' : '',
                    '</a></div>'
                ];
                searchDom += dom.join('');
            });

            $('#resultList').html(searchDom).show(100);
        }

        // ????????????
        function debounce(func, wait) {
            let timer;
            return function () {
                let context = this; // ?????? this ??????
                let args = arguments; // arguments?????????e
                if ( timer ) clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args)
                }, wait)
            }
        }

        // ??????????????????
        $('#SearchValue').on('input', debounce(function (e) {
            searchKeyword($('#SearchValue').val())
        }, 300)).on('blur', function () {
            $('#resultList').hide();
        });

        // ??????????????????????????????????????????????????????
        $('#resultList').on('mousedown', function (e) {
            e.preventDefault();
        });

        // ???????????????
        $('.lang-select').mouseover(function (e) {
            $('.nav-dropdown').toggle();
        });
        $('.lang-select').mouseout(function (e) {
            $('.nav-dropdown').toggle();
        });

        $('.lang-change').click(function (e) {
            var lang = $(this).data('lang');
            href = window.location.href;
            href = href.replace('/{$lang}','/'+lang);
            Cookies.set('language', lang);
            window.location.href = href
        });

        // ??????????????????????????????????????????
        $('.sideBar ul li a').on('click', function () {
            $.each($('.sideBar ul li a'), function () {
                $(this).filter("a").css("text-decoration", "none").css('color','#2c3e50');
            });
            $(this).filter("a").css("text-decoration", "underline").css('color','#0080ff');
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                method: 'POST',
                success: function (res) {
                    window.history.pushState(null,null,href);
                    var newHtml = $(res);
                    document.title = newHtml.filter('title').text();
                    var metaList = ['keywords','description'];
                    for (var i in metaList){
                        var col = metaList[i];
                        var newVal = newHtml.filter('meta[name='+col+']').attr('content');
                        if(!newVal){
                            newVal = '';
                        }
                        $('meta[name="'+col+'"]').attr("content", newVal);
                    }
                    $('.markdown-body').html(newHtml.find('.markdown-body').eq(0).html());
                    hljs.initHighlighting.called = false;
                    hljs.initHighlighting();
                    window.scrollTo(0, 0);
                    renderRightMenu();
                }
            });
            return false;
        });

        // ????????????
        renderRightMenu();

        // $('.fa_li').on('click', function(event) {
        //     event.stopPropagation();
        //     event.preventDefault()
        //     $(this).find('ul:first').slideToggle()
        //     if ($(this).hasClass('fa-angle-right')) {
        //         $(this).removeClass('fa-angle-right').addClass('fa-angle-down')
        //     } else if ($(this).hasClass('fa-angle-down')) {
        //         $(this).removeClass('fa-angle-down').addClass('fa-angle-right')
        //     }
        // })
        // $('.sideBar-toggle-button').click(function() {
        //     $('.sideBar').toggle()
        // })
        /********** ????????????????????? **************/
        /********** ??????????????????????????? **************/
        // $('.lang-select').hover(function() {
        //     $('.dropdown-wrapper .nav-dropdown').toggle()
        // })
        // $('.dropdown-wrapper .nav-dropdown').toggle()
        /********** ??????????????????????????? **************/
    });

    function dragFunc(id) {
        var Drag = document.getElementById(id);
        Drag.onmousedown = function(event) {
            var ev = event || window.event;
            event.stopPropagation();
            var disX = ev.clientX - Drag.offsetLeft;
            var disY = ev.clientY - Drag.offsetTop;
            document.onmousemove = function(event) {
                var ev = event || window.event;
                Drag.style.left = ev.clientX - disX + "px";
                Drag.style.top = ev.clientY - disY + "px";
                Drag.style.cursor = "move";
            };
        };
        Drag.onmouseup = function() {
            document.onmousemove = null;
            this.style.cursor = "default";
        };
    }

    // ***?????????????????????**
    function renderRightMenu()
    {
        var rightMenu = [];
        $(".markdown-body").children().each(function(index, element) {
            var tagName=$(this).get(0).tagName;
            if(tagName.substr(0,1).toUpperCase()=="H"){
                var contentH=$(this).text();//????????????
                var markid="mark-"+tagName+"-"+index.toString();
                $(this).attr("id",contentH);//?????????h????????????id
                var level = tagName.substr(1,2);
                rightMenu.push({
                    level: level,
                    content: contentH,
                    markid: markid,
                });
            }
        });
        $('.right-menu').empty();
        $('.right-menu').append("<div class='title'><i class='fa fa-list'></i> ????????????</div>");
        $.each(rightMenu, function (index, item) {
            var padding_left = (item.level - 1) * 12 +"px";
            $('.right-menu').append("<li style='padding-left:"+padding_left+"'><a href='#"+item.content+"' class='right-menu-item'>"+item.content+"</a></li>");
        });
        // ??????????????????????????????????????????????????????????????????????????????
        $('.right-menu').on('click','a',function(){
            // ???????????? ????????????
            var that = $(this);
            setTimeout(function (that) {
                $(".right-menu-item.active").removeClass("active");
                that.addClass("active");
            }, 50, that);
        });
        // ??????????????????
        $('.right-menu .title').on('click', function(){
            $(this).siblings().toggle();
        });
        dragFunc("right-menu");
    }
</script>
{/literal}

</html>