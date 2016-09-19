jQuery.validator.setDefaults({
  highlight: function(element) {
    jQuery(element).closest('.form-group').addClass('has-danger');
    jQuery(element).closest('.form-control').addClass('form-control-danger');
  },
  unhighlight: function(element) {
    jQuery(element).closest('.form-group').removeClass('has-danger');
    jQuery(element).closest('.form-control').removeClass('form-control-danger');
  },
  errorElement: 'div',
  errorClass: 'form-control-feedback',
  errorPlacement: function(error, element) {
      if(element.parent('.input-group').length) {
          error.insertAfter(element.parent());
      } else {
          error.insertAfter(element);
      }
  }
});
