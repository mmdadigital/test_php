(function($) {
  $(document).ready(function() {
    // Binds user save button.
    $('.user-submit').on('click', function() {
      var userInfo = {
        name: $('.user-name').val(),
        phones: $('.user-phones').val(),
        emails: $('.user-emails').val()
      };

      userInfo = JSON.stringify(userInfo);
      var path = '/salvar-contato/' + userInfo;

      $.get(path, function(data) {
        $('form').trigger("reset");
        alert('Usuário adicionado');
      });

      return false;
    });

    // Binds property type save button.
    $('.property-type-submit').on('click', function() {
      var propertyType = {
        name: $('form input').val(),
      };

      propertyType = JSON.stringify(propertyType);
      var path = '/salvar-tipo-imovel/' + propertyType;

      $.get(path, function(data) {
        $('form').trigger("reset");
        alert('Tipo de imóvel adicionado');
      });

      return false;
    });

    // Binds property save button.
    $('.property-submit').on('click', function() {
      var property = {
        property_type: $('.property-type option:selected').val(),
        street: $('.property-street').val(),
        number: $('.property-number').val(),
        photos: $('.property-photos').val(),
        city: $('.property-city').val(),
        state: $('.property-state').val(),
        description: $('.property-description').val(),
        responsible: $('.property-responsible option:selected').val(),
      };

      var path = '/salvar-imovel';

      $.post(path, property).done(function(data) {
        $('form').trigger("reset");
        alert('Imóvel adicionado');
      });

      return false;
    });

  });
})(jQuery);
