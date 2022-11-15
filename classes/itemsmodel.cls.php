<?php
  class ItemsModel extends DbConnection
    {
      protected function checkInput($itemName) {
        $statusInput;

        $stmt = $this->connect()->prepare("SELECT item_name FROM items WHERE item_name = ?;");

        if (!$stmt->execute(array($itemName))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
        }

        if ($stmt->rowCount() > 0) {
          $statusInput = false;
        }
        else {
          $statusInput = true;
        }

        $stmt = null;
        return $statusInput;
      }

      protected function insertElement($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility) {
        $stmt = $this->connect()->prepare("INSERT INTO items (item_name, item_category, item_stock, item_description, item_delivery_scope, item_compatibility) VALUES (?, ?, ?, ?, ?, ?);");

        if (!$stmt->execute(array($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
        }

        $stmt = null;
      }

      protected function fetchElements($itemId) {
        if ($itemId == "all") {
          $stmt = $this->connect()->prepare("SELECT item_id, item_name, item_category, item_stock, item_description, item_delivery_scope, item_compatibility FROM items;");

          if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
          }
        }
        else {
          $stmt = $this->connect()->prepare("SELECT item_id, item_name, item_category, item_stock, item_description, item_delivery_scope, item_compatibility FROM items WHERE item_id = ?;");

          if (!$stmt->execute(array($itemId))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
          }
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $result;
      }

      protected function updateElement($itemId, $itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility) {
        $stmt = $this->connect()->prepare("UPDATE items SET item_name = ?, item_category = ?, item_stock = ?, item_description = ?, item_delivery_scope = ?, item_compatibility = ? WHERE item_id = ?;");

        if (!$stmt->execute(array($itemName, $itemCategory, $itemStock, $itemDescription, $itemScope, $itemCompatibility, $itemId))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
        }

        $stmt = null;
      }

      protected function deleteElement($itemId) {
        $stmt = $this->connect()->prepare("DELETE FROM items WHERE item_id = ?;");

        if (!$stmt->execute(array($itemId))) {
          $stmt = null;
          header("location: ../index.php?error=stmtfailed");
          exit();
        }

        $stmt = null;
      }
    }
