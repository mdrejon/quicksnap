/**
 *  Quicksnap Admin JS
 *
 * @since 1.0
 */

(function ($) {
    "use strict";
    $(document).ready(function () {  
      // if ($("#wtdqs_quicksnap_otp_custom_css").length > 0) {
      //   // Get editor settings from WordPress
      //   var editorSettings = wp.codeEditor.defaultSettings
      //     ? _.clone(wp.codeEditor.defaultSettings)
      //     : {};
    
      //   // Ensure codemirror settings exist
      //   editorSettings.codemirror = editorSettings.codemirror || {};
    
      //   // Initialize CodeMirror editor
      //   var editor = wp.codeEditor.initialize(
      //     $("#wtdqs_quicksnap_otp_custom_css")[0], // Convert jQuery object to raw DOM element
      //     editorSettings
      //   );
      // } 
     
      
      $('input[name="wtdqs-search-field"]').on("change", function () {
        alert("The input field has changed!");
        // Your code here
      });
  
      // Tabs Section added
      $(".wtdqs-metabox-tabs-btn").on("click", function (e) {
        e.preventDefault();
  
        var tab_id = $(this).attr("data-active");
        $(".wtdqs-metabox-tabs-btn").removeClass("active");
        $(".wtdqs-tabs-item").removeClass("active");
  
        $(this).addClass("active");
        $("#" + tab_id).addClass("active");

        if ($("#" + tab_id+" .wtdqs-fields-CodeField").length > 0) {
        
          $("#" + tab_id).find('.wtdqs-fields-CodeField').each(function () { 
            
             let id = $(this).find('textarea').attr("id");

             initializeCodeEditor(id);

          });
          
        }
      });

      // active tab by default
      $('.wtdqs-tabs-item.active').find('.wtdqs-fields-CodeField').each(function () {  
            
          let id = $(this).find('textarea').attr("id");
          initializeCodeEditor(id); 
      });
  
      // copy to clipboard and show message
      $(".wtdqs-quicksnap-shortcode-btn").on("click", function (e) {
        e.preventDefault();
  
        let input = $(this)
          .closest(".wtdqs-quicksnap-shortcode-wrap")
          .find(".wtdqs-quicksnap-shortcode");
        input.select();
        document.execCommand("copy");
        // show message copied int the button
        $(this).text("Copied!");
      });


      // 

      

      function initializeCodeEditor(editorID) { 
    
        // Remove existing CodeMirror instance if it exists
        // Get the textarea element
        var textarea = document.getElementById(editorID);
 
        if (textarea && textarea.nextSibling && textarea.nextSibling.CodeMirror) {
          // textarea.nextSibling.CodeMirror.toTextArea();
          return;
        }
        // Get default settings and initialize CodeMirror
        var editorSettings = wp.codeEditor.defaultSettings
          ? _.clone(wp.codeEditor.defaultSettings)
          : {};
        editorSettings.codemirror = editorSettings.codemirror || {};
        wp.codeEditor.initialize($("#" + editorID)[0], editorSettings);
      }


    
    });
  })(jQuery);
  