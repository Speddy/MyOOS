<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: invoice.php,v 1.4 2003/02/16 13:40:33 thomasamoulton
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  define('OOS_VALID_MOD', 'yes');
  require 'includes/main.php';

  require 'includes/classes/class_currencies.php';
  $currencies = new currencies();

  $oID = oos_db_prepare_input($_GET['oID']);

  require '../includes/classes/class_order.php';
  $order = new order($oID);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?> - Administration [OOS]</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<!-- body_text //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo STORE_NAME . '<br>' . STORE_ADDRESS_STREET . '<br>' . STORE_ADDRESS_POSTCODE  . ' ' .  STORE_ADDRESS_CITY; ?></td>
        <td class="pageHeading" align="right"><?php echo oos_image(OOS_IMAGES . 'oos.gif', STORE_NAME, '130', '49'); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo ENTRY_SOLD_TO; ?></b></td>
          </tr>
          <tr>
            <td class="main"><?php echo oos_address_format($order->billing['format_id'], $order->billing, 1, '&nbsp;', '<br>'); ?></td>
          </tr>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td class="main"><?php echo $order->customer['telephone']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo ENTRY_SHIP_TO; ?></b></td>
          </tr>
          <tr>
            <td class="main"><?php echo oos_address_format($order->delivery['format_id'], $order->delivery, 1, '&nbsp;', '<br>'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b><?php echo ENTRY_ORDER_NUMBER; ?></b></td>
        <td class="main"><?php echo intval($oID); ?></td>
      <tr>
      <tr>
        <td class="main"><b><?php echo ENTRY_ORDER_DATE; ?></b></td>
        <td class="main"><?php echo oos_datetime_short($order->info['date_purchased']); ?></td>
      <tr>
      <tr>
        <td class="main"><b><?php echo ENTRY_PAYMENT_METHOD; ?></b></td>
        <td class="main"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>
    
    <table class="table table-striped w-100">
            <tr>
                <td colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td><?php echo TABLE_HEADING_PRODUCTS_SERIAL_NUMBER; ?></td>
                <td><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
                <td class="text-right"><?php echo TABLE_HEADING_TAX; ?></td>
                <td class="text-right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
                <td class="text-right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
                <td class="text-right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
                <td class="text-right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
            </tr>    
        </thead>
<?php
for ($i = 0, $n = count($order->products); $i < $n; $i++) {
    echo '      <tr class="dataTableRow">' . "\n" .
       '        <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
       '        <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

    if (isset($order->products[$i]['attributes']) && (count($order->products[$i]['attributes']) > 0)) {
        $k = count($order->products[$i]['attributes']);
        for ($j = 0; $j < $k; $j++) {
            echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
            if ($order->products[$i]['attributes'][$j]['price'] != '0') {
                echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
            }
            echo '</i></small></nobr>';
        }
    }

    echo '        </td>' . "\n";

    $serial_number = "";
    if (oos_is_not_null($order->products[$i]['serial_number'])) {
        $serial_number = $order->products[$i]['serial_number'];
    }

    echo '        <td class="dataTableContent" valign="top">' . $serial_number . '</td>' . "\n" .
       '        <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n";
    echo '        <td class="dataTableContent" align="right" valign="top">' . oos_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
       '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
       '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(oos_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
       '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n" .
       '        <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->format(oos_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</b></td>' . "\n";
    echo '      </tr>' . "\n";
}
?>
      <tr>
        <td align="right" colspan="9"><table border="0" cellspacing="0" cellpadding="2">
<?php
for ($i = 0, $n = count($order->totals); $i < $n; $i++) {
    echo '          <tr>' . "\n" .
       '            <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
       '            <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
       '          </tr>' . "\n";
}
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_text_eof //-->

<?php require 'includes/bottom.php'; ?>
<?php require 'includes/nice_exit.php'; ?>