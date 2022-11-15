<?php
  require "includes/autoloader.inc.php";
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <title>kfzteile</title>

  <meta charset="utf-8" />
  <meta name="author" content="kfzteile GmbH">
  <meta name="description" content="Ein Übersichtsseite für Autoteile" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="styling/main.css" />
</head>
<body>
  <header>
    <h1>kfzteile</h1>
  </header>
  <nav>
    <span class="url-nav"><a href="index.php">Übersicht</a><?php echo (isset($_GET["display"]) && $_GET["display"] !== "add") ? ' / <a href="index.php?display='.$_GET["display"].'">#'.$_GET["display"].'</a>' : ''; ?></span>
  </nav>
  <main>
    <?php
      // the following arrays determine which categories i can choose from (add und update item)
      $categories = array("Reifen", "Elektronik", "Scheinwerfer", "Motor");
      $cars = array("Skoda", "Audi", "BMW", "Volvo");

      // instiante the class of the ItemsView to display items / editable items
      $objItem = new ItemsView;

      if (!isset($_GET["display"]))
        {
          $itemId = "all";
          $results = $objItem->displayItems($itemId);
          $resultsRows = count($results) - 1;

          for ($i = 0; $i <= $resultsRows; $i++) {
            echo
            '<div class="item-container">
              <div class="item-image">
                <a class="action-link" href="index.php?display='.$results[$i]["item_id"].'"><i class="fa-solid fa-pen"></i> Bearbeiten</a>
              </div>
              <div class="item-information">
                <h2>'.$results[$i]["item_name"].'</h2>

                <p class="item-information-text">Kategorie: '.$results[$i]["item_category"].'</p>

                <p class="item-information-text">Lagerbestand: '.$results[$i]["item_stock"].'</p>

                <details>
                  <summary>Produktbeschreibung:</summary>
                  <p>'.$results[$i]["item_description"].'</p>
                </details>

                <details>
                  <summary>Lieferumfang:</summary>
                  <p>'.$results[$i]["item_delivery_scope"].'</p>
                </details>

                <p class="item-information-text">Kompatilität: '.$results[$i]["item_compatibility"].'</p>
              </div>
            </div>';
          }
    ?>
    <a class="action-link add-link" href="index.php?display=add"><i class="fa-solid fa-plus"></i> Hinzufügen</a>
    <?php
        }
      elseif ($_GET["display"] == "add")
        {
    ?>
    <form action="includes/requests.inc.php" method="POST">
      <input type="text" name="item-name" value="" placeholder="Name des Autoteiles" required />
      <select name="item-category" required>
        <option value="">Kategorie</option>
        <?php
          for ($i=0; $i <= count($categories) - 1; $i+=1) {
            echo '
            <option value="'.$categories[$i].'">'.$categories[$i].'</option>';
          }
        ?>
      </select>
      <input type="number" name="item-stock" min="0" value="" placeholder="Lagerbestand" required />
      <textarea name="item-description" placeholder="Produktbeschreibung" required></textarea>
      <textarea name="item-scope" placeholder="Lieferumfang" required></textarea>
      <select name="item-compatibility" required>
        <option value="">Kompatilität</option>
      <?php
        for ($i=0; $i <= count($cars) - 1; $i+=1) {
          echo '
          <option value="'.$cars[$i].'">'.$cars[$i].'</option>';
        }
      ?>
      </select>
      <!-- would be planned for the next feature-update: the ability to upload a picture to the item
      <p class="label">Wähle ein Beispielbild:</p>
      <input type="file" name="item-image" />
      -->
      <button class="action-button" type="submit" name="add-submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
    </form>
    <a class="action-link add-link" href="index.php"><i class="fa-solid fa-xmark"></i> Close</a>
    <?php
        }
      else
        {
          $itemId = $_GET["display"];
          $results = $objItem->displayItems($itemId);

            echo
            '<form action="includes/requests.inc.php" method="POST">
              <input type="hidden" name="item-id" value="'.$results[0]["item_id"].'" />
              <input type="text" name="item-name" value="'.$results[0]["item_name"].'" placeholder="Name des Autoteiles" required />
              <select name="item-category" required>
                <option value="">Kategorie</option>
              ';
              for ($i=0; $i <= count($categories) - 1; $i++) {
                echo '
                <option value="'.$categories[$i].'"'; echo ($results[0]["item_category"] == $categories[$i]) ? 'selected' : ''; echo '>'.$categories[$i].'</option>';
              }
              echo '
              </select>
              <input type="number" name="item-stock" min="0" value="'.$results[0]["item_stock"].'" placeholder="Lagerbestand" required />
              <textarea name="item-description" placeholder="Produktbeschreibung" required>'.$results[0]["item_description"].'</textarea>
              <textarea type="text" name="item-scope" placeholder="Lieferumfang" required>'.$results[0]["item_delivery_scope"].'</textarea>
              <select name="item-compatibility" required>
                <option value="">Kompatilität</option>';
                for ($i=0; $i <= count($cars) - 1; $i++) {
                  echo '
                  <option value="'.$cars[$i].'"'; echo ($results[0]["item_compatibility"] == $cars[$i]) ? 'selected' : ''; echo '>'.$cars[$i].'</option>';
                }
              echo '
              </select>
              <button class="action-button" type="submit" name="update-submit"><i class="fa-solid fa-arrows-rotate"></i> Update</button>
              <button class="action-button delete-button" type="submit" name="delete-submit"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>';
    ?>
    <a class="action-link add-link" href="index.php"><i class="fa-solid fa-xmark"></i> Close</a>
    <?php
      }
    ?>
  </main>
</body>
</html>
