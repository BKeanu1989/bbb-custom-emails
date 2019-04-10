<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!class_exists('WC_Email')) {
    return;
}
/**
 * Class WC_BBB_Customer_Reminder_Order
 */
class WC_BBB_Customer_Reminder_Order extends WC_Email
{
    /**
     * Create an instance of the class.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        // Email slug we can use to filter other data.
        $this->id = 'wc_customer_reminder_order';
        $this->title = __('Zahlungserinnerungsemail', 'bbb-custom-emails');
        $this->description = __('Erinnerungsmail, welche nach einem Zeitraum gesendet wird.', 'bbb-custom-emails');
        // For admin area to let the user know we are sending this email to customers.
        $this->customer_email = true;
        $this->heading = __('Zahlungserinnerung', 'bbb-custom-emails');
        $this->subject = sprintf(_x('Zahlungserinnerung: Deine Bestellung bei SafeBOXen vom %s', 'Standard Betreff für die Erinnerungsmail', 'bbb-custom-emails'), '{order_date}');

        $this->placeholders = array(
            '{site_title}' => $this->get_blogname(),
            '{order_date}' => '',
            '{order_number}' => '',
        );

        // Template paths.
        $this->template_html = 'emails/wc-customer-reminder-order.php';
        $this->template_plain = 'emails/plain/wc-customer-reminder-order.php';
        $this->template_base = BBB_CUSTOM_EMAIL_PATH . 'templates/';

        parent::__construct();
    }

    /**
     * Trigger Function that will send this email to the customer.
     *
     * @access public
     * @return void
     */
    public function trigger($order_id, $order = false)
    {
        $this->setup_locale();

        if ($order_id && !is_a($order, 'WC_Order')) {
            $order = wc_get_order($order_id);
        }

        if (is_a($order, 'WC_Order')) {
            $this->object = $order;
            $this->recipient = $this->object->get_billing_email();
            $this->placeholders['{order_date}'] = wc_format_datetime($this->object->get_date_created());
            $this->placeholders['{order_number}'] = $this->object->get_order_number();
        }

        if ($this->is_enabled() && $this->get_recipient()) {
            $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());
        }

        $this->restore_locale();
    }

    /**
     * Get content html.
     *
     * @access public
     * @return string
     */
    public function get_content_html()
    {
        return wc_get_template_html($this->template_html, array(
            'order' => $this->object,
            'email_heading' => $this->get_heading(),
            'sent_to_admin' => false,
            'plain_text' => false,
            'email' => $this,
        ), '', $this->template_base);
    }
    /**
     * Get content plain.
     *
     * @return string
     */
    public function get_content_plain()
    {
        return wc_get_template_html($this->template_plain, array(
            'order' => $this->object,
            'email_heading' => $this->get_heading(),
            'sent_to_admin' => false,
            'plain_text' => true,
            'email' => $this,
        ), '', $this->template_base);
    }
}
