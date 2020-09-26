// Zapobieganie przypadkowemu opuszczeniu formularza
$('#form').areYouSure();

// Kalendarz - data i czas
$('#datetime').flatpickr ({
    "locale": "pl",
    enableTime: true,
    time_24hr: true
});


// Kalendarz - tylko data
$('#date').flatpickr ({
    "locale": "pl"
});

// Edycja Rich Text Body
function tinymce_setup_callback(editor) {

    editor.remove();
    editor = null;


    tinymce.init({
        branding: false,
        menubar: false,
        selector: 'textarea.richTextBox',
        skin_url: $('meta[name="assets-path"]').attr('content') + '?path=js/skins/voyager',
        min_height: 600,
        resize: 'vertical',
        plugins: 'link, image, code, table, textcolor, lists',
        extended_valid_elements: 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
        file_browser_callback: function (field_name, url, type, win) {
            if (type == 'image') {
                $('#upload_file').trigger('click');
            }
        },
        toolbar: 'styleselect bold italic underline | forecolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table | code',
        convert_urls: false,
        image_caption: true,
        image_title: true,
        language_url: '/vendor/tinymce/langs/pl.js',
        language: "pl",
        setup : function(ed)
        {
            ed.on('init', function()
            {
                this.getDoc().body.style.fontSize = '15';
                this.getDoc().body.style.fontFamily = 'Roboto, sans-serif';
            });
        },
        formats: {
            blockquote: { block: 'blockquote', classes: 'blockquote'}
        }
    });
}

// Material Checkbox
//const checkbox = new MDCCheckbox(document.querySelector('.mdc-checkbox'));
//const formField = new MDCFormField(document.querySelector('.mdc-form-field'));
//formField.input = checkbox;