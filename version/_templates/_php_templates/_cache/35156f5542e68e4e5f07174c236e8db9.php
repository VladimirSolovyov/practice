<?
$_SERVER['SERVER_NAME'] = punycodeDecode($_SERVER['SERVER_NAME']);
?>

<h3><?= $msgBuffer['RecoverPasswordModule']['msg3'] ?><? $_SERVER['SERVER_NAME'] ?></h3>
<p><?= $msgBuffer['RecoverPasswordModule']['msg4'] ?>:</p>

<ul>
	<li><strong><?= $msgBuffer['RecoverPasswordModule']['msg5'] ?>:</strong> <?= $userlogin ?>
	<li><strong><?= $msgBuffer['RecoverPasswordModule']['msg6'] ?>:</strong> <?= $new_password ?>
</ul>
