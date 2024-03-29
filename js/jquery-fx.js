
(function($) {
    $.ec = $.ec || {};
    $.extend($.ec, {save: function(el, set) {
            for (var i = 0; i < set.length; i++) {
                if (set[i] !== null)
                    $.data(el[0], "ec.storage." + set[i], el.css(set[i]));
            }
        }, restore: function(el, set) {
            for (var i = 0; i < set.length; i++) {
                if (set[i] !== null)
                    el.css(set[i], $.data(el[0], "ec.storage." + set[i]));
            }
        }, getBaseline: function(origin, original) {
            var y, x;
            switch (origin[0]) {
                case'top':
                    y = 0;
                    break;
                case'middle':
                    y = 0.5;
                    break;
                case'bottom':
                    y = 1;
                    break;
                default:
                    y = origin[0] / original.height;
            }
            ;
            switch (origin[1]) {
                case'left':
                    x = 0;
                    break;
                case'center':
                    x = 0.5;
                    break;
                case'right':
                    x = 1;
                    break;
                default:
                    x = origin[1] / original.width;
            }
            ;
            return{x: x, y: y};
        }, createWrapper: function(el) {
            var props = {width: el.outerWidth({margin: true}), height: el.outerHeight({margin: true}), float: el.css('float')};
            el.wrap('<div  id="fxWrapper"></div>');
            var wrapper = el.parent();
            if (el.css('position') == 'static') {
                wrapper.css({position: 'relative'});
                el.css({position: 'relative'});
            } else {
                wrapper.css({position: el.css('position'), top: parseInt(el.css('top')) || null, left: parseInt(el.css('left')) || null, bottom: parseInt(el.css('bottom')) || null, right: parseInt(el.css('right')) || null});
                wrapper.show();
                el.css({position: 'relative', top: 0, left: 0});
            }
            wrapper.css(props);
            return wrapper;
        }, removeWrapper: function(el) {
            return el.parent().replaceWith(el);
        }, setTransition: function(el, list, factor, val) {
            val = val || {};
            $.each(list, function(i, x) {
                unit = el.cssUnit(x);
                if (unit[0] > 0)
                    val[x] = unit[0] * factor + unit[1];
            });
            return val;
        }, animateClass: function(value, duration, easing, callback) {
            var cb = (typeof easing == "function" ? easing : (callback ? callback : null));
            var ea = (typeof easing == "object" ? easing : null);
            this.each(function() {
                var offset = {};
                var that = $(this);
                var oldStyleAttr = that.attr("style") || '';
                if (typeof oldStyleAttr == 'object')
                    oldStyleAttr = oldStyleAttr["cssText"];
                if (value.toggle) {
                    that.hasClass(value.toggle) ? value.remove = value.toggle : value.add = value.toggle;
                }
                var oldStyle = $.extend({}, (document.defaultView ? document.defaultView.getComputedStyle(this, null) : this.currentStyle));
                if (value.add)
                    that.addClass(value.add);
                if (value.remove)
                    that.removeClass(value.remove);
                var newStyle = $.extend({}, (document.defaultView ? document.defaultView.getComputedStyle(this, null) : this.currentStyle));
                if (value.add)
                    that.removeClass(value.add);
                if (value.remove)
                    that.addClass(value.remove);
                for (var n in newStyle) {
                    if (typeof newStyle[n] != "function" && newStyle[n] && n.indexOf("Moz") == -1 && n.indexOf("length") == -1 && newStyle[n] != oldStyle[n] && (n.match(/color/i) || (!n.match(/color/i) && !isNaN(parseInt(newStyle[n])))) && (oldStyle.position != "static" || (oldStyle.position == "static" && !n.match(/left|top|bottom|right/))))
                        offset[n] = newStyle[n];
                }
                that.animate(offset, duration, ea, function() {
                    if (typeof $(this).attr("style") == 'object') {
                        $(this).attr("style")["cssText"] = "";
                        $(this).attr("style")["cssText"] = oldStyleAttr;
                    } else
                        $(this).attr("style", oldStyleAttr);
                    if (value.add)
                        $(this).addClass(value.add);
                    if (value.remove)
                        $(this).removeClass(value.remove);
                    if (cb)
                        cb.apply(this, arguments);
                });
            });
        }});
    $.fn.extend({_show: $.fn.show, _hide: $.fn.hide, _toggle: $.fn.toggle, _addClass: $.fn.addClass, _removeClass: $.fn.removeClass, _toggleClass: $.fn.toggleClass, effect: function(fx, o, speed, callback) {
            if ($.ec[fx]) {
                var elem = this.get(0);
                elem.fx = elem.fx || {};
                if (!elem.fx[fx]) {
                    elem.fx[fx] = true;
                    return $.ec[fx].apply(this, [{method: fx, options: o || {}, speed: speed, callback: function() {
                                if (callback)
                                    callback.apply(this.arguments);
                                elem.fx[fx] = null;
                            }}]);
                }
            }
        }, show: function(obj, speed, callback) {
            if (typeof obj == 'string' || typeof obj == 'undefined')
                return this._show(obj, speed);
            else {
                obj['mode'] = 'show';
                return this.effect(obj.method, obj, speed, callback);
            }
            ;
        }, hide: function(obj, speed, callback) {
            if (typeof obj == 'string' || typeof obj == 'undefined')
                return this._hide(obj, speed);
            else {
                obj['mode'] = 'hide';
                return this.effect(obj.method, obj, speed, callback);
            }
            ;
        }, toggle: function(obj, speed, callback) {
            return this.each(function() {
                var $this = $(this);
                $this.is(':hidden') ? $this.show(obj, speed, callback) : $this.hide(obj, speed, callback);
            });
        }, addClass: function(classNames, speed, easing, callback) {
            return speed ? $.ec.animateClass.apply(this, [{add: classNames}, speed, easing, callback]) : this._addClass(classNames);
        }, removeClass: function(classNames, speed, easing, callback) {
            return speed ? $.ec.animateClass.apply(this, [{remove: classNames}, speed, easing, callback]) : this._removeClass(classNames);
        }, toggleClass: function(classNames, speed, easing, callback) {
            return speed ? $.ec.animateClass.apply(this, [{toggle: classNames}, speed, easing, callback]) : this._toggleClass(classNames);
        }, morph: function(remove, add, speed, easing, callback) {
            return $.ec.animateClass.apply(this, [{add: add, remove: remove}, speed, easing, callback]);
        }, switchClass: function() {
            this.morph.apply(this, arguments);
        }, cssUnit: function(key) {
            var style = this.css(key), val = [];
            $.each(['em', 'px', '%', 'pt'], function(i, unit) {
                if (style.indexOf(unit) > 0)
                    val = [parseFloat(style), unit];
            });
            return val
        }});
})(jQuery);
(function($) {
    $.dimensions = {version: '@VERSION'};
    $.each(['Height', 'Width'], function(i, name) {
        $.fn['inner' + name] = function() {
            if (!this[0])
                return;
            var torl = name == 'Height' ? 'Top' : 'Left', borr = name == 'Height' ? 'Bottom' : 'Right';
            return this.is(':visible') ? this[0]['client' + name] : num(this, name.toLowerCase()) + num(this, 'padding' + torl) + num(this, 'padding' + borr);
        };
        $.fn['outer' + name] = function(options) {
            if (!this[0])
                return;
            var torl = name == 'Height' ? 'Top' : 'Left', borr = name == 'Height' ? 'Bottom' : 'Right';
            options = $.extend({margin: false}, options || {});
            var val = this.is(':visible') ? this[0]['offset' + name] : num(this, name.toLowerCase())
                    + num(this, 'border' + torl + 'Width') + num(this, 'border' + borr + 'Width')
                    + num(this, 'padding' + torl) + num(this, 'padding' + borr);
            return val + (options.margin ? (num(this, 'margin' + torl) + num(this, 'margin' + borr)) : 0);
        };
    });
    $.each(['Left', 'Top'], function(i, name) {
        $.fn['scroll' + name] = function(val) {
            if (!this[0])
                return;
            return val != undefined ? this.each(function() {
                this == window || this == document ? window.scrollTo(name == 'Left' ? val : $(window)['scrollLeft'](), name == 'Top' ? val : $(window)['scrollTop']()) : this['scroll' + name] = val;
            }) : this[0] == window || this[0] == document ? self[(name == 'Left' ? 'pageXOffset' : 'pageYOffset')] || $.boxModel && document.documentElement['scroll' + name] || document.body['scroll' + name] : this[0]['scroll' + name];
        };
    });
    $.fn.extend({position: function() {
            var left = 0, top = 0, elem = this[0], offset, parentOffset, offsetParent, results;
            if (elem) {
                offsetParent = this.offsetParent();
                offset = this.offset();
                parentOffset = offsetParent.offset();
                offset.top -= num(elem, 'marginTop');
                offset.left -= num(elem, 'marginLeft');
                parentOffset.top += num(offsetParent, 'borderTopWidth');
                parentOffset.left += num(offsetParent, 'borderLeftWidth');
                results = {top: offset.top - parentOffset.top, left: offset.left - parentOffset.left};
            }
            return results;
        }, offsetParent: function() {
            var offsetParent = this[0].offsetParent;
            while (offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && $.css(offsetParent, 'position') == 'static'))
                offsetParent = offsetParent.offsetParent;
            return $(offsetParent);
        }});
    function num(el, prop) {
        return parseInt($.css(el.jquery ? el[0] : el, prop)) || 0;
    }
    ;
})(jQuery);
(function(jQuery) {
    jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i, attr) {
        jQuery.fx.step[attr] = function(fx) {
            if (fx.state == 0) {
                fx.start = getColor(fx.elem, attr);
                fx.end = getRGB(fx.end);
            }
            fx.elem.style[attr] = "rgb(" + [Math.max(Math.min(parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0), Math.max(Math.min(parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0), Math.max(Math.min(parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)].join(",") + ")";
        }
    });
    function getRGB(color) {
        var result;
        if (color && color.constructor == Array && color.length == 3)
            return color;
        if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
            return[parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];
        if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
            return[parseFloat(result[1]) * 2.55, parseFloat(result[2]) * 2.55, parseFloat(result[3]) * 2.55];
        if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
            return[parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)];
        if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
            return[parseInt(result[1] + result[1], 16), parseInt(result[2] + result[2], 16), parseInt(result[3] + result[3], 16)];
        return colors[jQuery.trim(color).toLowerCase()];
    }
    function getColor(elem, attr) {
        var color;
        do {
            color = jQuery.curCSS(elem, attr);
            if (color != '' && color != 'transparent' || jQuery.nodeName(elem, "body"))
                break;
            attr = "backgroundColor";
        } while (elem = elem.parentNode);
        return getRGB(color);
    }
    ;
    var colors = {aqua: [0, 255, 255], azure: [240, 255, 255], beige: [245, 245, 220], black: [0, 0, 0], blue: [0, 0, 255], brown: [165, 42, 42], cyan: [0, 255, 255], darkblue: [0, 0, 139], darkcyan: [0, 139, 139], darkgrey: [169, 169, 169], darkgreen: [0, 100, 0], darkkhaki: [189, 183, 107], darkmagenta: [139, 0, 139], darkolivegreen: [85, 107, 47], darkorange: [255, 140, 0], darkorchid: [153, 50, 204], darkred: [139, 0, 0], darksalmon: [233, 150, 122], darkviolet: [148, 0, 211], fuchsia: [255, 0, 255], gold: [255, 215, 0], green: [0, 128, 0], indigo: [75, 0, 130], khaki: [240, 230, 140], lightblue: [173, 216, 230], lightcyan: [224, 255, 255], lightgreen: [144, 238, 144], lightgrey: [211, 211, 211], lightpink: [255, 182, 193], lightyellow: [255, 255, 224], lime: [0, 255, 0], magenta: [255, 0, 255], maroon: [128, 0, 0], navy: [0, 0, 128], olive: [128, 128, 0], orange: [255, 165, 0], pink: [255, 192, 203], purple: [128, 0, 128], violet: [128, 0, 128], red: [255, 0, 0], silver: [192, 192, 192], white: [255, 255, 255], yellow: [255, 255, 0], transparent: [255, 255, 255]};
})(jQuery);
(function($) {
    $.ec.blind = function(o) {
        this.each(function() {
            var el = $(this), props = ['position'];
            var mode = o.options.mode || 'hide';
            var direction = o.options.direction || 'vertical';
            $.ec.save(el, props);
            el.show();
            var wrapper = $.ec.createWrapper(el).css({overflow: 'hidden'});
            var ref = (direction == 'vertical') ? 'height' : 'width';
            var distance = (direction == 'vertical') ? wrapper.height() : wrapper.width();
            if (mode == 'show')
                wrapper.css(ref, 0);
            var animation = {};
            animation[ref] = mode == 'show' ? distance : 0;
            wrapper.animate(animation, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);
(function($) {
    $.ec.bounce = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left', 'opacity'];
            var mode = o.options.mode || 'effect';
            var direction = o.options.direction || 'up';
            var distance = o.options.distance || 20;
            var times = o.options.times || 5;
            var speed = o.options.speed || 250;
            $.ec.save(el, props);
            el.show();
            $.ec.createWrapper(el);
            var ref = (direction == 'up' || direction == 'down') ? 'top' : 'left';
            var motion = (direction == 'up' || direction == 'left') ? 'pos' : 'neg';
            var distance = o.options.distance || (ref == 'top' ? el.outerHeight({margin: true}) / 3 : el.outerWidth({margin: true}) / 3);
            if (mode == 'show')
                el.css('opacity', 0).css(ref, motion == 'pos' ? -distance : distance);
            if (mode == 'hide')
                distance = distance / (times * 2);
            if (mode != 'hide')
                times--;
            if (mode == 'show') {
                var animation = {opacity: 1};
                animation[ref] = (motion == 'pos' ? '+=' : '-=') + distance;
                el.animate(animation, speed / 2, o.options.easing);
                distance = distance / 2;
                times--;
            }
            ;
            for (var i = 0; i < times; i++) {
                var animation1 = {}, animation2 = {};
                animation1[ref] = (motion == 'pos' ? '-=' : '+=') + distance;
                animation2[ref] = (motion == 'pos' ? '+=' : '-=') + distance;
                el.animate(animation1, speed / 2, o.options.easing).animate(animation2, speed / 2, o.options.easing);
                distance = (mode == 'hide') ? distance * 2 : distance / 2;
            }
            ;
            if (mode == 'hide') {
                var animation = {opacity: 0};
                animation[ref] = (motion == 'pos' ? '-=' : '+=') + distance;
                el.animate(animation, speed / 2, o.options.easing, function() {
                    el.hide();
                    $.ec.restore(el, props);
                    $.ec.removeWrapper(el);
                    if (o.callback)
                        o.callback.apply(this, arguments);
                });
            } else {
                var animation1 = {}, animation2 = {};
                animation1[ref] = (motion == 'pos' ? '-=' : '+=') + distance;
                animation2[ref] = (motion == 'pos' ? '+=' : '-=') + distance;
                el.animate(animation1, speed / 2, o.options.easing).animate(animation2, speed / 2, o.options.easing, function() {
                    $.ec.restore(el, props);
                    $.ec.removeWrapper(el);
                    if (o.callback)
                        o.callback.apply(this, arguments);
                });
            }
            ;
        });
    }
})(jQuery);
(function($) {
    $.ec.clip = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left', 'width', 'height'];
            var mode = o.options.mode || 'hide';
            var direction = o.options.direction || 'vertical';
            $.ec.save(el, props);
            el.show();
            $.ec.createWrapper(el).css({overflow: 'hidden'});
            var ref = {size: (direction == 'vertical') ? 'height' : 'width', position: (direction == 'vertical') ? 'top' : 'left'};
            var distance = (direction == 'vertical') ? el.height() : el.width();
            if (mode == 'show') {
                el.css(ref.size, 0);
                el.css(ref.position, distance / 2);
            }
            var animation = {};
            animation[ref.size] = mode == 'show' ? distance : 0;
            animation[ref.position] = mode == 'show' ? 0 : distance / 2;
            el.animate(animation, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);
(function($) {
    $.ec.drop = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left', 'opacity'];
            var mode = o.options.mode || 'hide';
            var direction = o.options.direction || 'left';
            $.ec.save(el, props);
            el.show();
            $.ec.createWrapper(el);
            var ref = (direction == 'up' || direction == 'down') ? 'top' : 'left';
            var motion = (direction == 'up' || direction == 'left') ? 'pos' : 'neg';
            var distance = 16;
                    < !--o.options.distance || (ref == 'top'?el.outerHeight({margin:true}) / 2:el.outerWidth({margin:true}) / 2); -- >
                    // alert(distance);
                    if (mode == 'show')el.css('opacity', 0).css(ref, motion == 'pos'? - distance:distance);
                    var animation = {opacity: mode == 'show' ? 1 : 0};
            animation[ref] = (mode == 'show' ? (motion == 'pos' ? '+=' : '-=') : (motion == 'pos' ? '-=' : '+=')) + distance;
            el.animate(animation, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);



(function($) {
    $.ec.fade = function(o) {
        this.each(function() {
            var el = $(this), props = ['opacity'];
            var mode = o.options.mode || 'effect';
            var opacity = o.options.opacity || 0;
            $.ec.save(el, props);
            el.show();
            if (mode == 'show')
                el.css({opacity: 0});
            var animation = {opacity: mode == 'show' ? 1 : opacity};
            el.animate(animation, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                if (mode == 'hide')
                    $.ec.restore(el, props);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);

(function($) {
    $.ec.fold = function(o) {
        this.each(function() {
            var el = $(this), props = ['position'];
            var mode = o.options.mode || 'hide';
            var size = o.options.size || 15;
            $.ec.save(el, props);
            el.show();
            var wrapper = $.ec.createWrapper(el).css({overflow: 'hidden'});
            var ref = (mode == 'show') ? ['width', 'height'] : ['height', 'width'];
            var distance = (mode == 'show') ? [wrapper.width(), wrapper.height()] : [wrapper.height(), wrapper.width()];
            if (mode == 'show')
                wrapper.css({height: size, width: 0});
            var animation1 = {}, animation2 = {};
            animation1[ref[0]] = mode == 'show' ? distance[0] : size;
            animation2[ref[1]] = mode == 'show' ? distance[1] : 0;
            wrapper.animate(animation1, o.speed / 2, o.options.easing).animate(animation2, o.speed / 2, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);

(function($) {
    $.ec.highlight = function(o) {
        this.each(function() {
            var el = $(this), props = ['backgroundImage', 'backgroundColor', 'opacity'];
            var mode = o.options.mode || 'show';
            var color = o.options.color || "#ffff99";
            $.ec.save(el, props);
            el.show();
            el.css({backgroundImage: 'none', backgroundColor: color});
            var animation = {backgroundColor: $.data(this, "ec.storage.backgroundColor")};
            if (mode == "hide")
                animation['opacity'] = 0;
            el.animate(animation, o.speed, o.options.easing, function() {
                if (mode == "hide")
                    el.hide();
                $.ec.restore(el, props);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);

(function($) {
    $.ec.pulsate = function(o) {
        this.each(function() {
            var el = $(this);
            var mode = o.options.mode || 'show';
            var times = o.options.times || 5;
            if (mode != 'hide')
                times--;
            if (el.is(':hidden')) {
                el.css('opacity', 0);
                el.show();
                el.animate({opacity: 1}, o.speed / 2, o.options.easing);
                times--;
            }
            for (var i = 0; i < times; i++) {
                el.animate({opacity: 0}, o.speed / 2, o.options.easing).animate({opacity: 1}, o.speed / 2, o.options.easing);
            }
            ;
            if (mode == 'hide') {
                el.animate({opacity: 0}, o.speed / 2, o.options.easing, function() {
                    el.hide();
                    if (o.callback)
                        o.callback.apply(this, arguments);
                });
            }
            else {
                el.animate({opacity: 0}, o.speed / 2, o.options.easing).animate({opacity: 1}, o.speed / 2, o.options.easing, function() {
                    if (o.callback)
                        o.callback.apply(this, arguments);
                });
            }
            ;
        });
    }
})(jQuery);


(function($) {
    $.ec.puff = function(o) {
        this.each(function() {
            var el = $(this);
            var mode = o.options.mode || 'hide';
            var percent = parseInt(o.options.percent) || 150;
            o.options.fade = true;
            var original = {height: el.height(), width: el.width()};
            var factor = percent / 100;
            el.from = (mode == 'hide') ? original : {height: original.height * factor, width: original.width * factor};
            o.options.from = el.from;
            o.options.percent = (mode == 'hide') ? percent : 100;
            o.options.mode = mode;
            el.effect('scale', o.options, o.speed, o.callback);
        });
    };
    $.ec.scale = function(o) {
        this.each(function() {
            var el = $(this);
            var mode = o.options.mode || 'effect';
            var percent = parseInt(o.options.percent) || (parseInt(o.options.percent) == 0 ? 0 : (mode == 'hide' ? 0 : 100));
            var direction = o.options.direction || 'both';
            var origin = o.options.origin;
            if (mode != 'effect') {
                origin = origin || ['middle', 'center'];
                o.options.restore = true;
            }
            var original = {height: el.height(), width: el.width()};
            el.from = o.options.from || (mode == 'show' ? {height: 0, width: 0} : original);
            var factor = {y: direction != 'horizontal' ? (percent / 100) : 1, x: direction != 'vertical' ? (percent / 100) : 1};
            el.to = {height: original.height * factor.y, width: original.width * factor.x};
            if (origin) {
                var baseline = $.ec.getBaseline(origin, original);
                el.from.top = (original.height - el.from.height) * baseline.y;
                el.from.left = (original.width - el.from.width) * baseline.x;
                el.to.top = (original.height - el.to.height) * baseline.y;
                el.to.left = (original.width - el.to.width) * baseline.x;
            }
            ;
            if (o.options.fade) {
                if (mode == 'show') {
                    el.from.opacity = 0;
                    el.to.opacity = 1;
                }
                ;
                if (mode == 'hide') {
                    el.from.opacity = 1;
                    el.to.opacity = 0;
                }
                ;
            }
            ;
            o.options.from = el.from;
            o.options.to = el.to;
            el.effect('size', o.options, o.speed, o.callback);
        });
    };
    $.ec.size = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left', 'width', 'height', 'overflow', 'opacity'];
            var props1 = ['position', 'overflow', 'opacity'];
            var props2 = ['width', 'height', 'overflow'];
            var cProps = ['fontSize'];
            var vProps = ['borderTopWidth', 'borderBottomWidth', 'paddingTop', 'paddingBottom'];
            var hProps = ['borderLeftWidth', 'borderRightWidth', 'paddingLeft', 'paddingRight'];
            var mode = o.options.mode || 'effect';
            var restore = o.options.restore || false;
            var scale = o.options.scale || 'both';
            var original = {height: el.height(), width: el.width()};
            el.from = o.options.from || original;
            el.to = o.options.to || original;
            var factor = {from: {y: el.from.height / original.height, x: el.from.width / original.width}, to: {y: el.to.height / original.height, x: el.to.width / original.width}};
            if (scale == 'box' || scale == 'both') {
                if (factor.from.y != factor.to.y) {
                    props = props.concat(vProps);
                    el.from = $.ec.setTransition(el, vProps, factor.from.y, el.from);
                    el.to = $.ec.setTransition(el, vProps, factor.to.y, el.to);
                }
                ;
                if (factor.from.x != factor.to.x) {
                    props = props.concat(hProps);
                    el.from = $.ec.setTransition(el, hProps, factor.from.x, el.from);
                    el.to = $.ec.setTransition(el, hProps, factor.to.x, el.to);
                }
                ;
            }
            ;
            if (scale == 'content' || scale == 'both') {
                if (factor.from.y != factor.to.y) {
                    props = props.concat(cProps);
                    el.from = $.ec.setTransition(el, cProps, factor.from.y, el.from);
                    el.to = $.ec.setTransition(el, cProps, factor.to.y, el.to);
                }
                ;
            }
            ;
            $.ec.save(el, restore ? props : props1);
            el.show();
            $.ec.createWrapper(el);
            el.css('overflow', 'hidden').css(el.from);
            if (scale == 'content' || scale == 'both') {
                vProps = vProps.concat(['marginTop', 'marginBottom']).concat(cProps);
                hProps = hProps.concat(['marginLeft', 'marginRight']);
                props2 = props.concat(vProps).concat(hProps);
                el.find("*[width]").each(function() {
                    child = $(this);
                    if (restore)
                        $.ec.save(child, props2);
                    var c_original = {height: child.height(), width: child.width()};
                    child.from = {height: c_original.height * factor.from.y, width: c_original.width * factor.from.x};
                    child.to = {height: c_original.height * factor.to.y, width: c_original.width * factor.to.x};
                    if (factor.from.y != factor.to.y) {
                        child.from = $.ec.setTransition(child, vProps, factor.from.y, child.from);
                        child.to = $.ec.setTransition(child, vProps, factor.to.y, child.to);
                    }
                    ;
                    if (factor.from.x != factor.to.x) {
                        child.from = $.ec.setTransition(child, hProps, factor.from.x, child.from);
                        child.to = $.ec.setTransition(child, hProps, factor.to.x, child.to);
                    }
                    ;
                    child.css(child.from);
                    child.animate(child.to, o.speed, o.options.easing, function() {
                        if (restore)
                            $.ec.restore(child, props2);
                    });
                });
            }
            ;
            el.animate(el.to, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, restore ? props : props1);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);
(function($) {
    $.ec.shake = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left'];
            var mode = 'effect';
            var direction = o.options.direction || 'left';
            var distance = o.options.distance || 20;
            var times = o.options.times || 3;
            var speed = o.options.speed || 140;
            $.ec.save(el, props);
            el.show();
            $.ec.createWrapper(el);
            var ref = (direction == 'up' || direction == 'down') ? 'top' : 'left';
            var motion = (direction == 'up' || direction == 'left') ? 'pos' : 'neg';
            var animation = {}, animation1 = {}, animation2 = {};
            animation[ref] = (motion == 'pos' ? '-=' : '+=') + distance;
            animation1[ref] = (motion == 'pos' ? '+=' : '-=') + distance * 2;
            animation2[ref] = (motion == 'pos' ? '-=' : '+=') + distance * 2;
            el.animate(animation, speed, o.options.easing);
            for (var i = 1; i < times; i++) {
                el.animate(animation1, speed, o.options.easing).animate(animation2, speed, o.options.easing)
            }
            ;
            el.animate(animation1, speed, o.options.easing).animate(animation, speed / 2, o.options.easing, function() {
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);
(function($) {
    $.ec.slide = function(o) {
        this.each(function() {
            var el = $(this), props = ['position', 'top', 'left'];
            var mode = o.options.mode || 'show';
            var direction = o.options.direction || 'left';
            $.ec.save(el, props);
            el.show();
            $.ec.createWrapper(el).css({overflow: 'hidden'});
            var ref = (direction == 'up' || direction == 'down') ? 'top' : 'left';
            var motion = (direction == 'up' || direction == 'left') ? 'pos' : 'neg';
            var distance = o.options.distance || (ref == 'top' ? el.outerHeight({margin: true}) : el.outerWidth({margin: true}));
            if (mode == 'show')
                el.css(ref, motion == 'pos' ? -distance : distance);
            var animation = {};
            animation[ref] = (mode == 'show' ? (motion == 'pos' ? '+=' : '-=') : (motion == 'pos' ? '-=' : '+=')) + distance;
            el.animate(animation, o.speed, o.options.easing, function() {
                if (mode == 'hide')
                    el.hide();
                $.ec.restore(el, props);
                $.ec.removeWrapper(el);
                if (o.callback)
                    o.callback.apply(this, arguments);
            });
        });
    }
})(jQuery);