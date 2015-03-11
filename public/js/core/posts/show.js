
var Show_Post = function() {
    var list_comments = jQuery('#list_comments');

    return {
        init : function() {
            // On Click reply comment button
            $(".reply_comment").on("click", function() {
                var _self = $(this);
                var reply_id = _self.attr('data-reply');
                jQuery("#reply_" + reply_id).fadeToggle('fast');
            });
        }
    }
}();

Show_Post.init();