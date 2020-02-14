<?php
session_start();
require_once "../lib/dbsettings.php"; //匯入資料庫設定檔 (必須)
require_once "../lib/mysql.php";
$tab = $_REQUEST["tab"];
?>
<div id="data_tabs" class="easyui-tabs" data-options="fit:'true'">
<?php
$SQL = "SELECT * FROM `sys_tabs` WHERE tab_name='" . $tab . "'";
if ((int) $_SESSION["user_level"] == 9) {$SQL .= " AND NOT tab_level=0 ORDER BY tab_order";} else { $SQL .= " AND NOT tab_level=9 AND NOT tab_level=0 ORDER BY tab_order";}
$RS = run_sql($SQL);
if (is_array($RS)) {
    for ($i = 0; $i < count($RS); $i++) {
        $label = $RS[$i]["tab_label"];
        // if ($label == "管理")
        $href = $RS[$i]["tab_href"];
        // else $href = "#";
        ?>
  <div class="tab" title="<?php echo $label ?>" href="<?php echo $href ?>"></div>
<?php
}
}
?>
</div>
