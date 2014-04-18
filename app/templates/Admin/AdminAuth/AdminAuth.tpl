<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8"/>
        <title>{$siteTitle}</title>
        <link rel="stylesheet" href="{$packroot}style.css" type="text/css" media="screen" />
        {$extraCSS}


        <script src="{$rootpatch}includes/js/jquery-1.5.2.min.js" type="text/javascript"></script>


    </head>

    <body>

        <article class="module width_quarter center_box">
            <header><h3>Logowanie</h3></header>
            <form method="POST" action="{$rootpatch}{$p_Admin}/{$c_AdminAuth}/{$a_AdminLoginAuthorize}/">
                <div class="module_content">
                    <fieldset>
                        <label>Email</label>
                        <input name="email" placeholder="adres@email.pl" type="text">
                    </fieldset>
                    <fieldset>
                        <label>Hasło</label>
                        <input name="password" placeholder="********" type="password">
                    </fieldset>

                </div>
                <footer>
                    <a class="button_link floatBlockLeft back_to_web" href="{$rootpatch}">Powrót do strny głównej</a>
                    <div class="submit_link">

                        <input type="submit" class="alt_btn" value="Zaloguj się!" >

                    </div>
                </footer>
            </form>
        </article>
    </body>

</html>