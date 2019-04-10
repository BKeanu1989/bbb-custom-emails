<?php
/**
 * Admin cancelled order email (plain text)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/admin-cancelled-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates/Emails/Plain
 * @version     2.5.0
 */
if (!defined('ABSPATH')) {
    exit;
}
echo "= " . $email_heading . " =\n\n";
echo sprintf(__('Leider haben wir für Deine Schließfach-Bestellung mit der Bestell-Nr. #%1$s vom %2$s noch keinen Zahlungseingang verzeichnen können.', 'bbb-custom-emails'), $order->get_order_number(), $order->get_date_created()) . "\n\n";
echo sprintf(__('Sicherlich hast Du übersehen, dass die oben genannte Bestellung noch nicht ausgeglichen wurde. Wir bitten Dich daher höflich um Ausgleich des Betrags innerhalb der nächsten 5 Tage auf das unten genannte  Konto. Nach Ablauf der Frist wird Deine Bestellung automatisch storniert.', 'bbb-custom-emails')) . "\n\n";
echo sprintf(__('Solltest Du den Betrag in den letzten Tagen bereits überwiesen haben, so betrachte bitte dieses Schreiben als gegenstandslos.', 'bbb-custom-emails')) . "\n\n";
echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";
/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.
 * @since 2.5.0
 */
do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";
/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);
/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";
echo apply_filters('woocommerce_email_footer_text', get_option('woocommerce_email_footer_text'));
