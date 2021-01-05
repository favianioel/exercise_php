// Models
window.Article = Backbone.Model.extend();

window.ArticleCollection = Backbone.Collection.extend({
    model:Article,
    url:"/articles"
});

// Views
window.ArticleListView = Backbone.View.extend({
 
    tagName:'ul',

    initialize:function () {
        this.model.bind("reset", this.render, this);
    },

    render:function (eventName) {
        this.model.each(function (article) {
            $(this.el).append(new ArticleListItemView({model:article}).render().el);
        }, this);
        return this;
    }
 
});

window.ArticleListItemView = Backbone.View.extend({

    tagName:"li",

    template: Handlebars.compile($('#article-list-item').html()),

    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }

});

window.ArticleView = Backbone.View.extend({

    template:Handlebars.compile($('#article-details').html()),

    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }

});
 
// Router
var AppRouter = Backbone.Router.extend({
 
    routes : {
        "" : "list",
        "articles/:id" : "articleDetails"
    },
 
    list : function () {
        this.articleList = new ArticleCollection();
        this.articleListView = new ArticleListView({model:this.articleList});
        this.articleList.fetch();
        $('#table-row').innerHTML = this.articleListView.render().el;
    },

    articleDetails : function (id) {
        this.article = this.articleList.get(id);
        this.articleView = new ArticleView({model:this.article});
        $('#content').html(this.articleView.render().el);
    }
});
 
var app = new AppRouter();
Backbone.history.start();