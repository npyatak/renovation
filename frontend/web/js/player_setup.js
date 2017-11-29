$(document).ready(function () {
    jwplayer.key="btTjXiuYZsRbqAVggNOhFFVcP3mvO2KkI2kx4w==";
        jwplayer("history-video").setup({
            'width': "100%",
            'aspectratio': "16:9",
            'bufferlength': '3',
            'stretching': 'uniform',
            'primary': 'flash',
            'autostart': 'false',
            'duration': '',
            'playlist': [{
                'image': '/frontend/web/images/footer_gallery_img_new.jpg',
                'sources': [
                    {file: "https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/jwplayer.smil"},
                    {file: "https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/playlist.m3u8"},
                ]
            }]
        });
        jwplayer("footer-video").setup({
            'width': "100%",
            'aspectratio': "16:9",
            'bufferlength': '3',
            'stretching': 'uniform',
            'primary': 'flash',
            'autostart': 'false',
            'duration': '',
            'playlist': [{
                'image': '/frontend/web/images/footer_gallery_img_new.jpg',
                'sources': [
                    {file: "https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/jwplayer.smil"},
                    {file: "https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/playlist.m3u8"},
                ]
            }]
        });
})
