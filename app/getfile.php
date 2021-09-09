<?php
// ディレクトリトラバーサルの脆弱性を再現する処理である。
// クエリパラメーターfilenameに../../../../../etc/passwdを指定すると/etc/passwdが丸見えとなる。
$filename=$_GET['filename'];
$file = '/var/www/html/' . $filename;
if (file_exists($file) === true) {
  readfile($file);
}