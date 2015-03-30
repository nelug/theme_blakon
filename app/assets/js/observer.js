// Observer

(function() {
  "use strict";
  var $, Observer;

  $ = jQuery;

  Observer = (function() {
    Observer.settings = {
      interval: 800
    };

    function Observer(form, callback, settings) {
      if (settings == null) {
        settings = {};
      }
      this.form = form;
      this.callback = callback;
      this.settings = $.extend({}, Observer.settings, settings);
      this.observe();
    }

    Observer.prototype.observe = function() {
      var _this = this;
      $(this.form.elements).change(function() {
        return _this.modified = new Date();
      });
      $(this.form.elements).keypress(function() {
        return _this.modified = new Date();
      });
      return this.every(this.settings.interval, function() {
        if (_this.modified != null) {
          _this.callback.call(_this.form);
        }
        return delete _this.modified;
      });
    };

    Observer.prototype.every = function(interval, callback) {
      return setInterval(callback, interval);
    };

    return Observer;

  })();

  $.fn.extend({
    observe: function(callback, options) {
      if (options == null) {
        options = {};
      }
      return this.each(function() {
        return new Observer(this, callback, options);
      });
    }
  });

}).call(this);