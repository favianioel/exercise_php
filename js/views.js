window.ArticleListView = Backbone.View.extend({
    tagName:'ul',
 
    initialize:function () {
      this.model.bind("reset", this.render, this);
      var self = this;
      this.model.bind("add", function (article) {
        $(self.el).append(new ArticleListItemView({model:article}).render().el);
      });
    },
 
    render:function (eventName) {
        _.each(this.model.models, function (article) {
            $(this.el).append(new ArticleListItemView({model:article}).render().el);
        }, this);
        return this;
    }
});
 
window.ArticleListItemView = Backbone.View.extend({
 
    tagName:"li",
    template:_.template($('#tpl-article-list-item').html()),
 
    initialize:function () {
      this.model.bind("change", this.render, this);
      this.model.bind("destroy", this.close, this);
    },
 
    render:function (eventName) {
      $(this.el).html(this.template(this.model.toJSON()));
      return this;
    },
 
    close:function () {
      $(this.el).unbind();
      $(this.el).remove();
    }
});

window.ArticleView = Backbone.View.extend({

    template:_.template($('#tpl-article-details').html()),
    authors: false,
 
    initialize:function (options) {
      // this.options = options || {};
        this.authors = new AuthorCollection();
        this.categories = new CategoryCollection();
        var self = this;
        this.authors.fetch({
          success:_.bind(function (data) {
            self.authors = data
            self.render();
          })
        });
        this.categories.fetch({
          success:_.bind(function (data) {
            self.categories = data
            self.render();
          })
        });

        this.article_categories;
        Backbone.ajax({
            url: `http://localhost:8000/api/categories/article/${this.model.id}`,
            data: "",
            success: _.bind(function (data) {
            self.article_categories = data
            self.render();
          })
        });


      this.authors.bind("change", this.render, this);
      this.categories.bind("change", this.render, this);
      this.model.bind("change", this.render, this);
    },
 
    render:function (eventName) {
        if (this.authors) {
            $.when($(this.el).html(this.template({
                article:this.model.toJSON(),
                authors: this.authors,
                categories: this.categories,
                art_cat: this.article_categories
             }))).then(function() {
            $('#article_categories').multiSelect({
                 selectableHeader: "<div class='custom-header'>all categories</div>",
                    selectionHeader: "<div class='custom-header'>article categories</div>",
            });
          });
            return this;
        }
    },
 
    events:{
        "change input":"change",
        "click .save":"saveArticle",
        "click .delete":"deleteArticle"
    },
 
    change:function (event) {
        var target = event.target;
        console.log('changing ' + target.id + ' from: ' + target.defaultValue + ' to: ' + target.value);
        // var change = {};
        // change[target.id] = target.value;
        // this.model.set(change);
    },
 
    saveArticle:function () {
        this.model.set({
            id:$('#articleId').val(),
            title:$('#title').val(),
            author_id:$('#author_id').val(),
            description:$('#description').val(),
            categories:$('#article_categories').val()
        });
        if (this.model.isNew()) {
            var self = this;
            app.articles.create(this.model, {
                success:function () {
                    app.navigate('articles/' + self.model.id, false);
                }
            });
        } else {
            this.model.save([], {
                success:function () {
                    window.history.back();
                }
            });
        }
 
        return false;
    },
 
    deleteArticle:function () {
        this.model.destroy({
            success:function () {
                alert('Article deleted successfully');
                window.history.back();
            }
        });
        return false;
    },
 
    close:function () {
        $(this.el).unbind();
        $(this.el).empty();
    }
});
window.HeaderView = Backbone.View.extend({
 
    template:_.template($('#tpl-header').html()),
 
    initialize:function () {
        this.render();
    },
 
    render:function (eventName) {
        $(this.el).html(this.template());
        return this;
    },
 
    events:{
        "click .new":"newEntity"
    },
 
    newEntity:function (event) {
      var curentPath = Backbone.history.getFragment();
      if (curentPath != "") {
        if (curentPath.indexOf('/') != -1) {
          var curentPath = curentPath.substr(0, curentPath.indexOf("/"));
        } 
        app.navigate(curentPath.concat("/new"), true);
        
      } else {
      app.navigate("articles/new", true);
      }
      
      return false;
    }
});

window.AuthorListView = Backbone.View.extend({
    tagName:'ul',
 
    initialize:function () {
      this.model.bind("reset", this.render, this);
      var self = this;
      this.model.bind("add", function (author) {
        $(self.el).append(new AuthorListItemView({model:author}).render().el);
      });
    },
 
    render:function (eventName) {
        _.each(this.model.models, function (author) {
            $(this.el).append(new AuthorListItemView({model:author}).render().el);
        }, this);
        return this;
    }
});

window.AuthorListItemView = Backbone.View.extend({
 
    tagName:"li",
    template:_.template($('#tpl-author-list-item').html()),
 
    initialize:function () {
      this.model.bind("change", this.render, this);
      this.model.bind("destroy", this.close, this);
    },
 
    render:function (eventName) {
      $(this.el).html(this.template(this.model.toJSON()));
      return this;
    },
 
    close:function () {
      $(this.el).unbind();
      $(this.el).remove();
    }
});

window.AuthorView = Backbone.View.extend({

    template:_.template($('#tpl-author-details').html()),
 
    initialize:function () {
      this.model.bind("change", this.render, this);
    },
 
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    },
 
    events:{
        "change input":"change",
        "click .save":"saveAuthor",
        "click .delete":"deleteAuthor"
    },
 
    change:function (event) {
        var target = event.target;
        console.log('changing ' + target.id + ' from: ' + target.defaultValue + ' to: ' + target.value);
    },
 
    saveAuthor:function () {
        this.model.set({
            id:$('#authorId').val(),
            name:$('#name').val()
        });
        if (this.model.isNew()) {
            var self = this;
            console.log('isNew');
            app.author.create(this.model, {
                success:function () {
                    app.navigate('authors/' + self.model.id, false);
                }
            });
        } else {
            this.model.save([], {
                success:function () {
                    window.history.back();
                }
            });
        }
 
        return false;
    },
 
    deleteAuthor:function () {
        this.model.destroy({
            success:function () {
                alert('Author deleted successfully');
                window.history.back();
            }
        });
        return false;
    },
 
    close:function () {
        $(this.el).unbind();
        $(this.el).empty();
    }
});

window.CategoryListView = Backbone.View.extend({
    tagName:'ul',
 
    initialize:function () {
      this.model.bind("reset", this.render, this);
      var self = this;
      this.model.bind("add", function (category) {
        $(self.el).append(new CategoryListItemView({model:category}).render().el);
      });
    },
 
    render:function (eventName) {
        _.each(this.model.models, function (category) {
            $(this.el).append(new CategoryListItemView({model:category}).render().el);
        }, this);
        return this;
    }
});

window.CategoryListItemView = Backbone.View.extend({
 
    tagName:"li",
    template:_.template($('#tpl-category-list-item').html()),
 
    initialize:function () {
      this.model.bind("change", this.render, this);
      this.model.bind("destroy", this.close, this);
    },
 
    render:function (eventName) {
      $(this.el).html(this.template(this.model.toJSON()));
      return this;
    },
 
    close:function () {
      $(this.el).unbind();
      $(this.el).remove();
    }
});

window.CategoryView = Backbone.View.extend({

    template:_.template($('#tpl-category-details').html()),
 
    initialize:function () {
      this.model.bind("change", this.render, this);
    },
 
    render:function (eventName) {
        $(this.el).html(this.template(this.model.toJSON()));
        return this;
    },
 
    events:{
        "change input":"change",
        "click .save":"saveCategory",
        "click .delete":"deleteCategory"
    },
 
    change:function (event) {
        var target = event.target;
        console.log('changing ' + target.id + ' from: ' + target.defaultValue + ' to: ' + target.value);
    },
 
    saveCategory:function () {
        this.model.set({
            id:$('#categoryId').val(),
            categorie:$('#category').val()
        });
        if (this.model.isNew()) {
            var self = this;
            app.category.create(this.model, {
                success:function () {
                    app.navigate('categories/' + self.model.id, false);
                }
            });
        } else {
            this.model.save([], {
                success:function () {
                    window.history.back();
                }
            });
        }
 
        return false;
    },
 
    deleteCategory:function () {
        this.model.destroy({
            success:function () {
                window.history.back();
            }
        });
        return false;
    },
 
    close:function () {
        $(this.el).unbind();
        $(this.el).empty();
    }
});