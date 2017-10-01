__**Mod actions:**__
```|            Name | Actions count | Levels count |
|-----------------|---------------|--------------|
<?php
//error_reporting(0);
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT accountID,userName FROM accounts WHERE isAdmin = 1");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$mod){
	$query = $db->prepare("SELECT lastPlayed FROM users WHERE extID = :id");
	$query->execute([':id' => $mod["accountID"]]);
	$time = date("d/m/Y H:i", $query->fetchColumn());
	$query = $db->prepare("SELECT count(*) FROM modactions WHERE account = :id");
	$query->execute([':id' => $mod["accountID"]]);
	$actionscount = $query->fetchColumn();
	$query = $db->prepare("SELECT count(*) FROM modactions WHERE account = :id AND type = '1'");
	$query->execute([':id' => $mod["accountID"]]);
	$lvlcount = $query->fetchColumn();
	echo "| ".str_pad($mod["userName"], 15, " ", STR_PAD_LEFT)." | ".str_pad($actionscount, 13, " ", STR_PAD_LEFT)." | ".str_pad($lvlcount, 12, " ", STR_PAD_LEFT)." |\r\n";
}
?>
```
