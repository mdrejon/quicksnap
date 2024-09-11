/**
 *  Quicksnap Admin JS
 *
 * @since 1.0
 */

(function ($) {
  "use strict";
  $(document).ready(function () {
    // Load Css Code Editor
    // if #wtdqs_quicksnap_otp_custom_css exists
    if ($("#wtdqs_quicksnap_otp_custom_css").length > 0) {
      var editorSettings = wp.codeEditor.defaultSettings
        ? _.clone(wp.codeEditor.defaultSettings)
        : {};
      editorSettings.codemirror = _.extend({}, editorSettings.codemirror, {
        indentUnit: 1,
        tabSize: 2,
        theme: "dracula",
      });
      var editor = wp.codeEditor.initialize(
        $("#wtdqs_quicksnap_otp_custom_css"),
        editorSettings
      );
    }
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
  });
})(jQuery);
