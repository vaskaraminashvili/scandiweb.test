// Display the correct form input according to the product type

const SELECT = $('#productType');
const SIZE_CONTAINER = $('#size-container');
const WEIGHT_CONTAINER = $('#weight-container');
const DIMENSIONS_CONTAINER = $('#dimensions-container');

$(document).ready(() => {
    SELECT.change(() => {
        switchTypes();
    });
    SIZE_CONTAINER.show();
    WEIGHT_CONTAINER.hide();
    DIMENSIONS_CONTAINER.hide();
    switchTypes();

    $('#product_form').on('submit', function(event){
        event.preventDefault();
        $this = $(this);
        $.ajax({
            type: "POST",
            url: '',
            dataType: 'json',
            data: $this.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if (data.status === 200) {
                   $(location).attr('href', '/');
                }
                $this.find('input').removeClass('is-invalid');
                $this.find('input').addClass('is-valid');
                $('#custom_errors').html(data.html);
                $.each(data.fields, function( index ) {
                    $("input[name='"+index+"']").removeClass('is-valid');
                    $("input[name='"+index+"']").addClass('is-invalid');
                });
            }
        });
    });
});

const switchTypes = () => {
    if (SELECT.val() === 'book') {
        WEIGHT_CONTAINER.find('input').removeAttr('disabled','disabled');
        WEIGHT_CONTAINER.show();
        SIZE_CONTAINER.find('input').attr('disabled','disabled');
        SIZE_CONTAINER.hide();
        DIMENSIONS_CONTAINER.find('input').attr('disabled','disabled');
        DIMENSIONS_CONTAINER.hide();
    }

    if (SELECT.val() === 'furniture') {
        WEIGHT_CONTAINER.find('input').attr('disabled','disabled');
        WEIGHT_CONTAINER.hide();
        SIZE_CONTAINER.find('input').attr('disabled','disabled');
        SIZE_CONTAINER.hide();
        DIMENSIONS_CONTAINER.find('input').removeAttr('disabled','disabled');
        DIMENSIONS_CONTAINER.show();
    }

    if (SELECT.val() === 'dvd') {
        WEIGHT_CONTAINER.find('input').attr('disabled','disabled');
        WEIGHT_CONTAINER.hide();
        SIZE_CONTAINER.find('input').removeAttr('disabled','disabled');
        SIZE_CONTAINER.show();
        DIMENSIONS_CONTAINER.find('input').attr('disabled','disabled');
        DIMENSIONS_CONTAINER.hide();
    }

};
