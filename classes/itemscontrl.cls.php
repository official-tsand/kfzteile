<?php
  class ItemsContrl extends ItemsModel
    {
      private $itemName;
      private $itemCategory;
      private $itemStock;
      private $itemDescription;
      private $itemScope;
      private $itemCompatibility;

      public function __construct($name, $category, $stock, $description, $scope, $compatibility) {
        $this->itemName = $name;
        $this->itemCategory = $category;
        $this->itemStock = $stock;
        $this->itemDescription = $description;
        $this->itemScope = $scope;
        $this->itemCompatibility = $compatibility;
      }

      public function insertItem() {
        if ($this->checkInput($this->itemName) == false) {
          header("location: ../index.php?error=knownelement");
          exit();
        }
        else {
          $this->insertElement($this->itemName, $this->itemCategory, $this->itemStock, $this->itemDescription, $this->itemScope, $this->itemCompatibility);
        }
      }

      public function updateItem($itemId) {
        $this->updateElement($itemId, $this->itemName, $this->itemCategory, $this->itemStock, $this->itemDescription, $this->itemScope, $this->itemCompatibility);
      }

      public function deleteItem($itemId) {
        $this->deleteElement($itemId);
      }
    }
