// Router is responsible for driving the application. Usually
// this means populating the necessary data into models and
// collections, and then passing those to be displayed by
// appropriate views.
var Router = Backbone.Router.extend({
  routes: {
    '': 'list',  // At first we display the index route,
    'articles/new':   'newArticle',
    'articles/:id':   'articleDetails',
    'authors':        'listAuthors',
    'authors/new':    'newAuthor',
    'authors/:id':    'authorDetails',
    'categories':     'listCategories',
    'categories/new': 'newCategory',
    'categories/:id': 'categoryDetails'   
  },

  initialize:function () {
    $('#header').html(new HeaderView().render().el);
  },

  list:function () {
    this.articleList = new ArticleCollection();
    var self = this;
    this.articleList.fetch({
      success:function () {
        self.articleListView = new ArticleListView({model:self.articleList});
        $('#sidebar').html(self.articleListView.render().el);
        if (self.requestedId) self.articleDetails(self.requestedId);
      }
    });
  },

  articleDetails: function(id) {
    if (this.articleList) {
      this.article = this.articleList.get(id);

      if (this.articleView) this.articleView.close();
      this.articleView = new ArticleView({model:this.article});
      if (this.articleView.render()) {
        $('#content').html(this.articleView.render().el);
      }
    } else {
      this.requestedId = id;
      this.list();
    }
  },

  newArticle:function () {
    if (app.articleView) app.articleView.close();
    app.articleView = new ArticleView({model:new Article()});
    $('#content').html(app.articleView.render().el);
  },

  listAuthors:function () {
    this.authorList = new AuthorCollection();
    var self = this;
    this.authorList.fetch({
      success:function () {
        self.authorListView = new AuthorListView({model:self.authorList});
        $('#sidebar').html(self.authorListView.render().el);
        if (self.requestedId) self.authorDetails(self.requestedId);
      }
    });
  },

  authorDetails: function(id) {
    if (this.authorList) {
      this.author = this.authorList.get(id);
      if (this.authorView) this.authorView.close();
      this.authorView = new AuthorView({model:this.author});
      $('#content').html(this.authorView.render().el);
    } else {
      this.requestedId = id;
      this.list();
    }
  },

  newAuthor:function () {
    if (app.authorView) app.authorView.close();
    app.authorView = new AuthorView({model:new Author()});
    $('#content').html(app.authorView.render().el);
  },

  listCategories:function () {
    this.categoryList = new CategoryCollection();
    var self = this;
    this.categoryList.fetch({
      success:function () {
        self.categoryListView = new CategoryListView({model:self.categoryList});
        $('#sidebar').html(self.categoryListView.render().el);
        if (self.requestedId) self.categoryDetails(self.requestedId);
      }
    });
  },

  categoryDetails: function(id) {
    if (this.categoryList) {
      this.category = this.categoryList.get(id);
      if (this.categoryView) this.categoryView.close();
      this.categoryView = new CategoryView({model:this.category});
      $('#content').html(this.categoryView.render().el);
    } else {
      this.requestedId = id;
      this.list();
    }
  },

  newCategory:function () {
    if (app.categoryView) app.categoryView.close();
    app.categoryView = new CategoryView({model:new Category()});
    $('#content').html(app.categoryView.render().el);
  },
});

var app = new Router();
// And tell Backbone to start routing
Backbone.history.start();