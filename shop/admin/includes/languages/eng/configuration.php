<?php
/* ----------------------------------------------------------------------
   $Id: configuration.php,v 1.4 2008/06/04 14:41:37 r23 Exp $

   MyOOS [Shopsystem]
   http://www.oos-shop.de/

   Copyright (c) 2003 - 2016 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: configuration.php,v 1.7 2002/01/04 03:51:40 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/* ----------------------------------------------------------------------
   If you made a translation, please send to
      lang@oos-shop.de
   the translated file.
   ---------------------------------------------------------------------- */

define('TABLE_HEADING_CONFIGURATION_TITLE', 'Title');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Value');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_DATE_ADDED', 'Date Added:');
define('TEXT_INFO_LAST_MODIFIED', 'Last Modified:');


define('STORE_NAME_TITLE', 'Store Name');
define('STORE_NAME_DESC', 'The name of my store');

define('STORE_OWNER_TITLE', 'Store Owner');
define('STORE_OWNER_DESC', 'The name of my store owner');

define('STORE_OWNER_EMAIL_ADDRESS_TITLE', 'E-Mail Address');
define('STORE_OWNER_EMAIL_ADDRESS_DESC', 'The e-mail address of my store owner');

define('STORE_OWNER_VAT_ID_TITLE' , 'VAT ID of Shop Owner');
define('STORE_OWNER_VAT_ID_DESC' , 'The VAT ID of the Shop Owner');

define('STORE_ADDRESS_STREET_TITLE', 'Store Address: Street');
define('STORE_ADDRESS_STREET_DESC', 'This is the Street used on printable documents and displayed online');

define('STORE_ADDRESS_POSTCODE_TITLE', 'Store Address: Postcode');
define('STORE_ADDRESS_POSTCODE_DESC', 'This is the Postcode used on printable documents and displayed online');

define('STORE_ADDRESS_CITY_TITLE', 'Store Address: City');
define('STORE_ADDRESS_CITY_DESC', 'This is the City used on printable documents and displayed online');

define('STORE_ADDRESS_TELEPHONE_NUMBER_TITLE', 'Store Address: Phone');
define('STORE_ADDRESS_TELEPHONE_NUMBER_DESC', 'This is the Phone used on printable documents and displayed online');

define('STORE_ADDRESS_EMAIL_TITLE', 'Store Address: E-Mail Address');
define('STORE_ADDRESS_EMAIL_DESC', 'This is the e-mail address of my store ');

define('STORE_COUNTRY_TITLE', 'Country');
define('STORE_COUNTRY_DESC', 'The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>');

define('STORE_ZONE_TITLE', 'Zone');
define('STORE_ZONE_DESC', 'The zone my store is located in');


define('EXPECTED_PRODUCTS_SORT_TITLE', 'Expected Sort Order');
define('EXPECTED_PRODUCTS_SORT_DESC', 'This is the sort order used in the expected products box.');

define('EXPECTED_PRODUCTS_FIELD_TITLE', 'Expected Sort Field');
define('EXPECTED_PRODUCTS_FIELD_DESC', 'The column to sort by in the expected products box.');

define('USE_DEFAULT_LANGUAGE_CURRENCY_TITLE', 'Switch To Default Language Currency');
define('USE_DEFAULT_LANGUAGE_CURRENCY_DESC', 'Automatically switch to the language\'s currency when it is changed');

define('ADVANCED_SEARCH_DEFAULT_OPERATOR_TITLE', 'Default Search Operator');
define('ADVANCED_SEARCH_DEFAULT_OPERATOR_DESC', 'Default search operators');

define('STORE_NAME_ADDRESS_TITLE', 'Store Address and Phone');
define('STORE_NAME_ADDRESS_DESC', 'This is the Store Name, Address and Phone used on printable documents and displayed online');

define('TAX_DECIMAL_PLACES_TITLE', 'Tax Decimal Places');
define('TAX_DECIMAL_PLACES_DESC', 'Pad the tax value this amount of decimal places');

define('DISPLAY_PRICE_WITH_TAX_TITLE', 'Display Prices with Tax');
define('DISPLAY_PRICE_WITH_TAX_DESC', 'Display prices with tax included (true) or add the tax at the end (false)');

define('DISPLAY_CONDITIONS_ON_CHECKOUT_TITLE', 'Conditions on checkout');
define('DISPLAY_CONDITIONS_ON_CHECKOUT_DESC', 'Display the conditions on the checkout confirmation page before process.');

define('PRODUCTS_OPTIONS_SORT_BY_PRICE_TITLE', 'Sortierung Produktoptionen');
define('PRODUCTS_OPTIONS_SORT_BY_PRICE_DESC', 'M&ouml;chten Sie die Produktopionen nach Preisen sortieren?');

define('ENTRY_FIRST_NAME_MIN_LENGTH_TITLE', 'First Name');
define('ENTRY_FIRST_NAME_MIN_LENGTH_DESC', 'Minimum length of first name');

define('ENTRY_LAST_NAME_MIN_LENGTH_TITLE', 'Last Name');
define('ENTRY_LAST_NAME_MIN_LENGTH_DESC', 'Minimum length of last name');

define('ENTRY_DOB_MIN_LENGTH_TITLE', 'Date of Birth');
define('ENTRY_DOB_MIN_LENGTH_DESC', 'Minimum length of date of birth');

define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_TITLE', 'E-Mail Address');
define('ENTRY_EMAIL_ADDRESS_MIN_LENGTH_DESC', 'Minimum length of e-mail address');

define('ENTRY_STREET_ADDRESS_MIN_LENGTH_TITLE', 'Street Address');
define('ENTRY_STREET_ADDRESS_MIN_LENGTH_DESC', 'Minimum length of street address');

define('ENTRY_COMPANY_LENGTH_TITLE', 'Company');
define('ENTRY_COMPANY_LENGTH_DESC', 'Minimum length of company name');

define('ENTRY_POSTCODE_MIN_LENGTH_TITLE', 'Post Code');
define('ENTRY_POSTCODE_MIN_LENGTH_DESC', 'Minimum length of post code');

define('ENTRY_CITY_MIN_LENGTH_TITLE', 'City');
define('ENTRY_CITY_MIN_LENGTH_DESC', 'Minimum length of city');

define('ENTRY_STATE_MIN_LENGTH_TITLE', 'State');
define('ENTRY_STATE_MIN_LENGTH_DESC', 'Minimum length of state');

define('ENTRY_TELEPHONE_MIN_LENGTH_TITLE', 'Telephone Number');
define('ENTRY_TELEPHONE_MIN_LENGTH_DESC', 'Minimum length of telephone number');

define('ENTRY_PASSWORD_MIN_LENGTH_TITLE', 'Password');
define('ENTRY_PASSWORD_MIN_LENGTH_DESC', 'Minimum length of password');

define('CC_OWNER_MIN_LENGTH_TITLE', 'Credit Card Owner Name');
define('CC_OWNER_MIN_LENGTH_DESC', 'Minimum length of credit card owner name');

define('CC_NUMBER_MIN_LENGTH_TITLE', 'Credit Card Number');
define('CC_NUMBER_MIN_LENGTH_DESC', 'Minimum length of credit card number');

define('MIN_DISPLAY_BESTSELLERS_TITLE', 'Best Sellers');
define('MIN_DISPLAY_BESTSELLERS_DESC', 'Minimum number of best sellers to display');

define('MIN_DISPLAY_ALSO_PURCHASED_TITLE', 'Also Purchased');
define('MIN_DISPLAY_ALSO_PURCHASED_DESC', 'Minimum number of products to display in the \'This Customer Also Purchased\' block');

define('MIN_DISPLAY_XSELL_PRODUCTS_TITLE', 'Produkt-Empfehlungen');
define('MIN_DISPLAY_XSELL_PRODUCTS_DESC', 'Minimum Anzahl von Produkten, die in der \'Produkt-Empfehlungen\' Anzeige angezeigt werden');

define('MAX_ADDRESS_BOOK_ENTRIES_TITLE', 'Address Book Entries');
define('MAX_ADDRESS_BOOK_ENTRIES_DESC', 'Maximum address book entries a customer is allowed to have');

define('MAX_DISPLAY_SEARCH_RESULTS_TITLE', 'Search Results');
define('MAX_DISPLAY_SEARCH_RESULTS_DESC', 'Amount of products to list');

define('MAX_DISPLAY_PAGE_LINKS_TITLE', 'Page Links');
define('MAX_DISPLAY_PAGE_LINKS_DESC', 'Number of \'number\' links use for page-sets');

define('MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'New Products Module');
define('MAX_DISPLAY_NEW_PRODUCTS_DESC', 'Maximum number of new products to display in a category');

define('MAX_DISPLAY_UPCOMING_PRODUCTS_TITLE', 'Products Expected');
define('MAX_DISPLAY_UPCOMING_PRODUCTS_DESC', 'Maximum number of products expected to display');

define('MAX_RANDOM_SELECT_NEW_TITLE', 'Selection of Random New Products');
define('MAX_RANDOM_SELECT_NEW_DESC', 'How many records to select from to choose one random new product to display');

define('MAX_DISPLAY_PRODUCTS_NEW_TITLE', 'New Products Listing');
define('MAX_DISPLAY_PRODUCTS_NEW_DESC', 'Maximum number of new products to display in new products page');

define('MAX_DISPLAY_BESTSELLERS_TITLE', 'Best Sellers');
define('MAX_DISPLAY_BESTSELLERS_DESC', 'Maximum number of best sellers to display');

define('MAX_DISPLAY_ALSO_PURCHASED_TITLE', 'Also Purchased');
define('MAX_DISPLAY_ALSO_PURCHASED_DESC', 'Maximum number of products to display in the \'This Customer Also Purchased\' block');

define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_TITLE', 'Customer Order History-Block');
define('MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_DESC', 'Maximum number of products to display in the customer order history block');

define('MAX_DISPLAY_ORDER_HISTORY_TITLE', 'Order History');
define('MAX_DISPLAY_ORDER_HISTORY_DESC', 'Maximum number of orders to display in the order history page');

define('MAX_DISPLAY_XSELL_PRODUCTS_TITLE', 'Produkt-Empfehlungen');
define('MAX_DISPLAY_XSELL_PRODUCTS_DESC', 'Maximale Anzahl von Produkten, die im \'Produkt-Empfehlungen\'-Block angezeigt werden');

define('MAX_DISPLAY_WISHLIST_PRODUCTS_TITLE', 'Wunschzettel');
define('MAX_DISPLAY_WISHLIST_PRODUCTS_DESC', 'Maximale Produkte auf der Wunschzettel-Seite');

define('MAX_DISPLAY_WISHLIST_BOX_TITLE', 'Wunschzettel-Infobox');
define('MAX_DISPLAY_WISHLIST_BOX_DESC', 'Maximale Anzahl von Produkten, die im \'Wunschzettel\'-Block angezeigt werden');

define('MAX_DISPLAY_PRODUCTS_IN_PRODUCTS_HISTORY_BOX_TITLE', 'Anzahl der Products History');
define('MAX_DISPLAY_PRODUCTS_IN_PRODUCTS_HISTORY_BOX_DESC', 'Maximale Anzahl von Produkten, die im \'Products History\'-Block angezeigt werden');

define('SMALL_IMAGE_WIDTH_TITLE', 'Small Image Width');
define('SMALL_IMAGE_WIDTH_DESC', 'The pixel width of small images');

define('SMALL_IMAGE_HEIGHT_TITLE', 'Small Image Height');
define('SMALL_IMAGE_HEIGHT_DESC', 'The pixel height of small images');

define('SUBCATEGORY_IMAGE_WIDTH_TITLE', 'Subcategory Image Width');
define('SUBCATEGORY_IMAGE_WIDTH_DESC', 'The pixel width of subcategory images');

define('SUBCATEGORY_IMAGE_HEIGHT_TITLE', 'Subcategory Image Height');
define('SUBCATEGORY_IMAGE_HEIGHT_DESC', 'The pixel height of subcategory images');

define('CONFIG_CALCULATE_IMAGE_SIZE_TITLE', 'Calculate Image Size');
define('CONFIG_CALCULATE_IMAGE_SIZE_DESC', 'Calculate the size of images?');

define('IMAGE_REQUIRED_TITLE', 'Image Required');
define('IMAGE_REQUIRED_DESC', 'Enable to display broken images. Good for development.');

define('CUSTOMER_NOT_LOGIN_TITLE', 'Zugangsberechtigung');
define('CUSTOMER_NOT_LOGIN_DESC', 'Die Zugangsberechtigung wird durch den Administrator nach Pr&uuml;fung der Kundendaten erteilt');

define('SEND_CUSTOMER_EDIT_EMAILS_TITLE', 'Kundendaten per Mail');
define('SEND_CUSTOMER_EDIT_EMAILS_DESC', 'Die Kundendaten werden an den Shopbetreiber per eMail gesandt');

define('DEFAULT_MAX_ORDER_TITLE', 'Kundenkredit');
define('DEFAULT_MAX_ORDER_DESC', 'maximaler Wert einer Bestellung');

define('ACCOUNT_GENDER_TITLE', 'Anrede');
define('ACCOUNT_GENDER_DESC', 'Die Anrede wird angezeigt');

define('ACCOUNT_DOB_TITLE', 'Geburtsdatum');
define('ACCOUNT_DOB_DESC', 'Das Gebutsdatum wird zwingend gefordert');

define('ACCOUNT_NUMBER_TITLE', 'Kundennummer');
define('ACCOUNT_NUMBER_DESC', 'Verwaltung von eigenen Kundenummern');

define('ACCOUNT_COMPANY_TITLE', 'Firmenname');
define('ACCOUNT_COMPANY_DESC', 'Firmenname wird angezeigt');

define('ACCOUNT_OWNER_TITLE', 'Inhaber');
define('ACCOUNT_OWNER_DESC', 'Inhaber der Firmen wird angezeigt');

define('ACCOUNT_VAT_ID_TITLE', 'Umsatzsteuer ID');
define('ACCOUNT_VAT_ID_DESC', 'Die Umsatzsteuer ID bei gewerblichen Kunden kann eingegeben werden.');


define('ACCOUNT_SUBURB_TITLE', 'Stadtteil');
define('ACCOUNT_SUBURB_DESC', 'Stadtteil wird angezeigt');

define('ACCOUNT_STATE_TITLE', 'Bundesland');
define('ACCOUNT_STATE_DESC', 'Bundesland wird angezeigt');

define('NEWSLETTER_TITLE', 'Newsletter');
define('NEWSLETTER_DESC', 'Would you like to send newsletter?');

define('PRODUCTS_NOTIFICATIONS_TITLE', 'Products notifications');
define('PRODUCTS_NOTIFICATIONS_DESC', 'Would you like to send Products notifications?');

define('STORE_ORIGIN_COUNTRY_TITLE', 'Country Code');
define('STORE_ORIGIN_COUNTRY_DESC', 'Enter the &quot;ISO 3166&quot; Country Code of the Store to be used in shipping quotes.  To find your country code, visit the <A HREF=\"http://www.din.de/gremien/nas/nabd/iso3166ma/codlstp1/index.html\" TARGET=\"_blank\">ISO 3166 Maintenance Agency</A>.');

define('STORE_ORIGIN_ZIP_TITLE', 'Postal Code');
define('STORE_ORIGIN_ZIP_DESC', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.');

define('SHIPPING_MAX_WEIGHT_TITLE', 'Enter the Maximum Package Weight you will ship');
define('SHIPPING_MAX_WEIGHT_DESC', 'Carriers have a max weight limit for a single package. This is a common one for all.');

define('SHIPPING_BOX_WEIGHT_TITLE', 'Package Tare weight.');
define('SHIPPING_BOX_WEIGHT_DESC', 'What is the weight of typical packaging of small to medium packages?');

define('SHIPPING_BOX_PADDING_TITLE', 'Larger packages - percentage increase.');
define('SHIPPING_BOX_PADDING_DESC', 'For 10% enter 10');

define('PRODUCT_LIST_IMAGE_TITLE', 'Display Product Image');
define('PRODUCT_LIST_IMAGE_DESC', 'Do you want to display the Product Image?');

define('PRODUCT_LIST_MANUFACTURER_TITLE', 'Display Product Manufaturer Name');
define('PRODUCT_LIST_MANUFACTURER_DESC', 'Do you want to display the Product Manufacturer Name?');

define('PRODUCT_LIST_MODEL_TITLE', 'Display Product Model');
define('PRODUCT_LIST_MODEL_DESC', 'Do you want to display the Product Model?');

define('PRODUCT_LIST_NAME_TITLE', 'Display Product Name');
define('PRODUCT_LIST_NAME_DESC', 'Do you want to display the Product Name?');

define('PRODUCT_LIST_UVP_TITLE', 'Display Product List Price');
define('PRODUCT_LIST_UVP_DESC', 'Do you want to display the Product List Price?');

define('PRODUCT_LIST_PRICE_TITLE', 'Display Product Price');
define('PRODUCT_LIST_PRICE_DESC', 'Do you want to display the Product Price?');

define('PRODUCT_LIST_QUANTITY_TITLE', 'Display Product Quantity');
define('PRODUCT_LIST_QUANTITY_DESC', 'Do you want to display the Product Quantity?');

define('PRODUCT_LIST_WEIGHT_TITLE', 'Display Product Weight');
define('PRODUCT_LIST_WEIGHT_DESC', 'Do you want to display the Product Weight?');

define('PRODUCT_LIST_BUY_NOW_TITLE', 'Display Buy Now column');
define('PRODUCT_LIST_BUY_NOW_DESC', 'Do you want to display the Buy Now column?');

define('PRODUCT_LIST_SORT_ORDER_TITLE', 'Display Product Sort Order');
define('PRODUCT_LIST_SORT_ORDER_DESC', 'Do you want to display the Product Sort Order column?');

define('STOCK_CHECK_TITLE', 'Check stock level');
define('STOCK_CHECK_DESC', 'Check to see if sufficent stock is available');

define('STOCK_LIMITED_TITLE', 'Subtract stock');
define('STOCK_LIMITED_DESC', 'Subtract product in stock by product orders');

define('STOCK_ALLOW_CHECKOUT_TITLE', 'Allow Checkout');
define('STOCK_ALLOW_CHECKOUT_DESC', 'Allow customer to checkout even if there is insufficient stock');

define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_TITLE', 'Mark product out of stock');
define('STOCK_MARK_PRODUCT_OUT_OF_STOCK_DESC', 'Display something on screen so customer can see which product has insufficient stock');

define('STOCK_REORDER_LEVEL_TITLE', 'Stock Re-order level');
define('STOCK_REORDER_LEVEL_DESC', 'Define when stock needs to be re-ordered');

define('STORE_PAGE_PARSE_TIME_TITLE', 'Store Page Parse Time');
define('STORE_PAGE_PARSE_TIME_DESC', 'Store the time it takes to parse a page');

define('STORE_PAGE_PARSE_TIME_LOG_TITLE', 'Log Destination');
define('STORE_PAGE_PARSE_TIME_LOG_DESC', 'Directory and filename of the page parse time log');

define('STORE_PARSE_DATE_TIME_FORMAT_TITLE', 'Log Date Format');
define('STORE_PARSE_DATE_TIME_FORMAT_DESC', 'The date format');

define('DISPLAY_PAGE_PARSE_TIME_TITLE', 'Display The Page Parse Time');
define('DISPLAY_PAGE_PARSE_TIME_DESC', 'Display the page parse time (store page parse time must be enabled)');

define('USE_CACHE_TITLE', 'Use Cache');
define('USE_CACHE_DESC', 'Use caching features');

define('DOWNLOAD_ENABLED_TITLE', 'Enable download');
define('DOWNLOAD_ENABLED_DESC', 'Enable the products download functions.');

define('DOWNLOAD_BY_REDIRECT_TITLE', 'Download by redirect');
define('DOWNLOAD_BY_REDIRECT_DESC', 'Use browser redirection for download. Disable on non-Unix systems.');

define('DOWNLOAD_MAX_DAYS_TITLE', 'Expiry delay (days)');
define('DOWNLOAD_MAX_DAYS_DESC', 'Set number of days before the download link expires. 0 means no limit.');

define('DOWNLOAD_MAX_COUNT_TITLE', 'Maximum number of downloads');
define('DOWNLOAD_MAX_COUNT_DESC', 'Set the maximum number of downloads. 0 means no download authorized.');

define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_TITLE', 'Downloads Controller Download on hold message');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG_DESC', 'Downloads Controller Download on hold message');

define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_TITLE', 'Downloads Controller Order Status Value');
define('DOWNLOADS_CONTROLLER_ORDERS_STATUS_DESC', 'Downloads Controller Order Status Value - Default=2');

define('PDF_DATA_SHEET_TITLE', 'Enable PDF Data Sheet');
define('PDF_DATA_SHEET_DESC', 'M&ouml;chten Sie die Produktinformationen als PDF-Datei zum download anbieten?');

define('HEADER_COLOR_TABLE_TITLE', 'Farbe: Prospektkopf-Tabelle');
define('HEADER_COLOR_TABLE_DESC', 'Farbe in R, G, B, Werten (Beispiel: 230,230,230)');

define('PRODUCT_NAME_COLOR_TABLE_TITLE', 'Farbe: Produkname-Tabelle');
define('PRODUCT_NAME_COLOR_TABLE_DESC', 'Farbe in R, G, B, Werten (Beispiel: 230,230,230)');

define('FOOTER_CELL_BG_COLOR_TITLE', 'Hintergundfarbe: Prospektfuss');
define('FOOTER_CELL_BG_COLOR_DESC', 'Farbe in R, G, B, Werten (Beispiel: 210,210,210)');

define('SHOW_BACKGROUND_TITLE', 'Hintergrund');
define('SHOW_BACKGROUND_DESC', 'M&ouml;chten Sie die Hintergrundfarbe angezeigen?');

define('PAGE_BG_COLOR_TITLE', 'Hintergundfarbe: Prospekt');
define('PAGE_BG_COLOR_DESC', 'Farbe in R, G, B, Werten (Beispiel: 250,250,250)');

define('SHOW_WATERMARK_TITLE', 'Wasserzeichen');
define('SHOW_WATERMARK_DESC', 'M&ouml;chten Sie Ihren Firmenname als Wasserzeichen angezeigen?');

define('PAGE_WATERMARK_COLOR_TITLE', 'Wasserzeichenfarbe');
define('PAGE_WATERMARK_COLOR_DESC', 'Farbe in R, G, B, Werten (Beispiel: 236,245,255)');

define('PDF_IMAGE_KEEP_PROPORTIONS_TITLE', 'Produktbilder');
define('PDF_IMAGE_KEEP_PROPORTIONS_DESC', 'M&ouml;chten Sie die maximale bzw. minimale Produktgr&ouml;sse verwenden?');

define('MAX_IMAGE_WIDTH_TITLE', 'Breite der Produktbilder');
define('MAX_IMAGE_WIDTH_DESC', 'max. Breite in mm der Produktbilder');

define('MAX_IMAGE_HEIGHT_TITLE', 'H&ouml;he der Produktbilder');
define('MAX_IMAGE_HEIGHT_DESC', 'max. H&ouml;he in mm der Produktbilder');

define('PDF_TO_MM_FACTOR_TITLE', 'Faktor');
define('PDF_TO_MM_FACTOR_DESC', 'Produktbilder');

define('SHOW_PATH_TITLE', 'Kategoriename');
define('SHOW_PATH_DESC', 'M&ouml;chten Sie den Kategorienamen anzeigen?');

define('SHOW_IMAGES_TITLE', 'Produktbild');
define('SHOW_IMAGES_DESC', 'M&ouml;chten Sie das Produktbild anzeigen?');

define('SHOW_NAME_TITLE', 'Produktname');
define('SHOW_NAME_DESC', 'M&ouml;chten Sie den Produktnamen in der Beschreibung anzeigen?');

define('SHOW_MODEL_TITLE', 'Bestellnummer');
define('SHOW_MODEL_DESC', 'M&ouml;chten Sie die Bestellnummer anzeigen?');

define('SHOW_DESCRIPTION_TITLE', 'Produktbeschreibung');
define('SHOW_DESCRIPTION_DESC', 'M&ouml;chten Sie die Produktbeschreibung anzeigen?');

define('SHOW_MANUFACTURER_TITLE', 'Hersteller');
define('SHOW_MANUFACTURER_DESC', 'M&ouml;chten Sie den Hersteller anzeigen?');

define('SHOW_PRICE_TITLE', 'Produktpreis');
define('SHOW_PRICE_DESC', 'M&ouml;chten Sie den Produktpreis anzeigen?');

define('SHOW_SPECIALS_PRICE_TITLE', 'Sonderangebote');
define('SHOW_SPECIALS_PRICE_DESC', 'M&ouml;chten Sie den Angebotspreis anzeigen?');

define('SHOW_SPECIALS_PRICE_EXPIRES_TITLE', 'Datum Sonderangebote');
define('SHOW_SPECIALS_PRICE_EXPIRES_DESC', 'M&ouml;chten Sie das G&uuml;ltigkeitsdatum der Angebotspreise anzeigen?');

define('SHOW_TAX_CLASS_ID_TITLE', 'Steuersatz');
define('SHOW_TAX_CLASS_ID_DESC', 'M&ouml;chten Sie den Steuersatz anzeigen?');

define('SHOW_OPTIONS_TITLE', 'Produktoptionen');
define('SHOW_OPTIONS_DESC', 'M&ouml;chten Sie die Produktoptionen anzeigen?');

define('SHOW_OPTIONS_PRICE_TITLE', 'Preis der Produktoptionen');
define('SHOW_OPTIONS_PRICE_DESC', 'M&ouml;chten Sie die Preise der Produktoptionen anzeigen?');

define('SECURITY_CODE_LENGTH_TITLE', 'Redeem Code');
define('SECURITY_CODE_LENGTH_DESC', 'Set the length of the redeem code, the longer the more secure');

define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_TITLE', 'Neukunden Gutschein');
define('NEW_SIGNUP_GIFT_VOUCHER_AMOUNT_DESC', 'Determines the amount of the rebate which the new customer will receive. Leave the field empty when the new customer will not be receiving a \'Welcome Gift\'.');

define('NEW_SIGNUP_DISCOUNT_COUPON_TITLE', 'Coupon ID');
define('NEW_SIGNUP_DISCOUNT_COUPON_DESC', 'Set the coupon ID that will be sent by email to a new signup, if no id is set then no email');

define('STORE_TEMPLATES_TITLE', 'Layout Vorlage');
define('STORE_TEMPLATES_DESC', 'Shop Templates');

define('SHOW_DATE_ADDED_AVAILABLE_TITLE', 'Produkt - Datum');
define('SHOW_DATE_ADDED_AVAILABLE_DESC', 'M&ouml;chten Sie im Shop das Datum von der Aufnahme des Produktes zeigen?');

define('SHOW_COUNTS_TITLE', 'Artikelanzahl in den jeweiligen Kategorien');
define('SHOW_COUNTS_DESC', 'Anzeigen, wieviele Produkte in jeder Kategorie vorhanden sind');

define('DISPLAY_CART_TITLE', 'Display Cart After Adding Product');
define('DISPLAY_CART_DESC', 'Display the shopping cart after adding a product (or return back to their origin)');

define('SHOW_PRODUCTS_MODEL_TITLE', 'Navigation mit Bestellummer');
define('SHOW_PRODUCTS_MODEL_DESC', 'M&ouml;chten Sie die auf der Produkt-Informations-Seite die Bestellnummer in der Navation anzeigen?');

define('OOS_SMALL_IMAGE_WIDTH_TITLE', 'Small Image Width');
define('OOS_SMALL_IMAGE_WIDTH_DESC', 'The pixel width of small images');

define('OOS_SMALL_IMAGE_HEIGHT_TITLE', 'Small Image Height');
define('OOS_SMALL_IMAGE_HEIGHT_DESC', 'The pixel height of small images');

define('OOS_BIGIMAGE_WIDTH_TITLE', 'Breite grosses Bild');
define('OOS_BIGIMAGE_WIDTH_DESC', 'Breite vom grossen Bild in Pixel');

define('OOS_BIGIMAGE_HEIGHT_TITLE', 'H&ouml;he grosses Bild');
define('OOS_BIGIMAGE_HEIGHT_DESC', 'H&ouml;he vom grossen Bild in Pixel');

define('OOS_META_TITLE_TITLE', 'Shop Titel');
define('OOS_META_TITLE_DESC', 'Der Titel');

define('OOS_META_DESCRIPTION_TITLE', 'Beschreibung');
define('OOS_META_DESCRIPTION_DESC', 'Die Beschreibung Ihres Shop(max. 250 Zeichen)');

define('OOS_META_KEYWORDS_TITLE', 'Suchworte');
define('OOS_META_KEYWORDS_DESC', 'Geben Sie hier Ihre Schl&uuml;sselw&ouml;rter(durch Komma getrennt) ein(max. 250 Zeichen)');

define('OOS_META_PAGE_TOPIC_TITLE', 'Thema');
define('OOS_META_PAGE_TOPIC_DESC', 'Das Thema Ihres Shop');

define('OOS_META_AUDIENCE_TITLE', 'Zielgruppe');
define('OOS_META_AUDIENCE_DESC', 'Ihre Zielgruppe');

define('OOS_META_AUTHOR_TITLE', 'Autor');
define('OOS_META_AUTHOR_DESC', 'Der Autor des Shop');

define('OOS_META_COPYRIGHT_TITLE', 'Copyright');
define('OOS_META_COPYRIGHT_DESC', 'Der Entwickler des Shop');

define('OOS_META_PAGE_TYPE_TITLE', 'Seitentyp');
define('OOS_META_PAGE_TYPE_DESC', 'Typ der Internetpr&auml;senz');

define('OOS_META_PUBLISHER_TITLE', 'Herausgeber');
define('OOS_META_PUBLISHER_DESC', 'Der Herausgeber');

define('OOS_META_ROBOTS_TITLE', 'Indizierung');
define('OOS_META_ROBOTS_DESC', 'Typ der Indizierung');

define('OOS_META_EXPIRES_TITLE', 'G&uuml;ltigkeitsdauer');
define('OOS_META_EXPIRES_DESC', 'Angebot verf&auml;llt am:( 0 f&uuml;r h&auml;ufig ge&auml;nderte Sites)');

define('OOS_META_PAGE_PRAGMA_TITLE', 'Proxy Caching');
define('OOS_META_PAGE_PRAGMA_DESC', 'Ihr Shop soll von Proxys zwischengespeichert werden?');

define('OOS_META_REVISIT_AFTER_TITLE', 'Wiederbesuchen nach');
define('OOS_META_REVISIT_AFTER_DESC', 'Wann soll die Suchmaschine Ihre Seite wiederbesuchen?');

define('OOS_META_PRODUKT_TITLE', 'Pflege im Artikel');
define('OOS_META_PRODUKT_DESC', 'M&ouml;chten Sie Keywords und Description f&uuml;r jeden Artikel pflegen?');

define('OOS_META_INDEX_PAGE_TITLE', 'Index Seite erzeugen');
define('OOS_META_INDEX_PAGE_DESC', 'M&ouml;chten Sie eine Index-Seite mit allen Artikeln f&uuml;r Suchmaschinen erzeugen?');

define('OOS_META_INDEX_PATH_TITLE', 'Path to IndexSite');
define('OOS_META_INDEX_PATH_DESC', 'Path to store File for Spider');


define('SLAVE_LIST_IMAGE_TITLE', 'Display Slave Image');
define('SLAVE_LIST_IMAGE_DESC', 'Do you want to display the Product Image?');

define('SLAVE_LIST_MANUFACTURER_TITLE', 'Display Slave Manufacturer Name');
define('SLAVE_LIST_MANUFACTURER_DESC', 'Do you want to display the Product Manufacturer Name?');

define('SLAVE_LIST_MODEL_TITLE', 'Display Slave Model');
define('SLAVE_LIST_MODEL_DESC', 'Do you want to display the Product Model?');

define('SLAVE_LIST_NAME_TITLE', 'Display Slave Name');
define('SLAVE_LIST_NAME_DESC', 'Do you want to display the Product Name?');

define('SLAVE_LIST_PRICE_TITLE', 'Display Slave Price');
define('SLAVE_LIST_PRICE_DESC', 'Do you want to display the Product Price');

define('SLAVE_LIST_QUANTITY_TITLE', 'Display Slave Quantity');
define('SLAVE_LIST_QUANTITY_DESC', 'Do you want to display the Product Quantity?');

define('SLAVE_LIST_WEIGHT_TITLE', 'Display Slave Weight');
define('SLAVE_LIST_WEIGHT_DESC', 'Do you want to display the Product Weight?');

define('SLAVE_LIST_BUY_NOW_TITLE', 'Display Buy Now column');
define('SLAVE_LIST_BUY_NOW_DESC', 'Do you want to display the Buy Now column?');

