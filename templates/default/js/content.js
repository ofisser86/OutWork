var icms = icms || {};

icms.content = (function ($) {

    this.props_url = '';
    this.item_id = 0;

    this.onDocumentReady = function() { }

    //=====================================================================//

    this.initProps = function(props_url, item_id) {

        this.props_url = props_url;

        if (typeof(item_id) != 'undefined'){
            this.item_id = item_id;
        }

        $('#category_id').change(function(){
            var cat_id = $(this).val();
            icms.content.changePropsCat(cat_id);
        })

        var container = $('#fset_props');

        if($('.field', container).length == 0) { container.hide(); }

    }

    this.loadProps = function(){
        $('#category_id').trigger('change');
    }

    //=====================================================================//

    this.changePropsCat = function(cat_id) {

        var container = $('#fset_props');

        if (!cat_id) { container.html(''); container.hide(); return; }

        var url = this.props_url + '/' + cat_id;

        container.show().html('<div class="loading">'+LANG_LOADING+'</div>');

        $.post(url, {item_id: this.item_id}, function(result){

            if (!result.success) { container.html(''); container.hide(); return; }

            container.html(result.html);

        }, 'json')

    }

    //=====================================================================//

	return this;

}).call(icms.content || {},jQuery);
