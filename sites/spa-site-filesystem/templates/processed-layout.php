<!DOCTYPE html>
<html>
    <head>
        <?=displayArea($data_structure,$data,'head-meta');?>

        <link rel="stylesheet" href="/assets/styles/bootstrap.css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/assets/styles/sticky-footer-navbar.css" />
        <link rel="stylesheet" href="/assets/styles/theme-dark.css" />
<!--        <link rel="stylesheet" href="/assets/styles/theme-light.css" />-->
        <link rel="stylesheet" href="/assets/styles/carousel.css" />
        <script src="/assets/js/site.js"></script>
    </head>
    <body>
        <?=displayArea($data_structure,$data,'nav');?>
        <main role="main" class="container col-12 col-md-8 mb-3">
            <?=$content ?>
        </main>
        <?=displayArea($data_structure,$data,'footer');?>
        <?=displayArea($data_structure,$data,'footer-script');?>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script>

            // applicationForm.init({
            //     targetId:'myTabContent',
            //     formDefault:'version-extended',
            //     preloadForm:true,
            //     "btCarousel.indicatorGroupId":'version-extended-input-group'
            // });
<?php
if(isset($item_uid)):
    ?>
            //applicationImage.initSingle({targetId:'mainContent',itemDefault:"<?//=$item_uid;?>//",preloadItem:true});

            <?php
    endif;
?>


        </script>
    </body>
</html>
