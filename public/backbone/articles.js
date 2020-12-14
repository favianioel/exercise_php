// Models
window.Article = Backbone.Model.extend();

window.ArticleCollection = Backbone.Collection.extend({
    model:Article,
    url:"/articles"
});

// Views
window.ArticleListView = Backbone.View.extend({
 
    tagName:'td',
 
    initialize:function () {
        this.model.bind("reset", this.render, this);
    },
 
    render:function (eventName) {
        _.each(this.model.models, function (article) {
            $(this.el).append(new ArticleListItemView({model:article}).render().el);
        }, this);
        return this;
    }
 
});
 
window.ArticleListItemView = Backbone.View.extend({
 
    template:_.template($('#article-list-item').html()),
 
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    }
 
});
 
// Router
var AppRouter = Backbone.Router.extend({
 
    routes:{
        "":"list"
    },
 
    list:function () {
        this.articleList = new ArticleCollection();
        this.articleListView = new ArticleListView({model:this.articleList});
        this.articleList.fetch();
        console.log(this.articleListView);
        $('#table-row').html(this.articleListView.render().el);
    }
});
 
var app = new AppRouter();
Backbone.history.start();