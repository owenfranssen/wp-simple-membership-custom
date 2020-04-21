<?php
# ----------------------------------------
# PayPal SDK & button invocation 
# - only display on membership-join page
# ----------------------------------------

IF ( ( !SwpmMemberUtils::is_member_logged_in() 
      || $user_data['account_state'] == 'expired' )
    && ( is_page('membership-join') 
      || is_front_page() )
  ) { 

  echo "<div class='d-none subscription'>".do_shortcode('[swpm_payment_button id=51]')."</div>"; // subscription
  echo "<div class='d-none membership'>".do_shortcode('[swpm_payment_button id=90]')."</div>"; // buy now
  ?>
  <!-- <script src="https://www.paypal.com/sdk/js?client-id=AdPSDtQS7Zy3yYa2FMu6jXgS5Nl7uNMk9up6DLsI4aeR9nhQ7NjuP9-LbrCEze7c8Xkhns-ulAGitLRM"  data-namespace="paypal_sdk"></script> -->
  <script>
    jQuery( function($) {
      $('#subscription, #membership').click( function(e) {
        const type = $(this).attr('id');
        $('.'+type).find('form').submit();
      });

/*
      $('#subscription, #membership').click( function(e) {
        const type = $(this).attr('id');

        $('#paypal').html('');

        if(type == 'subscription') {
          paypal_sdk.Buttons({
            createOrder: function(data, actions) {
              // https://developer.paypal.com/docs/subscriptions/integrate/#1-set-up-your-development-environment
              // https://developer.paypal.com/docs/subscriptions/integrate/#3-create-a-plan
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: '6' //get from selected button and hidden shortcode buttons
                  }
                }]
              });
            },
            style: {
              color: 'blue',
              label: 'pay'
            }
          }).render('#paypal');

          $('body,html').animate({
            scrollTop: $($(e.currentTarget).attr('href')).offset().top - 20,
          }, 600);
          
        } else {
          const amount = 58; //$('.'+type).find('form input[amount]').val();

          paypal_sdk.Buttons({
            createOrder: function(data, actions) {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: amount //get from selected button and hidden shortcode buttons
                  }
                }]
              });
            },
            style: {
              color: 'blue',
              label: 'pay'
            }
          }).render('#paypal');
        }
      });
*/
    });
  </script>
  <?php 
}