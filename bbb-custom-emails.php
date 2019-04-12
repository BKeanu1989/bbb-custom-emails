<?php
/**
 * Plugin Name: BigBoxBerlin eigene emails
 * Version: 0.1.0
 * Author: Kevin Fechner
 * Description: Dieses Plugin fügt Erinnerungs- und Stornoemails hinzu. 
 * Text Domain: bbb-custom-emails
 * Domain Path: /languages
 */
if (!defined('ABSPATH')) {
    return;
}

/**
 * Class BBB_Custom_WC_Email
 */
class BBB_Custom_WC_Email
{
    /**
     * BBB_Custom_WC_Email constructor.
     */
    public function __construct()
    {
        // Filtering the emails and adding our own email.
        add_action('woocommerce_email_classes', array($this, 'register_emails'), 90, 1);
        // Absolute path to the plugin folder.
        define('BBB_CUSTOM_EMAIL_PATH', plugin_dir_path(__FILE__));
    }
    /**
     * @param array $emails
     *
     * @return array
     */
    public function register_emails($emails)
    {
        require_once 'emails/class-wc-customer-cancel-order.php';
        require_once 'emails/class-wc-customer-reminder-order.php';
        $emails['WC_BBB_Customer_Cancel_Order'] = new WC_BBB_Customer_Cancel_Order();
        $emails['WC_BBB_Customer_Reminder_Order'] = new WC_BBB_Customer_Reminder_Order();
        return $emails;
    }
}
new BBB_Custom_WC_Email();
