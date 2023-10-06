// custom.js
(function ($) {
    // Wait for the document to be ready.
    $(document).ready(function () {
    //   // Select all the <a> elements within the div.product-lists.
    //   var links = $('.products-1 .product-lists a');
  
    //   // Loop through each <a> element and retrieve the 'title' attribute.
    //   links.each(function () {
    //     var title = $(this).attr('title');
    //     console.log(title); // Output the title to the console.
    //   });

    // Iterate over each link with class "dropdown-item"
    $('.products-1 .product-lists .dropdown-item').each(function(index) {
        // Get the title attribute of the current link
        var title = $(this).attr('title');
        
        // Construct the ID of the corresponding <p> tag
        var pId = 'dropdown-item-desc-' + (index + 1);
        
        // Find the <p> tag by its ID and set its text content to the title attribute
        $('#' + pId).text(title);
      });

      $('.sample-list .dropdown-item').each(function(index) {
        // Get the title attribute of the current link
        var title = $(this).attr('title');
        console.log(title + 'title');
        
        // Construct the ID of the corresponding <p> tag
        var pId = 'dropdown-item-sample-desc-' + (index + 1);
        
        // Find the <p> tag by its ID and set its text content to the title attribute
        $('#' + pId).text(title);
      });
    });
  })(jQuery);
  

