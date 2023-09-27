jQuery( document ).ready(function( $ ) {

    /**
    * Passepartout
    */
   $(".astro_be_form_passepartout").submit(function(){

    var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
    var checkin_date_arr = checkin_date.split('-');
    $(this).find('#astro_be_form_passepartout_checkin').val(checkin_date_arr[2] + '/' + checkin_date_arr[1] + '/' + checkin_date_arr[0]); //format dd/mm/yy

    var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
    var checkout_date_arr = checkout_date.split('-');
    $(this).find('#astro_be_form_passepartout_checkout').val(checkout_date_arr[2] + '/' + checkout_date_arr[1] + '/' + checkout_date_arr[0]); //format dd/mm/yy

    var adults = $(this).find('.astro_be_select-adults').val();
    $(this).find('#astro_be_form_passepartout_adults').val(adults);

    var children = $(this).find('.astro_be_select-children').val();
    $(this).find('#astro_be_form_passepartout_children').val(children);

    /*var checkin_date = $(this).find('.astro_be_input-checkin-js').val();
    $(this).find('#astro_be_form_passepartout_fromDate').val(checkin_date);

    var checkout_date = $(this).find('.astro_be_input-checkout-js').val();
    $(this).find('#astro_be_form_passepartout_toDate').val(checkout_date);*/

    /*
    //adults
    var adults = $(this).find('.astro_be_select-adults').val();

    //collect occupancy for adults
    var occupancy = [];
    for (let i = 0; i < adults; i++) {
     occupancy.push('A');
    }

    //collect occupancy for children
    var children = $('.astro_be_select-children').length;
    if (children) {
     if( $(".astro_be_select-children option:selected").val() > 0 ) {
      if ($('.astro_be_select-children_age').length) {
       $(".astro_be_select-children_age option:selected").each(function(i){
        var childage = $(this).val();
        if (childage > 0) {
         occupancy.push(childage);
        }
       });
      }else{
       //alert($(".astro_be_select-children option:selected").val());
       for (i = 0; i < $(".astro_be_select-children option:selected").val(); i++) {
        occupancy.push(0);
       }
      }
     }
    }

    occupancy.join(","); //occupancy: convert array to string
    $(this).find('#astro_be_form_passepartout_rooms').val(occupancy); //occupancy: set value to input field
    */

   });



 });