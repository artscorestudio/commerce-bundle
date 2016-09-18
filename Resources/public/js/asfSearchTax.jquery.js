

// jQuery Artscore Studio Framework Search Product Plugin for Symfony2
// A jQuery Plugin used in Symfony2 project for interactive search product field
//
// version 0.1, 2015-09-21
// by Nicolas Claverie <info@artscore-studio.fr>
(function($){
    $.asfSearchTax = function(element, options) {
        
        // Plugin's default options
        // Private property accesible only from inside the plugin
        var defaults = {

        }
        
        // Reference to the current instance of the object
        , plugin = this;
        
        // Variable for the merging of defaults options and user-provider options
        plugin.settings = {};
        
        var $element = $(element), // Reference to the jQuery version of DOM element
            element = element;     // Reference to the actual DOM element
        
        // Constructor method called at the creation of the object
        plugin.init = function() {
            
            // Merge defaults options and user-provider options
            plugin.settings = $.extend({}, defaults, options);

            // Autocompletion
            plugin.autocomplete.init();
        }
        
        // Autocomplete field
        // ======================================================================
        plugin.autocomplete = {
            init: function(){
                $element.select2({
                    minimumInputLength: 3,
                    escapeMarkup: plugin.autocomplete.escapeMarkup,
                    templateResult: plugin.autocomplete.templateResult,
                    templateSelection: plugin.autocomplete.templateSelection
                });
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            processResult: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) > data.total_count
                    }
                };
            },
            templateSelection: function(data) {
                return data.name || data.text;
            },
            templateResult: function(response) {
                if (response.loading) return response.text;
                var $markup = $('<span></span>');
                $markup.text(response.name);
                return $markup;
            }
        }

        // Fire up the plugin !
        plugin.init();
    }
    
    // Add the plugin to jQuery functions (jQuery.fn object)
    $.fn.asfSearchTax = function(options) {
        
        // Iteration through the DOM elements we are attaching the plugin
        return this.each(function(){
            
            // If the plugin has not already been attached to the element
            if (undefined == $(this).data('asfSearchTax')) {
                
                // Create new instance of the plugin with current DOM element and user-provided options
                var plugin = new $.asfSearchTax(this, options);
                
                // In the jQuery version of the element,
                // store a reference to the plugin object
                // for access to the plugin form outside like 
                // element.data('asfSearchTax').createBtn(), etc.
                $(this).data('asfSearchTax', plugin);
            }
        });
    }
    
})(jQuery);

