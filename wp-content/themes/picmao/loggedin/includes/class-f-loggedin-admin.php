<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die( 'Damn it.! Dude you are looking for what?' );
}

/**
 * Admin side functionality of the plugin.
 *
 * @category   Core
 * @package    LoggedIn
 * @subpackage Admin
 * @author     Joel James <me@joelsays.com>
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://thefoxe.com/products/loggedin
 */
class F_LoggedIn_Admin {

    /**
     * Initialize the class and set its properties.
     * 
     * We register all our admin hooks here.
     *
     * @since  1.0.0
     * @access public
     * 
     * @return void
     */
    public function __construct() {

        add_action('admin_init', array( $this, 'options_page' ) );
    }

    /**
     * Create new option field label to the default settings page.
     *
     * @since  1.0.0
     * @access public
     * @uses   register_setting()   To register new setting.
     * @uses   add_settings_field() To add new field to for the setting.
     * 
     * @return void
     */
    public function options_page() {

        register_setting( 'general', 'loggedin_maximum' );

        add_settings_field(
            'loggedin_label',
            '<label for="dpr">' . __( '最大活动登录', F_LOGGEDIN_DOMAIN ) . '</label>',
            array( &$this, 'fields' ),
            'general'
        );
    }

    /**
     * Create new options field to the settings page.
     *
     * @since  1.0.0
     * @access public
     * @uses   get_option() To get the option value.
     * 
     * @return void
     */
    public function fields() {
        
        // get settings value
        $value = get_option( 'loggedin_maximum', 3 );
        echo '<input type="number" name="loggedin_maximum" min="1" value="' . intval( $value ) . '" />';
        echo '<p class="description">' . __( '设定最大用户帐户中的活动登录次数.', F_LOGGEDIN_DOMAIN ) . '</p>';
        echo '<p class="description">' . __( '如果达到此限制，下次登录请求将失败，用户将不得不从一个设备注销以继续.', F_LOGGEDIN_DOMAIN ) . '</p>';
        echo '<p class="description"><strong>' . __( '警告: ', F_LOGGEDIN_DOMAIN ) . '</strong>' . __( '即使浏览器关闭，登录会话也可能存在.', F_LOGGEDIN_DOMAIN ) . '</p>';
    }

}
