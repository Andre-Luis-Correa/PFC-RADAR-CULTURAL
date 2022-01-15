<?php

include("../../app/database/db.php");

if (isset($_POST['add-topic'])) {
	unset($_POST['add-topic']);
	dd($_POST);
}