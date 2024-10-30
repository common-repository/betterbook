<?php
  // verify nonce
  if ( empty($_POST[BETTERBOOK_APIKEY_NONCE]) || ! wp_verify_nonce( $_POST[BETTERBOOK_APIKEY_NONCE], basename(__FILE__) ) ) {
    $betterbook_apikey = get_option('betterbook_apikey');
  }else{
    //Form data sent
    $betterbook_apikey = sanitize_text_field($_POST['betterbook_apikey']);
    update_option('betterbook_apikey', $betterbook_apikey);

    ?>
    <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
    <?php
  } 
?>

<div class="wrap bb-admin-wrap">
  
  <div class="card">
    <h2><?php _e("1. Connect your BetterBook account"); ?></h2>
    <p class="bb-admin-subtitle"><?php _e("Sign up <a href=\"https://www.betterbook.io/signup\" target=\"_blank\" rel=\"noopener\">here</a>."); ?> to get started for free.</p>
    <hr />
    <form name="betterbook_apikey" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
      
   <?  wp_nonce_field( basename(__FILE__), BETTERBOOK_APIKEY_NONCE ); ?>
      
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="betterbook_apikey"><?php _e("API Key"); ?></label>
            </th>
            <td>
              <input type="text" name="betterbook_apikey" value="<?php echo $betterbook_apikey; ?>" size="20" class="regular-text">
              <p class="description"><?php _e("Your API was sent in the welcoming email after signing up.  You can request the key to be resent through the mobile app." ); ?></p>
            </td>
          </tr>
        </tbody>
      </table>

      <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'betterbook_trdom') ?>" class="button button-primary" />
      </p>
    </form>
  </div>

  <div class="card">
      <h2><?php _e("2. Add the short code to any page or post"); ?></h2>
      <p class="bb-admin-subtitle"><?php _e("To get started, simply <b>copy</b> and <b>paste</b> this shortcode to any <b>Page</b> or <b>Post</b>."); ?></p>
      
      <p><code>[<? echo "".BETTERBOOK_SHORTCODE ?>]</code><br/></p>
      <hr />
      
      <a href="https://help.betterbook.io/" target="_blank" rel="noopener"><?php _e("learn more"); ?></a>
  </div>

 
</div>
