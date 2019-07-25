jQuery(document).ready(function($){
  var mediaUploader;
  $('.button.manual_img_library_global').click(function(e) {
      e.preventDefault();

      var url_field_id = $(this).attr('id');
      var url_field = $('#'+url_field_id).closest('p').find('input[type=text].manual_img_library_global');
      var url_field_width = $('#'+url_field_id).closest('p').find('input[type=hidden].manual_img_library_global_width');
      var url_field_height = $('#'+url_field_id).closest('p').find('input[type=hidden].manual_img_library_global_height');

      // If the uploader object has already been created, reopen the dialog
      // if (mediaUploader) {
      //   mediaUploader.open();
      //   return;
      // }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $(url_field).val(attachment.url);
        $(url_field_width).val(attachment.width);
        $(url_field_height).val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});

jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_article_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_article_img_meta').val(attachment.url);
        $('#seopress_pro_rich_snippets_article_img_width').val(attachment.width);
        $('#seopress_pro_rich_snippets_article_img_height').val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_lb_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_lb_img_meta').val(attachment.url);
        $('#seopress_pro_rich_snippets_lb_img_width').val(attachment.width);
        $('#seopress_pro_rich_snippets_lb_img_height').val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_recipes_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_recipes_img_meta').val(attachment.url);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_videos_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_videos_img_meta').val(attachment.url);
        $('#seopress_pro_rich_snippets_videos_img_width').val(attachment.width);
        $('#seopress_pro_rich_snippets_videos_img_height').val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_product_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_product_img_meta').val(attachment.url);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_events_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_events_img_meta').val(attachment.url);
        $('#seopress_pro_rich_snippets_events_img_width').val(attachment.width);
        $('#seopress_pro_rich_snippets_events_img_height').val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});
jQuery(document).ready(function($){
  var mediaUploader;
  $('#seopress_pro_rich_snippets_review_img').click(function(e) {
      e.preventDefault();
      // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
        mediaUploader.open();
        return;
      }
      // Extend the wp.media object
      mediaUploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
        text: 'Choose Image'
      }, multiple: false });

      // When a file is selected, grab the URL and set it as the text field's value
      mediaUploader.on('select', function() {
        attachment = mediaUploader.state().get('selection').first().toJSON();
        $('#seopress_pro_rich_snippets_review_img_meta').val(attachment.url);
        $('#seopress_pro_rich_snippets_review_img_width').val(attachment.width);
        $('#seopress_pro_rich_snippets_review_img_height').val(attachment.height);
      });
      // Open the uploader dialog
      mediaUploader.open();
  });
});