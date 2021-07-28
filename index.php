<html>

<head>
    <style>
        #span
        {
            text-align:left
        }

        body {
            font-family: Vazir;
            direction: rtl;
        }

        .news-link {
            border-style: solid;
            border-color: lightgray;
            border-width: 0px 0px 1px 0px;
            text-decoration: none;
        }

        .news-link:hover {
            color: rgba(255, 188, 4, 0.685);
        }

        @font-face {
            font-family: Vazir;
            src: url('./fonts/Vazir.eot');
            src: url('./fonts/Vazir.eot?#iefix') format('embedded-opentype'),
                url('./fonts/Vazir.woff') format('woff'),
                url('./fonts/Vazir.ttf') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: Vazir;
            src: url('./fonts/Vazir-Bold.eot');
            src: url('./fonts/Vazir-Bold.eot?#iefix') format('embedded-opentype'),
                url('./fonts/Vazir-Bold.woff') format('woff'),
                url('./fonts/Vazir-Bold.ttf') format('truetype');
            font-weight: bold;
        }

        @font-face {
            font-family: Vazir;
            src: url('./fonts/Vazir-Light.eot');
            src: url('./fonts/Vazir-Light.eot?#iefix') format('embedded-opentype'),
                url('./fonts/Vazir-Light.woff') format('woff'),
                url('./fonts/Vazir-Light.ttf') format('truetype');
            font-weight: 300;
        }
    </style>
</head>
<?php
$cat = $_GET['cat'] ?? 0;
define('CAT_GLOBAL', '0');
define('CAT_SPORT', '1');
$categories = [
    CAT_GLOBAL => 'عمومی',
    CAT_SPORT => 'ورزشی',
];
?>
<body>
    <form action="" method="get">
        <select name="cat">
            <?php 
            foreach ($categories as $key => $value) {
            ?>
            <option value="<?php echo $key;?>" <?php if($cat == $key){echo 'selected';}?>><?php echo $value;?></option>
            <?php 
            }
            ?>
        </select>
        <button type="submit">بارگذاری خبر</button>
    </form>
    <?php
    /*function get_content($URL)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }*/
    
    switch (intval($cat)) {
        case CAT_GLOBAL: 
            $rss_urls = [
                'مهر' => 'https://www.mehrnews.com/rss',
                'فارس' => 'https://www.farsnews.ir/rss',
                //'تسنیم' => 'https://www.tasnimnews.com/fa/rss/feed/0/8/0/',
                // 'ایرنا' => 'https://www.irna.ir/rss',
                // 'تابناک' => 'https://www.tabnak.ir/fa/rss/1',
                // 'خبرفارسی' => 'https://khabarfarsi.com/rss/top',
                // 'https://www.yjc.news/fa/rss/allnews',
                // 'ایسنا' => 'https://www.isna.ir/rss',
                // 'خبرآنلاین' => 'https://www.khabaronline.ir/rss',
                // 'مشرق' => 'https://www.mashreghnews.ir/rss',
            ];
            break;
        case CAT_SPORT: // varzeshi
            $rss_urls = [
                'فارس' => 'https://www.farsnews.ir/rss/sports',
                'ایرنا' => 'https://www.irna.ir/rss/tp/14'
            ];
            break;
    }

    foreach ($rss_urls as $name => $rss_url) {
        $obj = simplexml_load_file($rss_url);
        $item = $obj->channel->item[0];
        $title = (string) $item->title;
        $link = (string) $item->link;
        echo '<span>'.(string) $item->pubDate.'</span>';
        if ($title) {
    ?>
            <a target="_blank" href="<?php echo $link; ?>" class="news-link">
                <?php echo $title; ?>
            </a> <span style="color: red;"><?php echo $name; ?></span></br>
    <?php
        }
    }
    ?>

</body>

</html>