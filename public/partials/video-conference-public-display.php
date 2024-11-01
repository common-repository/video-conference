<?php

/**

 * @link       https://webflazz.com/
 * @since      1.0.3
 *
 * @package    Video_Conference
 * @subpackage Video_Conference/public/partials
 */
global $post;
?>

<html>
    <head>
        <title>Video Conference - Class Room <?php echo $post->post_name; ?></title>
        <style>
            body {
                margin:0px !important;
                background: url("<?php echo VICON_URL . 'public/img/background-static.jpg'; ?>");
                background-size: cover;
                background-position: center;
            }
            .container {
                width: 600px;
                margin: auto;
                margin-top: 180px;
                text-align: center;
                font-weight: 800;
                font-size:1.8rem;
                color: #333333;
                background: rgba(255,255,255,0.5);
                border-radius: 1rem;
                padding: 2rem;
                padding-bottom: 0px;
            }
            a {
                color: #333;
                text-decoration: none;
                font-size: 1.2rem;
                line-height: 5
            }
        </style>
    </head>
    <body>
        <?php if($post->post_status == 'draft') { ?>
            <div class="container">
                Mohon maaf meeting saat ini sudah di tutup atau belum di mulai, silahkan hubungi moderator <br /> <a href="<?php echo get_bloginfo( 'url' ); ?>"> Klik disini untuk kembali ke halaman utama</a>
            </div>
        <?php } else { ?>
            <div id="meet" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" ></div>
        <?php } ?>

        <script src="<?php echo VICON_URL . 'public/js/external_api.js'; ?>"></script>
            <script>
                const interfaceConfigOverwrite = {
                    maxFullResolutionParticipants: 12,
                    SHOW_PROMOTIONAL_CLOSE_PAGE: true
                };
                const configOverwrite = {
                    maxFullResolutionParticipants: 12,
                    SHOW_PROMOTIONAL_CLOSE_PAGE: true
                };
                const domain = 'meet.jit.si/moderated';
                const options = {
                    roomName: '<?php echo md5($post->post_name); ?>',
                    parentNode: document.querySelector('#meet'),
                    lang: 'id',
                    configOverwrite: configOverwrite,
                    interfaceConfigOverwrite : interfaceConfigOverwrite
                };
                const api = new JitsiMeetExternalAPI(domain, options);


                api.on('readyToClose', () => {
                    window.location.replace("<?php echo get_bloginfo( 'url' ); ?>")
                })
                 api.on('videoConferenceLeft', (param) => {
                    window.location.replace("<?php echo get_bloginfo( 'url' ); ?>")
                 })

            </script>

    </body>
</html>
