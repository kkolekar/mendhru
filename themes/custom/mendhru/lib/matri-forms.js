(function ($, Drupal) {
  
  Drupal.behaviors.flipFormas = {
    attach: function (context, settings) {
      
      $().hide();

      console.log("log this");
    }

  };
})(jQuery, Drupal);