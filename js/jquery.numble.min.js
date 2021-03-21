/*
 *  numble - v1.1.0
 *  Simple jQuery number selector
 *  https://github.com/jasonyost/numble#readme
 *
 *  Made by 
 *  Under MIT License
 */
// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function($, window, document, undefined) {

	"use strict";

	// undefined is used here as the undefined global variable in ECMAScript 3 is
	// mutable (ie. it can be changed by someone else). undefined isn"t really being
	// passed in so we can ensure the value of it is truly undefined. In ES5, undefined
	// can no longer be modified.

	// window and document are passed through as local variable rather than global
	// as this (slightly) quickens the resolution process and can be more efficiently
	// minified (especially when both are regularly referenced in your plugin).

	// Create the defaults once
	var pluginName = "numble",
		defaults = {
			debug: false,
			includeButtons: true,
			allowNegative: true,
			maxValue: undefined,
			minValue: undefined,
			initialValue: undefined,
			allowScroll: true,
			incrementText: "&#x25B2;",
			decrementText: "&#x25BC;",
			allowEdit: true,
			hideButtonsOnMinMax: false
		};

	// The actual plugin constructor
	function Plugin(element, options) {
		this.element = element;
		// jQuery has an extend method which merges the contents of two or
		// more objects, storing the result in the first object. The first object
		// is generally empty as we don"t want to alter the default options for
		// future instances of the plugin
		this.settings = $.extend({}, defaults, options);
		this._defaults = defaults;
		this._name = pluginName;

		// expose canIncrement
		this.incrementable = function(){
			var current_val = parseInt($(this.element).val());
			var can = this.canIncrement(current_val, this.settings);
			this.debugMessage("incrementable called : " + can);
			return can;
		};

		// expose canDecrement
		this.decrementable = function(){
			var current_val = parseInt($(this.element).val());
			var resp = this.canDecrement(current_val, this.settings);
			this.debugMessage("incrementable called : " + resp.can);
			return resp.can;
		};

		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend(Plugin.prototype, {
		init: function() {
			var numble = this;
			numble.debugMessage("numble initialized");
			numble.initDom(numble.element, numble.settings);
			numble.bindElementChange(numble.element, numble.settings);
			numble.bindNumbleScroll(numble.element, numble.settings);
			numble.initValue(numble.element, numble.settings);
			numble.addButtons(numble.element, numble.settings);
		},
		initDom: function(element, settings){
			var numble = this;
			// Add a wrapper for the control
			$(element).wrap("<div class=\"numble-wrapper\"></div>");

			// Hide the original control to prevent default browser styling interference
			$(element).addClass("numble-original");
			$(element).hide();

			// Inject a new element into the page to handle the display control of the numbers
			$(element).after("<div class=\"numble-control\"><div class=\"numble-value\" " + (settings.allowEdit && !numble.isReadonly(element) ? "contenteditable" : "") + "></div></div>");

		},
		bindElementChange: function(element){
			var numble = this;
			var control = numble.getNumbleControl(element);
			// bind to change event of the input to update the new control
			$(element).change(function() {
				numble.debugMessage("change detected: " + $(this).val());
				control.text($(this).val());
				var incrementButton = numble.getIncrementButton(element);
				var decrementButton = numble.getDecrementButton(element);

				if(numble.settings.includeButtons && numble.settings.hideButtonsOnMinMax)
				{
					if(numble.canIncrement(numble.getCurrentValue(element), numble.settings))
					{
						incrementButton.show();
					}else{
						console.log();
						incrementButton.hide();
					}
					if(numble.canDecrement(numble.getCurrentValue(element), numble.settings).can)
					{
						decrementButton.show();
					}else{
						decrementButton.hide();
					}
				}
			});

			control.keydown(function(e){
				if (String.fromCharCode(e.keyCode).match(/[^0-9]/g) && e.keyCode !== 8){
					return false;
				}
			});

			control.blur(function(){
				if(control.text() > numble.settings.maxValue){
					numble.debugMessage("value set greater than maxValue, reverting");
					control.text($(element).val());
					return;
				}
				if(control.text() < numble.settings.minValue){
					numble.debugMessage("value set less than minValue, reverting");
					control.text($(element).val());
					return;
				}
				$(element).val(control.text()).trigger("change");
			});

		},
		bindNumbleScroll: function(element, settings){
			var numble = this;
			var control = numble.getNumbleControl(element);

			// bind the mouse wheel to the control
			if(settings.allowScroll){
				control.bind("mousewheel DOMMouseScroll", function(e) {
					numble.debugMessage("received scroll event");
					if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
						numble.debugMessage("received scroll up event");
						numble.incrementValue(element);
					} else {
						numble.debugMessage("received scroll down event");
						numble.decrementValue(element, settings);
					}
					e.preventDefault();
				});
			}
		},
		initValue: function(element, settings){
			var numble = this;

			// Display the original value of the control
			var originalValue = this.getIntialValue(element, settings);
			numble.debugMessage("original value " + originalValue);
			$(element).val(originalValue);
			$(element).change();
		},
		getNumbleControl: function(element){
			return $(element).siblings(".numble-control").find(".numble-value");
		},
		addButtons: function(element, settings) {
			var numble = this;
			if(settings.includeButtons){
				var n = $(element).siblings(".numble-control");
				var current_value = numble.getCurrentValue(element);

				n.append("<span class=\"numble-increment numble-arrow\">"+ settings.incrementText +"</span>");
				n.find(".numble-increment").click(function(){
					numble.incrementValue(element);
				});

				if(settings.hideButtonsOnMinMax && !numble.canIncrement(current_value, settings))
				{
					numble.debugMessage("hideButtonsOnMinMax set, current value: " + current_value + ", cannot increment, hiding button");
					n.find(".numble-increment").hide();
				}

				n.append("<span class=\"numble-decrement numble-arrow\">"+ settings.decrementText +"</span>");
				n.find(".numble-decrement").click(function(){
					numble.decrementValue(element, settings);
				});

				if(settings.hideButtonsOnMinMax && !numble.canDecrement(current_value, settings).can)
				{
					numble.debugMessage("hideButtonsOnMinMax set, current value: " + current_value + ", cannot decrement, hiding button");
					n.find(".numble-decrement").hide();
				}
			}
		},
		canIncrement: function(current_val, settings){
			if(settings.maxValue && current_val < settings.maxValue){
				return true;
			}
			if(!settings.maxValue){
				return true;
			}
		},
		incrementValue: function(element) {
			var numble = this;
			var current_val = parseInt($(element).val());

			if($(element).attr("disabled") || $(element).attr("readonly")){
				this.debugMessage("control is disabled/readonly");
				return false;
			}

			if(numble.canIncrement(current_val, numble.settings)){
				current_val++;
				$(element).val(current_val).trigger("change");
				this.debugMessage("incrementing to " + current_val);
			}else{
				this.debugMessage("maxValue set to " + this.settings.maxValue);
			}
		},
		canDecrement: function(current_val, settings){
			if(settings.minValue){
				// a min value has been defined
				if(current_val <= settings.minValue){
					// cannot decrement
					return {can: false, message: "minValue set to " + settings.minValue};
				}
			}
			if(current_val === 0 && settings.allowNegative === false){
				return {can: false, message: "allowNegative set to false"};
			}
			return {can:true};
		},
		decrementValue: function(element, settings) {
			var numble = this;
			var current_val = parseInt($(element).val());

			if($(element).attr("disabled") || $(element).attr("readonly")){
				this.debugMessage("control is disabled/readonly");
				return false;
			}

			var resp = numble.canDecrement(current_val, settings);
			if(resp.can){
				current_val--;
				$(element).val(current_val).trigger("change");
				this.debugMessage("decrementing to " + current_val);
			}else{
				this.debugMessage(resp.message);
			}

		},
		getIntialValue: function(element, settings){
			var val = parseInt($(element).val()) || 0;
			if(val === 0){
				val = parseInt(settings.initialValue) || 0;
			}
			return val;
		},
		isReadonly: function(element){
			return $(element).attr("disabled") || $(element).attr("readonly");
		},
		debugMessage: function(message) {
			if (this.settings.debug) {
				console.log(message);
			}
		},
		getCurrentValue: function(element){
			var current_value = parseInt($(element).val());
			return current_value;
		},
		getIncrementButton: function(element){
			var n = $(element).siblings(".numble-control");
			return n.find(".numble-increment");
		},
		getDecrementButton: function(element){
			var n = $(element).siblings(".numble-control");
			return n.find(".numble-decrement");
		}
	});

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations
	$.fn[pluginName] = function(options) {
		return this.each(function() {
			if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	};

})(jQuery, window, document);
