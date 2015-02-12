<?php
include "DropboxUploader.php";
include_once "../Settings.php";

function ExportDB($db_server, $db_user, $db_passwd, $db_name) {
  $command = "mysqldump --opt --host=$db_server --user=$db_user --password=$db_passwd --databases $db_name > $db_name.sql";
  system($command);
}

function TransferDB($db_name) {
  $uploader = new DropboxUploader('info@remedicreative.com', 'pleasant');
  $uploader->upload("$db_name.sql", 'Backups');
}

ExportDB($db_server, $db_user, $db_passwd, $db_name);
TransferDB($db_name);

// To set a cron job on JaguarPC:
// php -f /home/remediho/public_html/quickcareauto/backup/backupdb.php
?>