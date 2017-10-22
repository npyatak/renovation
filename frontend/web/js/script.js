'use strict';

window.app = {
    module: function(moduleName, jquerySelector, constructorFunction) {
        if (moduleName == null) { return; }

        if (typeof this[moduleName] === 'undefined') {
            this[moduleName] = {};
            this[moduleName].obj = this[moduleName];

            if (constructorFunction) {
                this[moduleName].el = $(jquerySelector);
                this[moduleName].selector = jquerySelector;
            } else {
                constructorFunction = jquerySelector;
            }

            if (typeof constructorFunction === 'function') {
                var publicProps = constructorFunction.call(this[moduleName], this[moduleName].el, this[moduleName].selector);

                if (typeof publicProps === 'object') {
                    for (var prop in publicProps) {
                        this[moduleName][prop] = publicProps[prop];
                    }

                    if (this[moduleName].el && typeof publicProps.events === 'object') {
                        var events = publicProps.events;
                        for (var prop in events) {
                            var propArray = prop.indexOf(' ') !== -1
                                ? [prop.substr(0, prop.indexOf(' ')), prop.substr(prop.indexOf(' ') + 1)]
                                : [prop, null];

                            this[moduleName].el.on(propArray[0], propArray[1], {
                                    moduleName: this[moduleName],
                                    val: events[prop]
                                }, function(ev) {
                                    var eventVal = ev.data.val;
                                    var callArgs = [ev.data.moduleName, ev];

                                    if (typeof eventVal !== 'function') {
                                        var calledEvent = eventVal;
                                        if (eventVal instanceof Array) {
                                            calledEvent = eventVal[0];
                                            callArgs.push.apply(callArgs, eventVal.slice(1));
                                        }
                                        app[moduleName][calledEvent].apply(this, callArgs);
                                    } else {
                                        eventVal.apply(this, callArgs);
                                    }
                                });
                            delete this[moduleName].events;
                        }
                    }
                }
            }
        } else {
            console.log('app.' + moduleName + ' is already defined!');
        }
    }
};
'use strict';