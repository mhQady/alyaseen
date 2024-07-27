var useDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
tinymce.init({
    selector: ".text-editor",
    height: 700,
    plugins:
        "print preview powerpaste casechange importcss searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap mentions quickbars linkchecker emoticons advtable export code",
    toolbar:
        "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | code",
    tinycomments_mode: "embedded",
    tinycomments_author: "Author name",
    a11y_advanced_options: true,
    branding: false,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    template_cdate_format: "[Date Created (CDATE): %d/%m/%Y : %H:%M:%S]",
    template_mdate_format: "[Date Modified (MDATE): %d/%m/%Y : %H:%M:%S]",
    image_caption: true,
    quickbars_selection_toolbar:
        "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: "sliding",
    // font_formats: "MAJALLA=MAJALLA;",
    fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt",
    content_css: "/admin/css/styleeditor.css",
    // skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
    // content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
    // content_style:
    //     "ul { display: block; list-style-type: disc; margin-top: 1em; margin-bottom: 1em; margin-left: 0; margin-right: 0; padding-left: 40px } !important",
});
