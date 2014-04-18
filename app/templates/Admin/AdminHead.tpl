<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>{$siteTitle}</title>

        <link rel="stylesheet" href="{$packroot}style.css" type="text/css" media="screen" />
        {$extraCSS}


        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="{$rootpatch}includes/js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="{$rootpatch}includes/js/hideshow.js" type="text/javascript"></script>
        <script src="{$rootpatch}includes/js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="{$rootpatch}includes/js/jquery.equalHeight.js" type="text/javascript" ></script>
        {literal}
            <script type="text/javascript">

                $(document).ready(function()
                {
                    $(".tablesorter").tablesorter();
                }
                );
                $(document).ready(function() {

                    //When page loads...
                    $(".tab_content").hide(); //Hide all content
                    $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                    $(".tab_content:first").show(); //Show first tab content

                    //On Click Event
                    $("ul.tabs li").click(function() {

                        $("ul.tabs li").removeClass("active"); //Remove any "active" class
                        $(this).addClass("active"); //Add "active" class to selected tab
                        $(".tab_content").hide(); //Hide all tab content

                        var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                        $(activeTab).fadeIn(); //Fade in the active ID content
                        return false;
                    });

                });

            </script>
            <script type="text/javascript">
                $(function() {
                    $('.column').equalHeight();
                });
            </script>
        {/literal}
    </head>


    <body>

        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="{$rootpatch}{$p_Admin}">{$serviceName} eCMS</a></h1>
                <h2 class="section_title">{$siteTitle}</h2><div class="btn_view_site"><a href="{$rootpatch}">Strona główna</a></div>
            </hgroup>
        </header> <!-- end of header bar -->

        <section id="secondary_bar">
            <div class="user">
                {if $isLogin}
                    <p>John Doe</p>
                    <a class="logout_user" href="#" title="Logout">Logout</a>
                {/if}
            </div>
            <div class="breadcrumbs_container">
                <article class="breadcrumbs"><a href="{$rootpatch}{$p_Admin}">Start</a> <div class="breadcrumb_divider"></div> <a class="current">{$a_login}</a></article>
            </div>
        </section><!-- end of secondary bar -->