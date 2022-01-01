<?php
/* ----------------------------------------------------------------------
   $Id: export_excel.php,v 1.3 2007/06/13 16:15:14 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2022 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: backup.php,v 1.21 2002/06/15 11:02:56 harley_vb
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

define('HEADING_TITLE', 'Datenbanksicherung');

define('TABLE_HEADING_TITLE', 'Titel');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Grösse');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neue Sicherung');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokal wiederherstellen');
define('TEXT_INFO_NEW_BACKUP', 'Bitte den Sicherungsprozess AUF KEINEN FALL unterbrechen. Dieser kann einige Minuten in Anspruch nehmen.');
define('TEXT_INFO_UNPACK', '<br><br>(nach dem die Dateien aus dem Archiv extrahiert wurden)');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Grösse:');
define('TEXT_INFO_COMPRESSION', 'Komprimieren:');
define('TEXT_INFO_USE_GZIP', 'Mit GZIP');
define('TEXT_INFO_USE_ZIP', 'Mit ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Keine Komprimierung (Raw SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Nur herunterladen (nicht auf dem Server speichern)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Sichere HTTPS Verbindung verwenden!');
define('TEXT_NO_EXTENSION', 'Keine');
define('TEXT_EXPORT_DIRECTORY', 'Sicherungsverzeichnis:');
define('TEXT_FORGET', '(<u> vergessen</u>)');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Sicherung löschen möchten?');

define('ERROR_EXPORT_DIRECTORY_DOES_NOT_EXIST', '<strong>Fehler!</strong> Das Sicherungsverzeichnis ist nicht vorhanden.');
define('ERROR_EXPORT_DIRECTORY_NOT_WRITEABLE', '<strong>Fehler!</strong> Das Sicherungsverzeichnis ist schreibgeschützt.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', '<strong>Fehler!</strong> Download Link nicht akzeptabel.');

define('SUCCESS_DATABASE_SAVED', '<strong>Erfolg!</strong> Die Datenbank wurde gesichert.');
define('SUCCESS_DATABASE_RESTORED', '<strong>Erfolg!</strong> Die Datenbank wurde wiederhergestellt.');
define('SUCCESS_EXPORT_DELETED', '<strong>Erfolg!</strong> Die Sicherungsdatei wurde gelöscht.');
