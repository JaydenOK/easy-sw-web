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
</head>
<link rel="stylesheet" href="/Css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/Css/highlight.css">
<link rel="stylesheet" href="/Css/markdown.css">
<link rel="stylesheet" href="/Css/content.css">


<body>
<div class="container">
    <a class="sideBar-toggle-button">
        <i class="fa fa-bars" style="font-size: 1.3rem;color: #333;"></i>
    </a>
    <header class="navBar">
        <div class="navInner">
            <a href="/">
                <img src="https://www.easyswoole.com/Images/docNavLogo.png" alt="">
            </a>
        </div>
    </header>
    <aside class="sideBar">{$sideBar}</aside>
    <section class="mainContent">
        <div class="content markdown-body">{$page.html}</div>
    </section>
</div>

</body>
{literal}
    <script src="/Js/jquery.min.js"></script>
    <script src="/Js/highlight.min.js"></script>
    <script src="/Js/Layer/layer.js"></script>
    <script src="/Js/global.js"></script>
    <script>
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




            hljs.initHighlightingOnLoad();


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

            $('.fa_li').on('click', function(event) {
                event.stopPropagation();
                event.preventDefault()
                $(this).find('ul:first').slideToggle()
                if ($(this).hasClass('fa-angle-right')) {
                    $(this).removeClass('fa-angle-right').addClass('fa-angle-down')
                } else if ($(this).hasClass('fa-angle-down')) {
                    $(this).removeClass('fa-angle-down').addClass('fa-angle-right')
                }
            })
            $('.sideBar-toggle-button').click(function() {
                $('.sideBar').toggle()
            })

            /********** ????????????????????? **************/

            /********** ??????????????????????????? **************/
            $('.lang-select').hover(function() {
                $('.dropdown-wrapper .nav-dropdown').toggle()
            })
            $('.dropdown-wrapper .nav-dropdown').toggle()
            /********** ??????????????????????????? **************/
        });
    </script>
{/literal}

</html>