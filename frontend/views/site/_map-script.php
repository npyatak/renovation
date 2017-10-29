app.module('objectMap', '#object-map', function() {
    this.ymapsInit = ymaps.ready(function() {
        this.map = new ymaps.Map('object-map', {
            center: [55.72929000, 37.64993000],
            controls: [],
            zoom: 10
        });

        var obj = this;

        this.geoObjects = [];
        this.changeZoom = 13;

        this.map.controls.add('zoomControl', {
            position: {top: 16, right: 16}
        });
        this.map.controls.add('geolocationControl', {
            position: {bottom: 32, right: 16}
        });

        this.clusterer = new ymaps.Clusterer({
            clusterIcons: [{
                href: window.mapsImagesPath + 'map-icons/cluster_<?=$type;?>.png',
                size: [79, 81],
                offset: [0, 0]
            }],

            groupByCoordinates: false,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false,
            zoomMargin: 50
        });

        this.balloonLayout = ymaps.templateLayoutFactory.createClass(
            '<div class="yandex-balloon">$[[options.contentLayout observeSize minWidth=180 maxWidth=300 minHeight=92 maxHeight=200]]</div>',
            {
                build: function() {
                    this.constructor.superclass.build.call(this);
                    this._$element = $('.yandex-balloon', this.getParentElement());
                    this.applyElementOffset();
                },
                onSublayoutSizeChange: function() {
                    obj.balloonLayout.superclass.onSublayoutSizeChange.apply(this, arguments);
                    if (!this._isElement(this._$element)) { return; }
                    this.applyElementOffset();
                    this.events.fire('shapechange');
                },
                applyElementOffset: function() {
                    this._$element.css({ left: -(this._$element[0].offsetWidth / 2), top: -(this._$element[0].offsetHeight + 4)});
                },
                getShape: function() {
                    if (!this._isElement(this._$element)) { return obj.balloonLayout.superclass.getShape.call(this); }
                    var position = this._$element.position();
                    return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                        [position.left, position.top], [ position.left + this._$element[0].offsetWidth, position.top + this._$element[0].offsetHeight]
                    ]));
                },
                _isElement: function(element) {
                    return element && element[0];
                }
            });

        if(window.objectPlacemarks.length > 0) {
            for (var point = 0, pointsLength = window.objectPlacemarks.length; point < pointsLength; point++) {
                var type = window.objectPlacemarks[point].type;

                this.geoObjects[point] = new ymaps.Placemark(window.objectPlacemarks[point].coords, {
                    balloonContent: window.objectPlacemarks[point].content
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: app.mapOptions.placemarksInfo[type].iconPath,
                    iconImageSize: app.mapOptions.defaultIconOptions.iconImageSize,
                    iconImageOffset: app.mapOptions.defaultIconOptions.iconImageOffset,

                    balloonLayout: obj.balloonLayout,
                    balloonPanelMaxMapArea: 0,
                    hideIconOnBalloonOpen: true,

                    type: type
                });
            }

            //app.window.md.mobile() || app.window.md.tablet() && this.map.behaviors.disable('scrollZoom');
            this.clusterer.add(this.geoObjects);
            this.map.geoObjects.add(this.clusterer);

            this.map.setBounds(this.clusterer.getBounds(), {
                checkZoomRange: true
            });
            this.map.events.add('boundschange', function(event) {
                var newZoom = event.get('newZoom');
                var prevZoom = event.get('oldZoom');
                var newOptions = {};
                var newPath = '';

                if (newZoom >= obj.changeZoom && prevZoom < obj.changeZoom) {
                    newOptions = {
                        iconImageSize: [36, 47],
                        iconImageOffset: [-18, -47]
                    };
                    newPath = 'largeIconPath';
                } else if (newZoom < obj.changeZoom && prevZoom >= obj.changeZoom) {
                    newOptions = {
                        iconImageSize: app.mapOptions.defaultIconOptions.iconImageSize,
                        iconImageOffset: app.mapOptions.defaultIconOptions.iconImageOffset
                    };
                    newPath = 'iconPath';
                }

                if (!$.isEmptyObject(newOptions)) {
                    obj.clusterer.getGeoObjects().forEach(function(placemark) {
                        var type = placemark.options.get('type');

                        placemark.options.set({
                            iconImageHref: app.mapOptions.placemarksInfo[type][newPath],
                            iconImageSize: newOptions.iconImageSize,
                            iconImageOffset: newOptions.iconImageOffset
                        });
                    });
                }
            });
        }
    });
});