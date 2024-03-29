
(function($) {
    $.extend({fieldEvent: function(el, obs) {
            var field = el[0] || el;
            if (field.type == 'radio' || field.type == 'checkbox')
                event = 'click';
            else if (obs && field.type == 'text' || field.type == 'textarea')
                event = 'keyup';
            else
                event = 'change';
            return event;
        }});
    $.fn.extend({delayedObserver: function(delay, callback) {
            var el = $(this);
            if (typeof window.delayedObserverStack == 'undefined')
                window.delayedObserverStack = [];
            if (typeof window.delayedObserverCallback == 'undefined') {
                window.delayedObserverCallback = function(stackPos) {
                    observed = window.delayedObserverStack[stackPos];
                    if (observed.timer)
                        clearTimeout(observed.timer);
                    observed.timer = setTimeout(function() {
                        observed.timer = null;
                        observed.callback(observed.obj, observed.obj.formVal());
                    }, observed.delay * 1000);
                    observed.oldVal = observed.obj.formVal();
                }
            }
            window.delayedObserverStack.push({obj: el, timer: null, delay: delay, oldVal: el.formVal(), callback: callback});
            var stackPos = window.delayedObserverStack.length - 1;
            if (el[0].tagName == 'FORM') {
                $(':input', el).each(function() {
                    var field = $(this);
                    field.bind($.fieldEvent(field, delay), function() {
                        observed = window.delayedObserverStack[stackPos];
                        if (observed.obj.formVal() == observed.obj.oldVal)
                            return;
                        else
                            window.delayedObserverCallback(stackPos);
                    });
                });
            } else {
                el.bind($.fieldEvent(el, delay), function() {
                    observed = window.delayedObserverStack[stackPos];
                    if (observed.obj.formVal() == observed.obj.oldVal)
                        return;
                    else
                        window.delayedObserverCallback(stackPos);
                });
            }
            ;
        }, formVal: function() {
            var el = this[0];
            if (el.tagName == 'FORM')
                return this.serialize();
            if (el.type == 'checkbox' || self.type == 'radio')
                return this.filter('input:checked').val() || '';
            else
                return this.val();
        }});
})(jQuery);
(function($) {
    $.fn.extend({Appear: function(speed, callback) {
            return this.fadeIn(speed, callback);
        }, BlindDown: function(speed, callback) {
            this.show({method: 'blind', direction: 'vertical'}, speed, callback);
            return this;
        }, BlindUp: function(speed, callback) {
            this.hide({method: 'blind', direction: 'vertical'}, speed, callback);
            return this;
        }, BlindRight: function(speed, callback) {
            this.show({method: 'blind', direction: 'horizontal'}, speed, callback);
            return this;
        }, BlindLeft: function(speed, callback) {
            this.hide({method: 'blind', direction: 'horizontal'}, speed, callback);
            return this;
        }, DropOut: function(speed, callback) {
            this.hide({method: 'drop', direction: 'up'}, speed, callback);
            return this;
        }, DropIn: function(speed, callback) {
            this.show({method: 'drop', direction: 'up'}, speed, callback);
            return this;
        }, Fade: function(speed, callback) {
            return this.fadeOut(speed, callback);
        }, Fold: function(speed, callback) {
            this.hide({method: 'fold'}, speed, callback);
            return this;
        }, FoldOut: function(speed, callback) {
            this.show({method: 'fold'}, speed, callback);
            return this;
        }, Grow: function(speed, callback) {
            this.show({method: 'scale'}, speed, callback);
            return this;
        }, Highlight: function(speed, callback) {
            this.show({method: 'highlight'}, speed, callback);
            return this;
        }, Puff: function(speed, callback) {
            this.hide({method: 'puff'}, speed, callback);
            return this;
        }, Pulsate: function(speed, callback) {
            this.show({method: 'pulsate'}, speed, callback);
            return this;
        }, Shake: function(speed, callback) {
            this.show({method: 'shake'}, speed, callback);
            return this;
        }, Shrink: function(speed, callback) {
            this.hide({method: 'scale'}, speed, callback);
            return this;
        }, Squish: function(speed, callback) {
            this.hide({method: 'scale', origin: ['top', 'left']}, speed, callback);
            return this;
        }, SlideUp: function(speed, callback) {
            this.hide({method: 'slide', direction: 'up'}, speed, callback);
            return this;
        }, SlideDown: function(speed, callback) {
            this.show({method: 'slide', direction: 'up'}, speed, callback);
            return this;
        }, SwitchOff: function(speed, callback) {
            this.hide({method: 'clip'}, speed, callback);
            return this;
        }, SwitchOn: function(speed, callback) {
            this.show({method: 'clip'}, speed, callback);
            return this;
        }});
})(jQuery);
(function($) {
    $.fn.extend({pause: function(milli, type) {
            milli = milli || 1000;
            type = type || "fx";
            return this.queue(type, function() {
                var self = this;
                setTimeout(function() {
                    $(self).dequeue();
                }, milli);
            });
        }, clearQueue: function(type) {
            return this.each(function() {
                type = type || "fx";
                if (this.queue && this.queue[type]) {
                    this.queue[type].length = 0;
                }
            });
        }, unpause: $.fn.clearQueue});
})(jQuery);