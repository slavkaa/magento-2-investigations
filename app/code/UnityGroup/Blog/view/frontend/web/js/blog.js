define(['uiComponent'], function(Component) {
    'use_strict';

    return Component.extend({
        defaults: {
            template: 'UnityGroup_Blog/blog'
        },

        initialize: function () {
            this._super();
            return this;
        },

        getDate: function (value) {
            const date = new Date(value);
            const formatter = new Intl.DateTimeFormat('en', {month: 'short'});
            const month = formatter.format(date);

            return month+ ' ' + date.getDate() + ', ' + date.getFullYear();
        }
    });
});
