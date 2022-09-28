

$(function () {

    function countingCharacters() {

        //-------------- get and dynamically count seo title characters ----------------------------------------------------

        var seoCharInputs = $('#seo_title');
        var seoCharOutputs = $('.seo-title-character-counter');

        seoCharInputs.on('focus', function () {
            seoCharOutputs.fadeIn('fast');
            $(this).on('keyup', function () {
                seoCharOutputs.fadeIn();
                var maxLength, charLength, remainingChar;
                maxLength = 65; charLength = $(this).val().length; remainingChar = maxLength - charLength;
                if (remainingChar <= 5) {
                    seoCharOutputs.children('.char-counter').html(remainingChar).css({'color':'red','font-weight':'bold'})
                } else {
                    seoCharOutputs.children('.char-counter').html(remainingChar).css({'color':'#333','font-weight':'normal'})
                }
            })
        });

        seoCharInputs.on('blur', function () {
            seoCharOutputs.fadeOut('fast');
        });

        //-------------- get and dynamically count meta description characters ---------------------------------------------

        var metaCharInputs = $('#meta_description');
        var metaCharOutputs = $('.meta-descr-character-counter');

        metaCharInputs.on('focus', function () {
            metaCharOutputs.fadeIn('fast');
            $(this).on('keyup', function () {
                metaCharOutputs.fadeIn();
                var maxLength, charLength, remainingChar;
                maxLength = 160; charLength = $(this).val().length; remainingChar = maxLength - charLength;
                if (remainingChar <= 5) {
                    metaCharOutputs.children('.char-counter').html(remainingChar).css({'color':'red','font-weight':'bold'})
                } else {
                    metaCharOutputs.children('.char-counter').html(remainingChar).css({'color':'#333','font-weight':'normal'})
                }
            })
        });

        metaCharInputs.on('blur', function () {
            metaCharOutputs.fadeOut('fast');
        });

        //-------------- get and dynamically count description characters --------------------------------------------------

        var textInTheArea = CKEDITOR.instances.description.getData();
        var descriptionOutputs = $('.description-character-counter');
        var ckeditor = CKEDITOR.instances.description;

        var showCharactersCount = function() {
            descriptionOutputs.fadeIn('fast');
            console.log('Yes, focused...');
        };

        var hideCharactersCount = function() {
            descriptionOutputs.fadeOut('fast');
            console.log('No, blurred...');
        };

        ckeditor.on('focus', showCharactersCount, function () {
            $(this).on('keyup', function () {
                console.log('typing...')
            })
        });
    }

    countingCharacters();

    //-----------------------------------------------------------------------------------------------------------------

    // remove destination if confirmed
    $('#remove-destination-button').on('click', function () {
        var destinationName = $('input#name').val();
        if (confirm('Are you sure you want to delete ' + destinationName + ' from list of destinations? The process is irreversible, you can\'t undo!')) {
            $('#remove-destination-form').submit();
        }
    });

    // remove tour category if confirmed
    $('#remove-tour-category-button').on('click', function () {
        var categoryName = $('input#name').val();
        if (confirm('Are you sure you want to delete this ' + categoryName + ' category? The process is irreversible, you can\'t undo!')) {
            $('#remove-tour-category-form').submit();
        }
    });

    // remove tour package if confirmed
    $('#remove-tour-button').on('click', function () {
        var tourName = $('input#name').val();
        if (confirm('Are you sure you want to delete this ' + tourName + '? The process is irreversible, you can\'t undo!')) {
            $('#remove-tour-form').submit();
        }
    });

    // remove page if confirmed
    $('#remove-page-button').on('click', function (e) {
        e.preventDefault();
        var pageName = $('input#name').val();
        if (confirm('Are you sure you want to delete this ' + pageName + '? The process is irreversible, you can\'t undo!')) {
            $('#remove-page-form').submit();
        }
    });

    // remove post category if confirmed
    $('#remove-post-category-button').on('click', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this post Category?')) {
            $('#remove-post-category-form').submit();
        }
    });

    // remove post if confirmed
    $('#remove-post-button').on('click', function (e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this Blog Post?')) {
            $('#remove-post-form').submit();
        }
    })


});