<?php
  class ItemsView extends ItemsModel
    {
      public function displayItems($itemId) {
        if ($itemId == "all" || filter_var($itemId, FILTER_VALIDATE_INT) == true) {
          $result = $this->fetchElements($itemId);

          return $result;
        } else {
          header("location: index.php?error=invalidargument");
          exit();
        }
      }
    }
