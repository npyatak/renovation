$(function() {
    app.module('mapOptions', document, function() {
        this.placemarksInfo = {
            type_house: {
                iconPath: window.mapsImagesPath + 'map-icons/1.svg',
                largeIconPath: window.mapsImagesPath + 'map-icons/1-large.svg'
            },
            type_start_place: {
                iconPath: window.mapsImagesPath + 'map-icons/2.svg',
                largeIconPath: window.mapsImagesPath + 'map-icons/2-large.svg'
            },
            type3: {
                iconPath: window.mapsImagesPath + 'map-icons/3.svg',
                largeIconPath: window.mapsImagesPath + 'map-icons/3-large.svg'
            },
            type4: {
                iconPath: window.mapsImagesPath + 'map-icons/4.svg',
                largeIconPath: window.mapsImagesPath + 'map-icons/4-large.svg'
            }
        };
        this.defaultIconOptions = {
            iconImageSize: [21, 28],
            iconImageOffset: [-10, -28]
        };
    });
});