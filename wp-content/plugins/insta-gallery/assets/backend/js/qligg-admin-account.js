(function ($) {

  _.mixin({
    escapeHtml: function (attribute) {
      return attribute.replace('&amp;', /&/g)
              .replace(/&gt;/g, ">")
              .replace(/&lt;/g, "<")
              .replace(/&quot;/g, '"')
              .replace(/&#039;/g, "'");
    },
    getFormData: function ($form) {
      return $form.serializeJSON();
    }
  });

  // Model
  // ---------------------------------------------------------------------------

  var Account = Backbone.Model.extend({
    defaults: {
      access_token: ''
    }
  });

  var AccountView = Backbone.View.extend({
    events: {
      'change input': 'enable',
      'click .media-modal-close': 'close',
      'submit .media-modal-form': 'submit'
    },
    templates: {},
    initialize: function () {
      _.bindAll(this, 'open', 'render', 'close', 'enable', 'submit');
      this.init();
      this.open();
    },
    init: function () {
      this.templates.window = wp.template('qligg-modal-account-main');
    },

    render: function () {
      var modal = this;
      modal.$el.html(modal.templates.window(modal.model.attributes));
    },
    updateModel: function (e) {
      e.preventDefault();
      var modal = this,
              $form = modal.$el.find('form');
      var model = _.getFormData($form);
      this.model.set(model);
    },
    enable: function (e) {
      $('.media-modal-submit').removeProp('disabled');
      this.updateModel(e);

    },
    open: function (e) {
      this.render();
      $('body').addClass('modal-open').append(this.$el);
    },
    close: function (e) {
      e.preventDefault();
      this.undelegateEvents();
      $(document).off('focusin');
      $('body').removeClass('modal-open');
      this.remove();
      return;
    },
    submit: function (e) {
      e.preventDefault();
      var modal = this,
              $modal = modal.$el.find('#qligg_modal'),
              $spinner = $modal.find('.settings-save-status .spinner'),
              $saved = $modal.find('.settings-save-status .saved');
      $.ajax({
        url: ajaxurl,
        data: {
          action: 'qligg_add_token',
          nonce: qligg_account.nonce.qligg_add_token,
          access_token: modal.model.attributes.access_token
        },
        dataType: 'json',
        type: 'POST',
        beforeSend: function () {
          $('.media-modal-submit').prop('disabled', true);
          $spinner.addClass('is-active');
        },
        complete: function () {
          $spinner.removeClass('is-active');
        },
        error: function (response) {
          alert('Error!');
        },
        success: function (response) {
          console.log(response);
          if (response.success) {
            $modal.addClass('reload');
            $saved.addClass('is-active');
            _.delay(function () {
              $saved.removeClass('is-active');
            }, 5000);
            modal.close(e);
            window.location.reload();

          } else {
            alert(response.data);
          }
        }
      });
      return false;
    }
  });

  var AccountModal = Backbone.View.extend({
    initialize: function (e) {
      var model = new Account();
      model.set({
        access_token: ''
      });
      new AccountView({
        model: model
      });
    }
  });

  // Copy token
  // ---------------------------------------------------------------------------

  $(document).on('click', '[data-qligg-copy-token]', function (e) {
    e.preventDefault();
    $($(this).data('qligg-copy-token')).select();
    document.execCommand('copy');
  });

  // Delete token
  // -------------------------------------------------------------------------

  $(document).on('click', '[data-qligg-delete-token]', function (e) {
    e.preventDefault();
    
    var c = confirm(qligg_account.message.confirm_delete);
    
    if (!c) {
      return false;
    }

    var $button = $(e.target),
            token_id = $button.closest('[data-token_id]').data('token_id'),
            $spinner = $(e.target).closest('td').find('.spinner');

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'qligg_delete_token',
        token_id: token_id,
        nonce: qligg_account.nonce.qligg_delete_token
      },
      beforeSend: function () {
        $spinner.addClass('is-active');
      },
      success: function (response) {
        if (response.success) {
          setTimeout(function () {
            window.location.reload();
          }, 300);

        } else {
          alert(response.data);
        }
      },
      complete: function () {
        $spinner.removeClass('is-active');
      },
      error: function (jqXHR, textStatus) {
        console.log(textStatus);
      }
    });

  });

  // Save token
  // ---------------------------------------------------------------------------

  $('#qligg-add-token').on('click', function (e) {
    e.preventDefault();
    new AccountModal(e);
  });

  // Generate token
  // ---------------------------------------------------------------------------
  $(document).on('ready', function (e) {

    var hash = window.location.hash,
            access_token = hash.substring(14);

    if (access_token.length > 40) {

      var $button = $('#qligg-generate-token'),
              $spinner = $button.closest('p').find('.spinner');

      $.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
          action: 'qligg_add_token',
          access_token: access_token,
          nonce: qligg_account.nonce.qligg_add_token
        },
        beforeSend: function () {
          $button.css({'opacity': '.5', 'pointer-events': 'none'});
          $spinner.addClass('is-active');
        },
        success: function (response) {
          if (response.success) {
            setTimeout(function () {
              window.location.reload();
            }, 300);
          } else {
            alert(response.data);
          }
        },
        complete: function () {
          $button.removeAttr('style');
          $spinner.removeClass('is-active');
          window.location.hash = '';
          window.location.href.split('#')[0]
        },
        error: function (jqXHR, textStatus) {
          console.log(textStatus);
        }
      });
    }
  });
})(jQuery);