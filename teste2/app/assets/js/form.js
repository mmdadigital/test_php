(function ($) {
  var picturesContainer = $('.form-container.pictures'),
      contactsContainer = $('.form-container.contacts'),
      containerRowClass = 'form-container__row';

  /**
   * Remove Picture
   */
  picturesContainer.on('click', '.remove_picture-btn',function (e) {
    e.preventDefault();
    var row      = $(this).parents('.'+containerRowClass);
    var rowClone = row.clone();

    if ($(picturesContainer).find('.'+containerRowClass).length > 1) {
      $(this).parents('.'+containerRowClass).remove();
    }
    else {
      rowClone.find('.picture-field').attr({'type': 'file', 'disabled': false, 'value': '', 'name': 'pictures[0][picture]'});
      rowClone.find('.caption-field').val('').attr('name', 'pictures[0][caption]');

      if (rowClone.find('.form-image')) rowClone.find('.form-image').remove();

      row.before(rowClone);

      $(this).parents('.'+containerRowClass).remove();
    }

    $('#add-realty-form').prepend('<input type="hidden" name="picture_delete[]" value="'+$(this).data('id')+'">');
  });

  /**
   * Add picture
   */
  picturesContainer.on('click', '.add_picture-btn',function (e) {
    e.preventDefault();
    var row       = $(this).parents('.'+containerRowClass);
    var rowClone  = row.clone();
    var rowCount  = $(picturesContainer).find('.'+containerRowClass).length - 1;

    rowClone.find('.picture-field').attr({'type': 'file', 'disabled': false, 'value': '', 'name': 'pictures['+(rowCount + 1)+'][picture]'});
    rowClone.find('.caption-field').val('').attr('name', 'pictures['+(rowCount + 1)+'][caption]');

    if (rowClone.find('.form-image')) rowClone.find('.form-image').remove();

    row.before(rowClone);
  });

  /**
   * Remove contact
   */
  contactsContainer.on('click', '.remove_contact-btn',function (e) {
    e.preventDefault();
    var row      = $(this).parents('.'+containerRowClass);
    var rowClone = row.clone();

    if ($(contactsContainer).find('.'+containerRowClass).length > 1) {
      $(this).parents('.'+containerRowClass).remove();
    }
    else {
      rowClone.find('.name-field').attr({'name': 'contacts[0][name]'}).val(0);

      row.before(rowClone);

      $(this).parents('.'+containerRowClass).remove();
    }

    $('#add-realty-form').prepend('<input type="hidden" name="contact_delete[]" value="'+$(this).data('id')+'">');
  });


  /**
   * Add contact
   */
  contactsContainer.on('click', '.add_contact-btn',function (e) {
    e.preventDefault();
    var row       = $(this).parents('.'+containerRowClass);
    var rowClone  = row.clone();
    var rowCount  = $(contactsContainer).find('.'+containerRowClass).length - 1;

    rowClone.find('.name-field').attr({'name': 'contacts['+(rowCount + 1)+'][name]'}).val(0);

    row.before(rowClone);
  });
})(jQuery);
