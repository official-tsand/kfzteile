<?php
  require "autoloader.inc.php";

  if (isset($_POST["add-submit"])) {
    // fetch data from form after hitting the add-submit button
    $itemName = $_POST["item-name"];
    $itemCategory = $_POST["item-category"];
    $itemStock = $_POST["item-stock"];
    $itemDescription = $_POST["item-description"];
    $itemScope = $_POST["item-scope"];
    $itemCompatibility = $_POST["item-compatibility"];

    $objInsertItem = new ItemsContrl($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility);
    $objInsertItem->insertItem();

    header("location: ../index.php?error=none");
    exit();
  }
  elseif (isset($_POST["update-submit"])) {
    // fetch data from form after hitting the update-submit button
    $itemName = $_POST["item-name"];
    $itemCategory = $_POST["item-category"];
    $itemStock = $_POST["item-stock"];
    $itemDescription = $_POST["item-description"];
    $itemScope = $_POST["item-scope"];
    $itemCompatibility = $_POST["item-compatibility"];
    $itemId = $_POST["item-id"];

    $objUpdateItem = new ItemsContrl($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility);
    $objUpdateItem->updateItem($itemId);

    header("location: ../index.php?error=none");
    exit();
  }
  elseif (isset($_POST["delete-submit"])) {
    // fetch data from form after hitting the delete-submit button
    $itemName = $_POST["item-name"];
    $itemCategory = $_POST["item-category"];
    $itemStock = $_POST["item-stock"];
    $itemDescription = $_POST["item-description"];
    $itemScope = $_POST["item-scope"];
    $itemCompatibility = $_POST["item-compatibility"];
    $itemId = $_POST["item-id"];

    $objDeleteItem = new ItemsContrl($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility);
    $objDeleteItem->deleteItem($itemId);

    header("location: ../index.php?error=none");
    exit();
  }
  else {
    header("location: ../index.php?error=notallowed");
    exit();
  }
