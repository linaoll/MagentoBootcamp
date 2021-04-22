define([
    'uiComponent',
    'ko',
    'jquery',    
    'mage/storage'
], function (Component, ko, $, storage, url) {
    return Component.extend({
        defaults: {
            titulo:'',
            contenido:'',
            email: '',
            image: '',
            blogs: [],
            blogsUrl:'/rest/V1/blogs?searchCriteria',
            blogPostUrl:'/rest/V1/blogs'
        },
        initialize: function() {
            this._super();
            this.getBlogs();
            return this;
        },
        initObservable: function() {
            this._super()
                .observe([
                    'title',
                    'email',
                    'content',
                    'image'
                ])
                .observe({
                    blogs: []
                });
            return this;
        },
        getBlogs: function() {
            storage.get(this.blogsUrl)
            .then($.proxy(function(data) {
                this.blogs(data.items);
            },this));    
        },
        sendBlog: function() {
            var blog = {
                'blog': {
                    "title": this.title(),
                    "email": this.email(),
                    "content": this.content(),
                    "image": this.image()
                }
            };
            storage.post(this.blogPostUrl, JSON.stringify(blog))
            .then($.proxy(function() {
                this.getBlogs();
            }, this));
        },
        
    });
});