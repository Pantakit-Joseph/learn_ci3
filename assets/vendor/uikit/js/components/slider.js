/*! UIkit 2.19.0 | http://www.getuikit.com | (c) 2014 YOOtheme | MIT License */
(function(addon) {

    var component;

    if (window.UIkit) {
        component = addon(UIkit);
    }

    if (typeof define == "function" && define.amd) {
        define("uikit-slider", ["uikit"], function(){
            return component || addon(UIkit);
        });
    }

})(function(UI){

    "use strict";

    var dragging, delayIdle, anchor, dragged, store = {};

    UI.component('slider', {

        defaults: {
            center    : false,
            threshold : 10,
            infinite  : true,
            activecls : 'uk-active'
        },

        boot:  function() {

            // init code
            UI.ready(function(context) {

                setTimeout(function(){

                    UI.$("[data-uk-slider]", context).each(function(){

                        var ele = UI.$(this);

                        if (!ele.data("slider")) {
                            UI.slider(ele, UI.Utils.options(ele.attr('data-uk-slider')));
                        }
                    });

                }, 0);
            });
        },

        init: function() {

            var $this = this;

            this.container = this.element.find('.uk-slider');
            this.focus     = 0;

            UI.$win.on("resize load", UI.Utils.debounce(function() {
                $this.resize(true);
            }, 100));

            this.on("click.uikit.slider", '[data-uk-slider-item]', function(e) {

                e.preventDefault();

                var item = UI.$(this).attr('data-uk-slider-item');

                if ($this.focus == item) return;

                switch(item) {
                    case 'next':
                    case 'previous':
                        $this[item=='next' ? 'next':'previous']();
                        break;
                    default:
                        $this.updateFocus(parseInt(slide, 10));
                }
            });

            this.container.on('touchstart mousedown', function(evt) {

                // ignore right click button
                if (evt.button && evt.button==2 || !$this.active) {
                    return;
                }

                anchor  = UI.$(evt.target).is('a') ? UI.$(evt.target) : UI.$(evt.target).parents('a:first');
                dragged = false;

                if (anchor.length) {

                    anchor.one('click', function(e){
                        if (dragged) e.preventDefault();
                    });
                }

                delayIdle = function(e) {

                    dragged = true;

                    dragging = $this;
                    store    = {
                        touchx : parseInt(e.pageX, 10),
                        dir    : 1,
                        focus  : $this.focus,
                        base   : $this.options.center ? 'center':'area'
                    };

                    if (e.originalEvent && e.originalEvent.touches) {
                        e = e.originalEvent.touches[0];
                    }

                    dragging.element.data({
                        'pointer-start': {x: parseInt(e.pageX, 10), y: parseInt(e.pageY, 10)},
                        'pointer-pos-start': $this.pos
                    });

                    $this.container.addClass('uk-drag');

                    delayIdle = false;
                };

                delayIdle.x         = parseInt(evt.pageX, 10);
                delayIdle.threshold = $this.options.threshold;

            });

            this.resize(true);

            this.on('display.uk.check', function(){
                if ($this.element.is(":visible")) {
                    $this.resize(true);
                }
            });

            // prevent dragging links + images
            this.element.find('a,img').attr('draggable', 'false');
        },

        resize: function(focus) {

            var $this = this, pos = 0, maxheight = 0, item, width, size;

            this.items = this.container.children();
            this.vp    = this.element[0].getBoundingClientRect().width;

            this.container.css({'min-width': '', 'min-height': ''});

            this.items.each(function(idx){

                item      = UI.$(this);
                size      = item.css({'left': '', 'width':''})[0].getBoundingClientRect();
                width     = size.width;
                maxheight = Math.max(maxheight, size.height);

                item.css({'left': pos, 'width':width}).data({'idx':idx, 'left': pos, 'width': width, 'area': (pos+width), 'center':(pos - ($this.vp/2 - width/2))});

                pos += width;
            });

            this.container.css({'min-width': pos, 'min-height': maxheight});

            if (this.options.infinite && pos <= (2*this.vp) && !this.itemsResized) {

                // fill with cloned items
                this.items.each(function(idx){
                   $this.container.append($this.items.eq(idx).clone(true).attr('id', ''));
                });

                this.items.each(function(idx){
                   $this.container.append($this.items.eq(idx).clone(true).attr('id', ''));
                });

                this.itemsResized = true;

                return this.resize();
            }

            this.cw     = pos;
            this.pos    = 0;
            this.active = pos >= this.vp;

            this.container.css({
                '-ms-transform': '',
                '-webkit-transform': '',
                'transform': ''
            });

            this.updateFocus(0);
        },

        updatePos: function(pos) {
            this.pos = pos;
            this.container.css({
                '-ms-transform': 'translateX('+pos+'px)',
                '-webkit-transform': 'translateX('+pos+'px)',
                'transform': 'translateX('+pos+'px)'
            });
        },

        updateFocus: function(idx, dir) {

            if (!this.active) {
                return;
            }

            dir = dir || (idx > this.focus ? 1:-1);

            var $this = this, item = this.items.eq(idx), area, i;

            if (this.options.infinite) {
                this.infinite(idx, dir);
            }

            if (this.options.center) {

                this.updatePos(item.data('center')*-1);

                this.items.filter('.'+this.options.activecls).removeClass(this.options.activecls);
                item.addClass(this.options.activecls);

            } else {

                if (this.options.infinite) {

                    this.updatePos(item.data('left')*-1);

                } else {

                    area = 0;

                    for (i=idx;i<this.items.length;i++) {
                        area += this.items.eq(i).data('width');
                    }


                    if (area > this.vp) {

                        this.updatePos(item.data('left')*-1);

                    } else {

                        if (dir == 1) {

                            area = 0;

                            for (i=this.items.length-1;i>=0;i--) {

                                area += this.items.eq(i).data('width');

                                if (area >= this.vp) {
                                    idx = i;
                                    break;
                                }
                            }

                            this.updatePos(this.items.eq(idx).data('left')*-1);
                        }
                    }
                }
            }

            this.focus = idx;

            this.trigger('focus.uikit.slider', [idx,this.items.eq(idx), this]);
        },

        next: function() {

            var focus = this.items[this.focus + 1] ? (this.focus + 1) : (this.options.infinite ? 0:this.focus);

            this.updateFocus(focus, 1);
        },

        previous: function() {

            var focus = this.items[this.focus - 1] ? (this.focus - 1) : (this.options.infinite ? (this.items[this.focus - 1] ? this.items-1:this.items.length-1):this.focus);

            this.updateFocus(focus, -1);
        },

        infinite: function(baseidx, direction) {

            var $this = this, item = this.items.eq(baseidx), i, z = baseidx, move = [], lastvisible, area = 0;

            if (direction == 1) {


                for (i=0;i<this.items.length;i++) {

                    if (z != baseidx) {
                        area += this.items.eq(z).data('width');
                        move.push(this.items.eq(z));
                    }

                    if (area > this.vp) {
                        break;
                    }

                    z = z+1 == this.items.length ? 0:z+1;
                }

                if (move.length) {

                    move.forEach(function(itm){

                        var left = item.data('area');

                        itm.css({'left': left}).data({
                            'left'  : left,
                            'area'  : (left+itm.data('width')),
                            'center': (left - ($this.vp/2 - itm.data('width')/2))
                        });

                        item = itm;
                    });
                }


            } else {

                for (i=this.items.length-1;i >-1 ;i--) {

                    area += this.items.eq(z).data('width');

                    if (z != baseidx) {
                        move.push(this.items.eq(z));
                    }

                    if (area > this.vp) {
                        break;
                    }

                    z = z-1 == -1 ? this.items.length-1:z-1;
                }

                if (move.length) {

                    move.forEach(function(itm){

                        var left = item.data('left') - itm.data('width');

                        itm.css({'left': left}).data({
                            'left'  : left,
                            'area'  : (left+itm.data('width')),
                            'center': (left - ($this.vp/2 - itm.data('width')/2))
                        });

                        item = itm;
                    });
                }
            }
        }
    });

    // handle dragging
    UI.$doc.on('mousemove.uikit.slider touchmove.uikit.slider', function(e) {

        if (e.originalEvent && e.originalEvent.touches) {
            e = e.originalEvent.touches[0];
        }

        if (delayIdle && Math.abs(e.pageX - delayIdle.x) > delayIdle.threshold) {

            if (!window.getSelection().toString()) {
                delayIdle(e);
            } else {
                dragging = delayIdle = false;
            }
        }

        if (!dragging) {
            return;
        }

        var x, xDiff, pos, dir, focus, item, next, diff, i, z, itm;

        if (e.clientX || e.clientY) {
            x = e.clientX;
        } else if (e.pageX || e.pageY) {
            x = e.pageX - document.body.scrollLeft - document.documentElement.scrollLeft;
        }

        focus = store.focus;
        xDiff = x - dragging.element.data('pointer-start').x;
        pos   = dragging.element.data('pointer-pos-start') + xDiff;
        dir   = x > dragging.element.data('pointer-start').x ? -1:1;
        item  = dragging.items.eq(store.focus);

        if (dir == 1) {

            diff = item.data('left') + Math.abs(xDiff);

            for (i=0,z=store.focus;i<dragging.items.length;i++) {

                itm = dragging.items.eq(z);

                if (z != store.focus && itm.data('left') < diff && itm.data('area') > diff) {
                    focus = z;
                    break;
                }

                z = z+1 == dragging.items.length ? 0:z+1;
            }

        } else {

            diff = item.data('left') - Math.abs(xDiff);

            for (i=0,z=store.focus;i<dragging.items.length;i++) {

                itm = dragging.items.eq(z);

                if (z != store.focus && itm.data('area') <= item.data('left') && itm.data('center') < diff) {
                    focus = z;
                    break;
                }

                z = z-1 == -1 ? dragging.items.length-1:z-1;
            }
        }

        if (dragging.options.infinite && focus!=store._focus) {
            dragging.infinite(focus, dir);
        }

        dragging.updatePos(pos);

        store.dir     = dir;
        store._focus  = focus;
        store.touchx  = parseInt(e.pageX, 10);
        store.diff    = diff;
    });

    UI.$doc.on('mouseup.uikit.slider touchend.uikit.slider', function(e) {

        if (dragging) {

            dragging.container.removeClass('uk-drag');

            var item  = dragging.items.eq(store.focus), itm, focus = false, i, z;

            if (store.dir == 1) {

                for (i=0,z=store.focus;i<dragging.items.length;i++) {

                    itm = dragging.items.eq(z);

                    if (z != store.focus && itm.data('left') > store.diff) {
                        focus = z;
                        break;
                    }

                    z = z+1 == dragging.items.length ? 0:z+1;
                }

            } else {

                for (i=0,z=store.focus;i<dragging.items.length;i++) {

                    itm = dragging.items.eq(z);

                    if (z != store.focus && itm.data('left') < store.diff) {
                        focus = z;
                        break;
                    }

                    z = z-1 == -1 ? dragging.items.length-1:z-1;
                }
            }

            dragging.updateFocus(focus!==false ? focus:store._focus);

            dragging = delayIdle = false;
        }


    });

    return UI.slider;
});
