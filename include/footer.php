<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    jQuery(document).ready(function () {
        jQuery("form#form-fm :input,select").bind('change keyup', function () {
            var name = $(this).find(':selected').attr('data-id');
            var current = $('#currentFormControlInput1').val();
            var desired = $('#desiredFormControlInput1').val();
            jQuery('#desiredFormControlInput1').removeClass('border-red');
            jQuery('.dna-error').hide();
            if (current != '' && desired != '') {
                if ( parseFloat(current) < parseFloat(desired) ){
                    jQuery('#desiredFormControlInput1').removeClass('border-red');
                    jQuery('.dna-error').hide();
                } else {
                    jQuery('#desiredFormControlInput1').addClass('border-red');
                    jQuery('.dna-error').show();
                }
            }

            if (name !== undefined) {
                $('#dia-hidden').val(name);
            }
            jQuery.ajax({
                url: 'action.php',
                type: 'POST',
                data: jQuery("form#form-fm").serialize(),
                success: function (data) {
                    console.log(data);
                    jQuery('.dinasaur-image').html(data.img);
                    jQuery('.c-dna').html('<h3>' + data.current_dna + '</h3>');
                    jQuery('.r-dna').html('<h3>' + data.required_dna + '</h3>');
                    jQuery('.coin-spent').html('<h3>' + data.coins_spent + '</h3>');
                    jQuery('.coin-required').html('<h3>' + data.coins_required + '</h3>');
                    jQuery('.exp_point').html('<h3>' + data.exp_point + '</h3>');

                }
            });
        });

    });
</script>
</body>
</html>