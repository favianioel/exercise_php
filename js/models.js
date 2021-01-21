// Our base model is "articles"
window.Article = Backbone.Model.extend({
    urlRoot:"api/articles",
    defaults:{
        "id":null,
        "title":"",
        "author_id":"",
        "description":""
      }
});

// Articles collection
window.ArticleCollection = Backbone.Collection.extend({
  url: 'api/articles',
  model: Article
});

// Authors Model and collection
window.Author = Backbone.Model.extend({
    urlRoot:"api/authors",
    defaults:{
        "id":null,
        "name":""
      }
});
window.AuthorCollection = Backbone.Collection.extend({
  url: 'api/authors',
  model: Author
});

// Category Model and collection
window.Category = Backbone.Model.extend({
    urlRoot:"api/categories",
    defaults:{
        "id":null,
        "categorie":""
      }
});
window.CategoryCollection = Backbone.Collection.extend({
  url: 'api/categories',
  model: Category
});