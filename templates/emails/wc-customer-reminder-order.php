<?php
/**
 * Cancelled Order sent to Customer.
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_heading, $email);

$order_number = $order->get_order_number();
$order_date = $order->get_date_created();
$date_object = new DateTime($order_date);
$date_formatted = $date_object->format('Y-m-d');
?>

 <p><?php printf(__('Leider haben wir für Deine Schließfach-Bestellung mit der Bestell-Nr. #%1$s vom %2$s noch keinen Zahlungseingang verzeichnen können.', 'bbb-custom-emails'), $order_number, $date_formatted) ?></p>
 <p><?php printf(__('Sicherlich hast Du übersehen, dass die oben genannte Bestellung noch nicht ausgeglichen wurde. Wir bitten Dich daher höflich, um Ausgleich des Betrags innerhalb der nächsten 5 Tage auf das unten genannte  Konto. Andernfalls kann deine Bestellung nicht berücksichtigt werden.', 'bbb-custom-emails')) ?></p>
 <p><?php printf(__('Solltest Du den Betrag in den letzten Tagen bereits überwiesen haben, so betrachte bitte dieses Schreiben als gegenstandslos.', 'bbb-custom-emails')) ?></p>
 <p><?php printf(__('Viele Grüße,', 'bbb-custom-emails')) ?></p>
 <p><?php printf(__('Dein SafeBOXen-Team', 'bbb-custom-emails')) ?></p>
<?php
/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.
 * @since 2.5.0
 */
do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);
/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);
/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);
/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);